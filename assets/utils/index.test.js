/**
 * External dependencies
 */
import { describe, expect, it, vi } from 'vitest';

/**
 * Internal dependencies
 */
import {
	deviceQuery,
	isDevice,
	mediaBreakpointDown,
	mediaBreakpointUp,
	onReady,
	prefersReducedMotion,
	whenVisible,
} from '.';

describe( 'deviceQuery', () => {
	it( 'matches SCSS media-breakpoint-down() of its breakpoint (a device and smaller)', () => {
		expect( deviceQuery( 'laptop' ) ).toBe( '(max-width: 1199.98px)' );
		expect( deviceQuery( 'tablet' ) ).toBe( '(max-width: 991.98px)' );
		expect( deviceQuery( 'mobile' ) ).toBe( '(max-width: 767.98px)' );
	} );

	it( 'desktop is above laptop', () => {
		expect( deviceQuery( 'desktop' ) ).toBe( '(min-width: 1200px)' );
	} );

	it( 'rejects unknown devices', () => {
		expect( () => deviceQuery( 'phablet' ) ).toThrow( /Unknown device/ );
	} );
} );

describe( 'mediaBreakpointUp / mediaBreakpointDown', () => {
	it( 'match Bootstrap 5 (and the SCSS mixins)', () => {
		expect( mediaBreakpointUp( 'sm' ) ).toBe( '(min-width: 576px)' );
		expect( mediaBreakpointUp( 'xxl' ) ).toBe( '(min-width: 1400px)' );
		expect( mediaBreakpointDown( 'md' ) ).toBe( '(max-width: 767.98px)' );
		expect( mediaBreakpointDown( 'xl' ) ).toBe( '(max-width: 1199.98px)' );
	} );

	it( 'xs has no limit', () => {
		expect( mediaBreakpointUp( 'xs' ) ).toBe( 'all' );
		expect( mediaBreakpointDown( 'xs' ) ).toBe( 'all' );
	} );

	it( 'rejects unknown names', () => {
		expect( () => mediaBreakpointUp( 'xxxl' ) ).toThrow(
			/Unknown breakpoint/
		);
	} );
} );

describe( 'isDevice and prefersReducedMotion', () => {
	it( 'ask the browser', () => {
		const matchMedia = vi.fn( ( query ) => ( {
			matches: query === '(max-width: 991.98px)',
		} ) );
		vi.stubGlobal( 'window', { matchMedia } );
		expect( isDevice( 'tablet' ) ).toBe( true );
		expect( isDevice( 'mobile' ) ).toBe( false );
		expect( prefersReducedMotion() ).toBe( false );
		expect( matchMedia ).toHaveBeenLastCalledWith(
			'(prefers-reduced-motion: reduce)'
		);
		vi.unstubAllGlobals();
	} );
} );

describe( 'onReady', () => {
	it( 'runs at once when the page is parsed', () => {
		vi.stubGlobal( 'document', { readyState: 'interactive' } );
		const callback = vi.fn();
		onReady( callback );
		expect( callback ).toHaveBeenCalledOnce();
		vi.unstubAllGlobals();
	} );

	it( 'waits while the page is loading', () => {
		const addEventListener = vi.fn();
		vi.stubGlobal( 'document', {
			readyState: 'loading',
			addEventListener,
		} );
		const callback = vi.fn();
		onReady( callback );
		expect( callback ).not.toHaveBeenCalled();
		expect( addEventListener ).toHaveBeenCalledWith(
			'DOMContentLoaded',
			callback,
			{ once: true }
		);
		vi.unstubAllGlobals();
	} );
} );

describe( 'whenVisible', () => {
	it( 'runs once, when the element comes near', () => {
		let notify;
		const disconnect = vi.fn();
		const IntersectionObserver = vi.fn( function ( callback, options ) {
			notify = callback;
			this.options = options;
			this.observe = vi.fn();
			this.disconnect = disconnect;
		} );
		vi.stubGlobal( 'window', { IntersectionObserver } );
		const callback = vi.fn();
		whenVisible( {}, callback );

		notify( [ { isIntersecting: false } ] );
		expect( callback ).not.toHaveBeenCalled();
		notify( [ { isIntersecting: true } ] );
		expect( callback ).toHaveBeenCalledOnce();
		expect( disconnect ).toHaveBeenCalled();
		expect( IntersectionObserver.mock.instances[ 0 ].options ).toEqual( {
			rootMargin: '200px',
		} );
		vi.unstubAllGlobals();
	} );

	it( 'runs at once without IntersectionObserver', () => {
		vi.stubGlobal( 'window', {} );
		const callback = vi.fn();
		whenVisible( {}, callback );
		expect( callback ).toHaveBeenCalledOnce();
		vi.unstubAllGlobals();
	} );
} );
