/**
 * Smooth wheel scrolling (Lenis): a mouse wheel's steps ease into one glide
 * instead of jumping. The page still scrolls natively underneath (Lenis
 * sets the position each frame), so the sticky header, anchor links (their
 * own CSS smooth scroll), keyboard scrolling and Find in page work as
 * before.
 *
 * Only with a mouse or trackpad (a fine pointer that can hover): touch
 * screens keep their own momentum. Off for visitors who ask for less
 * motion. Inside the open menu, a dialog or anything marked
 * data-lenis-prevent, the wheel scrolls that element natively; while the
 * menu overlay is open the page doesn't glide at all.
 *
 * `import { smoothScroll } from '../../utils/smooth-scroll';`
 * Styles: Lenis's own, in assets/styles/base/_elements.scss.
 */
import Lenis from 'lenis';

import { prefersReducedMotion } from './index';

/** Start smooth wheel scrolling (once). */
export function smoothScroll() {
	if (
		window.lenis ||
		prefersReducedMotion() ||
		! window.matchMedia( '(hover: hover) and (pointer: fine)' ).matches
	) {
		return;
	}

	const lenis = new Lenis( {
		// How much of the way to the target each frame covers: lower is
		// floatier. 0.12 keeps it light.
		lerp: 0.12,
		smoothWheel: true,
		autoRaf: true,
		prevent: ( node ) =>
			Boolean(
				node.closest(
					'.wp-block-navigation__responsive-container.is-menu-open, [role="dialog"], dialog, [data-lenis-prevent]'
				)
			),
	} );
	window.lenis = lenis;

	// WordPress's menu overlay locks the page (html.has-modal-open): stop
	// gliding while it's open.
	new window.MutationObserver( () => {
		if ( document.documentElement.classList.contains( 'has-modal-open' ) ) {
			lenis.stop();
		} else {
			lenis.start();
		}
	} ).observe( document.documentElement, {
		attributes: true,
		attributeFilter: [ 'class' ],
	} );
}
