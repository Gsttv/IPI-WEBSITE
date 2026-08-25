/**
 * Comportamentos gerais do tema: sombra no cabeçalho ao rolar a página,
 * rolagem suave para links âncora internos, botão "voltar ao topo" e
 * destaque do item de menu correspondente à seção visível (scroll-spy).
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

	// Botão "voltar ao topo": some/aparece conforme o scroll, sempre com
	// rolagem suave (respeitando prefers-reduced-motion, tratado no CSS).
	const backToTop = document.querySelector( '.back-to-top' );

	if ( backToTop ) {
		const toggleBackToTop = function () {
			backToTop.hidden = window.scrollY < window.innerHeight * 0.6;
		};

		toggleBackToTop();
		window.addEventListener( 'scroll', toggleBackToTop, { passive: true } );

		backToTop.addEventListener( 'click', function () {
			window.scrollTo( { top: 0, behavior: 'smooth' } );
		} );
	}

	// Scroll-spy: realça no menu principal o link correspondente à seção
	// da home atualmente visível (só existe nas âncoras da própria home).
	const sections = Array.from( document.querySelectorAll( 'main#primary > section[id]' ) );
	const navLinks = Array.from( document.querySelectorAll( '.primary-navigation a[href*="#"]' ) );

	if ( sections.length && navLinks.length && 'IntersectionObserver' in window ) {
		const linksBySection = new Map();

		navLinks.forEach( function ( link ) {
			const hash = link.hash ? link.hash.slice( 1 ) : '';
			if ( hash ) {
				linksBySection.set( hash, link );
			}
		} );

		const observer = new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					const link = linksBySection.get( entry.target.id );
					if ( link && entry.isIntersecting ) {
						navLinks.forEach( function ( l ) {
							l.classList.remove( 'is-current-section' );
						} );
						link.classList.add( 'is-current-section' );
					}
				} );
			},
			{ rootMargin: '-40% 0px -50% 0px' }
		);

		sections.forEach( function ( section ) {
			if ( linksBySection.has( section.id ) ) {
				observer.observe( section );
			}
		} );
	}
} )();
