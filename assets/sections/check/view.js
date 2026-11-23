/**
 * Check your site (sections/check): sends the address to this site's
 * PageSpeed route (inc/site-check.php), shows the results next to our demo's,
 * and "Let’s talk about your site" fills in the contact form with them (on
 * this page, or on the contact page through sessionStorage).
 */
import { onReady } from '../../utils';

const NUMBER = new Intl.NumberFormat( undefined, { maximumFractionDigits: 1 } );

/**
 * The REST API root WordPress prints in the head, or /wp-json/.
 */
function apiRoot() {
	const link = document.querySelector( 'link[rel="https://api.w.org/"]' );
	return link ? link.href : '/wp-json/';
}

/**
 * One result as text.
 *
 * @param {string}           key   Field.
 * @param {number|null|void} value Its value.
 */
function format( key, value ) {
	if ( value === null || value === undefined ) {
		return '–';
	}
	if ( key === 'lcp' ) {
		return `${ NUMBER.format( value ) } s`;
	}
	if ( key === 'weight' ) {
		return value >= 1024
			? `${ NUMBER.format( value / 1024 ) } MB`
			: `${ value } KB`;
	}
	return String( value );
}

/**
 * Set up one check box.
 *
 * @param {HTMLElement} box The .site-check element.
 */
function setUp( box ) {
	const form = box.querySelector( '.site-check__form' );
	const input = box.querySelector( 'input[name="url"]' );
	const button = form.querySelector( 'button' );
	const status = box.querySelector( '.site-check__status' );
	const result = box.querySelector( '.site-check__result' );
	const cta = box.querySelector( '.site-check__cta' );
	let last = null;

	form.addEventListener( 'submit', async ( event ) => {
		event.preventDefault();
		const url = input.value.trim();
		if ( ! url ) {
			status.textContent = 'Enter your website address first.';
			input.focus();
			return;
		}

		button.disabled = true;
		box.classList.add( 'is-busy' );
		status.textContent =
			'Testing your site on a simulated phone. This takes about 30 seconds…';

		try {
			const response = await fetch( `${ apiRoot() }arcnest/v1/check`, {
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				body: JSON.stringify( { url } ),
			} );
			const data = await response.json();
			if ( ! response.ok ) {
				throw new Error(
					data?.message ||
						'We couldn’t test that site. Try again in a minute.'
				);
			}

			last = data;
			box.querySelectorAll( '[data-check]' ).forEach( ( cell ) => {
				cell.textContent = format(
					cell.dataset.check,
					data[ cell.dataset.check ]
				);
			} );
			result.hidden = false;
			status.textContent = `Results for ${ new URL( data.url ).host }.`;
		} catch ( error ) {
			status.textContent = error.message;
		} finally {
			button.disabled = false;
			box.classList.remove( 'is-busy' );
		}
	} );

	// Fill in the contact form with the results: on this page if it has the
	// form, else on the contact page the link goes to (kept for this tab
	// only, in sessionStorage, never in the address).
	cta.addEventListener( 'click', () => {
		if ( ! last ) {
			return;
		}
		const text =
			`I'd like to talk about ${ last.url }. ` +
			`Mobile PageSpeed: performance ${ format(
				'performance',
				last.performance
			) }, accessibility ${ format(
				'accessibility',
				last.accessibility
			) }, LCP ${ format( 'lcp', last.lcp ) }, page weight ${ format(
				'weight',
				last.weight
			) }.`;
		const website = document.querySelector(
			'#contact input[name="your-website"]'
		);
		const message = document.querySelector(
			'#contact textarea[name="your-message"]'
		);
		if ( ! website && ! message ) {
			try {
				window.sessionStorage.setItem(
					'arcnest-site-check',
					JSON.stringify( { website: last.url, message: text } )
				);
			} catch {
				// Storage blocked: the contact page opens empty.
			}
			return;
		}
		if ( website && ! website.value ) {
			website.value = last.url;
		}
		if ( message && ! message.value ) {
			message.value = text;
		}
	} );
}

onReady( () => {
	document.querySelectorAll( '.site-check' ).forEach( setUp );
} );
