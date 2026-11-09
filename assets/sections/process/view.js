/**
 * Process (sections/process): the steps rise in one after another as they
 * scroll into view (the styles are in elite-section--process.scss). Steps
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
	const steps = section.querySelector( '.elite-column--process-steps' );
	if (
		! steps ||
		prefersReducedMotion() ||
		steps.getBoundingClientRect().top < window.innerHeight
	) {
		return;
	}
	steps
		.querySelectorAll( '.elite-div--process-step' )
		.forEach( ( step, index ) =>
			step.style.setProperty( '--i', String( index ) )
		);
	section.classList.add( 'is-reveal' );
	whenVisible(
		steps,
		() => section.classList.add( 'is-visible' ),
		'0px 0px -12% 0px'
	);
}

onReady( () => {
	document.querySelectorAll( '.elite-section--process' ).forEach( setUp );
} );
