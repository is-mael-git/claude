<?php
include_once BASE_MENU;
require_once BASE_MODAL;

use Core\auth;
?>



<div class="menuLateralAreaTrabalho areaTrabalhoAdm">
    <div class="visualizacoesMiniDest">

        <!-- STARTUPS -->
        <div class="cardIndicador">
            <div class="iconeCard Startups">
                <i class="fa-solid fa-rocket"></i>
            </div>

            <div class="informacaoCardAdm">
                <strong>23</strong>
                <span>Startups Ativas</span>
            </div>
        </div>


        <!-- MENTORES -->
        <div class="cardIndicador">
            <div class="iconeCard Mentores">
                <i class="fa-solid fa-users"></i>
            </div>

            <div class="informacaoCardAdm">
                <strong>18</strong>
                <span>Mentores Ativos</span>
            </div>
        </div>


        <!-- REUNIÕES -->
        <div class="cardIndicador">
            <div class="iconeCard Reunioes">
                <i class="fa-solid fa-calendar-check"></i>
            </div>

            <div class="informacaoCardAdm">
                <strong>12</strong>
                <span>Reuniões Este Mês</span>
            </div>
        </div>


        <!-- QUESTIONÁRIOS -->
        <div class="cardIndicador">
            <div class="iconeCard Questionarios">
                <i class="fa-solid fa-clipboard-list"></i>
                
            </div>
                
            <div class="informacaoCardAdm">
                <strong>2</strong>
                <span>Questionários Ativos</span>
            </div>
        </div>


    </div>

    <div class="caixaMaiorAdm">

        <div class="caixaStartupsAtivas">
            <table class=" tabelaListaStartupsAtivas">
                <thead class="tabelaCabecalho StartupsAtivas">
                    <tr class="linhaTabelaCabecalho ">
                        <th class="itemTabelaCabecalho ">Startup</th>
                        <th class="itemTabelaCabecalho ">Mentor</th>
                        <th class="itemTabelaCabecalho ">Ações</th>
                    </tr>
                </thead>
                <tbody class="tabelaCorpo tabelaCorpoAdm">
                    <tr class="linhaTabelaCorpo corpoAdm">
                        <td class="itemTabelaCorpo nome">
                            <p class="nomeicon">Nu Pagamentos S.A.</p>
                        </td>
                        <td class="itemTabelaCorpo "> Deyvid Michel Oliveira de Jesus</td>
                        <td class="itemTabelaCorpo ">
                            <button class="btnDefault abrir-modal" data-modal="validarReuniaoAdm">Validar Mentor</button>
                        </td>
                           
                    </tr>
                </tbody>
            </table>
        </div>



        <!-- CALENDARIO ADM  --> 
        <div class="calendarioAdm">
            <div class="agenda">
                <div class="calendario">
                    <div class="evento-text">Eventos <i class="fa-solid fa-star"></i></div>
                    <div class="navegacao">
                        <span id="anterior"><i class="fa-solid fa-angle-left"></i></span>
                        <h2 id="mesAno"></h2>
                        <span id="proximo"><i class="fa-solid fa-angle-right"></i></span>
                    </div>
                </div>
                <div id="calendario"></div>
                
                <script src="<?php echo BASE_URL ?>/Public/Js/calendarioAdm.js"></script>
            </div>
        </div>
    </div>
</div>


<?php abrirModal('validarReuniaoAdm', 'Histórico de Reuniões', '', '<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M20 35C16.1667 35 12.8267 33.7294 9.98 31.1883C7.13333 28.6472 5.50111 25.4733 5.08333 21.6667H8.5C8.88889 24.5556 10.1739 26.9444 12.355 28.8333C14.5361 30.7222 17.0844 31.6667 20 31.6667C23.25 31.6667 26.0072 30.535 28.2717 28.2717C30.5361 26.0083 31.6678 23.2511 31.6667 20C31.6656 16.7489 30.5339 13.9922 28.2717 11.73C26.0094 9.46778 23.2522 8.33556 20 8.33333C18.0833 8.33333 16.2917 8.77778 14.625 9.66667C12.9583 10.5556 11.5556 11.7778 10.4167 13.3333H15V16.6667H5V6.66667H8.33333V10.5833C9.75 8.80556 11.4794 7.43056 13.5217 6.45833C15.5639 5.48611 17.7233 5 20 5C22.0833 5 24.035 5.39611 25.855 6.18833C27.675 6.98056 29.2583 8.04944 30.605 9.395C31.9517 10.7406 33.0211 12.3239 33.8133 14.145C34.6056 15.9661 35.0011 17.9178 35 20C34.9989 22.0822 34.6033 24.0339 33.8133 25.855C33.0233 27.6761 31.9539 29.2594 30.605 30.605C29.2561 31.9506 27.6728 33.02 25.855 33.8133C24.0372 34.6067 22.0856 35.0022 20 35ZM24.6667 27L18.3333 20.6667V11.6667H21.6667V19.3333L27 24.6667L24.6667 27Z" fill="white"/>
</svg>
', 'parceiros/adicionar'); ?>

<!-- Informaçoes do modal do histotico de reuniõs -->
<div class="modalHistoricoReuniao">

    <table class="tabelaReunioes">
        <thead>
            <tr>
                <th>Data</th>
                <th>Mentor</th>
                <th>Startup</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>


            <tr>
                <td class="dataAdm">
                    23/06/2026
                </td>

                <td class="mentorAdm">
                    <svg width="42" height="42" viewBox="0 0 42 42">
                        <circle cx="20.75" cy="20.75" r="20" stroke="#2F3C54" stroke-width="1.5" />
                    </svg>

                    Deyvid Michel
                </td>

                <td class="startupsAdm">
                    <svg width="40" height="40" viewBox="0 0 40 40">
                        <rect width="40" height="40" rx="20" />
                    </svg>

                    Nu Pagamentos S.A. - Instituição de Pagamento
                </td>

                <td class="acoesAdm">
                    <button class="botaoAcoesAdm abrir-modal"
                        data-modal="validarReuniaoAdm">
                        Visualizar Relatos
                    </button>
                </td>
            </tr>


        </tbody>


    </table>

</div>
<?php fecharModal(); ?>
<?php abrirModal('bancoQuestoes', 'Banco de Questões', '', '<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M20 35C16.1667 35 12.8267 33.7294 9.98 31.1883C7.13333 28.6472 5.50111 25.4733 5.08333 21.6667H8.5C8.88889 24.5556 10.1739 26.9444 12.355 28.8333C14.5361 30.7222 17.0844 31.6667 20 31.6667C23.25 31.6667 26.0072 30.535 28.2717 28.2717C30.5361 26.0083 31.6678 23.2511 31.6667 20C31.6656 16.7489 30.5339 13.9922 28.2717 11.73C26.0094 9.46778 23.2522 8.33556 20 8.33333C18.0833 8.33333 16.2917 8.77778 14.625 9.66667C12.9583 10.5556 11.5556 11.7778 10.4167 13.3333H15V16.6667H5V6.66667H8.33333V10.5833C9.75 8.80556 11.4794 7.43056 13.5217 6.45833C15.5639 5.48611 17.7233 5 20 5C22.0833 5 24.035 5.39611 25.855 6.18833C27.675 6.98056 29.2583 8.04944 30.605 9.395C31.9517 10.7406 33.0211 12.3239 33.8133 14.145C34.6056 15.9661 35.0011 17.9178 35 20C34.9989 22.0822 34.6033 24.0339 33.8133 25.855C33.0233 27.6761 31.9539 29.2594 30.605 30.605C29.2561 31.9506 27.6728 33.02 25.855 33.8133C24.0372 34.6067 22.0856 35.0022 20 35ZM24.6667 27L18.3333 20.6667V11.6667H21.6667V19.3333L27 24.6667L24.6667 27Z" fill="white"/>
</svg>
', 'parceiros/adicionar'); ?>
<!-- Modal banco de questoes e montar questionarios  -->
<div class="bancoQuestoesModal">
    <button class="btnPergunta"> <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.71429 10.2128H1.28572C0.921433 10.2128 0.61629 10.0902 0.37029 9.84511C0.12429 9.6 0.000861576 9.29702 4.43349e-06 8.93617C-0.000852709 8.57532 0.122576 8.27234 0.37029 8.02724C0.618004 7.78213 0.923147 7.65958 1.28572 7.65958H7.71429V1.2766C7.71429 0.914898 7.83771 0.611919 8.08457 0.367664C8.33143 0.123409 8.63657 0.000855466 9 4.40205e-06C9.36343 -0.000846661 9.669 0.121707 9.91671 0.367664C10.1644 0.613621 10.2874 0.9166 10.2857 1.2766V7.65958H16.7143C17.0786 7.65958 17.3841 7.78213 17.631 8.02724C17.8779 8.27234 18.0009 8.57532 18 8.93617C17.9991 9.29702 17.8757 9.60043 17.6297 9.84638C17.3837 10.0923 17.0786 10.2145 16.7143 10.2128H10.2857V16.5957C10.2857 16.9574 10.1623 17.2608 9.91543 17.506C9.66857 17.7511 9.36343 17.8732 9 17.8723C8.63657 17.8715 8.33143 17.7489 8.08457 17.5047C7.83771 17.2604 7.71429 16.9574 7.71429 16.5957V10.2128Z" fill="#000000ff" />
        </svg>
        ADICIONAR PERGUNTA</button>
    <div class="espacamentoQuest">
        <div class=""></div>
    </div>
    <div class="bancoQuestao">
        <div class="questaoQ">Questão</div>
        <div class="eixoC">eixo CERNE</div>
        <div class="statusQ">Status</div>
        <div class="acoesQ">Ações</div>
    </div>
    <div class="espacamentoQuest">
        <div class=""></div>
    </div>
    <div class="questaop">
        <div class="linhaAddQuest">
            <div class="linha1">1.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?</div>
            <div class="eixoCerne">Mercado</div>
            <div class="statusAtivo">Ativo</div>
            <div class="acoesPergunta">Ações</div>
        </div>
        <div class="linhaAddQuest">
            <div class="linha1">1.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?</div>
            <div class="eixoCerne">Mercado</div>
            <div class="statusAtivo">Ativo</div>
            <div class="acoesPergunta">Ações</div>
        </div>
        <div class="linhaAddQuest">
            <div class="linha1">1.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?</div>
            <div class="eixoCerne">Mercado</div>
            <div class="statusAtivo">Ativo</div>
            <div class="acoesPergunta">Ações</div>
        </div>
        <div class="linhaAddQuest">
            <div class="linha1">1.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?</div>
            <div class="eixoCerne">Mercado</div>
            <div class="statusAtivo">Ativo</div>
            <div class="acoesPergunta">Ações</div>
        </div>
        <div class="linhaAddQuest">
            <div class="linha1">1.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?</div>
            <div class="eixoCerne">Mercado</div>
            <div class="statusAtivo">Ativo</div>
            <div class="acoesPergunta">Ações</div>
        </div>
        <div class="linhaAddQuest">
            <div class="linha1">1.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?</div>
            <div class="eixoCerne">Mercado</div>
            <div class="statusAtivo">Ativo</div>
            <div class="acoesPergunta">Ações</div>
        </div>
        <div class="linhaAddQuest">
            <div class="linha1">1.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?</div>
            <div class="eixoCerne">Mercado</div>
            <div class="statusAtivo">Ativo</div>
            <div class="acoesPergunta">Ações</div>
        </div>
        <div class="linhaAddQuest">
            <div class="linha1">1.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?</div>
            <div class="eixoCerne">Mercado</div>
            <div class="statusAtivo">Ativo</div>
            <div class="acoesPergunta">Ações</div>
        </div>
        <div class="linhaAddQuest">
            <div class="linha1">1.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?</div>
            <div class="eixoCerne">Mercado</div>
            <div class="statusAtivo">Ativo</div>
            <div class="acoesPergunta">Ações</div>
        </div>
        <div class="linhaAddQuest">
            <div class="linha1">1.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?</div>
            <div class="eixoCerne">Mercado</div>
            <div class="statusAtivo">Ativo</div>
            <div class="acoesPergunta">Ações</div>
        </div>
        <div class="linhaAddQuest">
            <div class="linha1">1.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?</div>
            <div class="eixoCerne">Mercado</div>
            <div class="statusAtivo">Ativo</div>
            <div class="acoesPergunta">Ações</div>
        </div>
    </div>


</div>
<?php fecharModal(); ?>
<?php abrirModal('montarQuestionario', 'Montar Questionário', '', '<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M20 35C16.1667 35 12.8267 33.7294 9.98 31.1883C7.13333 28.6472 5.50111 25.4733 5.08333 21.6667H8.5C8.88889 24.5556 10.1739 26.9444 12.355 28.8333C14.5361 30.7222 17.0844 31.6667 20 31.6667C23.25 31.6667 26.0072 30.535 28.2717 28.2717C30.5361 26.0083 31.6678 23.2511 31.6667 20C31.6656 16.7489 30.5339 13.9922 28.2717 11.73C26.0094 9.46778 23.2522 8.33556 20 8.33333C18.0833 8.33333 16.2917 8.77778 14.625 9.66667C12.9583 10.5556 11.5556 11.7778 10.4167 13.3333H15V16.6667H5V6.66667H8.33333V10.5833C9.75 8.80556 11.4794 7.43056 13.5217 6.45833C15.5639 5.48611 17.7233 5 20 5C22.0833 5 24.035 5.39611 25.855 6.18833C27.675 6.98056 29.2583 8.04944 30.605 9.395C31.9517 10.7406 33.0211 12.3239 33.8133 14.145C34.6056 15.9661 35.0011 17.9178 35 20C34.9989 22.0822 34.6033 24.0339 33.8133 25.855C33.0233 27.6761 31.9539 29.2594 30.605 30.605C29.2561 31.9506 27.6728 33.02 25.855 33.8133C24.0372 34.6067 22.0856 35.0022 20 35ZM24.6667 27L18.3333 20.6667V11.6667H21.6667V19.3333L27 24.6667L24.6667 27Z" fill="white"/>
</svg>
', 'parceiros/adicionar'); ?>
<!-- Modal montar questionario  -->
<div class="montarQuest">
    <input type="text" placeholder="Digite o nome do questionario">
    <div class="menu">

        <div class="menu-item active" data-step="1">
            <div class="circle">1</div>

            <span>Empreendedor</span>
            <div class="line"></div>
        </div>

        <div class="menu-item" data-step="2">
            <div class="circle">2</div>

            <span>Mercado</span>
            <div class="line"></div>
        </div>

        <div class="menu-item" data-step="3">
            <div class="circle">3</div>

            <span>Produto</span>
            <div class="line"></div>
        </div>

        <div class="menu-item" data-step="4">
            <div class="circle">4</div>

            <span>Gestão</span>
            <div class="line"></div>
        </div>

        <div class="menu-item" data-step="5">
            <div class="circle">5</div>

            <span>Capital</span>
        </div>

    </div>
    <div class="questaoEspaco">
        <h1>Questões</h1>
    </div>


    <div class="caixaEmpreendedor">

        <div class="caixaMontagem">
            <span>
                1.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                2.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                3.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                4.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                5.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                6.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                7.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                8.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                9.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                10.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <button id="trocaQuest">
            <svg width="13" height="23" viewBox="0 0 13 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.4831 12.7776L2.49627 23L0 20.4448L8.73871 11.5L0 2.55515L2.49627 0L12.4831 10.2224C12.8141 10.5613 13 11.0208 13 11.5C13 11.9792 12.8141 12.4387 12.4831 12.7776Z" fill="#E6EFFF" />
            </svg>
        </button>

        <script src="<?= BASE_JS ?>barraProgresso.js"></script>
    </div>
    <div class="caixaMercado">

        <div class="caixaMontagem">
            <span>
                1.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                2.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                3.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                4.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                5.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                6.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                7.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                8.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                9.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                10.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
    </div>
    <div class="caixaProduto">

        <div class="caixaMontagem">
            <span>
                1.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                2.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                3.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                4.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                5.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                6.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                7.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                8.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                9.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                10.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
    </div>
    <div class="caixaGestao">

        <div class="caixaMontagem">
            <span>
                1.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                2.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                3.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                4.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                5.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                6.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                7.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                8.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                9.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                10.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
    </div>
    <div class="caixaCapital">

        <div class="caixaMontagem">
            <span>
                1.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                2.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                3.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                4.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                5.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                6.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                7.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                8.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                9.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
        <div class="caixaMontagem">
            <span>
                10.Em uma escala de 1 a 5, como você avalia os serviços da Parktec?
            </span>
            <div class="statusCheck">
                <input type="checkbox">
            </div>
        </div>
    </div>





    <div class="espacoMontarQuest">
        <button id="btnMontarQuest">
            <svg width="13" height="23" viewBox="0 0 13 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.4831 12.7776L2.49627 23L0 20.4448L8.73871 11.5L0 2.55515L2.49627 0L12.4831 10.2224C12.8141 10.5613 13 11.0208 13 11.5C13 11.9792 12.8141 12.4387 12.4831 12.7776Z" fill="#E6EFFF" />
            </svg>

        </button>

    </div>

</div>