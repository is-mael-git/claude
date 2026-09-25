<?php abrirModal('modalCadastroMentor', 'Cadastro de Mentores', 'fa-solid fa-user-pen', '', ''); ?>

<form action="<?= BASE_URL ?>crudMentores/adicionar" method="POST">
    
<div class="areaModalCentral" data-step="1">

    <section class="areaStatusCard">
        <div class="statusCard1" data-card="1">
            <p class="circuloStatus1">1</p>
            <p>Dados Pessoais</p>
        </div>

        <hr class="statusPronto" data-linha="1">

        <div class="statusCard2" data-card="2">
            <p class="circuloStatus2">2</p>
            <p>Disponibilidade</p>
        </div>

        <hr class="statusPronto" data-linha="2">

        <div class="statusCard3" data-card="3">
            <p class="circuloStatus3">3</p>
            <p>Competências</p>
        </div>
    </section>

    <p class="subtituloSuperiorInfo">Preencha as informações para cadastrar um mentor ao sistema.</p>
    <div class="areaCentralCadastro">
        
        <section class="cardDadosPessoais" data-card="1">
            <h2 class="tituloCardMentor">Dados Pessoais</h2>

            <div class="containerMidias">
                <div class="perfilContainer">
                    <div class="areaFoto">
                        <img class="fotoPerfil" src="/ParkTec/Public/Assets/Icones/Vector.svg" alt="Foto de perfil do usuário">
                        <label class="btnAdicionarFoto">
                            <i class="fa-solid fa-plus"></i>
                            <input type="file" name="foto" accept="image/*" style="display:none;">
                        </label>
                    </div>
                    <p class="legendaMidia">Perfil</p>
                </div>

                <div class="bannerContainer">
                    <div class="areaBanner">
                        <img class="fotoBanner" src="/ParkTec/Public/Assets/imgSistema/nophotoempresa.jpg" alt="Logomarca da empresa">
                        <label class="btnAdicionarBanner">
                            <i class="fa-solid fa-plus"></i>
                            <input type="file" name="banner" accept="image/*" style="display:none;">
                        </label>
                    </div>
                    <p class="legendaMidia">Banner</p>
                </div>
            </div>

            <div class="cadastroMentorDados">
                <label class="inputMentorTitulo" for="nome">Nome</label>
                <input class="inputMentorCadastro" type="text" name="nome" placeholder="Ex. Nome Mentor" required>

                <label class="inputMentorTitulo" for="email">Email</label>
                <input class="inputMentorCadastro" type="email" name="email" placeholder="Ex. email@exemplo.com" required>
            </div>


            <!-- id parceiros são as empresas cadastradas no sistema, e o mentor pode estar vinculado a uma ou mais empresas. O select abaixo permite selecionar a empresa à qual o mentor está vinculado. (não que esquecer disso) -->


            <p class="inputMentorTitulo">Selecione a empresa</p> 
            
            <div class="areaDrop">
                <button class="dropNomeEmpresa" type="button"><i class="fa-solid fa-chevron-down"></i></button>
                <div class="dropConteudo">
                    <a class="itemDadoDrop" name="idParceiro" href="#"></a>
                </div>
            </div>

            <div class="socialInputs">
                <div class="dadoTelefoneMentor">  
                    <label class="inputMentorTitulo" for="telefone">Telefone</label>
                    <input class="inputMentorCadastroSocial" type="text" name="telefone" placeholder="(xx) xxxx-xxxx">
                </div>

                <div class="dadoInstagramMentor">
                    <label class="inputMentorTitulo" for="instagram">Instagram</label>
                    <input class="inputMentorCadastroSocial" type="text" name="instagram" placeholder="Ex. @seu-perfil">
                </div>
            </div>

            <div class="socialInputs">

                <div class="dadoLinkedin">
                    <label class="inputMentorTitulo" for="linkedin">Linkedin</label>
                    <input class="inputMentorCadastroSocial" type="text" name="linkedin" placeholder="Ex. linkedin.com/in/seu-perfil">
                </div>


            </div>
        </section>

        <section class="cardDisponibilidade" data-card="2">
            <h2 class="tituloCardMentor">Disponibilidade</h2>

            <p class="inputMentorTitulo">Semana</p>
            <div class="selecaoDisponibilidade">
                
                <div class="diasSemana1">
                    
                   
                    <label class="selecaoDia">
                        <div class="container">
                            <input name="semana" value="segunda" type="checkbox">
                            <div class="checkmark"></div>
                        </div>
                        <span class="selecaoItemNome">Segunda-feira</span>
                    </label>

                    <label class="selecaoDia">
                        <div class="container">
                            <input name="semana" value="terca" type="checkbox">
                            <div class="checkmark"></div>
                        </div>
                        <span class="selecaoItemNome">Terça-feira</span>
                    </label>

                    <label class="selecaoDia">
                        <div class="container">
                            <input name="semana" value="quarta" type="checkbox">
                            <div class="checkmark"></div>
                        </div>
                        <span class="selecaoItemNome">Quarta-feira</span>
                    </label>
                </div>

                <div class="diasSemana2">

                    <label class="selecaoDia">
                        <div class="container">
                            <input name="semana" value="quinta" type="checkbox">
                            <div class="checkmark"></div>
                        </div>
                        <span class="selecaoItemNome">Quinta-feira</span>
                    </label>

                    <label class="selecaoDia">
                        <div class="container">
                            <input name="semana" value="sexta" type="checkbox">
                            <div class="checkmark"></div>
                        </div>
                        <span class="selecaoItemNome">Sexta-feira</span>
                    </label>
                    <label class="selecaoDia">
                        <div class="container">
                            <input name="semana" value="sabado" type="checkbox">
                            <div class="checkmark"></div>
                        </div>
                        <span class="selecaoItemNome">Sábado</span>
                    </label>
                </div>

            </div>

            <div class="inputsDropdown">
                <div class="dropHorarios">
                    <p class="inputMentorTitulo">Horários</p>

                    <div class="areaDrop">
                        <button class="dropDisponibilidade" type="button"><i class="fa-solid fa-chevron-down"></i></button>
                        <div class="dropConteudo">

                            <label class="itemDadoDrop">
                                <div class="container">
                                    <input name="horario" value="matutino" type="checkbox">
                                    <div class="checkmark"></div>
                                </div>
                                <span class="selecaoItemNome">Matutino</span>
                            </label>
                            <label class="itemDadoDrop">
                                <div class="container">
                                    <input name="horario" value="vespertino" type="checkbox">
                                    <div class="checkmark"></div>
                                </div>
                                <span class="selecaoItemNome">Vespertino</span>
                            </label>
                            <label class="itemDadoDrop">
                                <div class="container">
                                    <input name="horario" value="noturno" type="checkbox">
                                    <div class="checkmark"></div>
                                </div>
                                <span class="selecaoItemNome">Noturno</span>
                            </label>

                        </div>
                    </div>

                </div>

                <div class="dropModalidade">
                    <p class="inputMentorTitulo">Modalidade</p>
                    <div class="areaDrop">
                        <button class="dropDisponibilidade" type="button"><i class="fa-solid fa-chevron-down"></i></button>
                        <div class="dropConteudo">
                            <label class="itemDadoDrop">
                                <div class="container">
                                    <input name="modalidade" value="online" type="radio">
                                    <div class="checkmark"></div>
                                </div>
                                <span class="selecaoItemNome">Online</span>
                            </label>
                            <label class="itemDadoDrop">
                                <div class="container">
                                    <input name="modalidade" value="hibrido" type="radio">
                                    <div class="checkmark"></div>
                                </div>
                                <span class="selecaoItemNome">Híbrido</span>
                            </label>
                            <label class="itemDadoDrop">
                                <div class="container">
                                    <input name="modalidade" value="presencial" type="radio">
                                    <div class="checkmark"></div>
                                </div>
                                <span class="selecaoItemNome">Presencial</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="biografiaInput">
                <p class="inputMentorTitulo">Biografia</p>
                <textarea class="caixaBiografia" name="biografia" maxlength="500" placeholder="Conte sua experiência como mentor..."></textarea>
                <span class="qtdCaracter">0/500</span>
            </div>
        </section>

        <section class="cardCernes" data-card="3">
            <h2 class="tituloCardMentor">Competências & Eixos Cernes</h2>

            <p class="inputMentorTitulo">Tecnologia</p>
            <div class="tecnologiaCerne">
                <label class="btnSelecaoEixo">
                    <input type="checkbox" name="competencia" value="produto&tecnologia">
                    <span class="btnEstiloVisual">Produto e Tecnologia</span>
                </label>
                <label class="btnSelecaoEixo">
                    <input type="checkbox" name="competencia" value="operacoes">
                    <span class="btnEstiloVisual">Operações</span>
                </label>
            </div>

            <p class="inputMentorTitulo">Capital</p>
            <div class="capitalCerne">
                <label class="btnSelecaoEixo">
                    <input type="checkbox" name="competencia" value="capital&investimentos">
                    <span class="btnEstiloVisual">Capital & Investimentos</span>
                </label>
                <label class="btnSelecaoEixo">
                    <input type="checkbox" name="competencia" value="financas">
                    <span class="btnEstiloVisual">Finanças</span>
                </label>
            </div>

            <p class="inputMentorTitulo">Empreendedor</p>
            <div class="empreendedorCerne">
                <label class="btnSelecaoEixo">
                    <input type="checkbox" name="competencia" value="estrategia">
                    <span class="btnEstiloVisual">Estratégia</span>
                </label>
                <label class="btnSelecaoEixo">
                    <input type="checkbox" name="competencia" value="gestao">
                    <span class="btnEstiloVisual">Gestão</span>
                </label>
            </div>

            <p class="inputMentorTitulo">Mercado</p>
            <div class="mercadoCerne">
                <label class="btnSelecaoEixo">
                    <input type="checkbox" name="competencia" value="networking&conexoes">
                    <span class="btnEstiloVisual">Networking & Conexões</span>
                </label>
                <label class="btnSelecaoEixo">
                    <input type="checkbox" name="competencia" value="marketing&vendas">
                    <span class="btnEstiloVisual">Marketing & Vendas</span>
                </label>
                <label class="btnSelecaoEixo">
                    <input type="checkbox" name="competencia" value="mercados&clientes">
                    <span class="btnEstiloVisual">Mercados & Clientes</span>
                </label>
            </div>

            <p class="inputMentorTitulo">Gestão</p>
            <div class="gestaoCerne">
                <label class="btnSelecaoEixo">
                    <input type="checkbox" name="competencia" value="juridico&pi">
                    <span class="btnEstiloVisual">Jurídico & PI</span>
                </label>
            </div>
        </section>

    </div>

    <div class="btnAreaMentor">
        
        <!-- <div class="areaSelecaoTermo">
            <label class="selecaoTermo">
                <div class="container">
                    <input name="termo" value="" type="checkbox">
                    <div class="checkmark"></div>
                </div>
                <span class="selecaoItemNome">1termo</span>
            </label>
            <label class="selecaoTermo">
                <div class="container">
                    <input name="termo" value="" type="checkbox">
                    <div class="checkmark"></div>
                </div>
                <span class="selecaoItemNome">2termo</span>
            </label>
            <label class="selecaoTermo">
                <div class="container">
                    <input name="termo" value="" type="checkbox">
                    <div class="checkmark"></div>
                </div>
                <span class="selecaoItemNome">3termo</span>
            </label>
        </div> -->
        
        <button type="button" class="btnVoltarCard "><i class="fa-solid fa-chevron-left"></i></button>
        <button type="button" class="btnCancelar ">CANCELAR</button>
        <button type="button" class="btnAvancarCard "><i class="fa-solid fa-chevron-right"></i></button>
        <button type="submit" class="btnSalvarErro ">SALVAR</button>

    </div>
        
    <script src="<?php echo BASE_JS ?>/crudMentores.js"></script>
</div>

</form>

<?php fecharModal(); ?>