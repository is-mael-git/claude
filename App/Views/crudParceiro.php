<?php

include_once BASE_MENU;
require_once BASE_MODAL;
require_once BASE_COMPONENTES . "/adicionarParceiro.php";
require_once BASE_COMPONENTES . "/modalInativar.php";

if (!empty($salvo)) {
    require BASE_COMPONENTES . "/modalSalvo.php";
}
?>

<div class="menuLateralAreaTrabalho crudParceiro">
    <button class="botaoAddParceiro abrirModal" data-modal="modalCadastroParceiro">
        <i class="fa-solid fa-plus"></i>
        PARCEIRO
    </button>
    <div class="containerTabela" id="paginar">
        <table class="tabela tabelaParceiros">
            <thead class="tabelaCabecalho tabelaCabecalhoParceiros">
                <tr class="linhaTabelaCabecalho linhaTabelaCabecalhoParceiros">
                    <th class="itemTabelaCabecalho itemTabelaParceiros1">Parceiro</th>
                    <th class="itemTabelaCabecalho itemTabelaParceiros2">Área de Atuação</th>
                    <th class="itemTabelaCabecalho itemTabelaParceiros3">CNPJ</th>
                    <th class="itemTabelaCabecalho itemTabelaParceiros4">E-mail</th>
                    <th class="itemTabelaCabecalho itemTabelaParceiros5">Telefone</th>
                    <th class="itemTabelaCabecalho itemTabelaParceiros6">Status</th>
                    <th class="itemTabelaCabecalho itemTabelaParceiros7">Ações</th>
                </tr>
            </thead>
            <tbody class="tabelaCorpo tabelaCorpoParceiros">


            </tbody>
        </table>
    </div>
    <div class="juntarPaginacaoPagina">
        <div class="paginacao">
            <div class="primeiro setasPaginacao"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10.5 3.5 6 8l4.5 4.5"></path>
                    <path d="M5.5 3.5v9"></path>
                </svg></div>
            <div class="anterior setasPaginacao"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10 3.5 5.5 8l4.5 4.5"></path>
                </svg></div>
            <div class="numeros">
            </div>
            <div class="proximo setasPaginacao"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 3.5 10.5 8 6 12.5"></path>
                </svg></div>
            <div class="ultimo setasPaginacao"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5.5 3.5 10 8l-4.5 4.5"></path>
                    <path d="M10.5 3.5v9"></path>
                </svg></div>
        </div>
        <div class="wrapperQuantidadePagina">
            <select name="quantidadePagina" id="quantidadePagina"></select>
        </div>
    </div>

    <button class="botaoVerCardParceiro" onclick="window.location.href = '<?= BASE_URL ?>parceiros/cards'"><i class="fa-solid fa-arrow-right"></i> VISUALIZAÇÃO EM CARDS</button>
</div>
<script src="<?= BASE_JS ?>Componentes/mascaras.js"></script>
<script src="<?= BASE_JS ?>Componentes/selectCustomizado.js"></script>
<script src="<?= BASE_JS ?>crudParceiro.js"></script>
<script src="<?= BASE_JS ?>Componentes/btnAtivoParceiro.js"></script>
<script src="<?= BASE_JS ?>Componentes/tabela.js"></script>