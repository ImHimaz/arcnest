const path = require( 'path' );
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const { featureFolders } = require( './scripts/features.cjs' );

/**
 * Entries: the global styles, then one per feature folder (assets/blocks,
 * layout, sections, pages, vendor → build/<kind>/<name>.css and .js), and
 * the editor's copy of every layout, section and page style (the editor
 * can't know which a post will use).
 *
 * @return {Record<string, string[]>} Webpack entries.
 */
function entries() {
	const features = featureFolders( __dirname );
	const editorFeatures = features
		.filter( ( f ) => [ 'layout', 'sections', 'pages' ].includes( f.kind ) )
		.flatMap( ( f ) => f.styles );

	return {
		theme: [ path.resolve( __dirname, 'assets/styles/main.scss' ) ],
		editor: [ path.resolve( __dirname, 'assets/styles/editor.scss' ) ],
		...( editorFeatures.length && { 'editor-features': editorFeatures } ),
		...Object.fromEntries(
			features.map( ( f ) => [
				`${ f.kind }/${ f.name }`,
				[ ...( f.script ? [ f.script ] : [] ), ...f.styles ],
			] )
		),
	};
}

module.exports = {
	...defaultConfig,
	entry: entries,
};
