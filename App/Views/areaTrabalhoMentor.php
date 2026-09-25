<?php
include_once BASE_MENU;
?>

<div class="menuLateralAreaTrabalho menuLateralATM">
    <div class="areaMaiorATM">
        
        <div class="areaDashboardResumidaATM">
            <div class="carDashboardATM cardStartupMentoradasATM">
                <div class="iconStartupMentoradasATM"><i class="fa-solid fa-rocket"></i></div>
                <div class="informacoesStartupMentoradas">
                    <div class="numeroStartupsMentoradasATM">4</div>
                    <div class="nomeStartupMentoradasATM">Startup Mentoradas</div>
                </div>    
            </div>
            <div class="cardDashboardATM cardStartupMentoradasATM">
                <div class="iconDashboardATM iconReunioesProximas"><i class="fa-regular fa-calendar"></i></i></div>
                <div class="infoDashboardATM informacoesStartupMentoradas">
                    <div class="numeroStartupsMentoradasATM">2</div>
                    <div class="nomeStartupMentoradasATM">Startup Mentoradas</div>
                </div>    
            </div>
            <div class="cardDashboardATM cardStartupMentoradasATM">
                <div class="iconDashboardATM"><i class="fa-solid fa-rocket"></i></div>
                <div class="infoDashboardATM informacoesStartupMentoradas">
                    <div class="numeroStartupsMentoradasATM">4</div>
                    <div class="nomeStartupMentoradasATM">Startup Mentoradas</div>
                </div>    
            </div>
            <div class="cardDashboardATM cardStartupMentoradasATM">
                <div class="iconDashboardATM"><i class="fa-solid fa-rocket"></i></div>
                <div class="infoDashboardATM informacoesStartupMentoradas">
                    <div class="numeroStartupsMentoradasATM">4</div>
                    <div class="nomeStartupMentoradasATM">Startup Mentoradas</div>
                </div>    
            </div>
        </div>


        <div class="areaATM">
            


            <div class="areaMentortiasAndamentoATM">
                <div class="cardHeaderHistoricoReunioesATM">
                    <h2 class="nomeHeaderHistoricoReunioesATM">Mentorias em Andamento</h2>
                </div>
                <div class="containerTabela containerTabelaATM containerTabelaATMDois">
                    <table class="tabela tabelaATM">
                        <thead class="tabelaCabecalho tabelaCabecalhoATMs">
                            <tr class="linhaTabelaCabecalho linhaTabelaCabecalhoATM">
                                <th class="itemTabelaCabecalho itemTabelaATM2 itemTabelaHistorico2">Startup</th>
                                <th class="itemTabelaCabecalho itemTabelaATM3 itemTabelaHistorico3">Area De Atuação</th>
                                <th class="itemTabelaCabecalho itemTabelaATM4 itemTabelaHistorico4">Redes Sociais</th>
                            </tr>
                        </thead>
                        <tbody class="tabelaCorpo tabelaCorpoATM">
                            

                            
                        </tbody>
                    </table>


                </div>

            </div>
            <div class="areaHistoricoReunioesATM">
                <div class="cardHeaderHistoricoReunioesATM">
                    <h2 class="nomeHeaderHistoricoReunioesATM">Historico de Reuniões</h2>
                </div>
                <div class="containerTabela containerTabelaATM containerTabelaATMDois">
                    <table class="tabela tabelaATM">
                        <thead class="tabelaCabecalho tabelaCabecalhoATMs">
                            <tr class="linhaTabelaCabecalho linhaTabelaCabecalhoATM">
                                <th class="itemTabelaCabecalho itemTabelaATM1 nomeHeaderHistoricoATM">Data</th>
                                <th class="itemTabelaCabecalho itemTabelaATM2 nomeHeaderHistoricoATM">Mentor</th>
                                <th class="itemTabelaCabecalho itemTabelaATM3 nomeHeaderHistoricoATM">Startup</th>
                                <th class="itemTabelaCabecalho itemTabelaATM4 nomeHeaderHistoricoATM">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="tabelaCorpo tabelaCorpoATM">

                            <tr class="linhaTabelaCorpo linhaTabelaCorpoATM">
                                <td class="itemTabelaCorpo itemTabelaATM1 itemTabelaCorpoATM itemTabelaCorpoHistoricoATM">16/01</td>
                                <td class="itemTabelaCorpo itemTabelaATM2 itemTabelaCorpoATM itemTabelaCorpoHistoricoATM">
                                    <div class="imgTabelaATM ">
                                        <p>Dayvid Michel Oliveira de Jesus</p>
                                    </div>
                                </td>
                                <td class="itemTabelaCorpo itemTabelaATM3 itemTabelaCorpoATM itemTabelaCorpoHistoricoATM">
                                        <p>Nu Pagamentos S.A.</p>
                                    </div>
                                </td>
                                <td class="itemTabelaCorpo itemTabelaATM4 itemTabelaCorpoATM itemTabelaCorpoHistoricoATM"><button class="btnDefault btnFazerRelatoATM">Fazer Relato</button></td>
                                </td>
                            </tr>

                            
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
            <div class="calendarioATM">
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

<script src="<?= BASE_JS ?>Componentes/tabela.js"></script>