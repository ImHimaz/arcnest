/**
 * Call to action (sections/cta): the heading, line and buttons rise in one
 * after another as the band scrolls into view (styles:
 * elite-section--cta.scss).
 */
import { onReady } from '../../utils';
import { reveal } from '../../utils/reveal';

onReady( () => {
	document
		.querySelectorAll( '.elite-section--cta' )
		.forEach( ( section ) =>
			reveal(
				section,
				'.elite-heading--cta-title, .elite-paragraph--cta-lead, .elite-div--cta-actions'
			)
		);
} );
