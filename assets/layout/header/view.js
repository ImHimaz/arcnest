/**
 * Header (layout/header): the progressive blur under the bar, as on
 * seemplicity.ai: layers of growing blur, each fading out sooner (the
 * styles are in header.scss). Without JS the header keeps one blur layer.
 */
import { onReady } from '../../utils';

const LAYERS = 8;

/**
 * Add the blur layers to one header.
 *
 * @param {HTMLElement} header The header template part.
 */
function setUp( header ) {
	const blur = document.createElement( 'div' );
	blur.className = 'site-header__blur';
	blur.setAttribute( 'aria-hidden', 'true' );
	for ( let i = 0; i < LAYERS; i++ ) {
		blur.append( document.createElement( 'i' ) );
	}
	header.prepend( blur );
	header.classList.add( 'has-blur' );
}

onReady( () => {
	document.querySelectorAll( '.site-header' ).forEach( setUp );
} );
