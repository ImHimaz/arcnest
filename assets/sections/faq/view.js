/**
 * FAQ (sections/faq): the questions rise in one after another as they
 * scroll into view (the styles are in elite-section--faq.scss). Questions
 * already on screen at load, and visitors who ask for less motion, see them
 * in place.
 */
import { onReady, prefersReducedMotion, whenVisible } from '../../utils';

/**
 * Set up one section (each copy on the page works on its own).
 *
 * @param {HTMLElement} section The section.
 */
function setUp( section ) {
	const list = section.querySelector( '.elite-accordion__items' );
	if (
		! list ||
		prefersReducedMotion() ||
		list.getBoundingClientRect().top < window.innerHeight
	) {
		return;
	}
	list.querySelectorAll( '.elite-accordion__item' ).forEach(
		( item, index ) => item.style.setProperty( '--i', String( index ) )
	);
	section.classList.add( 'is-reveal' );
	whenVisible(
		list,
		() => section.classList.add( 'is-visible' ),
		'0px 0px -12% 0px'
	);
}

onReady( () => {
	document.querySelectorAll( '.elite-section--faq' ).forEach( setUp );
} );
