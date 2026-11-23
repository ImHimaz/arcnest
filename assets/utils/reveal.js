/**
 * Scroll reveal (Arcnest): a section's items rise in one after another as
 * it scrolls into view (styles: the reveal-items() mixin in
 * assets/styles/abstracts/_functions.scss).
 *
 * `import { reveal } from '../../utils/reveal';`
 * `reveal( section, '.elite-div--service' );`
 *
 * Items already on screen at load, and visitors who ask for less motion,
 * see everything in place; without JavaScript nothing is hidden.
 */
import { prefersReducedMotion, whenVisible } from './index';

/**
 * Set up one section's reveal.
 *
 * @param {HTMLElement} section The section (gets .is-reveal, then .is-visible).
 * @param {string}      items   Selector for the items, in order.
 */
export function reveal( section, items ) {
	const list = [ ...section.querySelectorAll( items ) ];
	if (
		! list.length ||
		prefersReducedMotion() ||
		list[ 0 ].getBoundingClientRect().top < window.innerHeight
	) {
		return;
	}
	list.forEach( ( item, index ) =>
		item.style.setProperty( '--i', String( index ) )
	);
	section.classList.add( 'is-reveal' );
	whenVisible(
		list[ 0 ],
		() => {
			section.classList.add( 'is-visible' );
			whenDone( list[ list.length - 1 ], () =>
				section.classList.remove( 'is-reveal', 'is-visible' )
			);
		},
		'0px 0px -12% 0px'
	);
}

/**
 * Run a callback once the last item has risen in. Then the reveal's classes
 * come off, and with them its transition, which would otherwise replace the
 * items' own (a card's hover lift and shadow would jump, and wait out the
 * item's delay). Without them the items look the same: in place.
 *
 * @param {HTMLElement} item     The last item.
 * @param {() => void}  callback Called once.
 */
function whenDone( item, callback ) {
	let done = false;
	const finish = () => {
		if ( ! done ) {
			done = true;
			item.removeEventListener( 'transitionend', onEnd );
			callback();
		}
	};
	const onEnd = ( event ) => {
		if ( event.target === item && event.propertyName === 'translate' ) {
			finish();
		}
	};
	item.addEventListener( 'transitionend', onEnd );
	// A hidden item never fires transitionend: stop waiting after the
	// longest delay and duration this could take.
	const style = window.getComputedStyle( item );
	const seconds = ( value ) =>
		Math.max( ...value.split( ',' ).map( ( v ) => parseFloat( v ) || 0 ) );
	window.setTimeout(
		finish,
		( seconds( style.transitionDelay ) +
			seconds( style.transitionDuration ) ) *
			1000 +
			200
	);
}
