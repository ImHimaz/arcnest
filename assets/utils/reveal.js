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
		() => section.classList.add( 'is-visible' ),
		'0px 0px -12% 0px'
	);
}
