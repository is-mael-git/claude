<?php
include_once BASE_MENU;

use Controller\controllerMenuLateral;

// Lista de startups pra tabela. O caminho esperado é o controller passar via
// mostrarTela('crudStartups', ['startups' => ...]) — mas caso essa view seja
// renderizada sem essa variável chegar no escopo (depende de como mostrarTela
// repassa os dados), busca direto do Model como fallback.
$startups = $startups ?? \Model\startups::listar();

$mapaEstagioLabel = [
    1 => 'Ideação',
    2 => 'MVP',
    3 => 'Tração',
    4 => 'Escala',
    5 => 'Consolidação',
];

$mapaSetorLabel = [
    'tech'      => 'Tecnologia',
    'health'    => 'Saúde',
    'edu'       => 'Educação',
    'fin'       => 'Finanças',
    'agro'      => 'Agronegócio',
    'retail'    => 'Varejo',
    'logistica' => 'Logística',
    'outros'    => 'Outros',
];

// Formatação de exibição — o dado é salvo só com dígitos (ver
// controllerStartups::adicionar), então a máscara é reconstruída aqui.
$cnpjParaExibicao = function (?string $cnpj): string {
    $digitos = preg_replace('/\D/', '', (string) $cnpj);
    if (strlen($digitos) !== 14) return (string) $cnpj;
    return sprintf(
        '%s.%s.%s/%s-%s',
        substr($digitos, 0, 2), substr($digitos, 2, 3), substr($digitos, 5, 3),
        substr($digitos, 8, 4), substr($digitos, 12, 2)
    );
};

$telefoneParaExibicao = function (?string $telefone): string {
    $digitos = preg_replace('/\D/', '', (string) $telefone);
    if (strlen($digitos) === 11) return sprintf('(%s) %s-%s', substr($digitos, 0, 2), substr($digitos, 2, 5), substr($digitos, 7, 4));
    if (strlen($digitos) === 10) return sprintf('(%s) %s-%s', substr($digitos, 0, 2), substr($digitos, 2, 4), substr($digitos, 6, 4));
    return (string) $telefone;
};
?>


<div class="menuLateralAreaTrabalho crudStartups">
  <button class="cs-triggerBtn" onclick="abrirCadastroNovo()">Cadastrar Startup</button>

  <div class="cs-tableWrap">
    <table class="cs-table">
      <thead class="cs-tableHead">
        <tr class="cs-tableHeadRow">
          <th class="cs-tableHeadCell cs-col-startup">Startup</th>
          <th class="cs-tableHeadCell cs-col-setor">Setor de Atuação</th>
          <th class="cs-tableHeadCell cs-col-cnpj">CNPJ</th>
          <th class="cs-tableHeadCell cs-col-email">E-mail</th>
          <th class="cs-tableHeadCell cs-col-telefone">Telefone</th>
          <th class="cs-tableHeadCell cs-col-estagio">Estágio</th>
          <th class="cs-tableHeadCell cs-col-acoes">Ações</th>
        </tr>
      </thead>
      <tbody class="cs-tableBody">
        <?php if (empty($startups)): ?>
          <tr class="cs-tableRow cs-tableRowEmpty">
            <td class="cs-tableCell cs-tableEmptyState" colspan="7">Nenhuma startup cadastrada ainda.</td>
          </tr>
        <?php else: foreach ($startups as $startup): ?>
          <?php
            $estagioNum   = (int) ($startup['estagio_atual'] ?? 0);
            $estagioLabel = $mapaEstagioLabel[$estagioNum] ?? 'Não informado';
            $estagioTier  = $estagioNum <= 2 ? 1 : ($estagioNum === 3 ? 2 : 3);
            $setorChave   = $startup['setor_atuacao'] ?? '';
            $setorLabel   = $mapaSetorLabel[$setorChave] ?? ($setorChave !== '' ? $setorChave : '—');
            $fotoSrc      = !empty($startup['foto_startup'])
                ? '/ParkTec/Public/' . $startup['foto_startup']
                : '/ParkTec/Public/Assets/icons/nophotoempresa.jpg';
          ?>
          <tr class="cs-tableRow" data-id-startup="<?= (int) $startup['id_startup'] ?>">
            <td class="cs-tableCell cs-col-startup">
              <div class="cs-tableEntity">
                <img class="cs-tableAvatar" src="<?= htmlspecialchars($fotoSrc) ?>" alt="">
                <span><?= htmlspecialchars($startup['nome_startup'] ?? '') ?></span>
              </div>
            </td>
            <td class="cs-tableCell cs-col-setor"><?= htmlspecialchars($setorLabel) ?></td>
            <td class="cs-tableCell cs-col-cnpj"><?= htmlspecialchars($cnpjParaExibicao($startup['cnpj'] ?? '')) ?></td>
            <td class="cs-tableCell cs-col-email"><?= htmlspecialchars($startup['email_startup'] ?? '') ?></td>
            <td class="cs-tableCell cs-col-telefone"><?= htmlspecialchars($telefoneParaExibicao($startup['telefone_startup'] ?? '')) ?></td>
            <td class="cs-tableCell cs-col-estagio">
              <span class="cs-stageBadge cs-stageBadge--tier<?= $estagioTier ?>"><?= htmlspecialchars($estagioLabel) ?></span>
            </td>
            <td class="cs-tableCell cs-col-acoes">
              <button type="button" class="cs-tableActionBtn cs-tableActionEdit" data-id="<?= (int) $startup['id_startup'] ?>" title="Editar" aria-label="Editar startup">
                <svg width="15" height="15" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                  <path d="M13.5 3.5l3 3L6 17H3v-3L13.5 3.5z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round" />
                </svg>
              </button>
              <button type="button" class="cs-tableActionBtn cs-tableActionDelete" data-id="<?= (int) $startup['id_startup'] ?>" aria-label="Excluir startup">
                <svg width="15" height="15" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                  <path d="M4 6h12M8 6V4.5A1.5 1.5 0 0 1 9.5 3h1A1.5 1.5 0 0 1 12 4.5V6m-6.5 0 .6 9.4A1.5 1.5 0 0 0 7.6 17h4.8a1.5 1.5 0 0 0 1.5-1.6L14.5 6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </button>
            </td>
          </tr>
        <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>

  <section class="cs-overlay">

    <div class="cs-dialog" role="dialog" aria-labelledby="modalTitle" aria-modal="true">

      <header class="cs-modalHeader">
        <div class="cs-headerTitle">
          <svg width="30" height="30" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
            <circle cx="12" cy="7" r="4" fill="white" />
            <path d="M4 20c0-4.4 3.6-8 8-8s8 3.6 8 8" fill="white" />
          </svg>
          <h1 id="modalTitle">Cadastrar Startups</h1>
        </div>

        <button class="cs-closeBtn" onclick="closeModal()" aria-label="Fechar modal">
          <svg width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path fill="#E6EFFF" d="M18.3 5.71a1 1 0 0 0-1.42 0L12 10.59 7.12 5.71a1 1 0 1 0-1.42 1.42L10.59 12l-4.89 4.88a1 1 0 1 0 1.42 1.42L12 13.41l4.88 4.89a1 1 0 0 0 1.42-1.42L13.41 12l4.89-4.88a1 1 0 0 0 0-1.41z" />
          </svg>
        </button>
      </header>

      <div class="cs-modalContent">

        <nav class="cs-stepper" aria-label="Etapas do cadastro">
          <div class="cs-step">
            <span class="cs-stepCircle">1</span>
            <span class="cs-stepLabel">Dados da Startup</span>
          </div>
          <div class="cs-stepLine"></div>
          <div class="cs-step">
            <span class="cs-stepCircle">2</span>
            <span class="cs-stepLabel">Localização e Programa</span>
          </div>
          <div class="cs-stepLine"></div>
          <div class="cs-step">
            <span class="cs-stepCircle">3</span>
            <span class="cs-stepLabel">Questionário</span>
          </div>
        </nav>

        <p class="cs-subtitle">Preencha as informações para cadastrar uma startup no sistema.</p>

        <form id="startupForm">
          <div class="cs-columns">

            <!-- COLUNA 1 - DADOS DA STARTUP -->
            <section class="cs-card" aria-labelledby="col1-title">
              <div class="cs-cardTitle">
                <svg width="26" height="26" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                  <circle cx="12" cy="7" r="4" fill="#2F3C54" />
                  <path d="M4 20c0-4.4 3.6-8 8-8s8 3.6 8 8" fill="#2F3C54" />
                </svg>
                <h2 id="col1-title">Dados da Startup</h2>
              </div>
              <hr class="cs-cardDivider" />

              <div class="cs-photoRow">
                <div class="cs-photoUpload">
                  <input type="file" id="startup-photo" name="foto_startup" class="cs-fileInput" accept="image/*">
                  <label for="startup-photo" class="cs-avatarCircle" aria-label="Adicionar foto da startup">
                    <svg width="44" height="44" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                      <circle fill="#2F3C54" cx="32" cy="22" r="12" />
                      <path fill="#2F3C54" d="M8 58c0-12 10-20 24-20s24 8 24 20" />
                    </svg>
                    <span class="cs-avatarPlus">+</span>
                  </label>
                  <span class="cs-photoLabel">Adicionar Foto</span>
                </div>
              </div>

              <div class="cs-formGroup">
                <label for="startupName">Nome Da Startup</label>
                <div class="cs-inputWithIcon">
                  <svg class="cs-fieldIcon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2" y="2" width="14" height="14" rx="2" stroke="#2F3C54" stroke-width="1.6" />
                    <path d="M5 6h8M5 9h8M5 12h5" stroke="#2F3C54" stroke-width="1.4" stroke-linecap="round" />
                  </svg>
                  <input type="text" id="startupName" name="startupName" placeholder="Digite o nome da Startup" autocomplete="organization" required />
                </div>
              </div>

              <div class="cs-formGroup">
                <label for="email">E-mail Para Contato</label>
                <div class="cs-inputWithIcon">
                  <svg class="cs-fieldIcon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="1" y="3" width="16" height="12" rx="2" stroke="#2F3C54" stroke-width="1.6" />
                    <path d="M1 5.5l8 5 8-5" stroke="#2F3C54" stroke-width="1.4" />
                  </svg>
                  <input type="email" id="email" name="email" placeholder="contato@startup.com.br" autocomplete="email" required />
                </div>
              </div>

              <div class="cs-formGroup">
                <label for="cnpj">CNPJ</label>
                <div class="cs-inputWithIcon">
                  <svg class="cs-fieldIcon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2" y="1" width="14" height="16" rx="2" stroke="#2F3C54" stroke-width="1.6" />
                    <path d="M5 6h8M5 9h8M5 12h5" stroke="#2F3C54" stroke-width="1.4" stroke-linecap="round" />
                  </svg>
                  <input type="text" id="cnpj" name="cnpj" placeholder="00.000.000/0000-00" maxlength="18" required />
                </div>
              </div>

              <div class="cs-formGroup">
                <label for="phone">Número De Contato</label>
                <div class="cs-inputWithIcon">
                  <svg class="cs-fieldIcon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.2 2A1.2 1.2 0 0 1 4.4 1h1.8l1.2 3.5L5.6 6a8.6 8.6 0 0 0 4.4 4.4l1.5-1.8L15 9.8v1.8A1.2 1.2 0 0 1 13.8 13 11.8 11.8 0 0 1 3.2 2z" stroke="#2F3C54" stroke-width="1.4" />
                  </svg>
                  <input type="tel" id="phone" name="phone" placeholder="(xx) xxxxx-xxxx" autocomplete="tel" />
                </div>
              </div>
            </section>

            <!-- COLUNA 2 - LOCALIZAÇÃO & PROGRAMA -->
            <section class="cs-card" aria-labelledby="col2-title">
              <div class="cs-cardTitle">
                <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M13 2a8 8 0 0 1 8 8c0 5.5-8 14-8 14S5 15.5 5 10a8 8 0 0 1 8-8z" stroke="#2F3C54" stroke-width="2" />
                  <circle fill="#2F3C54" cx="13" cy="10" r="3" />
                </svg>
                <h2 id="col2-title">Localização e Programa</h2>
              </div>
              <hr class="cs-cardDivider" />

              <div class="cs-formGroup">
                <label for="address">Endereço</label>
                <div class="cs-inputWithIcon">
                  <svg class="cs-fieldIcon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 1.5A5.5 5.5 0 0 1 14.5 7c0 3.8-5.5 9.5-5.5 9.5S3.5 10.8 3.5 7A5.5 5.5 0 0 1 9 1.5z" stroke="#2F3C54" stroke-width="1.5" />
                    <circle fill="#2F3C54" cx="9" cy="7" r="2" />
                  </svg>
                  <input type="text" id="address" name="address" placeholder="Digite o seu endereço" autocomplete="street-address" />
                </div>
              </div>

              <div class="cs-formGroup">
                <label for="programs">Participação em Outros Programas</label>
                <div class="cs-inputWithIcon">
                  <svg class="cs-fieldIcon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="9" cy="9" r="7.5" stroke="#2F3C54" stroke-width="1.5" />
                    <path d="M9 5v4l3 2" stroke="#2F3C54" stroke-width="1.4" stroke-linecap="round" />
                  </svg>
                  <input type="text" id="programs" name="programs" placeholder="Ex.: SEBRAE, Inova MS…" />
                </div>
              </div>

              <div class="cs-formGroup">
                <label for="sector">Setor De Atuação</label>
                <div class="cs-selectWrapper">
                  <select id="sector" name="sector">
                    <option value="">Selecione o setor</option>
                    <option value="tech">Tecnologia</option>
                    <option value="health">Saúde</option>
                    <option value="edu">Educação</option>
                    <option value="fin">Finanças</option>
                    <option value="agro">Agronegócio</option>
                    <option value="retail">Varejo</option>
                    <option value="logistica">Logística</option>
                    <option value="outros">Outros</option>
                  </select>
                </div>
              </div>

              <div class="cs-formGroup">
                <label>Data De Fundação</label>
                <div class="cs-dateRow">
                  <div class="cs-selectWrapper">
                    <select id="foundDay" name="foundDay" aria-label="Dia de fundação"></select>
                  </div>
                  <div class="cs-selectWrapper">
                    <select id="foundMonth" name="foundMonth" aria-label="Mês de fundação"></select>
                  </div>
                  <div class="cs-selectWrapper">
                    <select id="foundYear" name="foundYear" aria-label="Ano de fundação"></select>
                  </div>
                </div>
              </div>

              <fieldset>
                <legend class="cs-sectionTitle">Estágio Atual</legend>
                <input type="hidden" id="stage" name="stage" value="">
                <div class="cs-tagsRow" id="stageTags">
                  <button type="button" class="cs-tagBtn" data-stage="ideacao">Ideação</button>
                  <button type="button" class="cs-tagBtn" data-stage="mvp">MVP</button>
                  <button type="button" class="cs-tagBtn" data-stage="tracao">Tração</button>
                  <button type="button" class="cs-tagBtn" data-stage="escala">Escala</button>
                  <button type="button" class="cs-tagBtn" data-stage="consolidacao">Consolidação</button>
                </div>
              </fieldset>
            </section>

            <!-- COLUNA 3 - QUESTIONÁRIO & FUNDADORES -->
            <section class="cs-card" aria-labelledby="col3-title">
              <div class="cs-cardTitle">
                <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="3" y="2" width="16" height="20" rx="2" stroke="#2F3C54" stroke-width="2" />
                  <path d="M7 7h8M7 11h8M7 15h5" stroke="#2F3C54" stroke-width="1.6" stroke-linecap="round" />
                  <circle fill="#2F3C54" cx="20" cy="20" r="5" />
                  <path d="M18 20h4M20 18v4" stroke="white" stroke-width="1.6" stroke-linecap="round" />
                </svg>
                <h2 id="col3-title">Questionário e Fundadores</h2>
              </div>
              <hr class="cs-cardDivider" />

              <div class="cs-formGroup">
                <label for="questionnaire">Questionário</label>
                <div class="cs-selectWithPlus">
                  <div class="cs-selectWrapper">
                    <select id="questionnaire" name="questionnaire">
                      <option value="">Selecione um questionário</option>
                      <option value="q1">Questionário Geral</option>
                      <option value="q2">Diagnóstico CERNE</option>
                      <option value="q3">Avaliação Inicial</option>
                    </select>
                  </div>
                  <button type="button" class="cs-plusBtn" id="addQuestBtn" title="Adicionar novo questionário">+</button>
                </div>
                <div class="cs-infoBox" id="questionnaireInfo" hidden></div>
              </div>

              <hr class="cs-sectionDivider" />

              <fieldset>
                <legend class="cs-sectionTitle">Fundadores</legend>
                <div class="cs-foundersList" id="foundersList" aria-live="polite"></div>
                <button type="button" class="cs-btnAddFounder" id="addFounderBtn">
                  <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <circle cx="7" cy="7" r="6" stroke="#2F3C54" stroke-width="1.5" />
                    <path d="M7 4v6M4 7h6" stroke="#2F3C54" stroke-width="1.5" stroke-linecap="round" />
                  </svg>
                  Adicionar Fundador
                </button>
              </fieldset>
            </section>

          </div>

          <footer class="cs-modalFooter">
            <button type="button" class="cs-btn cs-btnCancel" onclick="closeModal()">CANCELAR</button>
            <button type="submit" class="cs-btn cs-btnSave">SALVAR</button>
          </footer>
        </form>

      </div>
    </div>
  </section>

  <!-- ────────────────────────────────────────────────────────────
       MODAL DE DETALHES DO FUNDADOR (aberto pelo ícone "i" do item)
       Modelo visual: só "Fundador nº" e o nome vêm de dado real (digitado
       no card de cadastro). E-mail, telefone, LinkedIn, participação e bio
       são placeholders — não existe ainda um cadastro de Fundadores no
       banco. Quando esse módulo existir, essas linhas passam a vir de um
       fetch em vez de texto fixo no PHP.
  ──────────────────────────────────────────────────────────────── -->
  <section class="cs-founderOverlay" id="founderOverlay">
    <div class="cs-founderDialog" role="dialog" aria-labelledby="founderModalTitle" aria-modal="true">

      <header class="cs-modalHeader">
        <div class="cs-headerTitle">
          <svg width="26" height="26" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
            <circle cx="12" cy="7" r="4" fill="white" />
            <path d="M4 20c0-4.4 3.6-8 8-8s8 3.6 8 8" fill="white" />
          </svg>
          <h2 id="founderModalTitle">Detalhes do Fundador</h2>
        </div>
        <button type="button" class="cs-founderCloseBtn cs-closeBtn" aria-label="Fechar detalhes do fundador">
          <svg width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path fill="#E6EFFF" d="M18.3 5.71a1 1 0 0 0-1.42 0L12 10.59 7.12 5.71a1 1 0 1 0-1.42 1.42L10.59 12l-4.89 4.88a1 1 0 1 0 1.42 1.42L12 13.41l4.88 4.89a1 1 0 0 0 1.42-1.42L13.41 12l4.89-4.88a1 1 0 0 0 0-1.41z" />
          </svg>
        </button>
      </header>

      <div class="cs-founderModalContent">

        <div class="cs-founderDetailHead">
          <div class="cs-founderDetailAvatar" aria-hidden="true">
            <svg width="34" height="34" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
              <circle fill="#2F3C54" cx="32" cy="22" r="12" />
              <path fill="#2F3C54" d="M8 58c0-12 10-20 24-20s24 8 24 20" />
            </svg>
          </div>
          <span class="cs-founderDetailEyebrow">Fundador nº <span class="cs-founderDetailBadge">1</span></span>
        </div>

        <hr class="cs-cardDivider" />

        <form id="founderForm" class="cs-founderForm">
          <div class="cs-formGroup">
            <label for="founderNome">Nome</label>
            <div class="cs-inputWithIcon">
              <svg class="cs-fieldIcon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="2" y="2" width="14" height="14" rx="2" stroke="#2F3C54" stroke-width="1.6" />
                <path d="M5 6h8M5 9h8M5 12h5" stroke="#2F3C54" stroke-width="1.4" stroke-linecap="round" />
              </svg>
              <input type="text" id="founderNome" class="cs-founderNomeInput" placeholder="Nome do fundador">
            </div>
          </div>

          <div class="cs-formGroup">
            <label for="founderCargo">Cargo</label>
            <div class="cs-inputWithIcon">
              <svg class="cs-fieldIcon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="2" y="5" width="14" height="10" rx="1.5" stroke="#2F3C54" stroke-width="1.4" />
                <path d="M6 5V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v1" stroke="#2F3C54" stroke-width="1.4" />
              </svg>
              <input type="text" id="founderCargo" class="cs-founderCargoInput" placeholder="Ex.: CEO, CTO, Head de Produto...">
            </div>
          </div>

          <div class="cs-founderFormRow">
            <div class="cs-formGroup">
              <label for="founderEmail">E-mail</label>
              <div class="cs-inputWithIcon">
                <svg class="cs-fieldIcon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="1" y="3" width="16" height="12" rx="2" stroke="#2F3C54" stroke-width="1.6" />
                  <path d="M1 5.5l8 5 8-5" stroke="#2F3C54" stroke-width="1.4" />
                </svg>
                <input type="email" id="founderEmail" class="cs-founderEmailInput" placeholder="email@exemplo.com">
              </div>
            </div>

            <div class="cs-formGroup">
              <label for="founderTelefone">Telefone</label>
              <div class="cs-inputWithIcon">
                <svg class="cs-fieldIcon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M3.2 2A1.2 1.2 0 0 1 4.4 1h1.8l1.2 3.5L5.6 6a8.6 8.6 0 0 0 4.4 4.4l1.5-1.8L15 9.8v1.8A1.2 1.2 0 0 1 13.8 13 11.8 11.8 0 0 1 3.2 2z" stroke="#2F3C54" stroke-width="1.4" />
                </svg>
                <input type="tel" id="founderTelefone" class="cs-founderTelefoneInput" placeholder="(xx) xxxxx-xxxx">
              </div>
            </div>
          </div>

          <div class="cs-founderFormRow">
            <div class="cs-formGroup">
              <label for="founderLinkedin">LinkedIn</label>
              <div class="cs-inputWithIcon">
                <svg class="cs-fieldIcon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M7 11L11 7" stroke="#2F3C54" stroke-width="1.5" stroke-linecap="round" />
                  <path d="M8.5 4.5L10 3a3 3 0 0 1 4 4l-1.5 1.5M9.5 13.5L8 15a3 3 0 0 1-4-4l1.5-1.5" stroke="#2F3C54" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <input type="text" id="founderLinkedin" class="cs-founderLinkedinInput" placeholder="linkedin.com/in/...">
              </div>
            </div>

            <div class="cs-formGroup">
              <label for="founderParticipacao">Participação</label>
              <div class="cs-inputWithIcon">
                <svg class="cs-fieldIcon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="5" cy="5" r="1.8" stroke="#2F3C54" stroke-width="1.4" />
                  <circle cx="13" cy="13" r="1.8" stroke="#2F3C54" stroke-width="1.4" />
                  <path d="M13 5L5 13" stroke="#2F3C54" stroke-width="1.4" stroke-linecap="round" />
                </svg>
                <input type="text" id="founderParticipacao" class="cs-founderParticipacaoInput" placeholder="Ex.: 25%, Sócio-fundador...">
              </div>
            </div>
          </div>

          <div class="cs-formGroup">
            <label for="founderBio">Sobre</label>
            <textarea id="founderBio" class="cs-founderBioInput" rows="3" placeholder="Conte um pouco sobre a trajetória do fundador..."></textarea>
          </div>

          <p class="cs-infoBox">
            Isso fica salvo só nesta sessão do navegador — quando o cadastro de
            Fundadores existir de verdade no banco, esse formulário passa a
            salvar lá.
          </p>

          <footer class="cs-secondaryModalFooter">
            <button type="button" class="cs-btn cs-btnCancel cs-founderCancelBtn">CANCELAR</button>
            <button type="submit" class="cs-btn cs-btnSave">SALVAR</button>
          </footer>
        </form>

      </div>
    </div>
  </section>
  <section class="cs-questOverlay" id="questOverlay">
    <div class="cs-questDialog" role="dialog" aria-labelledby="questModalTitle" aria-modal="true">

      <header class="cs-modalHeader">
        <div class="cs-headerTitle">
          <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
            <rect x="3" y="2" width="16" height="20" rx="2" stroke="white" stroke-width="2" />
            <path d="M7 7h8M7 11h8M7 15h5" stroke="white" stroke-width="1.6" stroke-linecap="round" />
          </svg>
          <h2 id="questModalTitle">Adicionar Questionário</h2>
        </div>
        <button type="button" class="cs-questCloseBtn cs-closeBtn" aria-label="Fechar adicionar questionário">
          <svg width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path fill="#E6EFFF" d="M18.3 5.71a1 1 0 0 0-1.42 0L12 10.59 7.12 5.71a1 1 0 1 0-1.42 1.42L10.59 12l-4.89 4.88a1 1 0 1 0 1.42 1.42L12 13.41l4.88 4.89a1 1 0 0 0 1.42-1.42L13.41 12l4.89-4.88a1 1 0 0 0 0-1.41z" />
          </svg>
        </button>
      </header>

      <div class="cs-questModalContent">

        <p class="cs-subtitle">Cadastre um novo questionário pra usar no cadastro de startups.</p>

        <form id="questForm" class="cs-questForm">
          <div class="cs-formGroup">
            <label for="questNome">Nome do Questionário</label>
            <div class="cs-inputWithIcon">
              <svg class="cs-fieldIcon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="2" y="2" width="14" height="14" rx="2" stroke="#2F3C54" stroke-width="1.6" />
                <path d="M5 6h8M5 9h8M5 12h5" stroke="#2F3C54" stroke-width="1.4" stroke-linecap="round" />
              </svg>
              <input type="text" id="questNome" name="questNome" class="cs-questNomeInput" placeholder="Ex.: Diagnóstico CERNE" required>
            </div>
          </div>

          <p class="cs-infoBox">
            Por enquanto isso só adiciona a opção na lista deste formulário. Quando o
            cadastro de Questionários existir de verdade, esse nome passa a ser
            salvo no banco.
          </p>

          <footer class="cs-secondaryModalFooter">
            <button type="button" class="cs-btn cs-btnCancel cs-questCancelBtn">CANCELAR</button>
            <button type="submit" class="cs-btn cs-btnSave">ADICIONAR</button>
          </footer>
        </form>

      </div>
    </div>
  </section>

</div>
<script src="<?= BASE_JS ?>crudStartups.js"></script>