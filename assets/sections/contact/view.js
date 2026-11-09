/**
 * Contact (sections/contact): the heading, form and founding box rise in
 * one after another as they scroll into view (the styles are in
 * elite-section--contact.scss). Content already on screen at load, and
 * visitors who ask for less motion, see it in place.
 */
import { onReady, prefersReducedMotion, whenVisible } from '../../utils';

/**
 * Set up one section (each copy on the page works on its own).
 *
 * @param {HTMLElement} section The section.
 */
function setUp( section ) {
	const content = section.querySelector( '.section-inner > .container' );
	if (
		! content ||
		prefersReducedMotion() ||
		content.getBoundingClientRect().top < window.innerHeight
	) {
		return;
	}
	[ ...content.children ].forEach( ( child, index ) =>
		child.style.setProperty( '--i', String( index ) )
	);
	section.classList.add( 'is-reveal' );
	whenVisible(
		content,
		() => section.classList.add( 'is-visible' ),
		'0px 0px -12% 0px'
	);
}

onReady( () => {
	document.querySelectorAll( '.elite-section--contact' ).forEach( setUp );
} );
