/**
 * Feature folders: one folder = one feature (its styles and, optionally, its
 * script), built to build/<kind>/<name>.css|js and loaded only where it's
 * used (inc/assets.php). Shared by webpack.config.js and scripts/classes.mjs.
 *
 *   assets/blocks/<block-class>/  with that block (e.g. elite-button)
 *   assets/layout/<part>/         with that template part (header, footer)
 *   assets/sections/<name>/       on pages using its class (elite-section--<name>)
 *   assets/pages/<body-class>/    on pages with that body class (single-post, search)
 *   assets/vendor/<plugin>/       while that plugin is active (`// Active when:`)
 *
 * In each: every `*.scss` not starting with `_` is compiled into one CSS
 * file, and `view.js` (if any) into one script.
 */
const fs = require( 'fs' );
const path = require( 'path' );

const KINDS = [ 'blocks', 'layout', 'sections', 'pages', 'vendor' ];
const SCRIPT = 'view.js';
const NAME_PATTERN = /^[a-z0-9][a-z0-9-]*$/;

/**
 * Every feature folder.
 *
 * @param {string} themeDir Theme root.
 * @return {Array<{kind: string, name: string, dir: string, styles: string[], script: string|null}>} Features, by kind then name.
 */
function featureFolders( themeDir ) {
	const features = [];
	for ( const kind of KINDS ) {
		const kindDir = path.join( themeDir, 'assets', kind );
		if ( ! fs.existsSync( kindDir ) ) {
			continue;
		}
		for ( const name of fs.readdirSync( kindDir ).sort() ) {
			const dir = path.join( kindDir, name );
			if (
				! NAME_PATTERN.test( name ) ||
				! fs.statSync( dir ).isDirectory()
			) {
				continue;
			}
			const files = fs.readdirSync( dir ).sort();
			const script = files.includes( SCRIPT )
				? path.join( dir, SCRIPT )
				: null;
			const styles = files
				.filter(
					( f ) => f.endsWith( '.scss' ) && ! f.startsWith( '_' )
				)
				.map( ( f ) => path.join( dir, f ) );
			if ( styles.length || script ) {
				features.push( { kind, name, dir, styles, script } );
			}
		}
	}
	return features;
}

module.exports = { KINDS, SCRIPT, NAME_PATTERN, featureFolders };
