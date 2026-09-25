document.addEventListener('DOMContentLoaded', () => {

    const modalCriarQuestoes =
        document.querySelector(
            '#modalCriarQuestoes'
        );

    const formQuestao =
        document.querySelector(
            '.formQuestao'
        );

    const perguntaQuestao =
        document.querySelector(
            '#perguntaQuestao'
        );

    const contadorQuestao =
        document.querySelector(
            '.contadorQuestao'
        );

    const textoSelectQuestao =
        document.querySelector(
            '.textoSelectQuestao'
        );

    const inputCompetenciaQuestao =
        document.querySelector(
            '#idCompetenciaQuestao'
        );

    const opcoesQuestao =
        document.querySelectorAll(
            '.opcaoSelectQuestao'
        );

    const botaoCancelarQuestao =
        document.querySelector(
            '.btnCancelarQuestao'
        );

    const botaoSalvarQuestao =
        document.querySelector(
            '.btnSalvarQuestao'
        );

    const listaGerenciarQuestoes =
        document.querySelector(
            '#listaGerenciarQuestoes'
        );

    const botaoFiltroGerenciarQuestao =
        document.querySelector(
            '#botaoFiltroGerenciarQuestao'
        );

    const nomeFiltroGerenciarQuestao =
        document.querySelector(
            '#nomeFiltroGerenciarQuestao'
        );

    const opcoesFiltroGerenciarQuestao =
        document.querySelector(
            '#opcoesFiltroGerenciarQuestao'
        );

    const opcoesEixo =
        document.querySelectorAll(
            '.opcaoFiltroGerenciarQuestao'
        );


    let eixoAtual = 'todos';

    function resetarFormularioQuestao() {

        if (!formQuestao) {
            return;
        }

        formQuestao.reset();

        if (contadorQuestao) {
            contadorQuestao.textContent =
                '0 / 500';
        }

        if (textoSelectQuestao) {
            textoSelectQuestao.textContent =
                'Selecione um eixo';
        }

        if (inputCompetenciaQuestao) {
            inputCompetenciaQuestao.value =
                '';
        }

        opcoesQuestao.forEach(opcao => {
            opcao.classList.remove(
                'opcaoAtualQuestao'
            );
        });
    }


    function fecharModalQuestao() {

        if (
            modalCriarQuestoes &&
            modalCriarQuestoes.open
        ) {

            modalCriarQuestoes.close();
        }
    }


    if (modalCriarQuestoes) {

        modalCriarQuestoes.addEventListener(
            'close',
            () => {

                modalCriarQuestoes.dataset.origem =
                    '';
            }
        );
    }


    function normalizarTexto(texto) {

        return texto
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .toLowerCase()
            .trim();
    }


    function escaparHTML(texto) {

        const elemento =
            document.createElement('div');

        elemento.textContent =
            texto ?? '';

        return elemento.innerHTML;
    }


    if (perguntaQuestao && contadorQuestao) {

        perguntaQuestao.addEventListener(
            'input',
            () => {

                contadorQuestao.textContent =
                    `${perguntaQuestao.value.length} / 500`;
            }
        );
    }


    if (botaoCancelarQuestao) {

        botaoCancelarQuestao.addEventListener(
            'click',
            () => {

                fecharModalQuestao();
                resetarFormularioQuestao();

                if (modalCriarQuestoes) {

                    modalCriarQuestoes.dataset.origem =
                        '';
                }
            }
        );
    }


    if (formQuestao) {

        formQuestao.addEventListener(
            'submit',
            async event => {

                event.preventDefault();

                const pergunta =
                    perguntaQuestao
                        ? perguntaQuestao.value.trim()
                        : '';

                const idCompetencia =
                    inputCompetenciaQuestao
                        ? inputCompetenciaQuestao.value
                        : '';

                if (pergunta === '') {

                    alert(
                        'Digite a pergunta.'
                    );

                    perguntaQuestao?.focus();

                    return;
                }

                if (idCompetencia === '') {

                    alert(
                        'Selecione uma competência válida.'
                    );

                    return;
                }

                const dados =
                    new FormData(formQuestao);

                try {

                    if (botaoSalvarQuestao) {
                        botaoSalvarQuestao.disabled =
                            true;
                    }

                    const resposta =
                        await fetch(
                            formQuestao.action,
                            {
                                method: 'POST',
                                body: dados
                            }
                        );

                    const resultado =
                        await resposta.json();

                    if (!resposta.ok) {

                        alert(
                            resultado.mensagem ||
                            'Não foi possível cadastrar a questão.'
                        );

                        return;
                    }

                    alert(
                        resultado.mensagem ||
                        'Questão cadastrada com sucesso.'
                    );

                    const origemModalQuestao =
                        modalCriarQuestoes
                            ? modalCriarQuestoes.dataset.origem
                            : '';

                    const abertoPeloQuestionario =
                        origemModalQuestao === 'questionario' ||
                        origemModalQuestao === 'atualizarQuestionario';

                    fecharModalQuestao();
                    resetarFormularioQuestao();

                    if (abertoPeloQuestionario) {

                        modalCriarQuestoes.dataset.origem =
                            '';

                        document.dispatchEvent(
                            new CustomEvent(
                                'questaoCadastradaQuestionario',
                                {
                                    detail: {
                                        origem: origemModalQuestao
                                    }
                                }
                            )
                        );

                        return;
                    }

                    window.location.reload();

                } catch (erro) {

                    console.error(erro);

                    alert(
                        'Ocorreu um erro ao cadastrar a questão.'
                    );

                } finally {

                    if (botaoSalvarQuestao) {
                        botaoSalvarQuestao.disabled =
                            false;
                    }
                }
            }
        );
    }


    async function carregarQuestoes() {

        if (!listaGerenciarQuestoes) {
            return;
        }

        try {

            listaGerenciarQuestoes.innerHTML =
                '<p>Carregando questões...</p>';


            const resposta = await fetch(
                '/ParkTec/questao/listar'
            );


            if (!resposta.ok) {

                throw new Error(
                    'Erro ao carregar questões.'
                );
            }


            const questoes =
                await resposta.json();


            listaGerenciarQuestoes.innerHTML =
                '';


            if (questoes.length === 0) {

                listaGerenciarQuestoes.innerHTML =
                    '<p>Nenhuma questão cadastrada.</p>';

                return;
            }


            questoes.forEach(
                (questao, indice) => {

                    const eixos =
                        questao.eixos
                            ? questao.eixos
                                .split(',')
                                .map(
                                    eixo =>
                                        normalizarTexto(eixo)
                                )
                            : [];


                    const eixosTexto =
                        eixos.join(',');


                    const nomesEixos =
                        questao.eixos
                            ? questao.eixos
                                .split(',')
                                .join(' • ')
                            : 'Sem eixo';


                    const checked =
                        Number(questao.ativo) === 1
                            ? 'checked'
                            : '';


                    listaGerenciarQuestoes
                        .insertAdjacentHTML(
                            'beforeend',
                            `
                            <div
                                class="itemGerenciarQuestao"
                                data-id="${questao.id}"
                                data-eixos="${eixosTexto}"
                            >

                                <div class="textoGerenciarQuestao">

                                    <span class="numeroGerenciarQuestao">
                                        ${indice + 1}
                                    </span>

                                    <p>
                                        ${escaparHTML(
                                            questao.pergunta
                                        )}
                                    </p>

                                </div>


                                <div class="acoesGerenciarQuestao">

                                    <span class="eixoGerenciarQuestao">
                                        ${escaparHTML(
                                            nomesEixos
                                        )}
                                    </span>


                                    <div class="btnSwitch">

                                        <label class="switch">

                                            <input
                                                type="checkbox"
                                                class="toggle toggleQuestao"
                                                data-id="${questao.id}"
                                                ${checked}
                                            >

                                            <span class="slider"></span>

                                        </label>

                                    </div>

                                </div>

                            </div>
                            `
                        );
                }
            );


            filtrarQuestoes();

        } catch (erro) {

            console.error(erro);

            listaGerenciarQuestoes.innerHTML = `
                <p>
                    Não foi possível carregar as questões.
                </p>
            `;
        }
    }


    function filtrarQuestoes() {

        const itens =
            document.querySelectorAll(
                '.itemGerenciarQuestao'
            );


        itens.forEach(item => {

            const eixos =
                (
                    item.dataset.eixos || ''
                )
                    .split(',')
                    .filter(
                        eixo => eixo !== ''
                    );


            const mostrar =
                eixoAtual === 'todos' ||
                eixos.includes(eixoAtual);


            item.style.display =
                mostrar
                    ? 'flex'
                    : 'none';
        });
    }


    if (botaoFiltroGerenciarQuestao) {

        botaoFiltroGerenciarQuestao
            .addEventListener(
                'click',
                event => {

                    event.stopPropagation();

                    opcoesFiltroGerenciarQuestao
                        ?.classList
                        .toggle(
                            'abertoGerenciarQuestao'
                        );
                }
            );
    }


    opcoesEixo.forEach(opcao => {

        opcao.addEventListener(
            'click',
            () => {

                eixoAtual =
                    opcao.dataset.eixo;


                if (nomeFiltroGerenciarQuestao) {

                    nomeFiltroGerenciarQuestao
                        .textContent =
                        opcao.textContent.trim();
                }


                opcoesFiltroGerenciarQuestao
                    ?.classList
                    .remove(
                        'abertoGerenciarQuestao'
                    );


                filtrarQuestoes();
            }
        );
    });


    if (listaGerenciarQuestoes) {

        listaGerenciarQuestoes.addEventListener(
            'change',
            async event => {

            const toggle =
                event.target.closest(
                    '.toggleQuestao'
                );


            if (!toggle) {
                return;
            }


            const id =
                Number(
                    toggle.dataset.id
                );


            const ativo =
                toggle.checked
                    ? 1
                    : 0;


            const dados =
                new FormData();


            dados.append(
                'id',
                id
            );


            dados.append(
                'ativo',
                ativo
            );


            try {

                toggle.disabled = true;


                const resposta =
                    await fetch(
                        '/ParkTec/questao/status',
                        {
                            method: 'POST',
                            body: dados
                        }
                    );


                const resultado =
                    await resposta.json();


                if (!resposta.ok) {

                    toggle.checked =
                        !toggle.checked;


                    alert(
                        resultado.mensagem ||
                        'Não foi possível alterar a questão.'
                    );
                }


            } catch (erro) {

                console.error(erro);


                toggle.checked =
                    !toggle.checked;


                alert(
                    'Erro ao alterar o status da questão.'
                );


            } finally {

                toggle.disabled = false;
            }
            }
        );
    }


    document.addEventListener(
        'click',
        event => {

            if (
                botaoFiltroGerenciarQuestao &&
                opcoesFiltroGerenciarQuestao &&
                !botaoFiltroGerenciarQuestao
                    .contains(
                        event.target
                    ) &&
                !opcoesFiltroGerenciarQuestao
                    .contains(
                        event.target
                    )
            ) {

                opcoesFiltroGerenciarQuestao
                    .classList
                    .remove(
                        'abertoGerenciarQuestao'
                    );
            }
        }
    );


    carregarQuestoes();

});
