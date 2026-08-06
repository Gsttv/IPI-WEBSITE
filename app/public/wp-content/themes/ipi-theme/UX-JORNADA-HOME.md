# Jornada de UX — Home do IPI (da chegada ao clique no WhatsApp)

**Papel:** UX Designer especializado em clínicas médicas · **Escopo:** página inicial completa, do primeiro scroll ao clique de conversão · **Referência:** [DESIGN-SYSTEM.md](DESIGN-SYSTEM.md) — todo componente citado aqui já tem token definido lá.

---

## Framework: por que uma home de clínica não é uma home de e-commerce

Em varejo, o objetivo é impulso. Em saúde, o objetivo é **reduzir incerteza até o ponto em que agir pareça seguro**. Uma pessoa chegando nesta home pode estar:

- **Ansiosa** (sintoma novo, medo do diagnóstico);
- **Constrangida** (especialidades como HIV/Aids e ISTs carregam estigma — a maior taxa de abandono de clínicas de infectologia acontece por vergonha, não por preço);
- **Cética** (já pesquisou 3 clínicas antes desta e quer confirmar que não é golpe/despreparo).

Por isso a jornada abaixo segue um funil específico de saúde, não o AIDA genérico de marketing:

**Acolhimento → Credibilidade → Relevância ("isso é pra mim?") → Prova social → Remoção de fricção → Ação assistida**

Cada seção da home corresponde a um desses estágios, na ordem em que a pessoa rola a página. Nenhuma seção pula etapa — não se pede conversão (Ação) antes de entregar Credibilidade, por exemplo.

---

## Personas de referência (usadas para calibrar cada decisão abaixo)

| Persona | Estado emocional ao chegar | O que precisa ver primeiro |
|---|---|---|
| **Marina, 34, sintoma novo** | Ansiosa, quer resolver rápido | Que é fácil marcar e que terá resposta rápida |
| **Sr. Antônio, 68, encaminhado pelo convênio** | Cético quanto a tecnologia, quer confirmar convênio aceito | Texto grande, convênio visível, telefone bem à mão (não só WhatsApp) |
| **Paciente de ISTs/HIV, qualquer idade** | Constrangido(a), teme julgamento ou exposição | Linguagem acolhedora, nenhuma seção "expõe" a especialidade de forma sensacionalista, sigilo mencionado explicitamente |

---

## 1. Cabeçalho fixo (sticky header)

**Objetivo:** ser a rede de segurança presente o tempo todo — o usuário nunca deve "perder" o caminho para o contato, não importa o quanto role a página.

**O que exibe:** logo, navegação principal, e um botão de contato (telefone ou WhatsApp) sempre visível à direita.

**Por que funciona:** em saúde, decisão de contato pode acontecer a qualquer momento da leitura — inclusive na primeira dobra, sem ler mais nada. Um cabeçalho fixo com CTA visível captura essas conversões "de impulso" que uma home sem header sticky perderia.

**Comportamento:** ganha uma sombra sutil (`shadow-sm`) só depois de iniciado o scroll — sinal discreto de que a página se moveu, sem distrair.

---

## 2. Faixa de emergência (condicional)

**Objetivo:** triagem sem alarmar todo mundo. Só aparece quando configurada (ex.: período de surto, plantão de feriado).

**Por que funciona:** uma faixa vermelha permanente vira "cegueira de banner" e perde efeito quando realmente precisa ser usada. Sendo condicional, mantém força de urgência real quando ativada.

**Cuidado de UX:** o texto precisa deixar claro o que é urgência (ex.: "Sintomas graves? Ligue agora") vs. o que não é — do contrário, pacientes com dúvidas leves também tentam usar o canal de emergência, sobrecarregando-o.

---

## 3. Hero — a primeira impressão (3 segundos)

**Objetivo:** responder três perguntas antes que o usuário role a página: *"O que é isso? É pra mim? O que eu faço agora?"*

**O que exibe:**
- Título (H1) — a promessa central, não o nome da clínica (o nome já está no logo). Ex.: "Cuidado especializado em Infectologia para Pernambuco" — comunica especialidade + geografia (relevância local, importante para busca e para confiança "é daqui, não é uma corrente nacional genérica").
- Subtítulo (lede) — expande a promessa com prova concreta (equipe especializada, infraestrutura própria) sem jargão técnico.
- **Dois CTAs, não um:** um primário ("Agendar Consulta", leva ao WhatsApp) e um secundário de baixo compromisso ("Conhecer especialidades", âncora para a seção 5). Nem todo visitante está pronto para agir — o CTA secundário evita perder quem só quer entender o serviço antes de decidir.
- Imagem real da clínica/equipe (nunca banco de imagens genérico com atores sorrindo) — autenticidade é o maior redutor de ceticismo nesta primeira dobra.

**Por que funciona:** decidir em 3 segundos exige que a pessoa não precise pensar. Dois caminhos claros (agir agora / entender mais) cobrem os dois estados emocionais mais comuns de chegada.

---

## 4. Faixa de confiança (trust strip)

**Objetivo:** entregar credibilidade **antes** de pedir qualquer coisa — o usuário ainda não foi convidado a agir de novo, só a confiar.

**O que exibe:** selos/frases curtas de prova (equipe especializada, atendimento humanizado, infraestrutura própria, referência na região) — e, assim que houver dados reais, **logos de convênios aceitos**. Convênio aceito é frequentemente o fator decisório #1 para o Sr. Antônio da persona acima; deveria ganhar destaque visual assim que o cadastro de planos existir.

**Por que funciona:** psicologicamente, isso é "prova social de baixo custo" — não exige que o usuário leia depoimentos longos, só reconheça sinais familiares (nome do convênio, "infraestrutura própria") em poucos segundos.

---

## 5. Especialidades / Serviços — "isso é pra mim?"

**Objetivo:** autotriagem. O visitante precisa se reconhecer em um dos cards sem precisar ligar para perguntar "vocês tratam X?".

**O que exibe:** grid de cards (ícone + título + descrição curta) cobrindo as frentes de atendimento — incluindo, com o mesmo peso visual e o mesmo tom neutro das demais, especialidades sensíveis (HIV/Aids e ISTs). Nenhuma delas fica isolada, menor ou com cor diferente das outras — isolar visualmente a especialidade sensível é o erro mais comum (e mais nocivo) de UX em clínicas de infectologia, porque sinaliza ao próprio usuário que aquele assunto "é diferente/deve ser escondido".

**Por que funciona:** ao tratar todas as especialidades com o mesmo cartão, mesma cor, mesmo ícone-container — a mensagem implícita é "aqui isso é normal, tratado com o mesmo cuidado que qualquer outra consulta". Isso reduz a barreira de vergonha mais do que qualquer texto explicativo conseguiria.

**Comportamento:** hover eleva o card (`shadow-md` + leve `translateY`) — feedback de que é clicável, mesmo que hoje leve só à mesma página (deve linkar para uma página própria da especialidade assim que existir).

---

## 6. Como funciona o atendimento (seção nova recomendada)

**Ainda não existe no tema — recomendo criar.**

**Objetivo:** eliminar a maior fonte de ansiedade silenciosa: *"Eu não sei o que acontece depois que eu clico."* Preciso de encaminhamento? Quanto tempo demora? É por WhatsApp mesmo ou vou ter que ligar?

**O que exibe:** 3–4 passos numerados e ilustrados, curtos, em linguagem simples:
1. Chame no WhatsApp (ou ligue)
2. Nossa equipe confirma disponibilidade e convênio
3. Consulta agendada — você recebe confirmação por mensagem

**Por que funciona:** processos desconhecidos geram mais fricção do que processos longos, mas conhecidos. Um paciente que sabe exatamente o que vai acontecer nos próximos 5 minutos tem muito mais chance de completar a ação do que um que está "no escuro". Esta seção é, na prática, a que mais reduz a taxa de abandono antes do clique final — recomendo priorizá-la no próximo ciclo de desenvolvimento.

---

## 7. Equipe médica (seção nova recomendada)

**Ainda não existe no tema como listagem — recomendo criar (o card já está especificado no Design System).**

**Objetivo:** humanizar. Em saúde, o usuário não está escolhendo uma marca, está escolhendo **uma pessoa** para confiar sua saúde.

**O que exibe:** cards de médicos com foto real, nome, CRM (obrigatório — reforça credibilidade e é exigência ética/legal), especialidade, e um botão de baixo compromisso ("Ver perfil").

**Por que funciona:** ver o rosto e o CRM de quem vai atender reduz a ansiedade de "vou ser atendido por um desconhecido sem nome" — é a ponte entre "conheço a clínica" e "confio no médico".

---

## 8. Depoimentos / Prova social

**Objetivo:** prova social qualitativa, complementando os selos frios da seção 4 com histórias reais.

**O que exibe:** 2–3 depoimentos curtos, com nome (ou iniciais, se o paciente preferir por privacidade — especialmente relevante nas especialidades sensíveis) e, quando possível, foto/avatar. Card com fundo diferenciado (`neutral-50`, não branco) para não ser confundido com conteúdo institucional — é a voz do paciente, não da clínica.

**Cuidado de UX/LGPD:** depoimentos de pacientes de especialidades sensíveis exigem consentimento explícito e por escrito, e devem priorizar anonimização (iniciais, sem foto) — nunca usar como "prova" de forma que exponha a condição de saúde de alguém identificável.

---

## 9. Conteúdo educativo (blog) — já existe no tema

**Objetivo:** captar quem ainda não está pronto para agendar, mas está pesquisando sintomas/condições — o topo do funil.

**Por que funciona:** também funciona como prova de autoridade passiva ("eles publicam conteúdo técnico, então entendem do assunto") sem precisar dizer "somos os melhores" — a demonstração é mais convincente que a afirmação.

**Observação:** para o público de especialidades sensíveis, conteúdo educativo é frequentemente o **primeiro contato real** com a marca (a pessoa pesquisa o sintoma antes de considerar procurar uma clínica) — vale garantir que existam artigos cobrindo essas condições com o mesmo tom acolhedor do resto do site.

---

## 10. FAQ (seção nova recomendada)

**Ainda não existe — recomendo criar antes do CTA final.**

**Objetivo:** resolver objeções operacionais antes que virem mensagens de WhatsApp repetitivas para a equipe (e antes que a dúvida vire desistência silenciosa).

**Perguntas mínimas a cobrir:** convênios aceitos, necessidade de encaminhamento, atende urgência, é preciso exame prévio, há sigilo/confidencialidade garantidos, forma de pagamento particular.

**Por que funciona:** reduz o custo cognitivo de "vou ter que perguntar isso e pode ser embaraçoso" — principalmente a pergunta de sigilo, que muitas vezes é exatamente o que trava o clique final para o paciente mais constrangido.

---

## 11. Banner de CTA final — já existe no tema

**Objetivo:** o último convite antes do rodapé, para quem leu a página inteira e ainda não agiu.

**O que exibe:** título direto ("Precisa de atendimento especializado?"), e os dois canais lado a lado (WhatsApp + telefone) — nunca só um, porque o Sr. Antônio da persona prefere ligar, e insistir em WhatsApp como único canal o perderia.

**Por que funciona:** contraste alto (fundo `primary-600`, texto branco) sinaliza "esta é a ação que temos pedido a página inteira" — visualmente distinto de todo o resto para não ser ignorado por "cegueira de banner".

---

## 12. Rodapé — já existe no tema

**Objetivo:** confiança de "bastidor" — o que uma pessoa cética confere antes de decidir. Endereço físico real, CNPJ, redes sociais ativas (perfil não abandonado), e (recomendo adicionar) link para a Política de Privacidade — obrigatório sob a LGPD para um site que trata de dados de saúde, e um forte sinal de seriedade institucional.

---

## 13. O botão de WhatsApp — o elemento central desta jornada

Este é o ponto de virada de toda a página: onde a intenção construída nas seções 1–12 vira uma ação real.

### Onde ele mora

- **Um CTA de WhatsApp no header** (sempre visível, seção 1);
- **Um CTA de WhatsApp no hero** (ação primária, seção 3);
- **Um CTA de WhatsApp no banner final** (seção 11);
- **Um botão flutuante fixo**, canto inferior direito, visível em toda a rolagem (mobile e desktop) — recomendo adicionar; ainda não existe no tema.

**Por que repetir 4 vezes não é redundante:** a decisão de contato não acontece num momento fixo da leitura — cada pessoa "amadurece" em um ponto diferente da página. Repetir o mesmo caminho de saída em pontos previsíveis (não a cada 2 parágrafos) atende a todos esses momentos sem parecer insistência.

### Comportamento do botão flutuante

- Aparece com um leve *fade-in* depois que o usuário rola além do hero (não some no topo — evita competir com os CTAs do hero, que já cobrem esse momento).
- Ícone reconhecível do WhatsApp + rótulo curto ("Fale conosco") em telas largas; só o ícone em círculo (`radius-full`) em mobile, para não ocupar espaço de leitura.
- **Nunca usar animação de pulso agressiva/contínua** — em contexto de saúde, um elemento "gritando" por atenção o tempo todo aumenta ansiedade em vez de convidar à ação. Se houver ênfase, uma única pulsação sutil na primeira aparição, depois estática.

### A mensagem pré-preenchida (o detalhe que mais importa)

Ao clicar, o link do WhatsApp deve abrir a conversa **com uma mensagem inicial já escrita** (parâmetro de URL padrão do WhatsApp), nunca uma tela em branco. Duas razões:

1. **Remove a "ansiedade da página em branco"** — muita gente desiste de escrever a primeira mensagem porque não sabe como começar ("Oi, vi o site de vocês e..."). Se o texto já vem pronto, o único esforço do usuário é apertar enviar.
2. **Contextualiza a equipe** que recebe a mensagem — sabem de onde veio o contato e podem responder mais rápido.

Recomendo variar a mensagem pré-preenchida por origem do clique (ex.: "Olá! Vi o site do IPI e gostaria de agendar uma consulta" a partir do hero vs. "Olá! Tenho uma dúvida sobre convênios aceitos" a partir do FAQ) — pequeno ajuste que aumenta muito a taxa de resposta útil da equipe.

### Expectativa de resposta

Perto de qualquer CTA de WhatsApp, uma frase curta ajustando expectativa ("Respondemos em até 15 minutos em horário comercial") reduz a ansiedade pós-clique — a pessoa não fica se perguntando se foi ignorada.

---

## Mapa emocional da jornada (resumo)

| Seção | Estado emocional antes | Estado emocional depois |
|---|---|---|
| Hero | Incerto, avaliando | Orientado — sabe que existem 2 caminhos |
| Faixa de confiança | Orientado, ainda cético | Levemente mais confiante |
| Especialidades | "Será que é pra mim?" | Reconhecido, sem constrangimento |
| Como funciona | Curioso, um pouco ansioso | Tranquilo — sabe o que esperar |
| Equipe médica | Vai confiar numa marca | Vai confiar numa pessoa |
| Depoimentos | Cético quanto a resultado | Validado por pares |
| FAQ | Com dúvidas operacionais | Sem objeções pendentes |
| CTA final / flutuante | Convencido, sem pretexto para adiar | **Age** |

---

## O que evitar (guardrails éticos, não apenas de UX)

- **Nenhuma urgência falsa** ("Só 2 vagas hoje!", contadores regressivos) — prática antiética em saúde e proibida em boa parte das diretrizes de publicidade médica (CFM).
- **Nenhum pop-up bloqueando conteúdo** ao chegar na página — em saúde, interromper alguém que busca informação é o oposto do acolhimento que a marca propõe.
- **Nenhuma pré-marcação de consentimento** (ex.: checkbox de newsletter já marcado) — LGPD exige opt-in explícito, e é a postura eticamente correta para dados sensíveis de saúde.
- **Nunca isolar visualmente** as especialidades sensíveis (ver seção 5) — o dano de estigma supera qualquer ganho de clareza.

---

## Métricas para validar esta jornada (uma vez publicada)

- Taxa de clique no WhatsApp por seção de origem (hero vs. flutuante vs. banner final) — indica em que ponto da leitura a decisão realmente amadurece.
- Scroll depth até a seção "Como funciona" — se a maioria não chega lá, ela deveria subir na ordem da página.
- Taxa de abertura do FAQ antes do clique final — sinal de que dúvidas operacionais ainda são a maior barreira.
- Tempo de resposta real da equipe no WhatsApp vs. a expectativa comunicada na página (ajustar o texto se a promessa não for cumprida).
