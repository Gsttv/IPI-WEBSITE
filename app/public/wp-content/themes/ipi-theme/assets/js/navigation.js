/**
 * Navegação principal: alterna o menu mobile e controla submenus com
 * suporte a teclado e ARIA, sem dependências externas.
 *
 * @package IPI_Theme
 */
( function () {
	'use strict';

	const siteNavigation = document.getElementById( 'site-navigation' );

	if ( ! siteNavigation ) {
		return;
	}

	const button = document.querySelector( '.menu-toggle' );

	if ( ! button ) {
		return;
	}

	const menu = siteNavigation.querySelector( 'ul' );

	// Garante que o menu tenha uma lista, mesmo vazio, para o toggle funcionar.
	if ( ! menu ) {
		button.style.display = 'none';
		return;
	}

	if ( ! menu.classList.contains( 'menu' ) ) {
		menu.classList.add( 'menu' );
	}

	button.addEventListener( 'click', function () {
		const isOpen = siteNavigation.classList.contains( 'is-open' );

		siteNavigation.classList.toggle( 'is-open' );
		button.setAttribute( 'aria-expanded', String( ! isOpen ) );
	} );

	// Fecha o menu mobile ao pressionar Escape.
	siteNavigation.addEventListener( 'keyup', function ( event ) {
		if ( event.key === 'Escape' && siteNavigation.classList.contains( 'is-open' ) ) {
			siteNavigation.classList.remove( 'is-open' );
			button.setAttribute( 'aria-expanded', 'false' );
			button.focus();
		}
	} );

	// Submenus: abre/fecha ao tocar/clicar em telas pequenas (hover não existe).
	const menuItemsWithChildren = siteNavigation.querySelectorAll( 'li.menu-item-has-children' );

	menuItemsWithChildren.forEach( function ( item ) {
		const link = item.querySelector( ':scope > a' );

		if ( ! link ) {
			return;
		}

		link.insertAdjacentHTML(
			'afterend',
			'<button class="submenu-toggle" aria-expanded="false"><span class="screen-reader-text">Abrir submenu</span></button>'
		);

		const submenuToggle = item.querySelector( ':scope > .submenu-toggle' );

		submenuToggle.addEventListener( 'click', function () {
			const isSubmenuOpen = item.classList.contains( 'is-submenu-open' );

			item.classList.toggle( 'is-submenu-open' );
			submenuToggle.setAttribute( 'aria-expanded', String( ! isSubmenuOpen ) );
		} );
	} );

	// Fecha o menu mobile automaticamente ao redimensionar para desktop.
	let resizeTimer;
	window.addEventListener( 'resize', function () {
		clearTimeout( resizeTimer );
		resizeTimer = setTimeout( function () {
			if ( window.innerWidth > 782 ) {
				siteNavigation.classList.remove( 'is-open' );
				button.setAttribute( 'aria-expanded', 'false' );
			}
		}, 150 );
	} );
} )();
