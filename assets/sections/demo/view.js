/**
 * Demo (sections/demo): as the video scrolls in, it grows from an inset
 * rounded card to the full width (sets --p from 0 to 1; the styles are in
 * elite-div--demo-media.scss). Visitors who ask for less motion, and the
 * editor (no script), see it full width. The video itself (lazy loading,
 * pause button) is Elite Blocks' background video.
 */
import { onReady, prefersReducedMotion } from '../../utils';

/**
 * Set up one video.
 *
 * @param {HTMLElement} media The video's Div.
 */
function setUp( media ) {
	if ( prefersReducedMotion() ) {
		return;
	}
	media.classList.add( 'is-growing' );

	// Grown once most of it is on screen; checked at most once a frame.
	let queued = false;
	const update = () => {
		queued = false;
		const box = media.getBoundingClientRect();
		const reach = Math.min( box.height, window.innerHeight ) * 0.85;
		const progress = Math.min(
			1,
			Math.max( 0, ( window.innerHeight - box.top ) / reach )
		);
		media.style.setProperty( '--p', progress.toFixed( 3 ) );
	};
	const queue = () => {
		if ( ! queued ) {
			queued = true;
			window.requestAnimationFrame( update );
		}
	};
	window.addEventListener( 'scroll', queue, { passive: true } );
	window.addEventListener( 'resize', queue );
	update();
}

onReady( () => {
	document
		.querySelectorAll( '.elite-section--demo .elite-div--demo-media' )
		.forEach( setUp );
} );
