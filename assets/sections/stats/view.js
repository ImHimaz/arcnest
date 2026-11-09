/**
 * Stats (sections/stats): the stats rise in one after another as they
 * scroll into view (the styles are in elite-section--stats.scss); the
 * larger numbers count up on their own (Elite Counter). A band already on
 * screen at load, and visitors who ask for less motion, see them in place.
 */
import { onReady, prefersReducedMotion, whenVisible } from '../../utils';

/**
 * Set up one band (each copy on the page works on its own).
 *
 * @param {HTMLElement} section The section.
 */
function setUp( section ) {
	const grid = section.querySelector( '.elite-row--stats-grid' );
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
	document.querySelectorAll( '.elite-section--stats' ).forEach( setUp );
} );
