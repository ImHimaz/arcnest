/**
 * Who it's for / Signs it's time (sections/service-fit): the cards rise in
 * one after another as they scroll into view.
 */
import { onReady } from '../../utils';
import { reveal } from '../../utils/reveal';

onReady( () => {
	document
		.querySelectorAll( '.elite-section--service-fit' )
		.forEach( ( section ) =>
			reveal(
				section,
				'.elite-div--service-fit, .elite-div--service-sign'
			)
		);
} );
