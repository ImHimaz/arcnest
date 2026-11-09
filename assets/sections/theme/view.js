/**
 * Our theme (sections/theme): as the section scrolls into view, the checks
 * rise one by one, the panel scales up and its tiles follow (the styles are
 * in elite-section--theme.scss). Sections already on screen at load, and
 * visitors who ask for less motion, see everything in place.
 */
import { onReady, prefersReducedMotion, whenVisible } from '../../utils';

/**
 * Set up one section (each copy on the page works on its own).
 *
 * @param {HTMLElement} section The section.
 */
function setUp( section ) {
	const row = section.querySelector( '.elite-row' );
	if (
		! row ||
		prefersReducedMotion() ||
		row.getBoundingClientRect().top < window.innerHeight
	) {
		return;
	}
	// Stagger each list's items.
	section
		.querySelectorAll( '.core-list--checks, .core-list--theme-blocks' )
		.forEach( ( list ) =>
			[ ...list.children ].forEach( ( item, index ) =>
				item.style.setProperty( '--i', String( index ) )
			)
		);
	section.classList.add( 'is-reveal' );
	whenVisible(
		row,
		() => section.classList.add( 'is-visible' ),
		'0px 0px -12% 0px'
	);
}

onReady( () => {
	document.querySelectorAll( '.elite-section--theme' ).forEach( setUp );
} );
