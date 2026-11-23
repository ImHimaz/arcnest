/**
 * Why Arcnest (sections/reasons): the four reasons rise in one after another
 * as they scroll into view (styles: elite-section--reasons.scss).
 */
import { onReady } from '../../utils';
import { reveal } from '../../utils/reveal';

onReady( () => {
	document
		.querySelectorAll( '.elite-section--reasons' )
		.forEach( ( section ) => reveal( section, '.elite-div--reason' ) );
} );
