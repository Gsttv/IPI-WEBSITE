/**
 * Comportamentos gerais do tema: sombra no cabeçalho ao rolar a página e
 * rolagem suave para links âncora internos.
 *
 * @package IPI_Theme
 */
( function () {
	'use strict';

	const header = document.getElementById( 'masthead' );

	if ( header ) {
		const toggleHeaderShadow = function () {
			header.classList.toggle( 'is-scrolled', window.scrollY > 4 );
		};

		toggleHeaderShadow();
		window.addEventListener( 'scroll', toggleHeaderShadow, { passive: true } );
	}

	// Rolagem suave para links internos (#âncora), respeitando o usuário
	// que prefere movimento reduzido (tratado via CSS em html { scroll-behavior }).
	document.querySelectorAll( 'a[href^="#"]' ).forEach( function ( link ) {
		link.addEventListener( 'click', function ( event ) {
			const targetId = link.getAttribute( 'href' );

			if ( ! targetId || targetId === '#' ) {
				return;
			}

			const target = document.querySelector( targetId );

			if ( ! target ) {
				return;
			}

			event.preventDefault();
			target.scrollIntoView( { behavior: 'smooth', block: 'start' } );
			target.setAttribute( 'tabindex', '-1' );
			target.focus( { preventScroll: true } );
		} );
	} );
} )();
