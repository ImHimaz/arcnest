/**
 * Comparison (sections/compare): the two cards slide in from either side as
 * they scroll into view (the styles are in elite-section--compare.scss).
 * Sections already on screen at load, and visitors who ask for less motion,
 * see them in place. The scores count up on their own (Elite Counter).
 */
import { onReady, prefersReducedMotion, whenVisible } from '../../utils';

/**
 * Set up one section (each copy on the page works on its own).
 *
 * @param {HTMLElement} section The section.
 */
function setUp( section ) {
	const cards = section.querySelector( '.elite-row--compare-cards' );
	if (
		! cards ||
		prefersReducedMotion() ||
		cards.getBoundingClientRect().top < window.innerHeight
	) {
		return;
	}
	section.classList.add( 'is-reveal' );
	whenVisible(
		cards,
		() => section.classList.add( 'is-visible' ),
		'0px 0px -12% 0px'
	);
}

onReady( () => {
	document.querySelectorAll( '.elite-section--compare' ).forEach( setUp );
} );
