<?php
include_once BASE_MENU;
require_once BASE_MODAL;
require_once BASE_COMPONENTES . "Questao/adicionarQuestao.php";
require_once BASE_COMPONENTES . "Questao/atualizarQuestao.php";
require_once BASE_COMPONENTES . "modalInativar.php";
?>

<div class="menuLateralAreaTrabalho crudQuestionario">

    <div class="botoesOpcaoQuestionario">

        <button
            class="opcaoQuestionario opcaoQuestao btnDefault abrirModal"
            data-modal="modalCriarQuestoes"
        >
            <i class="fa-solid fa-plus"></i>
            Questão
        </button>

    </div>

    <div class="containerTabela" id="paginar">

        <table class="tabela tabelaQuestionario">

            <thead class="tabelaCabecalho">

                <tr class="linhaTabelaCabecalho">

                    <th class="itemTabelaCabecalho itemTabelaQuestionario1">
                        Nome do questão
                    </th>

                    <th class="itemTabelaCabecalho itemTabelaQuestionario2">
                        Eixo cerne
                    </th>

                    <th class="itemTabelaCabecalho itemTabelaQuestionario3">
                        Status
                    </th>

                    <th class="itemTabelaCabecalho itemTabelaQuestionario4">
                        Ações
                    </th>

                </tr>

            </thead>

            <tbody class="tabelaCorpo"></tbody>

        </table>

    </div>

    <div class="paginacao">

        <div class="primeiro setasPaginacao">

            <svg
                width="16"
                height="16"
                viewBox="0 0 16 16"
                fill="none"
                stroke="currentColor"
                stroke-width="1.6"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M10.5 3.5 6 8l4.5 4.5"></path>
                <path d="M5.5 3.5v9"></path>
            </svg>

        </div>

        <div class="anterior setasPaginacao">

            <svg
                width="16"
                height="16"
                viewBox="0 0 16 16"
                fill="none"
                stroke="currentColor"
                stroke-width="1.6"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M10 3.5 5.5 8l4.5 4.5"></path>
            </svg>

        </div>

        <div class="numeros"></div>

        <div class="proximo setasPaginacao">

            <svg
                width="16"
                height="16"
                viewBox="0 0 16 16"
                fill="none"
                stroke="currentColor"
                stroke-width="1.6"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M6 3.5 10.5 8 6 12.5"></path>
            </svg>

        </div>

        <div class="ultimo setasPaginacao">

            <svg
                width="16"
                height="16"
                viewBox="0 0 16 16"
                fill="none"
                stroke="currentColor"
                stroke-width="1.6"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M5.5 3.5 10 8l-4.5 4.5"></path>
                <path d="M10.5 3.5v9"></path>
            </svg>

        </div>

    </div>

</div>

<script src="<?= BASE_JS ?>Componentes/btnAtivoParceiro.js"></script>
<script src="<?= BASE_JS ?>Componentes/tabela.js"></script>
<script src="<?= BASE_JS ?>Componentes/Questao/adicionarQuestao.js"></script>
<script src="<?= BASE_JS ?>Componentes/Questao/atualizarQuestao.js"></script>
