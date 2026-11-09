// Records the Arcnest demo: a title card, then building a new hero in the
// WordPress editor with Elite Blocks (section, Block Classes, columns,
// heading, text, button with an icon, an image that opens in a popup),
// publishing it and opening the popup on the page, then an end card.
// Each part is JPEG frames from a CDP screencast with timestamps; encode.sh
// joins and encodes them.
//
//   node record.mjs <out-dir>
import { chromium } from '/Users/Himaz/Projects/elite-blocks/node_modules/playwright/index.mjs';
import fs from 'node:fs';
import path from 'node:path';

const SITE = 'http://localhost:8892';
const IMAGE_ID = Number( process.env.IMAGE_ID || 41 );
const OUT = process.argv[2] || path.resolve( 'take' );
const DEBUG = process.env.DEBUG_SHOTS === '1';
fs.rmSync( OUT, { recursive: true, force: true } );
fs.mkdirSync( OUT, { recursive: true } );

const CURSOR = `(() => {
	if (window.top !== window || document.getElementById('__rec-cursor')) return;
	const add = () => {
		const c = document.createElement('div');
		c.id = '__rec-cursor';
		c.innerHTML = '<svg width="28" height="28" viewBox="0 0 24 24"><path d="M5 3l14 8-6.5 1.5L9.5 19z" fill="#16101c" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/></svg>';
		Object.assign(c.style, { position: 'fixed', left: '0', top: '0', zIndex: 2147483647, pointerEvents: 'none', transform: 'translate(960px, 560px)', transition: 'transform 0ms', filter: 'drop-shadow(0 2px 3px rgb(0 0 0 / .35))' });
		document.documentElement.appendChild(c);
		window.__cursor = {
			move(x, y, ms) { c.style.transition = 'transform ' + ms + 'ms cubic-bezier(.45,.05,.25,1)'; c.style.transform = 'translate(' + (x - 4) + 'px,' + (y - 3) + 'px)'; },
			jump(x, y) { c.style.transition = 'transform 0ms'; c.style.transform = 'translate(' + (x - 4) + 'px,' + (y - 3) + 'px)'; },
			ripple(x, y) {
				const r = document.createElement('div');
				Object.assign(r.style, { position: 'fixed', left: (x - 18) + 'px', top: (y - 18) + 'px', width: '36px', height: '36px', borderRadius: '50%', background: 'rgb(215 223 35 / .55)', zIndex: 2147483646, pointerEvents: 'none', transform: 'scale(.3)', opacity: '1', transition: 'transform 450ms ease-out, opacity 450ms ease-out' });
				document.documentElement.appendChild(r);
				requestAnimationFrame(() => { r.style.transform = 'scale(1.4)'; r.style.opacity = '0'; });
				setTimeout(() => r.remove(), 500);
			},
		};
	};
	// The editor without the admin bar (fullscreen, as WordPress shows it by default).
	if (location.pathname.indexOf('/wp-admin/post') === 0) {
		const css = document.createElement('style');
		css.textContent = '#wpadminbar{display:none!important}html.wp-toolbar{padding-top:0!important}.interface-interface-skeleton{top:0!important}';
		(document.head || document.documentElement).appendChild(css);
	}
	if (document.documentElement) add(); else document.addEventListener('DOMContentLoaded', add);
})();`;

const browser = await chromium.launch();
// The theme's font, inlined: a card page can't load it from the site (fonts need CORS).
const FONT = 'data:font/woff2;base64,' + fs.readFileSync( '/Users/Himaz/Projects/arcnest/assets/fonts/plus-jakarta-sans/PlusJakartaSans-Latin-VariableFont_wght.woff2' ).toString( 'base64' );

// Screencast frames of a page into <OUT>/<part>/.
const castInto = async ( page, part ) => {
	const dir = path.join( OUT, part );
	fs.mkdirSync( dir, { recursive: true } );
	const cdp = await page.context().newCDPSession( page );
	const stamps = [];
	let writing = Promise.resolve();
	cdp.on( 'Page.screencastFrame', ( frame ) => {
		const index = stamps.length;
		stamps.push( frame.metadata.timestamp );
		writing = writing.then( () => fs.promises.writeFile( path.join( dir, `f${ String( index ).padStart( 5, '0' ) }.jpg` ), Buffer.from( frame.data, 'base64' ) ) );
		cdp.send( 'Page.screencastFrameAck', { sessionId: frame.sessionId } ).catch( () => {} );
	} );
	await cdp.send( 'Page.startScreencast', { format: 'jpeg', quality: 92, maxWidth: 1920, maxHeight: 1080, everyNthFrame: 1 } );
	return async () => {
		await cdp.send( 'Page.stopScreencast' );
		await writing;
		fs.writeFileSync( path.join( dir, 'timestamps.json' ), JSON.stringify( stamps ) );
		return stamps.length;
	};
};

// A title card: brand purple, lime, the site's font; text rises in.
const card = async ( part, html, seconds ) => {
	const page = await browser.newPage( { viewport: { width: 1920, height: 1080 } } );
	await page.setContent( `<!doctype html><html><head><style>
		@font-face { font-family: Jakarta; src: url(${ FONT }) format("woff2"); font-weight: 200 800; }
		html, body { margin: 0; height: 100%; }
		body { display: grid; place-content: center; justify-items: center; gap: 28px; text-align: center; color: #fff; font-family: Jakarta, sans-serif; overflow: hidden;
			background: radial-gradient(60% 80% at 75% 105%, rgb(146 46 186 / .75), transparent 70%), radial-gradient(40% 50% at 15% 0%, rgb(215 223 35 / .16), transparent 70%), #26062f; }
		.eyebrow { display: inline-flex; gap: 14px; align-items: center; color: #d7df23; font-size: 26px; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; }
		.eyebrow::before { content: ""; width: 12px; height: 12px; border-radius: 50%; background: #d7df23; }
		h1 { margin: 0; font-size: 132px; font-weight: 700; letter-spacing: -.04em; line-height: .98; }
		p { margin: 0; color: rgb(255 255 255 / .75); font-size: 38px; }
		.dot { color: #d7df23; }
		.rise { animation: rise 1s cubic-bezier(.2,.7,.2,1) both; }
		.rise:nth-child(2) { animation-delay: .12s; } .rise:nth-child(3) { animation-delay: .24s; }
		@keyframes rise { from { opacity: 0; transform: translateY(40px); } }
	</style></head><body>${ html }</body></html>` );
	await page.evaluate( () => document.fonts.ready );
	const stop = await castInto( page, part );
	await page.waitForTimeout( seconds * 1000 );
	const frames = await stop();
	await page.close();
	return frames;
};

await card( '1-intro', '<div class="eyebrow rise">See it in action</div><h1 class="rise">Build a hero<br>in minutes<span class="dot">.</span></h1><p class="rise">Native WordPress blocks with Elite Blocks. No page builder.</p>', 3.2 );

// ---- The editor ----
const context = await browser.newContext( { viewport: { width: 1920, height: 1080 }, reducedMotion: 'no-preference' } );
await context.addInitScript( CURSOR );
const page = await context.newPage();
const sleep = ( ms ) => page.waitForTimeout( ms );
let shot = 0;
const debug = async ( name ) => {
	if ( DEBUG ) {
		await page.screenshot( { path: path.join( OUT, `debug-${ String( ++shot ).padStart( 2, '0' ) }-${ name }.png` ) } );
	}
};

await page.goto( `${ SITE }/wp-login.php` );
await page.fill( '#user_login', 'admin' );
await page.fill( '#user_pass', 'password' );
await page.click( '#wp-submit' );
await page.waitForURL( /wp-admin/ );
await page.goto( `${ SITE }/wp-admin/post-new.php?post_type=page` );
await page.waitForFunction( () => window.wp?.data?.select( 'core/editor' )?.getCurrentPostId() );
await page.evaluate( () => {
	const prefs = window.wp.data.dispatch( 'core/preferences' );
	prefs.set( 'core/edit-post', 'welcomeGuide', false );
	prefs.set( 'core', 'enableChoosePatternModal', false );
	prefs.set( 'core', 'fixedToolbar', false );
} );
await sleep( 1500 );
await page.goto( `${ SITE }/wp-admin/post-new.php?post_type=page` );
await page.waitForFunction( () => window.wp?.data?.select( 'core/editor' )?.getCurrentPostId() );
const canvas = page.frameLocator( 'iframe[name="editor-canvas"]' );
await canvas.locator( '.editor-post-title' ).waitFor();
// The editor without the admin bar (fullscreen), and no plugin suggestions in search.
await page.addStyleTag( { content: '#wpadminbar{display:none!important}html.wp-toolbar{padding-top:0!important}.interface-interface-skeleton{top:0!important}.block-directory-downloadable-blocks-panel{display:none!important}' } );
await page.keyboard.press( 'Escape' );
await sleep( 800 );

// Cursor: glide to a point or an element's centre, optionally click.
let at = { x: 960, y: 540 };
const glide = async ( x, y ) => {
	const ms = Math.min( 900, Math.max( 350, Math.hypot( x - at.x, y - at.y ) * 0.9 ) );
	await page.evaluate( ( [ px, py, d ] ) => window.__cursor?.move( px, py, d ), [ x, y, ms ] );
	await page.mouse.move( x, y, { steps: Math.round( ms / 16 ) } );
	at = { x, y };
	await sleep( Math.max( 0, ms - ( ms / 16 ) * 2 ) + 120 );
};
const centre = async ( locator ) => {
	await locator.waitFor( { state: 'visible' } );
	await locator.scrollIntoViewIfNeeded();
	const box = await locator.boundingBox();
	return [ box.x + box.width / 2, box.y + box.height / 2 ];
};
const clickOn = async ( locator, pause = 350 ) => {
	const [ x, y ] = await centre( locator );
	await glide( x, y );
	await page.evaluate( ( [ px, py ] ) => window.__cursor?.ripple( px, py ), [ x, y ] );
	await page.mouse.click( x, y );
	await sleep( pause );
};
const type = async ( text, delay = 50 ) => page.keyboard.type( text, { delay } );
const insp = page.locator( '.block-editor-block-inspector' );
const tab = ( name ) => insp.getByRole( 'tab', { name } ).first();
const classes = async ( names ) => {
	await clickOn( tab( 'Styles' ), 500 );
	await clickOn( insp.locator( 'input[id^="react-select"]' ).first(), 250 );
	for ( const name of names ) {
		await type( name, 70 );
		await sleep( 450 );
		await page.keyboard.press( 'Enter' );
		await sleep( 500 );
	}
	await page.keyboard.press( 'Escape' );
	await sleep( 700 );
};
const column = ( n ) => canvas.locator( '.elite-column' ).nth( n );

const stopEditor = await castInto( page, '2-build' );
await page.evaluate( () => window.__cursor?.jump( 960, 540 ) );
await sleep( 600 );

// 1. Title, then an Elite Section from the slash inserter.
await clickOn( canvas.locator( '.editor-post-title' ), 250 );
await type( 'Launch', 70 );
await page.keyboard.press( 'Enter' );
await sleep( 300 );
await type( '/elite section', 55 );
await sleep( 700 );
await page.keyboard.press( 'Enter' );
await sleep( 900 );
await debug( 'section' );

// 2. Dark and Spacious, from Block Classes.
await classes( [ 'Dark', 'Spac' ] );
await debug( 'dark' );

// 3. Left column: half width; heading, text and a button.
await clickOn( column( 0 ).locator( '.elite-focusable-icon__tab' ), 400 );
await clickOn( tab( 'Settings' ), 400 );
await clickOn( insp.getByRole( 'button', { name: '6 of 12' } ).first(), 500 );
await clickOn( column( 0 ).locator( '.block-list-appender button, .block-editor-button-block-appender' ).first(), 600 );
await type( 'elite heading', 50 );
await sleep( 600 );
await clickOn( page.getByRole( 'option', { name: /Elite Heading/ } ).first(), 500 );
await type( 'Launch pages your team can edit', 45 );
await page.keyboard.press( 'Enter' );
await sleep( 250 );
await type( '/elite paragraph', 45 );
await sleep( 600 );
await page.keyboard.press( 'Enter' );
await sleep( 300 );
await type( 'Native WordPress blocks, fast by default. Edit every word in place.', 28 );
await page.keyboard.press( 'Enter' );
await sleep( 250 );
await type( '/elite button', 45 );
await sleep( 600 );
await page.keyboard.press( 'Enter' );
await sleep( 500 );
await type( 'Get started', 60 );
await sleep( 400 );
await debug( 'left' );
// The button's arrow (Icons → after text).
try {
	const after = insp.getByText( /Icon after text/i ).locator( 'xpath=following::button[1]' );
	await clickOn( after, 600 );
	await type( 'arrow right', 50 );
	await sleep( 500 );
	await clickOn( page.getByRole( 'button', { name: /^Arrow Right$/ } ).or( page.getByRole( 'option', { name: /^Arrow Right$/ } ) ).first(), 500 );
	await page.keyboard.press( 'Escape' );
	await sleep( 400 );
} catch ( error ) {
	console.log( 'icon step skipped:', error.message.split( '\n' )[ 0 ] );
	await page.keyboard.press( 'Escape' );
}
await debug( 'icon' );

// 4. Right column: half width; the image, opening in a popup.
await clickOn( column( 1 ).locator( '.elite-focusable-icon__tab' ), 400 );
await clickOn( tab( 'Settings' ), 300 );
await clickOn( insp.getByRole( 'button', { name: '6 of 12' } ).first(), 500 );
await clickOn( column( 1 ).locator( '.block-list-appender button, .block-editor-button-block-appender' ).first(), 600 );
await type( 'elite image', 50 );
await sleep( 600 );
await clickOn( page.getByRole( 'option', { name: /Elite Image/ } ).first(), 700 );
await clickOn( column( 1 ).getByRole( 'button', { name: 'Media Library' } ), 1400 );
await clickOn( page.locator( `.media-modal li.attachment[data-id="${ IMAGE_ID }"]` ), 500 );
await clickOn( page.locator( '.media-modal .media-button-select' ), 1200 );
const linkType = insp.locator( 'select' ).filter( { hasText: 'Image popup' } ).first();
const [ lx, ly ] = await centre( linkType );
await glide( lx, ly );
await page.evaluate( ( [ px, py ] ) => window.__cursor?.ripple( px, py ), [ lx, ly ] );
await linkType.selectOption( { label: 'Image popup' } );
await sleep( 900 );
await classes( [ 'Rounded', 'Shadow' ] );
await debug( 'image' );

// 5. Publish and view.
await clickOn( page.getByRole( 'region', { name: 'Editor top bar' } ).getByRole( 'button', { name: 'Publish', exact: true } ), 900 );
await clickOn( page.getByRole( 'region', { name: 'Editor publish' } ).getByRole( 'button', { name: 'Publish', exact: true } ), 1800 );
const view = page.getByRole( 'region', { name: 'Editor publish' } ).getByRole( 'link', { name: /View Page/i } ).first();
const [ vx, vy ] = await centre( view );
await glide( vx, vy );
await page.evaluate( ( [ px, py ] ) => window.__cursor?.ripple( px, py ), [ vx, vy ] );
const url = await view.getAttribute( 'href' );
await stopEditor();

// ---- The page: open the image's popup, close it ----
const front = await context.newPage();
await front.goto( url, { waitUntil: 'networkidle' } );
await front.waitForTimeout( 400 );
const stopFront = await castInto( front, '3-page' );
await front.evaluate( ( [ px, py ] ) => window.__cursor?.jump( px, py ), [ vx, vy ] );
await front.waitForTimeout( 1600 );
const image = front.locator( '.elite-section--dark .elite-image' ).first();
const ib = await image.boundingBox();
const [ ix, iy ] = [ ib.x + ib.width / 2, ib.y + ib.height / 2 ];
await front.evaluate( ( [ px, py ] ) => window.__cursor?.move( px, py, 800 ), [ ix, iy ] );
await front.mouse.move( ix, iy, { steps: 50 } );
await front.waitForTimeout( 900 );
await front.evaluate( ( [ px, py ] ) => window.__cursor?.ripple( px, py ), [ ix, iy ] );
await front.mouse.click( ix, iy );
await front.waitForTimeout( 2600 );
if ( DEBUG ) {
	await front.screenshot( { path: path.join( OUT, 'debug-popup.png' ) } );
}
await front.keyboard.press( 'Escape' );
await front.waitForTimeout( 1300 );
await stopFront();

await card( '4-outro', '<h1 class="rise" style="font-size:150px">arcnest<span class="dot">.</span></h1><p class="rise">Native WordPress. No page builders.</p>', 2.6 );

console.log( `page: ${ url }` );
await browser.close();
