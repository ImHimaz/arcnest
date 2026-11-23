/**
 * Work (sections/work): the two cards rise in one after the other as they
 * scroll into view (styles: elite-section--work.scss).
 */
import { onReady } from '../../utils';
import { reveal } from '../../utils/reveal';

onReady( () => {
	document
		.querySelectorAll( '.elite-section--work' )
		.forEach( ( section ) => reveal( section, '.elite-div--work-card' ) );
} );
