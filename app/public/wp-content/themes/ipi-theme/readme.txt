=== IPI Theme ===
Contributors: institutopernambucanodeinfectologia
Requires at least: 6.4
Tested up to: 6.6
Requires PHP: 8.2
Version: 1.0.0
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: blog, custom-colors, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready, accessibility-ready, block-styles, wide-blocks, one-column, two-columns

Tema institucional do Instituto Pernambucano de Infectologia (IPI).

== Descrição ==

IPI Theme é um tema WordPress clássico (compatível com o Editor de Blocos
via theme.json), desenvolvido sob medida para o Instituto Pernambucano de
Infectologia. Construído com HTML5 semântico, CSS moderno (custom
properties, Grid e Flexbox, tipografia fluida) e JavaScript vanilla, sem
dependências externas.

Principais características:

* Página inicial institucional (front-page.php) com hero, especialidades,
  faixa de confiança, CTA e últimas publicações do blog.
* Cabeçalho com menu responsivo acessível (teclado + ARIA) e call-to-action
  de agendamento (telefone/WhatsApp configuráveis no Personalizador).
* Dados estruturados (Schema.org / JSON-LD) como `MedicalClinic` na home,
  meta description, Open Graph e Twitter Card automáticos (desativados
  automaticamente se um plugin de SEO dedicado estiver ativo).
* Skip link, `:focus-visible`, landmarks semânticos e contraste AA por
  padrão — alinhado às diretrizes accessibility-ready do WordPress.org.
* Zero fontes/scripts de terceiros: usa a pilha de fontes do sistema
  operacional e enfileira apenas os próprios assets, com `defer`.
* Áreas de widgets: barra lateral do blog + 3 colunas no rodapé.
* Opções no Personalizador: telefone, WhatsApp, e-mail, endereço, faixa de
  emergência e redes sociais.

== Instalação ==

1. Envie a pasta `ipi-theme` para `/wp-content/themes/`.
2. Ative o tema em Aparência > Temas.
3. Configure o menu principal em Aparência > Menus (localização "Menu Principal").
4. Preencha telefone/WhatsApp/redes sociais em Aparência > Personalizar >
   Informações Institucionais e Redes Sociais.
5. Opcional: defina uma Página estática como página inicial em Ajustes >
   Leitura para editar o texto do hero pelo editor de blocos.

== Requisitos ==

* WordPress 6.4 ou superior
* PHP 8.2 ou superior

== Notas para desenvolvimento ==

* A paleta de cores existe em dois lugares: `style.css` (custom properties,
  usadas pelo front-end) e `theme.json` (settings.color.palette, usado pelo
  editor de blocos). O editor de blocos não lê custom properties do CSS, por
  isso não há como ter uma única fonte de verdade sem um passo de build —
  ao alterar uma cor, replique manualmente nos dois arquivos.

== Changelog ==

= 1.0.0 =
* Versão inicial do tema.

== Créditos ==

Desenvolvido para o Instituto Pernambucano de Infectologia. Estrutura de
template inspirada nos padrões oficiais de temas WordPress (_s/underscores)
e no WordPress Theme Handbook.
