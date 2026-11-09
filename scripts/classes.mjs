#!/usr/bin/env node
/**
 * Theme manifest and scaffolding (the replacement for b3rg's `npm run ng`).
 *
 *   npm run classes                                    Rebuild assets/json/ from the SCSS and feature folders.
 *   npm run add -- <block> <name>                      Add a modifier class ("Block Classes" multi-select).
 *   npm run add -- <block> <name> --style              Add a block style (single choice, core Styles panel).
 *   npm run add -- sections/<name>                     Add a section design (root class elite-section--<name>).
 *   npm run add -- sections/<name> <block> <part>      Add a part: a class for a block inside it.
 *   npm run add -- pages/<body-class> [<block> <part>] Add page-type styles (e.g. pages/single-post).
 *   npm run add -- layout/<part> [<block> <part>]      Add template part styles (layout/header).
 *   npm run add -- vendor/<plugin> --when <name>       Add styles for a plugin (loads while <name> is defined).
 *   Options: --js (also a view.js), --label "My label".
 *
 * <block> is `section` (short for elite/section) or a full name like `core/button`.
 * Its class base is the block name with a hyphen: `elite-section`, `core-button`.
 *
 * Feature folders (scripts/features.cjs) and what their files mean:
 *   blocks/elite-section/elite-section--dark.scss → class `elite-section--dark` in Block Classes
 *   blocks/core-button/style--outline.scss        → register_block_style(), class `is-style-outline`
 *   sections/hero/elite-section--hero.scss        → the section's root class (it loads the folder)
 *   sections/hero/elite-div--hero-media.scss      → a part: class for elite/div, "Hero › Hero Media"
 *   anything-else.scss                            → compiled in, no editor option
 *   view.js                                       → the folder's script (front end)
 *
 * It also writes, from assets/styles/abstracts/: colors.json (the editor
 * palette, from `$colors`), text-styles.json (the "Text Style" dropdown, from
 * `$text-styles`) and breakpoints.json (for theme scripts, from
 * `$grid-breakpoints` and `$devices`).
 */
import {
	existsSync,
	mkdirSync,
	readFileSync,
	readdirSync,
	statSync,
	writeFileSync,
} from 'node:fs';
import { createRequire } from 'node:module';
import { basename, dirname, join, relative } from 'node:path';
import { fileURLToPath } from 'node:url';
import { parseArgs } from 'node:util';
import * as sass from 'sass';

const require = createRequire( import.meta.url );
const {
	KINDS,
	NAME_PATTERN,
	SCRIPT,
	featureFolders,
} = require( './features.cjs' );

const THEME_DIR = join( dirname( fileURLToPath( import.meta.url ) ), '..' );
const ASSETS_DIR = join( THEME_DIR, 'assets' );
const ABSTRACTS_DIR = join( ASSETS_DIR, 'styles/abstracts' );
const JSON_DIR = join( ASSETS_DIR, 'json' );
const OUTPUT = join( JSON_DIR, 'manifest.json' );

const LABEL_PATTERN = /^\/\/\s*Label:\s*(.+)$/m;
const WHEN_PATTERN = /^\/\/\s*Active when:\s*([A-Za-z_\\][A-Za-z0-9_\\]*)\s*$/m;
const CLASS_FILE_PATTERN = /^([a-z0-9]+-[a-z0-9-]+?)--([a-z0-9-]+)\.scss$/;

/**
 * `elite/section` ↔ `elite-section`. The namespace is everything before the first hyphen.
 *
 * @param {string} folder Folder name.
 * @return {string} Block name.
 */
const folderToBlock = ( folder ) => folder.replace( '-', '/' );
const blockToFolder = ( block ) => block.replace( '/', '-' );

/**
 * Core blocks drop the namespace from their wrapper class (`wp-block-button`).
 *
 * @param {string} block Block name.
 * @return {string} Wrapper class.
 */
function wrapperClass( block ) {
	const [ ns, name ] = block.split( '/' );
	return ns === 'core' ? `wp-block-${ name }` : `wp-block-${ ns }-${ name }`;
}

/**
 * @param {string} folder Class base / folder, e.g. `elite-section`.
 * @param {string} name   Modifier name.
 * @return {string} Modifier class, e.g. `elite-section--dark`.
 */
const modifierClass = ( folder, name ) => `${ folder }--${ name }`;

/**
 * `primary-small` → `Primary Small` (as b3rg labels its classes).
 *
 * @param {string} slug Hyphenated name.
 * @return {string} Label.
 */
const titleCase = ( slug ) =>
	slug
		.split( '-' )
		.map( ( word ) => word.charAt( 0 ).toUpperCase() + word.slice( 1 ) )
		.join( ' ' );

/**
 * Escape a string for use inside a RegExp.
 *
 * @param {string} value Raw string.
 * @return {string} Escaped string.
 */
const escapeRegExp = ( value ) =>
	value.replace( /[.*+?^${}()|[\]\\]/g, '\\$&' );

/**
 * Label from a `// Label: …` comment, falling back to the file name.
 *
 * @param {string} file Absolute path.
 * @param {string} name Variant name.
 * @return {string} Label.
 */
function readLabel( file, name ) {
	const match = readFileSync( file, 'utf8' ).match( LABEL_PATTERN );
	return match ? match[ 1 ].trim() : titleCase( name );
}

/**
 * A block folder's entry: block styles and modifier classes.
 *
 * @param {{name: string, styles: string[], script: string|null}} feature Feature folder.
 * @return {{folder: string, styles: Array, modifiers: Array, script: boolean}} Entry.
 */
function blockEntry( feature ) {
	const folder = feature.name;
	const entry = {
		folder,
		styles: [],
		modifiers: [],
		script: !! feature.script,
	};
	const modifierPattern = new RegExp(
		`^${ escapeRegExp( folder ) }--([a-z0-9-]+)\\.scss$`
	);

	for ( const file of feature.styles ) {
		const name = basename( file );
		const style = name.match( /^style--([a-z0-9-]+)\.scss$/ );
		const modifier = name.match( modifierPattern );
		if ( style ) {
			entry.styles.push( {
				name: style[ 1 ],
				label: readLabel( file, style[ 1 ] ),
			} );
		} else if ( modifier ) {
			entry.modifiers.push( {
				value: modifierClass( folder, modifier[ 1 ] ),
				label: readLabel( file, modifier[ 1 ] ),
			} );
		}
	}
	return entry;
}

/**
 * A layout, section, page or vendor folder's entry: its classes (by block),
 * what loads it, and whether it has a script.
 *
 * @param {{kind: string, name: string, styles: string[], script: string|null}} feature Feature folder.
 * @return {{modifiers: Record<string, Array>, script: boolean, trigger?: string, when?: string}} Entry.
 */
function featureEntry( feature ) {
	const where = `${ feature.kind }/${ feature.name }`;
	const classes = feature.styles
		.map( ( file ) => [
			file,
			basename( file ).match( CLASS_FILE_PATTERN ),
		] )
		.filter( ( [ , match ] ) => match )
		.map( ( [ file, [ , base, name ] ] ) => ( {
			file,
			block: folderToBlock( base ),
			value: modifierClass( base, name ),
			name,
		} ) );
	const entry = { modifiers: {}, script: !! feature.script };

	// Parts are labelled under the feature: "Hero › Media".
	let group = titleCase( feature.name );
	if ( feature.kind === 'sections' ) {
		const root = classes.find( ( c ) => c.name === feature.name );
		if ( ! root ) {
			fail(
				`${ where }: needs a root class file named after the folder, e.g. elite-section--${ feature.name }.scss (the class that loads it).`
			);
		}
		entry.trigger = root.value;
		group = readLabel( root.file, feature.name );
	}
	if ( feature.kind === 'vendor' ) {
		const when = feature.styles
			.map( ( file ) =>
				readFileSync( file, 'utf8' ).match( WHEN_PATTERN )
			)
			.find( Boolean );
		if ( ! when ) {
			fail(
				`${ where }: add "// Active when: <constant, class or function>" (e.g. MEGAMENU_VERSION) to one of its SCSS files.`
			);
		}
		entry.when = when[ 1 ];
		return entry; // A plugin's markup: no classes to offer.
	}

	for ( const c of classes ) {
		const label = readLabel( c.file, c.name );
		( entry.modifiers[ c.block ] ??= [] ).push( {
			value: c.value,
			label:
				c.value === entry.trigger ? label : `${ group } › ${ label }`,
		} );
	}
	return entry;
}

/**
 * Folders the build skips because of their name (it must be lowercase
 * letters, numbers and hyphens): say so, or their files would silently
 * never load.
 */
function warnSkippedFolders() {
	for ( const kind of KINDS ) {
		const kindDir = join( ASSETS_DIR, kind );
		if ( ! existsSync( kindDir ) ) {
			continue;
		}
		for ( const name of readdirSync( kindDir ) ) {
			if (
				! NAME_PATTERN.test( name ) &&
				! name.startsWith( '.' ) &&
				statSync( join( kindDir, name ) ).isDirectory()
			) {
				console.warn(
					`Skipped assets/${ kind }/${ name }: folder names are lowercase letters, numbers and hyphens (e.g. ${ name
						.toLowerCase()
						.replace( /[^a-z0-9-]+/g, '-' ) }).`
				);
			}
		}
	}
}

/**
 * Scan the feature folders and write assets/json/manifest.json.
 *
 * @return {Record<string, Record<string, Object>>} The manifest, by kind.
 */
function generate() {
	warnSkippedFolders();
	const manifest = Object.fromEntries(
		KINDS.map( ( kind ) => [ kind, {} ] )
	);
	const owners = new Map();

	for ( const feature of featureFolders( THEME_DIR ) ) {
		if ( feature.kind === 'blocks' ) {
			if ( ! feature.name.includes( '-' ) ) {
				continue;
			}
			manifest.blocks[ folderToBlock( feature.name ) ] =
				blockEntry( feature );
		} else {
			manifest[ feature.kind ][ feature.name ] = featureEntry( feature );
		}
	}

	// One class, one meaning: the same class from two folders would show
	// twice in Block Classes and load either folder's styles.
	for ( const [ kind, entries ] of Object.entries( manifest ) ) {
		for ( const [ key, entry ] of Object.entries( entries ) ) {
			const lists = Array.isArray( entry.modifiers )
				? [ entry.modifiers ]
				: Object.values( entry.modifiers ?? {} );
			for ( const { value } of lists.flat() ) {
				const owner = `${ kind }/${ kind === 'blocks' ? entry.folder : key }`;
				if ( owners.has( value ) && owners.get( value ) !== owner ) {
					fail(
						`Class "${ value }" is in both ${ owners.get( value ) } and ${ owner }. Rename one (e.g. prefix it with the section's name).`
					);
				}
				owners.set( value, owner );
			}
		}
	}

	mkdirSync( JSON_DIR, { recursive: true } );
	writeFileSync( OUTPUT, JSON.stringify( manifest, null, '\t' ) + '\n' );

	const counts = KINDS.map(
		( kind ) => `${ Object.keys( manifest[ kind ] ).length } ${ kind }`
	).join( ', ' );
	console.log(
		`manifest: ${ owners.size } class(es); ${ counts } → ${ relative( THEME_DIR, OUTPUT ) }`
	);
	return manifest;
}

/**
 * Create a file (never overwrites).
 *
 * @param {string} file    Absolute path.
 * @param {string} content File content.
 */
function create( file, content ) {
	if ( existsSync( file ) ) {
		fail( `${ relative( THEME_DIR, file ) } already exists.` );
	}
	mkdirSync( dirname( file ), { recursive: true } );
	writeFileSync( file, content );
	console.log( `add: created ${ relative( THEME_DIR, file ) }` );
}

/**
 * `section` → `elite/section`; checks the name.
 *
 * @param {string} raw Block as typed.
 * @return {string} Block name.
 */
function blockName( raw ) {
	const block = raw.includes( '/' ) ? raw : `elite/${ raw }`;
	if ( ! /^[a-z0-9-]+\/[a-z0-9-]+$/.test( block ) ) {
		fail(
			`Invalid block name "${ block }". Use "section" or "core/button".`
		);
	}
	return block;
}

/**
 * @param {string} name Name as typed.
 * @return {string} The name, if valid.
 */
function checkName( name ) {
	if ( ! NAME_PATTERN.test( name ?? '' ) ) {
		fail(
			`Invalid name "${ name ?? '' }". Use lowercase letters, numbers and hyphens.`
		);
	}
	return name;
}

/**
 * Create files, then regenerate the manifest.
 *
 * @param {string[]} argv CLI arguments after `add`.
 */
function add( argv ) {
	const { values, positionals } = parseArgs( {
		args: argv,
		allowPositionals: true,
		options: {
			style: { type: 'boolean', short: 's', default: false },
			label: { type: 'string', short: 'l' },
			js: { type: 'boolean', default: false },
			when: { type: 'string' },
		},
	} );
	const [ first, ...rest ] = positionals;
	if ( ! first ) {
		fail(
			'Usage: npm run add -- <block> <name> [--style] | sections/<name> | pages/<body-class> | layout/<part> | vendor/<plugin> [<block> <part>] [--js] [--label "Label"]'
		);
	}

	const feature = first.match( /^(layout|sections|pages|vendor)\/(.+)$/ );
	const dir = feature
		? join( ASSETS_DIR, feature[ 1 ], checkName( feature[ 2 ] ) )
		: addToBlock( first, rest, values );
	if ( feature ) {
		addToFeature( feature[ 1 ], feature[ 2 ], dir, rest, values );
	}
	if ( values.js && ! existsSync( join( dir, SCRIPT ) ) ) {
		create( join( dir, SCRIPT ), starterScript( dir ) );
	}

	generateAll();
	console.log(
		'Restart `npm start` if it is running so webpack picks up new folders.'
	);
}

/**
 * `npm run add -- <block> <name>`: a modifier or block style.
 *
 * @param {string}   rawBlock Block as typed.
 * @param {string[]} rest     [name].
 * @param {Object}   values   Options.
 * @return {string} The block's folder.
 */
function addToBlock( rawBlock, rest, values ) {
	const block = blockName( rawBlock );
	const name = checkName( rest[ 0 ] );
	const folder = blockToFolder( block );
	const dir = join( ASSETS_DIR, 'blocks', folder );
	const label = values.label ?? titleCase( name );
	const selector = values.style
		? `.${ wrapperClass( block ) }.is-style-${ name }`
		: `.${ modifierClass( folder, name ) }`;
	const where = values.style
		? 'core Styles panel (single choice)'
		: 'Block Classes (multi-select)';

	create(
		join(
			dir,
			values.style
				? `style--${ name }.scss`
				: `${ modifierClass( folder, name ) }.scss`
		),
		`// Label: ${ label }\n// ${ block } → ${ where }.\n\n${ selector } {\n${ starterBody(
			folder,
			values.style
		) }}\n`
	);
	return dir;
}

/**
 * `npm run add -- <kind>/<name> [<block> <part>]`: a feature folder (its
 * first file), or a part (a class for a block inside it).
 *
 * @param {string}   kind   layout, sections, pages or vendor.
 * @param {string}   name   Folder name.
 * @param {string}   dir    Folder.
 * @param {string[]} rest   [block, part].
 * @param {Object}   values Options.
 */
function addToFeature( kind, name, dir, rest, values ) {
	const isNew = ! existsSync( dir );
	const group = titleCase( name );
	const scope = {
		layout: `.site-${ name }`,
		sections: `.elite-section--${ name }`,
		pages: `body.${ name }`,
	}[ kind ];

	// Check everything before writing anything.
	if ( rest.length && kind === 'vendor' ) {
		fail( 'Vendor folders style a plugin’s own markup: no parts.' );
	}
	const block = rest.length ? blockName( rest[ 0 ] ) : null;
	const part = rest.length ? checkName( rest[ 1 ] ) : null;
	if ( isNew && kind === 'vendor' && ! values.when ) {
		fail(
			'Say when the plugin is active: --when <constant, class or function>, e.g. --when MEGAMENU_VERSION.'
		);
	}
	if ( ! isNew && ! rest.length && ! values.js ) {
		fail(
			`${ relative( THEME_DIR, dir ) } exists. Add a part with: npm run add -- ${ kind }/${ name } <block> <part>`
		);
	}

	if ( isNew ) {
		if ( kind === 'sections' ) {
			const label = rest.length ? group : ( values.label ?? group );
			create(
				join( dir, `elite-section--${ name }.scss` ),
				`// Label: ${ label }\n// elite/section → Block Classes. This class loads the folder (styles and\n// view.js) on pages that use it; style the section's parts under it.\n\n${ scope } {\n${ starterBody( 'elite-section', false ) }}\n`
			);
		} else if ( kind === 'vendor' ) {
			create(
				join( dir, `${ name }.scss` ),
				`// ${ group }: loaded on every page while the plugin is active.\n// Active when: ${ values.when }\n\n// Add styles here.\n`
			);
		} else {
			const what =
				kind === 'layout'
					? `the "${ name }" template part: loads on pages that show it`
					: `pages with the body class "${ name }"`;
			create(
				join( dir, `${ name }.scss` ),
				`// Styles for ${ what }.\n// Classes for blocks in it:\n// npm run add -- ${ kind }/${ name } <block> <part>\n\n${ scope } {\n\t// Add styles here.\n}\n`
			);
		}
	}

	if ( block ) {
		const folder = blockToFolder( block );
		const label = values.label ?? titleCase( part );
		const nested =
			kind === 'sections'
				? `${ scope } .${ folder }--${ part }`
				: `.${ folder }--${ part }`;
		create(
			join( dir, `${ modifierClass( folder, part ) }.scss` ),
			`// Label: ${ label }\n// ${ block } → Block Classes, under "${ group }".\n// Loads with ${ kind }/${ name }.\n\n${ nested } {\n\t// Add styles here.\n}\n`
		);
	}
}

/**
 * Body of a new variant file. Section modifiers get spacing hints: values set
 * in the CMS (Spacing - Top/Bottom) always win over these.
 *
 * @param {string}  folder  Class base, e.g. `elite-section`.
 * @param {boolean} isStyle Whether this is a block style.
 * @return {string} SCSS lines.
 */
function starterBody( folder, isStyle ) {
	if ( folder !== 'elite-section' || isStyle ) {
		return '\t// Add styles here.\n';
	}
	return [
		'\t// Add styles here.',
		'',
		'\t// Margin: use these variables (plain margin-* loses to WordPress layout CSS).',
		'\t// --section-margin-top: 80px;',
		'\t// --section-margin-bottom: 80px;',
		'',
		'\t// Padding: on .section-inner.',
		'\t// .section-inner {',
		'\t// \tpadding-top: 80px;',
		'\t// \tpadding-bottom: 80px;',
		'\t// }',
		'',
	].join( '\n' );
}

/**
 * A new view.js: each copy of the feature on the page set up on its own.
 *
 * @param {string} dir Feature folder.
 * @return {string} JS.
 */
function starterScript( dir ) {
	const [ kind, name ] = relative( ASSETS_DIR, dir ).split( /[\\/]/ );
	const selector = {
		blocks: `.${ name }`,
		layout: `.site-${ name }`,
		sections: `.elite-section--${ name }`,
		pages: 'main',
		vendor: 'body',
	}[ kind ];
	return [
		'/**',
		` * ${ titleCase( name ) } (${ kind }/${ name }): loads only where its styles do, deferred.`,
		' */',
		"import { onReady } from '../../utils';",
		'',
		'/**',
		' * Set up one copy (each copy on the page works on its own).',
		' *',
		' * @param {HTMLElement} element The element.',
		' */',
		'function setUp( element ) {',
		'\t// Style the ready state with .is-ready if needed.',
		"\telement.classList.add( 'is-ready' );",
		'}',
		'',
		'onReady( () => {',
		`\tconst selector = '${ selector }';`,
		'\tdocument.querySelectorAll( selector ).forEach( setUp );',
		'} );',
		'',
	].join( '\n' );
}

function fail( message ) {
	console.error( message );
	process.exit( 1 );
}

/**
 * The entries of an abstracts map, compiled with Sass (so any valid value
 * works: hex, rgba, functions, units).
 *
 * @param {string} module   Abstracts partial, e.g. `colors`.
 * @param {string} variable Map variable, e.g. `colors`.
 * @return {Array<[string, string]>} Key/value pairs, in order.
 */
function readMap( module, variable ) {
	if ( ! existsSync( join( ABSTRACTS_DIR, `_${ module }.scss` ) ) ) {
		return [];
	}
	const { css } = sass.compileString(
		`@use "sass:meta";\n@use "${ module }" as m;\n.map { @each $key, $value in m.$${ variable } { --v-#{$key}: #{meta.inspect($value)}; } }`,
		{ loadPaths: [ ABSTRACTS_DIR ], style: 'expanded' }
	);
	return [ ...css.matchAll( /^\s+--v-([a-z0-9-]+):\s*(.+?);$/gm ) ].map(
		( [ , key, value ] ) => [ key, value ]
	);
}

/**
 * Write a generated JSON file.
 *
 * @param {string}       name File name in assets/json.
 * @param {Object|Array} data Data.
 * @param {string}       what Summary for the console.
 */
function writeJson( name, data, what ) {
	const file = join( JSON_DIR, name );
	mkdirSync( JSON_DIR, { recursive: true } );
	writeFileSync( file, JSON.stringify( data, null, '\t' ) + '\n' );
	console.log( `${ what } → ${ relative( THEME_DIR, file ) }` );
}

/**
 * assets/json/colors.json: the `$colors` map as WordPress palette entries.
 */
function generateColors() {
	const palette = readMap( 'colors', 'colors' ).map(
		( [ slug, color ] ) => ( {
			slug,
			name: titleCase( slug ),
			color,
		} )
	);
	writeJson(
		'colors.json',
		palette,
		`colors: ${ palette.length } colour(s)`
	);
}

/**
 * assets/json/text-styles.json: the `$text-styles` keys, for the editor's
 * "Text Style" dropdown (not the components' own, `editor: false`).
 */
function generateTextStyles() {
	const styles = readMap( 'text-styles', 'text-styles' )
		.filter( ( [ , value ] ) => ! /\beditor:\s*false\b/.test( value ) )
		.map( ( [ slug ] ) => ( {
			slug,
			name: titleCase( slug ),
		} ) );
	writeJson( 'text-styles.json', styles, `text styles: ${ styles.length }` );
}

/**
 * assets/json/breakpoints.json, for theme scripts: `grid` ($grid-breakpoints,
 * Bootstrap's, in px) and `devices` (each device's breakpoint in px: a
 * device is below it).
 */
function generateBreakpoints() {
	const px = ( [ key, value ] ) => {
		if ( ! /^\d+(\.\d+)?(px)?$/.test( value ) ) {
			fail(
				`$grid-breakpoints: ${ key } must be in px (got ${ value }).`
			);
		}
		return [ key, parseFloat( value ) ];
	};
	const grid = Object.fromEntries(
		readMap( 'breakpoints', 'grid-breakpoints' ).map( px )
	);
	const devices = Object.fromEntries(
		readMap( 'breakpoints', 'devices' ).map( ( [ device, name ] ) => {
			if ( ! ( name in grid ) ) {
				fail(
					`$devices: ${ device } names "${ name }", not in $grid-breakpoints.`
				);
			}
			return [ device, grid[ name ] ];
		} )
	);
	writeJson(
		'breakpoints.json',
		{ grid, devices },
		`breakpoints: ${ Object.keys( grid ).join( ', ' ) }; devices: ${ Object.keys( devices ).join( ', ' ) }`
	);
}

function generateAll() {
	generate();
	generateColors();
	generateTextStyles();
	generateBreakpoints();
}

const [ command, ...rest ] = process.argv.slice( 2 );
if ( command === 'add' ) {
	add( rest );
} else {
	generateAll();
}
