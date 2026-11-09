#!/bin/bash
# Joins the recorded parts (take/<part>/f*.jpg + timestamps.json) with short
# crossfades into demo.mp4 (H.264), demo.webm (VP9) and demo-poster.jpg.
set -euo pipefail
TAKE=${1:-take}; OUT=${2:-out}; FADE=0.5
mkdir -p "$OUT/parts"
parts=()
for dir in "$TAKE"/*/; do
	name=$(basename "$dir")
	python3 - "$dir" > "$OUT/parts/$name.txt" <<'PY'
import json, sys, os
d = sys.argv[1]
ts = json.load(open(os.path.join(d, 'timestamps.json')))
for i, t in enumerate(ts):
    dur = (ts[i + 1] - t) if i + 1 < len(ts) else 0.6
    print(f"file '{os.path.abspath(os.path.join(d, f'f{i:05d}.jpg'))}'\nduration {max(dur, 0.001):.4f}")
print(f"file '{os.path.abspath(os.path.join(d, f'f{len(ts) - 1:05d}.jpg'))}'")
PY
	# The editor part plays a little faster (typing still reads naturally).
	speed=""; [[ "$name" == *build* ]] && speed=",setpts=PTS/1.3"
	ffmpeg -y -loglevel error -f concat -safe 0 -i "$OUT/parts/$name.txt" -vf "fps=30${speed},fps=30,format=yuv420p" -c:v libx264 -preset fast -crf 10 "$OUT/parts/$name.mp4"
	parts+=("$OUT/parts/$name.mp4")
done
# Crossfade them in order.
inputs=(); filter=""; offset=0; prev="0:v"
for i in "${!parts[@]}"; do inputs+=(-i "${parts[$i]}"); done
for ((i = 1; i < ${#parts[@]}; i++)); do
	d=$(ffprobe -v error -show_entries format=duration -of csv=p=0 "${parts[$((i - 1))]}")
	offset=$(python3 -c "print(round($offset + $d - $FADE, 3))")
	label="v$i"; [ $i -eq $((${#parts[@]} - 1)) ] && label="out"
	filter+="[$prev][$i:v]xfade=transition=fade:duration=$FADE:offset=$offset[$label];"
	prev=$label
done
ffmpeg -y -loglevel error "${inputs[@]}" -filter_complex "${filter%;}" -map "[out]" -r 30 -pix_fmt yuv420p -c:v libx264 -preset slow -crf 24 -profile:v high -movflags +faststart -an "$OUT/demo.mp4"
ffmpeg -y -loglevel error -i "$OUT/demo.mp4" -c:v libvpx-vp9 -crf 42 -b:v 0 -row-mt 1 -deadline good -cpu-used 2 -an "$OUT/demo.webm"
ffmpeg -y -loglevel error -ss 2.6 -i "$OUT/demo.mp4" -frames:v 1 -q:v 5 "$OUT/demo-poster.jpg"
ls -la "$OUT"/demo.*  "$OUT"/demo-poster.jpg
ffprobe -v error -show_entries format=duration -of csv=p=0 "$OUT/demo.mp4"
