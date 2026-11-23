/**
 * Contact page (sections/contact-page): fills in the form from where the
 * visitor came from. A link can choose the service (?service=rebuild) and
 * tick the call box (?call=1); a speed check result (saved by
 * sections/check in sessionStorage, never in the address) fills in the
 * website and message. Fields the visitor already filled in are kept.
 */
import { onReady } from '../../utils';

const STORAGE_KEY = 'arcnest-site-check';

// ?service= value → a word in its option's text.
const SERVICES = {
	'design-and-build': 'design',
	rebuild: 'rebuild',
	'care-plans': 'care plan',
	'white-label': 'white-label',
};

/**
 * The speed check result saved for this tab, if any.
 *
 * @return {{website?: string, message?: string}|null} Result.
 */
function savedCheck() {
	try {
		return JSON.parse( window.sessionStorage.getItem( STORAGE_KEY ) );
	} catch {
		return null;
	}
}

/**
 * Fill in one form.
 *
 * @param {HTMLFormElement} form The Contact Form 7 form.
 */
function prefill( form ) {
	const params = new URLSearchParams( window.location.search );

	const select = form.querySelector( 'select[name="your-service"]' );
	const word = SERVICES[ params.get( 'service' ) ];
	if ( select && word && ! select.value ) {
		const option = [ ...select.options ].find( ( o ) =>
			o.text.toLowerCase().includes( word )
		);
		if ( option ) {
			select.value = option.value;
		}
	}

	const call = form.querySelector( 'input[name="your-call[]"]' );
	if ( call && params.get( 'call' ) === '1' ) {
		call.checked = true;
	}

	const check = savedCheck();
	if ( check ) {
		const website = form.querySelector( 'input[name="your-website"]' );
		const message = form.querySelector( 'textarea[name="your-message"]' );
		if ( website && ! website.value && check.website ) {
			website.value = check.website;
		}
		if ( message && ! message.value && check.message ) {
			message.value = check.message;
		}
	}

	// Sent: the saved result has done its job.
	form.closest( '.wpcf7' )?.addEventListener( 'wpcf7mailsent', () => {
		try {
			window.sessionStorage.removeItem( STORAGE_KEY );
		} catch {
			// Storage blocked: nothing was saved.
		}
	} );
}

onReady( () => {
	document
		.querySelectorAll( '.elite-section--contact-page .wpcf7-form' )
		.forEach( prefill );
} );
