/**
 * Preview em tempo real no Personalizador (Customizer) para título e
 * subtítulo do site — demais opções usam refresh completo.
 *
 * @package IPI_Theme
 */
( function ( wp ) {
	'use strict';

	if ( ! wp || ! wp.customize ) {
		return;
	}

	wp.customize( 'blogname', function ( value ) {
		value.bind( function ( newValue ) {
			document.querySelectorAll( '.site-title a' ).forEach( function ( el ) {
				el.textContent = newValue;
			} );
		} );
	} );

	wp.customize( 'blogdescription', function ( value ) {
		value.bind( function ( newValue ) {
			document.querySelectorAll( '.site-description' ).forEach( function ( el ) {
				el.textContent = newValue;
			} );
		} );
	} );
} )( window.wp );
