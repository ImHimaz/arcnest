/**
 * Services (sections/services): the cards rise in one after another as they
 * scroll into view (the styles are in elite-section--services.scss).
 * Sections already on screen at load, and visitors who ask for less motion,
 * see them in place.
 */
import { onReady, prefersReducedMotion, whenVisible } from '../../utils';

/**
 * Set up one section (each copy on the page works on its own).
 *
 * @param {HTMLElement} section The section.
 */
function setUp( section ) {
	const grid = section.querySelector( '.elite-row--services-grid' );
	if (
		! grid ||
		prefersReducedMotion() ||
		grid.getBoundingClientRect().top < window.innerHeight
	) {
		return;
	}
	[ ...grid.children ].forEach( ( column, index ) =>
		column.style.setProperty( '--i', String( index ) )
	);
	section.classList.add( 'is-reveal' );
	whenVisible(
		grid,
		() => section.classList.add( 'is-visible' ),
		'0px 0px -12% 0px'
	);
}

onReady( () => {
	document.querySelectorAll( '.elite-section--services' ).forEach( setUp );
} );
