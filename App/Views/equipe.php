<?php

include_once BASE_MENU;

?>

<section class="equipeModalPrincipalStaff" id="cadastrarStaff">


    <div class="equipeCadastrarModal">


        <!-- TOPO -->
        <header class="equipeInformacaoModal">

            <div class="equipeIconeModal">

                <div class="equipeIconeTrabalho">
                    <i class="fa-solid fa-users equipeIconeTitleModal"></i>
                </div>

                <p class="equipeTitleModal">CADASTRAR STAFF</p>

            </div>

            <button class="fechar-modal" onclick="closeStaff()">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </header>

        <!-- FUNDO -->
        <main class="equipeFundoModal">

            <!-- STEPS -->
            <!-- <section class="equipeContainerModal">

                <div class="equipeStepModal">
                    <div class="equipeCirculo equipeAtivo">1</div>
                    <span class="equipeTextoModal equipeTextoAtivo">
                        Dados Pessoais
                    </span>
                </div>

                <div class="equipeLinhaContainer"></div>

                <div class="equipeStepModal">
                    <div class="equipeCirculo equipeInativo">2</div>
                    <span class="equipeTexto equipeTextoInativo">
                        Disponibilidade
                    </span>
                </div>

                <div class="equipeLinhaContainer"></div>

                <div class="equipeStepModal">
                    <div class="equipeCirculo equipeInativo">3</div>
                    <span class="equipeTexto equipeTextoInativo">
                        Perfil de Acesso
                    </span>
                </div>

            </section> -->


            <!-- TEXTO -->
            <!-- <div class="equipeTextoInformacaoModal">
                <p>
                    Preencha as informações para cadastrar um staff no sistema.
                </p>
            </div> -->

            <!-- CARDS -->

            <div class="equipeCadastrarStaff">


                <!-- DADOS PESSOAIS -->
                <div class="equipeEspacamento1">
                    <div class="equipeDadosPessoaisCards">
                        <section class="equipeDadosPessoaisCards">

                            <div class="equipeTituloCard">
                                <h2 class="equipeTituloInicial">Dados Pessoais</h2>
                            </div>

                            <div class="equipeLinhaCard"></div>

                            <div class="equipeFotoContainer">

                                <div class="equipeFotoCard">
                                    <i class="fa-solid fa-user"></i>
                                </div>

                                <button class="equipeAddCard" type="button" id="btnAddFoto">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                                <input type="file" id="inputFoto" accept="image/*" hidden onchange="lerFoto()">

                            </div>

                            <div class="equipeCampoCard">
                                <label for="nome">Nome<span class="equipeMarcacaoObrigatoria">*</span></label>

                                <div class="equipeInputIcon">
                                    <input type="text" id="nome" placeholder="Ex.: Felipe josé corrêa da silva">
                                </div>
                            </div>

                            <div class="equipeCampoCard">
                                <label for="email">Email<span class="equipeMarcacaoObrigatoria">*</span></label>

                                <div class="equipeInputIcon">

                                    <input type="text" id="email" placeholder="Ex.: felipelipee1234@gmail.com">
                                </div>
                            </div>


                            <div class="equipeCampoTelefoneCpf">

                                <div class="equipeCampoDadosTelefone">
                                    <label for="telefone">Telefone<span class="equipeMarcacaoObrigatoria">*</span></label>

                                    <div class="equipeInputIcon">
                                        <input type="tel" id="telefone" placeholder="(00) 00000-0000" pattern="\(\d{2}\)\s\d{5}-\d{4}">
                                    </div>
                                </div>

                                <div class="equipeCampoDadosCpf">
                                    <label for="cpf">CPF<span class="equipeMarcacaoObrigatoria">*</span></label>
                                    <div class="equipeInputIcon">
                                        <input type="text" id="cpf" placeholder="000.000.000-00" maxlength="14">
                                    </div>
                                </div>

                            </div>








                        </section>

                    </div>

                </div>
                <div class="equipeCardDisponibilidadePerfil">
                    <div class="equipeDisponibilidadeCards">
                        <div class="equipeEspacamento2">
                            <section class="disponibilidade card">

                                <div class="equipeTituloCard">
                                    <h2 class="equipeTituloInicial">Disponibilidade</h2>
                                </div>

                                <div class="equipeLinhaCard"></div>

                                <div class="equipeGrupoDisponibilidade">
                                    <h3 class="equipeTituloSegundoCard">Dias da Semana<span class="equipeMarcacaoObrigatoria">*</span></h3>

                                    <div class="equipeDisponobilidadeSemana1">
                                        <div class="equipeGrupoDisponibilidadeSemana1">

                                            <label><input type="checkbox" name="diaSemana" value="Segunda-Feira"> Segunda-Feira</label>
                                            <label><input type="checkbox" name="diaSemana" value="Terça-Feira"> Terça-Feira</label>
                                            <label><input type="checkbox" name="diaSemana" value="Quarta-Feira"> Quarta-Feira</label>
                                        </div>

                                        <div class="equipeGrupoDisponibilidadeSemana2">

                                            <label><input type="checkbox" name="diaSemana" value="Quinta-Feira"> Quinta-Feira</label>
                                            <label><input type="checkbox" name="diaSemana" value="Sexta-Feira"> Sexta-Feira</label>

                                        </div>
                                    </div>
                                </div>

                                <div class="equipeLinhaCard"></div>

                                <div class="equipeGrupoHorariosModalidade">

                                    <div class="equipeGrupoDisponibilidadeHorarios">
                                        <h3 class="equipeTituloSegundoCard">Horários<span class="equipeMarcacaoObrigatoria">*</span></h3>

                                        <select class="equipeSelecionarModalidade" type="checkbox" >
                                            <label>
                                                <option>Selecionar</option>
                                            </label>
                                            <label>
                                                <option value="manha" type="checkbox">Matutino</option>
                                            </label>
                                            <label>
                                                <option value="tarde" type="checkbox">Vespertino</option>
                                            </label>
                                            <label>
                                                <option value="noite" type="checkbox">Noturno</option>
                                            </label>
                                        </select>
                                    </div>
                                    <div class="equipeGrupoDisponibilidadeModalidade">
                                        <h3 class="equipeTituloSegundoCard">Modalidade<span class="equipeMarcacaoObrigatoria">*</span></h3>

                                        <select class="equipeSelecionarModalidade" type="checkbox" >
                                            <label>
                                                <option>Selecionar</option>
                                            </label>
                                            <label>
                                                <option value="manha" type="checkbox">Presencial</option>
                                            </label>
                                            <label>
                                                <option value="tarde" type="checkbox">Remoto</option>
                                            </label>
                                            <label>
                                                <option value="noite" type="checkbox">Híbrido</option>
                                            </label>
                                        </select>

                                    </div>

                                </div>

                            </section>

                        </div>
                    </div>
                    <div class="equipePerfilsCard">
                        <div class="equipeEspacamento3">

                            <section class="equipePerfis card">

                                <div class="equipeTituloCard">
                                    <h2 class="equipeTituloInicial">Perfis de Acesso<span class="equipeMarcacaoObrigatoria">*</span></h2>

                                    <button class="equipeAdicionarPerfil" onclick="openModalNovoperfil()">
                                        <i class="fa-solid fa-plus equipeAumentar"></i>
                                    </button>
                                </div>

                                <div class="equipeLinhaCard"></div>

                                <div class="equipePerfilItens">
                                  <select class="equipeSelecionarModalidade" type="checkbox">
                                    <label>
                                        <option>Selecionar</option>
                                    </label>
                                    <label>
                                        <option value="administrador">Administrador</option>
                                    </label>
                                    <label>
                                        <option value="estagiario">Estagiário</option>
                                    </label>
                                    <label>
                                        <option value="mentor">Mentor</option>
                                    </label>
                                    <label>
                                        <option value="startup">Startup</option>
                                    </label>


                                  </select>
                                </div>

                            </section>

                        </div>




                    </div>

                </div>



            </div>
            <div class="equipeBtnAcoesFormularios">
                <button class="btnCancelar">Cancelar</button>
                <button class="btnSalvar equipeSalvarBtn">Salvar</button>
            </div>

        </main>
    </div>

</section>



</main>

</div>

</section>


<div id="overlay" class="equipeOverlay">

    <div class="equipeModalPerfilStaff">
        <div class="equipeTitleStaff">
            CADASTRAR PERFIL
            <button class="equipeCloseBtnStaff" onclick="closeModalNovoperfil()">
                ✕
            </button>
        </div>

        <div class="equipeModalHeaderStaff">

            <div class="equipeModalStaff">

                <div class="equipeTopRow">

                    <div class="equipeField">
                        <label>Nome do perfil</label>
                        <input
                            type="text"
                            id="profileName"
                            placeholder="Digite o nome do perfil">
                    </div>

                    <div class="equipeCaixa">

                        <button id="meuBotao" type="button" aria-expanded="false">Selecione uma Cor</button>

                        <div class="equipePaletaCores">
                            <div class="equipeCampoSelecaoCor">
                                <label for="seletorCor">Escolha uma cor</label>
                                <input type="color" id="seletorCor" value="#ff0000" aria-label="Seletor de cor">
                            </div>

                            <div class="equipeCampoCodigoCor">
                                <label for="codigoCor">Código HEX</label>
                                <input type="text" id="codigoCor" value="#ff0000" maxlength="7" pattern="#[0-9A-Fa-f]{6}" placeholder="#000000">
                            </div>
                        </div>
                    </div>


                </div>

                <h2 class="equipeTitlePrimary">Permissões de acesso</h2>

                <div class="equipePermissionBox">

                    <label class="equipeSelectAll">
                        <input
                            type="checkbox"
                            id="selectAll">
                        Selecionar todos
                    </label>

                    <hr>

                    <div class="equipeSection">

                        <h3>Visualizadores</h3>

                        <div class="equipeGridPermissoes">

                            <div class="visualizarIndicadores">

                                <label><input type="checkbox" class="equipePermission"> Visualizar dashboard ADM</label>

                                <br>

                                <label><input type="checkbox" class="equipePermission"> Visualizar dashboard startup</label>

                                <br>

                                <label><input type="checkbox" class="equipePermission"> Visualizar dashboard mentores</label>

                            </div>

                            <div class="visualizarIndicadores">
                                <label><input type="checkbox" class="equipePermission"> Visualizar área da startup</label>

                                <br>


                                <label><input type="checkbox" class="equipePermission"> Visualizar área mentores</label>


                                <br>

                                <label><input type="checkbox" class="equipePermission"> Visualizar dashboard ADM</label>
                            </div>

                            <div class="visualizarIndicadores"> 

                                <label><input type="checkbox" class="equipePermission"> Visualizar relatos</label>

                                <br>

                                <label><input type="checkbox" class="equipePermission"> Visualizar área parceiros</label>

                                <br>

                                <label><input type="checkbox" class="equipePermission"> Visualizar área staff</label>

                            </div>

                        </div>

                    </div>

                    <hr>

                    <div class="equipeSection">

                        <h3>Gerenciadores</h3>

                        <div class="equipeGridPermissoes">

                            <label><input type="checkbox" class="equipePermission"> Gerenciar documentos</label>

                            <label><input type="checkbox" class="equipePermission"> Gerenciar parceiros</label>

                            <label><input type="checkbox" class="equipePermission"> Gerenciar questionários</label>

                        </div>

                    </div>

                    <hr>

                    <div class="equipeSection">

                        <h3>Validadores</h3>

                        <div class="equipeGridPermissoes">

                            <div class="visualizarIndicadores">

                                <label><input type="checkbox" class="equipePermission"> Validar junção startup x mentor</label>

                            </div>

                            <div class="visualizarIndicadores">

                                <label><input type="checkbox" class="equipePermission"> Validar reuniões</label>

                            </div>

                        </div>

                    </div>

                    <hr>

                    <div class="equipeSection">

                        <h3>Operações</h3>

                        <div class="equipeGridPermissoes">

                            <label><input type="checkbox" class="equipePermission"> Relatar reuniões</label>

                            <label><input type="checkbox" class="equipePermission"> Agendar reuniões</label>

                            <label><input type="checkbox" class="equipePermission"> Cadastrar perfis</label>

                            <label><input type="checkbox" class="equipePermission"> Realizar questionário</label>

                            <label><input type="checkbox" class="equipePermission"> Receber notificações</label>

                        </div>

                    </div>

                </div>

                <div class="equipeFooterButtons">

                    <button
                        class="equipeCancelBtn"
                        onclick="closeModalNovoperfil()">
                        CANCELAR
                    </button>

                    <button class="equipeSaveBtn">
                        SALVAR
                    </button>

                </div>
            </div>

        </div>

    </div>

</div>

<div class="menuLateralAreaTrabalho equipeAreaTrabalhoCrud">

    <button class="equipeBtnCadastrarStaff" onclick="openStaff()">
        + Cadastrar STAFF
    </button>

    <div class="containerTabela">
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
                <tr class="linhaTabelaCorpo linhaTabelaCorpoParceiros">
                    <td class="itemTabelaCorpo itemTabelaParceiros1">
                        <div class="imgWrapper">

                            <img
                                src="https://yt3.googleusercontent.com/Yvl6yndRtGAfTmEd7_27messwiyzF9caEkTb18bziBS14fmJ-OVFwKJt6PKjPzJ8jLEGhLdZ=s900-c-k-c0x00ffffff-no-rj"
                                alt="Nubank">
                            <p>Nubank</p>
                        </div>
                    </td>
                    <td class="itemTabelaCorpo itemTabelaParceiros2">Capital & Investimento | Produto & Tecnologia
                        | Estratégia | Mercado & Clientes | Finanças
                        Marketing & Vendas</td>
                    <td class="itemTabelaCorpo itemTabelaParceiros3">12.345.678/0001-90</td>
                    <td class="itemTabelaCorpo itemTabelaParceiros4">Contato@Tech_assist.com</td>
                    <td class="itemTabelaCorpo itemTabelaParceiros5"><i class="fa-brands fa-whatsapp"></i>(67) 11
                        89563-4321</td>
                    <td class="itemTabelaCorpo itemTabelaParceiros6"></td>
                    <td class="itemTabelaCorpo itemTabelaParceiros7">

                    </td>
                </tr>
            </tbody>
        </table>
    </div>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="<?= BASE_JS ?>novoPerfil.js"></script>
</div>
