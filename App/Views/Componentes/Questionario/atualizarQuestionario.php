<?php abrirModal(
    'modalAtualizarQuestionario',
    'Editar Questionário',
    '',
    '',
    ''
); ?>

<div
    class="formularioAtualizarQuestionario"
    data-id-questionario="">

    <div class="etapasAtualizarQuestionario">

        <div
            class="etapaAtualizarQuestionario etapaAtivaAtualizarQuestionario"
            data-tela="1">
            <span class="numeroEtapaAtualizarQuestionario">1</span>
            <p>Informações</p>
        </div>

        <div class="linhaEtapaAtualizarQuestionario"></div>

        <div
            class="etapaAtualizarQuestionario"
            data-tela="2">
            <span class="numeroEtapaAtualizarQuestionario">2</span>
            <p>Questões</p>
        </div>

        <div class="linhaEtapaAtualizarQuestionario"></div>

        <div
            class="etapaAtualizarQuestionario"
            data-tela="3">
            <span class="numeroEtapaAtualizarQuestionario">3</span>
            <p>Revisão</p>
        </div>

    </div>


    <!-- ========================= -->
    <!-- UPDATE - ETAPA 1 -->
    <!-- ========================= -->

    <div
        class="telaAtualizarQuestionario telaAtivaAtualizarQuestionario"
        data-tela="1">

        <div class="areaFormularioAtualizarQuestionario">

            <div class="campoFormularioAtualizarQuestionario">

                <label for="nomeAtualizarQuestionario">
                    Nome do Questionário
                </label>

                <input
                    type="text"
                    id="nomeAtualizarQuestionario"
                    name="nomeAtualizarQuestionario"
                    placeholder="Nome do questionário"
                    required>

            </div>


            <div class="campoFormularioAtualizarQuestionario">

                <label for="descricaoAtualizarQuestionario">
                    Descrição
                </label>

                <textarea
                    id="descricaoAtualizarQuestionario"
                    name="descricaoAtualizarQuestionario"
                    placeholder="Descrição do questionário..."
                    maxlength="500"></textarea>

                <span class="contadorCaracteresAtualizarQuestionario">
                    0/500
                </span>

            </div>


            <div class="areaBotoesAtualizarQuestionario">

                <button
                    type="button"
                    class="btnCancelarAtualizarQuestionario">
                    CANCELAR
                </button>

                <button
                    type="button"
                    class="btnAvancarAtualizarQuestionario">
                    AVANÇAR
                </button>

            </div>

        </div>

    </div>


    <!-- ========================= -->
    <!-- UPDATE - ETAPA 2 -->
    <!-- ========================= -->

    <div
        class="telaAtualizarQuestionario"
        data-tela="2">

        <div class="areaQuestoesAtualizarQuestionario">

            <div class="cabecalhoQuestoesAtualizarQuestionario">

                <div class="tituloQuestoesAtualizarQuestionario">

                    <h2>Selecione as questões</h2>

                    <p>
                        Escolha as questões que farão parte do questionário.
                    </p>

                </div>


                <button
                    type="button"
                    class="botaoAdicionarQuestaoQuestionario botaoAdicionarQuestaoAtualizarQuestionario"
                    id="botaoAdicionarQuestaoAtualizarQuestionario">
                    <i class="fa-solid fa-plus"></i>
                    Questão
                </button>


                <div class="filtroQuestoesAtualizarQuestionario">

                    <button
                        type="button"
                        class="botaoFiltroAtualizarQuestionario"
                        id="botaoFiltroAtualizarQuestionario">

                        <span
                            class="nomeFiltroAtualizarQuestionario"
                            id="nomeFiltroAtualizarQuestionario">
                            Todos os eixos
                        </span>

                        <svg
                            class="iconeFiltroGerenciarQuestao"
                            width="16"
                            height="16"
                            viewBox="0 0 16 16"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4 6L8 10L12 6"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>

                    </button>


                    <div
                        class="opcoesFiltroAtualizarQuestionario"
                        id="opcoesFiltroAtualizarQuestionario">

                        <button
                            type="button"
                            class="opcaoFiltroAtualizarQuestionario"
                            data-eixo="todos">
                            Todos os eixos
                        </button>

                        <button
                            type="button"
                            class="opcaoFiltroAtualizarQuestionario"
                            data-eixo="empreendedor">
                            Empreendedor
                        </button>

                        <button
                            type="button"
                            class="opcaoFiltroAtualizarQuestionario"
                            data-eixo="tecnologia">
                            Tecnologia
                        </button>

                        <button
                            type="button"
                            class="opcaoFiltroAtualizarQuestionario"
                            data-eixo="capital">
                            Capital
                        </button>

                        <button
                            type="button"
                            class="opcaoFiltroAtualizarQuestionario"
                            data-eixo="mercado">
                            Mercado
                        </button>

                        <button
                            type="button"
                            class="opcaoFiltroAtualizarQuestionario"
                            data-eixo="gestao">
                            Gestão
                        </button>

                    </div>

                </div>

            </div>


            <div class="resumoSelecaoAtualizarQuestionario">

                <div class="quantidadeEixosAtualizarQuestionario">

                    <span>
                        Empreendedor

                        <strong
                            id="quantidadeEmpreendedorAtualizarQuestionario">
                            0
                        </strong>
                    </span>


                    <span>
                        Tecnologia

                        <strong
                            id="quantidadeTecnologiaAtualizarQuestionario">
                            0
                        </strong>
                    </span>


                    <span>
                        Capital

                        <strong
                            id="quantidadeCapitalAtualizarQuestionario">
                            0
                        </strong>
                    </span>


                    <span>
                        Mercado

                        <strong
                            id="quantidadeMercadoAtualizarQuestionario">
                            0
                        </strong>
                    </span>


                    <span>
                        Gestão

                        <strong
                            id="quantidadeGestaoAtualizarQuestionario">
                            0
                        </strong>
                    </span>

                </div>


                <span class="quantidadeSelecionadaAtualizarQuestionario">
                    0 selecionadas
                </span>

            </div>


            <!-- QUESTÕES SERÃO CARREGADAS PELO JS -->

            <div
                class="listaQuestoesAtualizarQuestionario"
                id="listaQuestoesAtualizarQuestionario">
                <p>Carregando questões...</p>
            </div>


            <div class="areaBotoesAtualizarQuestionario">

                <button
                    type="button"
                    class="btnVoltarAtualizarQuestionario">
                    VOLTAR
                </button>

                <button
                    type="button"
                    class="btnAvancarAtualizarQuestionario">
                    AVANÇAR
                </button>

            </div>

        </div>

    </div>


    <!-- ========================= -->
    <!-- UPDATE - ETAPA 3 -->
    <!-- ========================= -->

    <div
        class="telaAtualizarQuestionario"
        data-tela="3">

        <div class="areaRevisaoAtualizarQuestionario">

            <h2>Revise o questionário</h2>


            <div class="itemRevisaoAtualizarQuestionario">

                <span>Nome</span>

                <p id="revisaoNomeAtualizarQuestionario"></p>

            </div>


            <div class="itemRevisaoAtualizarQuestionario">

                <span>Descrição</span>

                <p id="revisaoDescricaoAtualizarQuestionario"></p>

            </div>


            <div class="itemRevisaoAtualizarQuestionario">

                <span>Questões selecionadas</span>

                <p id="revisaoQuantidadeAtualizarQuestionario">
                    0 questões
                </p>

            </div>


            <button
                type="button"
                class="botaoPreviaQuestionario">
                <i class="fa-solid fa-arrow-right"></i>
                Prévia do Questionário
            </button>


            <div class="areaBotoesAtualizarQuestionario">

                <button
                    type="button"
                    class="btnVoltarAtualizarQuestionario">
                    VOLTAR
                </button>

                <button
                    type="button"
                    class="btnSalvarAtualizarQuestionario">
                    SALVAR
                </button>

            </div>

        </div>

    </div>

</div>

<?php fecharModal(); ?>
