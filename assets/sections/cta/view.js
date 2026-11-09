/**
 * Call to Action (sections/cta): the content fades up as the section scrolls
 * into view. Sections already on screen at load, and visitors who ask for
 * less motion, see it straight away (no flash, no waiting).
 */
import { onReady, prefersReducedMotion, whenVisible } from '../../utils';

/**
 * Set up one section (each copy on the page works on its own).
 *
 * @param {HTMLElement} section The section.
 */
function setUp( section ) {
	const belowTheFold =
		section.getBoundingClientRect().top > window.innerHeight;
	if ( prefersReducedMotion() || ! belowTheFold ) {
		return;
	}
	section.classList.add( 'is-reveal' );
	whenVisible(
		section,
		() => section.classList.add( 'is-visible' ),
		'0px 0px -15% 0px'
	);
}

onReady( () => {
	document.querySelectorAll( '.elite-section--cta' ).forEach( setUp );
} );
