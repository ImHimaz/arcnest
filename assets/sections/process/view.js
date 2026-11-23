/**
 * Process (sections/process): the four steps rise in one after another as
 * they scroll into view (styles: elite-section--process.scss).
 */
import { onReady } from '../../utils';
import { reveal } from '../../utils/reveal';

onReady( () => {
	document
		.querySelectorAll( '.elite-section--process' )
		.forEach( ( section ) =>
			reveal( section, '.elite-div--process-step' )
		);
} );
