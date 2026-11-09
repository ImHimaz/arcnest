/**
 * Helpers for theme scripts (any feature folder's view.js):
 * `import { onReady, whenVisible, isDevice, prefersReducedMotion } from '../../utils';`
 * Breakpoints are the SCSS ones (assets/json/breakpoints.json): Bootstrap's
 * grid (`mediaBreakpointUp( 'md' )`) and Elite Blocks' devices (`isDevice()`).
 * Each script bundles what it imports, so keep these small.
 */
import breakpoints from '../json/breakpoints.json';

/**
 * Run once the page's HTML is ready (at once if it already is, as for
 * deferred scripts).
 *
 * @param {() => void} callback What to run.
 */
export function onReady( callback ) {
	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', callback, {
			once: true,
		} );
	} else {
		callback();
	}
}

/**
 * Run once an element comes near the screen, e.g. to start a carousel or
 * load something heavy only when it's about to be seen.
 *
 * @param {Element}    element    Element to watch.
 * @param {() => void} callback   What to run (once).
 * @param {string}     rootMargin How far outside the screen counts as near.
 * @return {() => void} Stop watching (if it hasn't run yet).
 */
export function whenVisible( element, callback, rootMargin = '200px' ) {
	if ( ! ( 'IntersectionObserver' in window ) ) {
		callback();
		return () => {};
	}
	const observer = new window.IntersectionObserver(
		( entries ) => {
			if ( entries.some( ( entry ) => entry.isIntersecting ) ) {
				observer.disconnect();
				callback();
			}
		},
		{ rootMargin }
	);
	observer.observe( element );
	return () => observer.disconnect();
}

/**
 * A grid breakpoint's width in px, checked.
 *
 * @param {string} name Breakpoint: xs, sm, md, lg, xl or xxl.
 * @return {number} Its width (0 for xs).
 */
function gridWidth( name ) {
	if ( ! ( name in breakpoints.grid ) ) {
		throw new Error(
			`Unknown breakpoint "${ name }". Use ${ Object.keys(
				breakpoints.grid
			).join( ', ' ) }.`
		);
	}
	return breakpoints.grid[ name ];
}

/**
 * Bootstrap's `media-breakpoint-up`: from that breakpoint up
 * (`mediaBreakpointUp( 'md' )` is 768px+).
 *
 * @param {string} name Breakpoint: xs, sm, md, lg, xl or xxl.
 * @return {string} Media query.
 */
export function mediaBreakpointUp( name ) {
	const width = gridWidth( name );
	return width ? `(min-width: ${ width }px)` : 'all';
}

/**
 * Bootstrap's `media-breakpoint-down`: below that breakpoint
 * (`mediaBreakpointDown( 'md' )` is under 768px).
 *
 * @param {string} name Breakpoint: xs, sm, md, lg, xl or xxl.
 * @return {string} Media query.
 */
export function mediaBreakpointDown( name ) {
	const width = gridWidth( name );
	return width ? `(max-width: ${ width - 0.02 }px)` : 'all';
}

/**
 * The media query for a device: the device and every smaller one, as the
 * SCSS `media-breakpoint-down()` of its breakpoint ("tablet" = down(lg):
 * tablet and mobile); "desktop" is above laptop.
 *
 * @param {'desktop'|'laptop'|'tablet'|'mobile'} device Device.
 * @return {string} Media query.
 */
export function deviceQuery( device ) {
	const { devices } = breakpoints;
	if ( device === 'desktop' ) {
		return `(min-width: ${ devices.laptop }px)`;
	}
	if ( ! ( device in devices ) ) {
		throw new Error(
			`Unknown device "${ device }". Use desktop, ${ Object.keys(
				devices
			).join( ', ' ) }.`
		);
	}
	return `(max-width: ${ devices[ device ] - 0.02 }px)`;
}

/**
 * Whether the screen is that device (or smaller), as the SCSS
 * `media-breakpoint-down()` of its breakpoint: `isDevice( 'tablet' )` is
 * true on tablets and phones.
 *
 * @param {'desktop'|'laptop'|'tablet'|'mobile'} device Device.
 * @return {boolean} Whether it matches now.
 */
export function isDevice( device ) {
	return window.matchMedia( deviceQuery( device ) ).matches;
}

/**
 * Whether the visitor asked for less motion: skip autoplay and animations.
 *
 * @return {boolean} Reduced motion.
 */
export function prefersReducedMotion() {
	return window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
}
