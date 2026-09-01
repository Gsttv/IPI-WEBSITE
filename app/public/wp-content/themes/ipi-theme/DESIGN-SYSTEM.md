# Design System — Instituto Pernambucano de Infectologia (IPI)

**Versão:** 1.0.0 · **Status:** Aprovado para desenvolvimento · **Escopo:** identidade visual completa, anterior à construção de novas funcionalidades.

## Princípios de design

Referência: clínicas premium e hospitais modernos (linha Sírio-Libanês/Einstein no Brasil; One Medical, Forward, Tia internacionalmente). Quatro princípios guiam toda decisão abaixo:

1. **Confiança antes de tudo.** Cor contida (verde-sálvia da marca) como base, alto contraste, nada de saturação agressiva. Quem chega ao site pode estar ansioso ou fragilizado — a interface não pode competir por atenção.
2. **Premium é espaço, não decoração.** Whitespace generoso, sombras suaves em vez de bordas duras, cantos arredondados consistentes. Luxo aqui significa "não aglomerado", não "cheio de efeitos".
3. **Acessível por padrão, não por exceção.** Público inclui pacientes idosos, imunossuprimidos, com baixa visão. Contraste AA é piso, não meta. Alvos de toque ≥ 44px.
4. **Consistência reduz carga cognitiva.** Um único vocabulário de cor, tipografia, espaçamento e elevação — repetido, nunca reinventado por seção.

Esta especificação **substitui e formaliza** os tokens ad hoc já usados no tema (`style.css`/`theme.json`); os valores de marca já em produção foram preservados como âncora das escalas abaixo para não exigir retrabalho.

> **Atualização (kit de identidade visual completo):** a versão anterior deste documento usava um azul-petróleo (`#0A6E79`) como cor de marca provisória, definida antes da identidade visual oficial existir. Depois, uma revisão intermediária trocou para o verde real do logo mas ainda inventou uma "terracota" secundária sem base em nenhum material do cliente. Esta versão usa o **kit de identidade completo** entregue pelo cliente (`wp-admin/images/IPI • IDV/`: 4 versões do logo em SVG/PNG/JPG/PDF, aplicações em peças reais — cartão de visita, adesivo de porta, assinatura de e-mail, wallpaper —, e as fontes oficiais da marca). Três achados corrigem o restante do documento: **(1)** a marca é um sistema verde + creme + marrom escuro, sem segunda cor saturada (seção 2); **(2)** a tipografia oficial é General Sans, não Manrope/Inter (seção 5); **(3)** o próprio logo é o símbolo "IPI" estilizado como uma rede orgânica de formas conectadas, remetendo à colônia/vírus e ao coletivo médico. Personalidade de marca (do PDF de proposta): **Colaborativo, Preciso, Moderno, Humano, Científico**; pilares: Ciência, Colaboração, Precisão, Cuidado.

---

## 1. Paleta principal — "Verde Instituto"

Verde-sálvia/oliva, extraído da logo oficial do IPI. Cor de marca, usada em header, links, botões primários, ícones de destaque.

| Token | Hex | Uso |
|---|---|---|
| primary-50 | `#F8FAF5` | Fundos muito sutis (hover de linha, zebra de tabela) |
| primary-100 | `#EEF2E9` | Fundos de badge/ícone, seções alternadas leves |
| primary-200 | `#DAE0D1` | Bordas em componentes sobre fundo claro da marca |
| primary-300 | `#BAC4AB` | Elementos decorativos, gráficos, ilustrações |
| primary-400 | `#96A385` | Estados hover em superfícies claras |
| primary-500 | `#7A8768` | Uso decorativo de média intensidade |
| **primary-600** | **`#667058`** | **Base da marca** — cor exata da logo (botão primário, links, header, foco de navegação) |
| primary-700 | `#49513D` | Hover/active de botão primário |
| primary-800 | `#3F4733` | Texto sobre fundo primary-100, dark mode futuro |
| primary-900 | `#2A3121` | Texto de alto contraste sobre tons claros da marca |
| primary-950 | `#1B2013` | Máximo contraste, uso raro (ex: overlay escuro) |

**Contraste:** primary-600 sobre branco ≈ 6.3:1 (AA para texto normal). Para texto pequeno/fino, preferir primary-700+.

---

## 2. Par neutro de marca — "Creme & Marrom escuro"

O kit de identidade oficial (pasta `IPI • IDV`) não define uma segunda cor saturada — a marca é deliberadamente um sistema de **dois neutros + uma tinta**, não "primária + destaque colorido". As quatro versões oficiais do logo (`Marca/SVG|PNG|JPG/Versão 01–04`) e as peças aplicadas (cartão de visita, adesivo de porta, assinatura de e-mail) confirmam o padrão: verde sobre branco/creme, **ou** creme sobre marrom escuro. Nunca um terceiro tom entra na mistura.

| Token | Hex | Uso |
|---|---|---|
| **cream** | **`#E5DCCC`** | Creme da marca — painéis/destaques decorativos, versão do logo para fundo escuro. **Não usar como cor de texto sobre branco** (contraste insuficiente) |
| cream-tint | `#F6F3EF` | Diluição quase branca do creme — fundo de seções alternadas (`.section--alt`), bordas sutis |
| **ink** | **`#473F30`** | Marrom escuro da marca — fundo de painéis "assinatura" (rodapé, faixa de CTA final), como nas peças aplicadas |
| ink-hover | `#5B513E` | Hover/active sobre fundo ink |

> **Por que abandonar a paleta "Terracota" de uma revisão anterior deste documento?** Aquela paleta foi uma decisão de design **inventada** antes de o kit de identidade completo (pasta `wp-admin/images/IPI • IDV`) ter sido revisado — não existe terracota em nenhuma das 4 versões de logo, no PDF de proposta ou nas peças aplicadas (cartões, adesivos, assinatura de e-mail) fornecidas pelo cliente. O par creme/marrom escuro descrito acima é o que a marca *de fato* usa.

---

## 3. Escala de cinzas — "Neutro"

Cinza com leve viés quente quase imperceptível (mesma matiz do verde-sálvia, saturação bem baixa), para harmonizar com a marca. Base de texto, fundo e bordas em toda a interface.

| Token | Hex | Uso |
|---|---|---|
| neutral-0 | `#FFFFFF` | Fundo padrão, cards |
| neutral-50 | `#F8FAF6` | Fundo de página sutil |
| neutral-100 | `#F5F7F3` | Seções alternadas (`.section--alt`) |
| neutral-200 | `#EAEDE5` | Divisores leves |
| neutral-300 | `#E1E5DC` | Bordas padrão (cards, inputs, tabelas) |
| neutral-400 | `#C5CABB` | Bordas em estado desabilitado |
| neutral-500 | `#97A085` | Placeholder, ícones inativos |
| neutral-600 | `#7A8368` | Texto terciário |
| neutral-700 | `#606657` | Texto secundário (metadados, legendas) |
| neutral-800 | `#3A3F32` | Texto de títulos secundários |
| neutral-900 | `#242720` | Texto principal do corpo |
| neutral-950 | `#15170F` | Texto de máximo contraste, nunca preto puro |

---

## 4. Cores semânticas

Reservadas **exclusivamente** para comunicar estado. Nunca usar como decoração.

### 4.1 Sucesso — "Confirmado"

Verde vívido, deliberadamente mais saturado e mais "quente-verde" que o Secundário, para não ser confundido com ele.

| Token | Hex | Uso |
|---|---|---|
| success-50 | `#EAFBF1` | Fundo de alerta/banner de sucesso |
| success-100 | `#CFF5DF` | Fundo de badge "Confirmado", "Disponível" |
| success-200 | `#9EEABF` | Bordas |
| success-300 | `#66D89C` | Ilustração/ícone decorativo de estado |
| success-400 | `#34C17D` | Hover de elementos de sucesso |
| **success-600** | **`#0F8850`** | **Base** — texto/ícone de confirmação, borda de campo validado |
| success-700 | `#0B6B3F` | Texto sobre success-50/100 (contraste AA) |
| success-900 | `#06341F` | Alto contraste |

### 4.2 Aviso — "Atenção"

Âmbar/dourado — também usado como cor de foco (anel de foco de teclado), reaproveitando o mesmo significado de "preste atenção aqui".

| Token | Hex | Uso |
|---|---|---|
| warning-50 | `#FFF8EA` | Fundo de banner de aviso |
| warning-100 | `#FFEBC2` | Fundo de badge "Pendente", "Aguardando" |
| warning-300 | `#FFC04D` | Ilustração/ícone |
| **warning-500** | **`#F5A623`** | **Base** — ícone de aviso, anel de foco de acessibilidade |
| warning-700 | `#B0670C` | Texto sobre warning-50/100 (contraste AA — nunca usar warning-500 como texto sobre branco) |
| warning-900 | `#5C3307` | Alto contraste |

### 4.3 Erro — "Crítico"

Vermelho — validação de formulário, cancelamentos, e a faixa de emergência do cabeçalho.

| Token | Hex | Uso |
|---|---|---|
| error-50 | `#FDECEC` | Fundo de banner de erro |
| error-100 | `#FBD2D0` | Fundo de badge de erro |
| error-300 | `#ED7570` | Ilustração/ícone |
| error-500 | `#C7362D` | Hover claro |
| **error-600** | **`#B3261E`** | **Base** — texto de erro, borda de campo inválido, faixa de emergência, botão destrutivo |
| error-700 | `#8F1D17` | Hover/active de botão destrutivo |
| error-900 | `#4A0F0C` | Alto contraste |

---

## 5. Fontes

Definição final de identidade (substitui a recomendação anterior de Manrope + Inter, escrita antes de o kit `IPI • IDV/Fontes/` ter sido revisado): **General Sans**, em duas variações apenas, de propósito — um sistema tipográfico de 2 pesos, não multi-peso. É a fonte que o próprio logo já usa.

| Papel | Fonte | Peso | Fallback / entrega |
|---|---|---|---|
| **Títulos** (H1–H6) | **General Sans Bold** | 700 | Auto-hospedada em `assets/fonts/` (WOFF2), licença ITF Free Font License (Fontshare) — gratuita para uso e auto-hospedagem |
| **Texto corrido / UI** (parágrafos, botões, formulários, navegação) | **General Sans Light** | 300 | Mesma fonte, mesma licença; itálico (Light Italic / Bold Italic) incluído para `<em>`/citações |
| **Fallback do sistema** (enquanto a fonte carrega / falha de rede) | `-apple-system, "Segoe UI", Roboto, Helvetica, Arial, sans-serif` | — | `font-display: swap` — texto visível imediatamente no fallback, troca suave quando a General Sans carrega. Preload das duas variações no `<head>` (ver `inc/performance.php`) evita atraso perceptível |

**Só dois pesos, de propósito:** qualquer elemento que peça um peso intermediário (ex.: nav/badges historicamente em 600) recai automaticamente no peso disponível mais próximo — o navegador nunca sintetiza um "bold falso", só escolhe entre os dois reais já carregados (`@font-face` declara faixas `300–500` e `600–800`, ver `style.css` seção 0). Mantém o arquivo de fontes pequeno (~94KB para os 4 arquivos WOFF2) e a decisão de marca explícita: Light informa, Bold decide.

**Por que não serifada:** hospitais tradicionais usam serifa para transmitir autoridade; hospitais **modernos** premium (a referência pedida) majoritariamente usam sans-serif humanista — a sensação de "premium" vem da tipografia + espaçamento + cor, não de uma serifa.

---

## 6. Escala tipográfica

Fluida (`clamp()`), mobile → desktop. Continua a abordagem já usada no tema — agora com General Sans Bold para todo nível de título e General Sans Light para todo nível de corpo.

| Nível | Fonte/Peso | Tamanho (fluido) | Line-height | Letter-spacing | Uso |
|---|---|---|---|---|---|
| Display | General Sans Bold 700 | 44px → 72px | 1.1 | -0.02em | Hero da home, só um por página |
| H1 | General Sans Bold 700 | 36px → 48px | 1.15 | -0.01em | Título de página |
| H2 | General Sans Bold 700 | 28px → 36px | 1.2 | -0.01em | Título de seção |
| H3 | General Sans Bold 700 | 22px → 28px | 1.25 | normal | Subtítulo, título de card grande |
| H4 | General Sans Bold 700 | 18px → 22px | 1.3 | normal | Título de card padrão, label de destaque |
| Body Large (lede) | General Sans Light 300 | 18px | 1.6 | normal | Parágrafo de introdução/resumo |
| Body (base) | General Sans Light 300 | 16px → 17px | 1.6 | normal | Texto corrido padrão |
| Body Small | General Sans Light 300 | 14px | 1.5 | normal | Metadados, texto auxiliar |
| Caption | General Sans Light 300 | 13px | 1.4 | normal | Legendas de imagem, texto de ajuda de formulário |
| Overline/Label | General Sans Bold 700 | 12px | 1.3 | 0.08em (maiúsculas) | "Eyebrows", badges, rótulos de categoria — Bold aqui por serem rótulos curtos que precisam de destaque, não corpo de texto |


## 7. Espaçamentos

Escala de base 4px (múltiplos de 4/8, padrão de mercado). Nomes semânticos mapeiam para os tokens numéricos.

| Token | Valor | Alias | Uso típico |
|---|---|---|---|
| space-1 | 4px | 3xs | Gap ícone+texto |
| space-2 | 8px | 2xs | Gap entre itens muito próximos (badge, tag) |
| space-3 | 12px | xs | Padding interno de botão pequeno/input |
| space-4 | 16px | sm | Padding interno padrão de componente |
| space-5 | 20px | — | Gap entre campos de formulário |
| space-6 | 24px | md | Gap entre elementos relacionados, padding de card |
| space-8 | 32px | — | Padding interno de card grande |
| space-10 | 40px | lg | Espaço entre blocos dentro de uma seção |
| space-12 | 48px | — | Margem de subseção |
| space-16 | 64px | xl | Espaço entre seções (mobile) |
| space-20 | 80px | — | Espaço entre seções (tablet) |
| space-24 | 96px | 2xl | Espaço entre seções (desktop) |
| space-32 | 128px | 3xl | Respiro de seções âncora (hero, fechamento de página) |

---

## 8. Border radius

| Token | Valor | Uso |
|---|---|---|
| radius-none | 0px | Elementos full-bleed, tabelas densas |
| radius-sm | 6px | Inputs, botões pequenos, badges retangulares |
| radius-md | 12px | Botões padrão, cards de conteúdo |
| radius-lg | 20px | Cards grandes, imagens de destaque, modais |
| radius-xl | 28px | Painéis hero, blocos de destaque premium |
| radius-full | 9999px | Pills, avatares, botão flutuante (WhatsApp), badges arredondados |

Regra: **um único valor de radius por "família" de componente** — nunca misturar `radius-sm` e `radius-lg` dentro do mesmo card.

---

## 9. Sombras (elevação)

Sombras com leve tingimento na cor de texto/marca (`#242720`, o mesmo tom quente usado no neutral-900) em vez de preto puro — detalhe premium que aparece em produtos de saúde de alto padrão.

| Token | Valor (camadas) | Uso |
|---|---|---|
| shadow-xs | `0 1px 2px rgba(36,39,32,.06)` | Hover sutil em linha de lista |
| shadow-sm | `0 2px 6px rgba(36,39,32,.08), 0 1px 2px rgba(36,39,32,.04)` | Card em repouso |
| shadow-md | `0 8px 24px rgba(36,39,32,.12), 0 2px 6px rgba(36,39,32,.06)` | Card em hover, dropdown, menu de submenu |
| shadow-lg | `0 20px 48px rgba(36,39,32,.16), 0 8px 16px rgba(36,39,32,.08)` | Modal, popover grande |
| shadow-xl | `0 32px 64px rgba(36,39,32,.20), 0 12px 24px rgba(36,39,32,.10)` | Elemento flutuante premium (ex: card de agendamento sticky) |
| shadow-focus | `0 0 0 4px rgba(245,166,35,.35)` | Anel de foco de teclado (usa warning-500) — nunca remover, é requisito de acessibilidade |

---

## 10. Botões

**Alturas (touch target):** sm = 36px · **md = 44px (padrão)** · lg = 52px (CTAs de hero). 44px é o mínimo recomendado para alvos de toque acessíveis — decisivo para um público que inclui pacientes idosos.

| Variante | Fundo | Texto | Borda | Uso |
|---|---|---|---|---|
| **Primário** | primary-600 → hover primary-700 → active primary-800 | branco | nenhuma | Ação principal da tela ("Agendar Consulta") — no máximo 1 por seção visível |
| **Secundário preenchido** | secondary-600 → hover secondary-700 | branco | nenhuma | Ação positiva alternativa ("Confirmar", "Enviar") |
| **Secundário outline** | transparente → hover primary-50 | primary-600 | 2px primary-600 | Ação de igual relevância à primária, sem competir visualmente ("Saiba mais") |
| **Ghost/Terciário** | transparente → hover neutral-100 | primary-600 | nenhuma | Ação de baixa ênfase ("Cancelar", "Voltar") |
| **Destrutivo** | error-600 → hover error-700 | branco | nenhuma | Ação crítica/irreversível ("Cancelar consulta") — sempre pedir confirmação |
| **Link** | transparente | primary-600, sublinhado só no hover | nenhuma | Ação inline dentro de texto/tabela |

**Estados obrigatórios em todas as variantes:** default · hover (−1 tom + leve elevação) · active/pressed (−2 tons, sem elevação) · `focus-visible` (shadow-focus) · disabled (opacidade 40%, sem interação) · loading (spinner + texto com opacidade reduzida).

---

## 11. Cards

Elevação padrão: `shadow-xs` em repouso → `shadow-sm`/`shadow-md` no hover + leve `translateY(-2px)`. Radius padrão: `radius-md` (12px). Fundo: `neutral-0` (branco), exceto onde indicado.

| Tipo | Estrutura | Observação |
|---|---|---|
| **Card padrão** | Padding space-6, borda 1px neutral-300 | Uso genérico de conteúdo |
| **Card de especialidade/serviço** | Ícone em bloco radius-sm bg primary-100, título H4, texto Body Small | Já usado na home; formaliza o padrão existente |
| **Card de equipe médica** | Foto topo (radius-lg só no topo, proporção 4:5), nome H4, especialidade em Overline, CRM em Caption, rodapé com botão Ghost "Ver perfil" | Nome do médico nunca em cor semântica — sempre neutral-900 |
| **Card de depoimento** | Fundo neutral-50 (não branco), aspas decorativas em secondary-200, texto em Body Large, rodapé com avatar + nome + badge "Paciente verificado" | Diferenciação de fundo evita confundir com card de conteúdo comum |
| **Card de artigo/blog** | Imagem topo 16:9 (radius-lg), categoria em Overline (cor secondary), título H4, excerpt Body Small, meta (data + tempo de leitura) em Caption | Já corresponde ao `template-parts/content.php` existente |
| **Card de plano/convênio aceito** | Borda 2px primary-600 quando "recomendado" + badge "Mais procurado" em warning-100/warning-700 | Reservado para páginas de convênios/pacotes de check-up |

---

## 12. Inputs

**Altura padrão: 44px** (mesma lógica de toque dos botões). Radius: `radius-sm` (6px) — deliberadamente menor que o de cards/botões grandes, para diferenciar "área de digitação" de "área de clique".

| Elemento | Especificação |
|---|---|
| Texto/Textarea | Borda 1px neutral-300, padding 12px 16px, fundo branco, placeholder neutral-500. Foco: borda primary-600 + shadow-focus |
| Select | Mesmo tratamento do texto + ícone chevron neutral-600 |
| Checkbox | 20×20px, radius-sm, borda 2px neutral-300; marcado: fundo primary-600, ícone check branco |
| Radio | 20×20px, radius-full, mesma lógica de cor do checkbox |
| Label | Acima do campo, General Sans Bold, Body Small, cor neutral-800; asterisco de obrigatório em error-600 |
| Texto de ajuda | Abaixo do campo, Caption, neutral-600 |
| **Estado de erro** | Borda error-600, texto de ajuda em error-700, ícone de alerta à direita |
| **Estado validado/sucesso** | Borda success-600, ícone de check à direita — útil em validação de CPF/carteirinha de convênio |
| **Estado desabilitado** | Fundo neutral-100, texto neutral-400, cursor not-allowed |

---

## 13. Containers

| Token | Largura máx. | Uso |
|---|---|---|
| container-narrow | 720px | Formulários, artigos/posts, páginas de texto longo (~75–80 caracteres por linha, leitura confortável) |
| **container-default** | **1200px** | Seções padrão, grids de card — a maioria do site |
| container-wide | 1440px | Hero, showcases largos — evita conteúdo "esticado" em monitores grandes |
| container-full | 100vw (full-bleed) | Faixas de cor de fundo (CTA banner, faixa de emergência), imagens de fundo |

**Grid:** 12 colunas · gutter 24px em desktop / 16px em mobile · margens laterais fluidas (24px mobile → 64px+ desktop, já implementado via `clamp()` no espaçamento `md`/`lg`).

---

## 14. Breakpoints

Mobile-first.

| Token | Largura mínima | Uso |
|---|---|---|
| base | 0px | 1 coluna, navegação em menu mobile |
| sm | 480px | Telas de celular grande/phablet |
| md | 768px | Tablet — grids passam a 2 colunas |
| **nav-collapse** | **782px** | **Exceção intencional**: breakpoint do menu principal, alinhado ao ponto em que a admin bar do WordPress também colapsa (consistência para usuários logados) |
| lg | 1024px | Tablet paisagem/notebook pequeno — navegação horizontal completa, grids em 3 colunas |
| xl | 1280px | Desktop — `container-wide` entra em uso |
| 2xl | 1536px | Monitores grandes/ultra-wide — conteúdo mantém `container-wide`, nunca estica a 100% |

---

## Notas de implementação (para quando formos ao código)

- Os hex marcados em **negrito/base** em cada escala já existem em produção (`style.css`/`theme.json`) — a migração é uma **extensão**, não uma substituição de marca.
- `theme.json` precisará ganhar as escalas completas (hoje só tem os tons "base"); lembrar de manter `style.css` e `theme.json` sincronizados manualmente (débito técnico já documentado no `readme.txt`).
- Cores semânticas (Sucesso/Aviso/Erro) ainda não existem como custom properties — hoje só há `--color-danger`. Precisarão ser adicionadas por completo.
- ✅ Fontes: General Sans (Light para texto, Bold para títulos) já implementada, substituindo a recomendação anterior de Manrope/Inter — WOFF2 auto-hospedada em `assets/fonts/`, `@font-face` em `style.css` (seção 0) e `assets/css/editor-style.css`, preload das duas variações via `inc/performance.php`.
