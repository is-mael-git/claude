// ──────────────────────────────────────────────
// REFERÊNCIAS
// ──────────────────────────────────────────────
const form          = document.getElementById('startupForm');
const foundersList  = document.getElementById('foundersList');
const addFounderBtn = document.getElementById('addFounderBtn');
const addQuestBtn   = document.getElementById('addQuestBtn');
const questSelect   = document.getElementById('questionnaire');
const questInfo     = document.getElementById('questionnaireInfo');
const stageTags     = document.getElementById('stageTags');
const stageInput    = document.getElementById('stage');

// overlay e trigger: seletores alinhados às classes cs- do HTML
const mainOverlay  = document.querySelector('.crudStartups .cs-overlay');
const triggerBtn = document.querySelector('.crudStartups .cs-triggerBtn');
const mainModal = document.querySelector('.crudStartups .cs-dialog');

// modal (aninhado) de detalhes do fundador — ver seção FUNDADORES mais abaixo
const founderOverlay   = document.querySelector('.crudStartups .cs-founderOverlay');
const founderDialog    = document.querySelector('.crudStartups .cs-founderDialog');
const founderCloseBtn  = document.querySelector('.crudStartups .cs-founderCloseBtn');
const founderForm      = document.getElementById('founderForm');
const founderCancelBtn = document.querySelector('.crudStartups .cs-founderCancelBtn');

// item .cs-founderItem sendo editado no modal no momento (null = nenhum)
let founderModalAlvo = null;

// modal (aninhado) de adicionar questionário — ver seção QUESTIONÁRIO mais abaixo
const questOverlay   = document.querySelector('.crudStartups .cs-questOverlay');
const questDialog    = document.querySelector('.crudStartups .cs-questDialog');
const questCloseBtn  = document.querySelector('.crudStartups .cs-questCloseBtn');
const questCancelBtn = document.querySelector('.crudStartups .cs-questCancelBtn');
const questForm      = document.getElementById('questForm');

// ──────────────────────────────────────────────
// ABRIR / FECHAR
// ──────────────────────────────────────────────
function openModal() {
  if (mainOverlay)  mainOverlay.classList.add('show');
  if (triggerBtn) triggerBtn.classList.add('hide');
}

function closeModal() {
  if (mainOverlay)  mainOverlay.classList.remove('show');
  if (triggerBtn) triggerBtn.classList.remove('hide');
}

function abrirDetalhesFundador(item) {
  if (!item || !founderDialog) return;
  founderModalAlvo = item;

  const badgeEl = founderDialog.querySelector('.cs-founderDetailBadge');
  if (badgeEl) badgeEl.textContent = item.querySelector('.cs-founderNumber')?.textContent || '';

  const campos = {
    '.cs-founderNomeInput':         item.querySelector('.cs-founderInput')?.value || '',
    '.cs-founderCargoInput':        item.dataset.cargo || '',
    '.cs-founderEmailInput':        item.dataset.email || '',
    '.cs-founderTelefoneInput':     item.dataset.telefone || '',
    '.cs-founderLinkedinInput':     item.dataset.linkedin || '',
    '.cs-founderParticipacaoInput': item.dataset.participacao || '',
    '.cs-founderBioInput':          item.dataset.bio || '',
  };

  Object.entries(campos).forEach(([seletor, valor]) => {
    const campo = founderDialog.querySelector(seletor);
    if (campo) campo.value = valor;
  });

  if (founderOverlay) founderOverlay.classList.add('show');
}

function fecharDetalhesFundador() {
  if (founderOverlay) founderOverlay.classList.remove('show');
  founderModalAlvo = null;
}

if (founderCloseBtn) {
  founderCloseBtn.addEventListener('click', e => {
    e.stopPropagation();
    fecharDetalhesFundador();
  });
}

if (founderCancelBtn) {
  founderCancelBtn.addEventListener('click', e => {
    e.stopPropagation();
    fecharDetalhesFundador();
  });
}

if (founderForm) {
  founderForm.addEventListener('submit', e => {
    e.preventDefault();
    if (!founderModalAlvo) return;

    // sincroniza o nome de volta pro input da lista de fundadores, já que
    // agora dá pra editar o nome por aqui também
    const nomeInput = founderDialog.querySelector('.cs-founderNomeInput');
    const inputLista = founderModalAlvo.querySelector('.cs-founderInput');
    if (inputLista) inputLista.value = nomeInput?.value.trim() || '';

    // o resto fica guardado no próprio item (dataset) — sem backend de
    // Fundadores ainda, isso é o que faz o dado "lembrar" se o modal for
    // reaberto depois, mesmo que só dure a sessão da página.
    founderModalAlvo.dataset.cargo        = founderDialog.querySelector('.cs-founderCargoInput')?.value.trim() || '';
    founderModalAlvo.dataset.email        = founderDialog.querySelector('.cs-founderEmailInput')?.value.trim() || '';
    founderModalAlvo.dataset.telefone     = founderDialog.querySelector('.cs-founderTelefoneInput')?.value.trim() || '';
    founderModalAlvo.dataset.linkedin     = founderDialog.querySelector('.cs-founderLinkedinInput')?.value.trim() || '';
    founderModalAlvo.dataset.participacao = founderDialog.querySelector('.cs-founderParticipacaoInput')?.value.trim() || '';
    founderModalAlvo.dataset.bio          = founderDialog.querySelector('.cs-founderBioInput')?.value.trim() || '';

    fecharDetalhesFundador();
  });
}

function abrirModalQuestionario() {
  if (questOverlay) questOverlay.classList.add('show');
  const input = questForm?.querySelector('.cs-questNomeInput');
  if (input) {
    input.value = '';
    setTimeout(() => input.focus(), 0);
  }
}

function fecharModalQuestionario() {
  if (questOverlay) questOverlay.classList.remove('show');
}

if (questCloseBtn) {
  questCloseBtn.addEventListener('click', e => {
    e.stopPropagation();
    fecharModalQuestionario();
  });
}

if (questCancelBtn) {
  questCancelBtn.addEventListener('click', e => {
    e.stopPropagation();
    fecharModalQuestionario();
  });
}

document.addEventListener('click', e => {
  const path = e.composedPath();

  // Os dois modais secundários (detalhes do fundador e adicionar
  // questionário) ficam "por cima" do modal principal e nunca aparecem ao
  // mesmo tempo um com o outro. Cada um é checado primeiro: se estiver
  // aberto, um clique fora dele fecha só ele — sem cair na checagem do
  // modal principal e fechar o cadastro inteiro (que ainda pode ter dados
  // preenchidos).
  if (founderOverlay && founderOverlay.classList.contains('show')) {
    if (path.includes(founderDialog)) return;
    fecharDetalhesFundador();
    return;
  }

  if (questOverlay && questOverlay.classList.contains('show')) {
    if (path.includes(questDialog)) return;
    fecharModalQuestionario();
    return;
  }

  if (!mainOverlay || !mainOverlay.classList.contains('show')) return;

  // composedPath() reflete o caminho do clique no momento em que o evento
  // foi disparado — ao contrário de e.target + contains(), continua correto
  // mesmo se o elemento clicado já tiver sido removido do DOM (ex.: o botão
  // de remover fundador, que apaga o item antes deste listener rodar).
  if (path.includes(mainModal)) return;
  if (triggerBtn && path.includes(triggerBtn)) return;
  closeModal();
});

document.addEventListener('keyup', e => {
  if (e.key !== 'Escape') return;

  // Mesma prioridade do listener de clique: Esc fecha primeiro o modal que
  // estiver "por cima" (fundador ou questionário), e só fecha o principal
  // numa tecla seguinte, se ele ainda estiver aberto.
  if (founderOverlay && founderOverlay.classList.contains('show')) {
    fecharDetalhesFundador();
    return;
  }

  if (questOverlay && questOverlay.classList.contains('show')) {
    fecharModalQuestionario();
    return;
  }

  if (mainOverlay && mainOverlay.classList.contains('show')) closeModal();
});
// ──────────────────────────────────────────────
// SUBMIT
// ──────────────────────────────────────────────
const ENDPOINT_ADICIONAR_STARTUP = '/ParkTec/startups/adicionar';
const ENDPOINT_ATUALIZAR_STARTUP = '/ParkTec/startups/atualizar';
const ENDPOINT_BUSCAR_STARTUP    = '/ParkTec/startups/buscar';

// null = cadastrando uma startup nova; com valor = editando essa startup
let startupEmEdicaoId = null;

const mapaEstagioReverso = { 1: 'ideacao', 2: 'mvp', 3: 'tracao', 4: 'escala', 5: 'consolidacao' };

function formatarCnpjExibicao(valor) {
  const digitos = (valor || '').replace(/\D/g, '');
  if (digitos.length !== 14) return valor || '';
  return `${digitos.slice(0, 2)}.${digitos.slice(2, 5)}.${digitos.slice(5, 8)}/${digitos.slice(8, 12)}-${digitos.slice(12, 14)}`;
}

function formatarTelefoneExibicao(valor) {
  const digitos = (valor || '').replace(/\D/g, '');
  if (digitos.length === 11) return `(${digitos.slice(0, 2)}) ${digitos.slice(2, 7)}-${digitos.slice(7, 11)}`;
  if (digitos.length === 10) return `(${digitos.slice(0, 2)}) ${digitos.slice(2, 6)}-${digitos.slice(6, 10)}`;
  return valor || '';
}

function limparErrosStartupForm() {
  const antigo = form.querySelector('.cs-fieldError');
  if (antigo) antigo.remove();
}

function mostrarErrosStartupForm(erros) {
  limparErrosStartupForm();
  const msg = document.createElement('p');
  msg.className = 'cs-fieldError';
  msg.style.color = '#c0392b';
  msg.style.margin = '8px 0 0';
  msg.textContent = erros.join(' • ');
  form.querySelector('.cs-modalFooter').before(msg);
}

// Abre o modal zerado, pra cadastrar uma startup nova — usado pelo botão
// "Cadastrar Startup" e sempre que uma edição é cancelada/concluída.
function abrirCadastroNovo() {
  startupEmEdicaoId = null;
  form.reset();
  stageTags?.querySelectorAll('.cs-tagBtn').forEach(b => b.classList.remove('active'));
  if (stageInput) stageInput.value = '';
  limparErrosStartupForm();

  const tituloEl = mainModal?.querySelector('.cs-headerTitle h1');
  if (tituloEl) tituloEl.textContent = 'Cadastrar Startups';

  openModal();
}

// Busca os dados de uma startup e abre o mesmo modal já preenchido, em modo
// de edição — o submit passa a chamar /atualizar em vez de /adicionar.
async function abrirEdicaoStartup(id) {
  try {
    const resposta = await fetch(`${ENDPOINT_BUSCAR_STARTUP}?id=${encodeURIComponent(id)}`);
    const dados = await resposta.json();

    if (!dados.sucesso || !dados.startup) {
      alert('Não foi possível carregar essa startup.');
      return;
    }

    const s = dados.startup;
    limparErrosStartupForm();
    startupEmEdicaoId = s.id_startup;

    form.querySelector('#startupName').value = s.nome_startup || '';
    form.querySelector('#email').value       = s.email_startup || '';
    form.querySelector('#cnpj').value        = formatarCnpjExibicao(s.cnpj);
    form.querySelector('#phone').value       = formatarTelefoneExibicao(s.telefone_startup);
    form.querySelector('#programs').value    = s.participacao_programas || '';
    form.querySelector('#address').value     = s.endereco || '';
    form.querySelector('#sector').value      = s.setor_atuacao || '';

    if (s.data_fundacao) {
      const [ano, mes, dia] = s.data_fundacao.split('-');
      form.querySelector('#foundYear').value  = String(parseInt(ano, 10));
      form.querySelector('#foundMonth').value = String(parseInt(mes, 10));
      form.querySelector('#foundDay').value   = String(parseInt(dia, 10));
    }

    const estagioChave = mapaEstagioReverso[Number(s.estagio_atual)];
    stageTags?.querySelectorAll('.cs-tagBtn').forEach(b => b.classList.remove('active'));
    if (estagioChave) {
      stageTags?.querySelector(`.cs-tagBtn[data-stage="${estagioChave}"]`)?.classList.add('active');
      if (stageInput) stageInput.value = estagioChave;
    }

    // Upload de foto não dá pra pré-preencher por segurança do navegador —
    // deixar o campo vazio na edição está OK: o backend mantém a foto atual
    // quando nenhuma nova é enviada (ver controllerStartups::atualizar).

    const tituloEl = mainModal?.querySelector('.cs-headerTitle h1');
    if (tituloEl) tituloEl.textContent = 'Editar Startup';

    openModal();
  } catch (erro) {
    alert('Erro de conexão ao carregar a startup.');
  }
}

form.addEventListener('submit', async e => {
  e.preventDefault();

  const saveBtn = form.querySelector('.cs-btnSave');
  saveBtn.disabled = true;
  saveBtn.textContent = 'Salvando...';

  const editando = startupEmEdicaoId !== null;
  const formData = new FormData(form);
  if (editando) formData.set('id_startup', startupEmEdicaoId);

  try {
    const resposta = await fetch(editando ? ENDPOINT_ATUALIZAR_STARTUP : ENDPOINT_ADICIONAR_STARTUP, {
      method: 'POST',
      body: formData,
    });
    const dados = await resposta.json();

    if (dados.sucesso) {
      // recarrega pra tabela já vir com a startup nova/atualizada — mais
      // simples e confiável do que reconstruir a linha via JS.
      alert(editando ? 'Startup atualizada com sucesso!' : 'Startup cadastrada com sucesso!');
      window.location.reload();
    } else {
      mostrarErrosStartupForm(dados.erros || [dados.erro || 'Não foi possível salvar a startup.']);
    }
  } catch (erro) {
    mostrarErrosStartupForm(['Erro de conexão. Tente novamente.']);
  } finally {
    saveBtn.disabled = false;
    saveBtn.textContent = 'SALVAR';
  }
});

// ──────────────────────────────────────────────
// TABELA DE STARTUPS — editar / excluir
// ──────────────────────────────────────────────
const tableBody = document.querySelector('.crudStartups .cs-tableBody');

if (tableBody) {
  tableBody.addEventListener('click', async e => {
    const editBtn = e.target.closest('.cs-tableActionEdit');
    if (editBtn) {
      abrirEdicaoStartup(editBtn.dataset.id);
      return;
    }

    const deleteBtn = e.target.closest('.cs-tableActionDelete');
    if (!deleteBtn) return;

    const row  = deleteBtn.closest('.cs-tableRow');
    const nome = row?.querySelector('.cs-tableEntity span')?.textContent?.trim() || 'esta startup';

    if (!confirm(`Excluir ${nome}? Essa ação não pode ser desfeita.`)) return;

    deleteBtn.disabled = true;
    try {
      const resposta = await fetch(`/ParkTec/startups/deletar?id=${encodeURIComponent(deleteBtn.dataset.id)}`, {
        method: 'POST',
      });
      const dados = await resposta.json();

      if (dados.sucesso) {
        row.remove();
        if (!tableBody.querySelector('.cs-tableRow')) {
          tableBody.innerHTML = `
            <tr class="cs-tableRow cs-tableRowEmpty">
              <td class="cs-tableCell cs-tableEmptyState" colspan="7">Nenhuma startup cadastrada ainda.</td>
            </tr>`;
        }
      } else {
        alert('Não foi possível excluir a startup.');
        deleteBtn.disabled = false;
      }
    } catch (erro) {
      alert('Erro de conexão ao excluir a startup.');
      deleteBtn.disabled = false;
    }
  });
}

// ──────────────────────────────────────────────
// TAGS DE ESTÁGIO — seleção única com toggle
// ──────────────────────────────────────────────
if (stageTags) {
  stageTags.addEventListener('click', e => {
    const btn = e.target.closest('.cs-tagBtn');
    if (!btn) return;

    const alreadyActive = btn.classList.contains('active');
    stageTags.querySelectorAll('.cs-tagBtn').forEach(b => b.classList.remove('active'));

    if (!alreadyActive) {
      btn.classList.add('active');
      if (stageInput) stageInput.value = btn.dataset.stage;
    } else if (stageInput) {
      stageInput.value = '';
    }
  });
}

// ──────────────────────────────────────────────
// QUESTIONÁRIO — adicionar nova opção
// Abre o modal cs-questOverlay em vez do prompt() nativo; o resultado é o
// mesmo: só adiciona a opção no <select> (nada persiste no banco ainda).
// ──────────────────────────────────────────────
if (addQuestBtn) {
  addQuestBtn.addEventListener('click', () => abrirModalQuestionario());
}

if (questForm) {
  questForm.addEventListener('submit', e => {
    e.preventDefault();

    const input = questForm.querySelector('.cs-questNomeInput');
    const nome  = input?.value.trim();
    if (!nome) {
      input?.focus();
      return;
    }

    const opt       = document.createElement('option');
    opt.value       = `custom_${Date.now()}`;
    opt.textContent = nome;
    questSelect.appendChild(opt);
    questSelect.value = opt.value;

    questInfo.textContent = `✓ "${nome}" adicionado e selecionado.`;
    questInfo.hidden = false;
    setTimeout(() => { questInfo.hidden = true; }, 3000);

    fecharModalQuestionario();
  });
}

// ──────────────────────────────────────────────
// FUNDADORES — adicionar / remover
// Nota: o backend ainda não persiste fundadores (id_fundador é um
// placeholder fixo por enquanto), então esses campos ficam só visuais
// até a tela/tabela de Fundadores existir.
// ──────────────────────────────────────────────

// Renumera os itens conforme a posição atual na lista (1..N), em vez de
// usar um contador que só cresce. Isso garante que a numeração exibida
// (badge, placeholder, aria-label, name do input) nunca pule um número
// quando um item do meio é removido, e volta a começar do 1 mesmo que o
// primeiro fundador seja removido.
function renumerarFundadores() {
  foundersList.querySelectorAll('.cs-founderItem').forEach((item, index) => {
    const numero    = index + 1;
    const badge     = item.querySelector('.cs-founderNumber');
    const input     = item.querySelector('.cs-founderInput');
    const infoBtn   = item.querySelector('.cs-founderInfo');
    const removeBtn = item.querySelector('.cs-founderRemove');

    if (badge) badge.textContent = numero;
    if (input) {
      input.name = `founder_${numero}`;
      input.placeholder = `Nome do Fundador ${numero}`;
      input.setAttribute('aria-label', `Fundador ${numero}`);
    }
    if (infoBtn)   infoBtn.setAttribute('aria-label', `Ver detalhes do fundador ${numero}`);
    if (removeBtn) removeBtn.setAttribute('aria-label', `Remover fundador ${numero}`);
  });
}

function criarFounderItem() {
  const item = document.createElement('div');
  item.className = 'cs-founderItem'; // ← classe scoped

  const badge = document.createElement('span');
  badge.className = 'cs-founderNumber'; // ← classe scoped

  const input = document.createElement('input');
  input.type = 'text';
  input.className = 'cs-founderInput'; // ← classe scoped

  // Ícone de detalhes — abre o modal de visualização do fundador. Os campos
  // além de nome/número ainda são só um modelo visual (ver nota no modal).
  const infoBtn = document.createElement('button');
  infoBtn.type = 'button';
  infoBtn.className = 'cs-founderInfo'; // ← classe scoped
  infoBtn.title = 'Ver detalhes do fundador';
  infoBtn.innerHTML = `
    <svg width="14" height="14" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
      <circle cx="9" cy="9" r="7.3" stroke="currentColor" stroke-width="1.4" />
      <path d="M9 8.3v4.1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
      <circle cx="9" cy="5.6" r="0.95" fill="currentColor" />
    </svg>`;
  infoBtn.addEventListener('click', e => {
    e.stopPropagation();
    abrirDetalhesFundador(item);
  });

  const removeBtn = document.createElement('button');
  removeBtn.type = 'button';
  removeBtn.className = 'cs-founderRemove'; // ← classe scoped
  removeBtn.title = 'Remover fundador';
  removeBtn.textContent = '×';
  removeBtn.addEventListener('click', e => {
    // Sem isso, o clique borbulha até o listener de "clicou fora, fecha o
    // modal" lá em cima. Como o item já foi removido do DOM antes desse
    // listener rodar, mainModal.contains(e.target) passava a dar false e o
    // modal inteiro fechava junto — stopPropagation evita que o clique
    // chegue até lá.
    e.stopPropagation();
    item.remove();
    renumerarFundadores();
  });

  item.appendChild(badge);
  item.appendChild(input);
  item.appendChild(infoBtn);
  item.appendChild(removeBtn);

  return item;
}

if (addFounderBtn) {
  addFounderBtn.addEventListener('click', () => {
    const item = criarFounderItem();
    foundersList.appendChild(item);
    renumerarFundadores();
    item.querySelector('.cs-founderInput').focus();
  });
}

// ──────────────────────────────────────────────
// DATA DE FUNDAÇÃO — preenche os selects via JS
// ──────────────────────────────────────────────
function buildDateSelects() {
  const dayEl   = document.getElementById('foundDay');
  const monthEl = document.getElementById('foundMonth');
  const yearEl  = document.getElementById('foundYear');

  const monthNames = ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
  const curYear    = new Date().getFullYear();

  dayEl.innerHTML = '<option value="">Dia</option>';
  for (let d = 1; d <= 31; d++) {
    dayEl.innerHTML += `<option value="${d}">${d}</option>`;
  }

  monthEl.innerHTML = '<option value="">Mês</option>';
  monthNames.forEach((m, i) => {
    monthEl.innerHTML += `<option value="${i + 1}">${m}</option>`;
  });

  yearEl.innerHTML = '<option value="">Ano</option>';
  for (let y = curYear; y >= 1990; y--) {
    yearEl.innerHTML += `<option value="${y}">${y}</option>`;
  }
}

buildDateSelects();

/*
  RECOMENDAÇÕES RÁPIDAS (resumo das melhorias discutidas):

  1) Estrutura / Templates
     - Centralizar um layout (header/footer) e usar partials para evitar duplicação.
     - Extrair componentes reutilizáveis (ex.: modal) em arquivos separados.

  2) JavaScript
     - Remover atributos inline (onclick) e adicionar event listeners no JS.
     - Encapsular código em módulo/IIFE para não poluir o escopo global.
     - Verificar existência de elementos antes de usá-los (defensivo).

  3) Acessibilidade do modal
     - Gerenciar foco (mover foco para o primeiro elemento do modal ao abrir e restaurar ao fechar).
     - Implementar trap-focus enquanto o modal estiver aberto.
     - Usar role/aria já presentes e garantir label adequado.

  4) Scroll / UX
     - Bloquear scroll do body ao abrir o modal (document.body.style.overflow = 'hidden') e restaurar ao fechar.
     - Preferir rolagem interna no conteúdo do modal (overflow:auto) para manter o topo fixo.

  5) CSS / Organização
     - Variáveis centralizadas em .crudStartups; prefixo cs- em todas as classes internas.
     - Estados comportamentais (show, hide, active) sem prefixo — controlados pelo JS.

  6) Backend / Segurança (quando for portar dados)
     - Usar prepared statements (PDO) para evitar SQL injection.
     - Validar server-side e proteger formulários com CSRF.
*/