/**
 * Why it matters (sections/problem): the three points rise in one after
 * another as they scroll into view (styles: elite-section--problem.scss).
 */
import { onReady } from '../../utils';
import { reveal } from '../../utils/reveal';

onReady( () => {
	document
		.querySelectorAll( '.elite-section--problem' )
		.forEach( ( section ) =>
			reveal( section, '.elite-div--problem-point' )
		);
} );
