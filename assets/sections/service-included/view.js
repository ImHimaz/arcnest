/**
 * What's included (sections/service-included): the items rise in one after
 * another as they scroll into view.
 */
import { onReady } from '../../utils';
import { reveal } from '../../utils/reveal';

onReady( () => {
	document
		.querySelectorAll( '.elite-section--service-included' )
		.forEach( ( section ) =>
			reveal( section, '.elite-div--service-item' )
		);
} );
