/**
 * Services (sections/services): the cards rise in one after another as they
 * scroll into view (styles: elite-section--services.scss).
 */
import { onReady } from '../../utils';
import { reveal } from '../../utils/reveal';

onReady( () => {
	document
		.querySelectorAll( '.elite-section--services' )
		.forEach( ( section ) => reveal( section, '.elite-div--service' ) );
} );
