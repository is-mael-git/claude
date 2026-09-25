document.addEventListener('DOMContentLoaded', () => {

    const telasQuestionario = document.querySelectorAll(
        '.telaQuestionario'
    );

    const etapasQuestionario = document.querySelectorAll(
        '.etapaQuestionario'
    );

    const botoesAvancarQuestionario = document.querySelectorAll(
        '.btnAvancarQuestionario'
    );

    const botoesVoltarQuestionario = document.querySelectorAll(
        '.btnVoltarQuestionario'
    );

    const botaoVoltarPrimeiraEtapa = document.querySelector(
        '.telaQuestionario[data-tela="1"] .btnCancelarQuestionario'
    );

    const botaoSalvarQuestionario = document.querySelector(
        '.btnSalvarQuestionario'
    );

    const modalNovoQuestionario = document.querySelector(
        '#modalNovoQuestionario'
    );

    const botaoFiltroQuestionario = document.querySelector(
        '#botaoFiltroQuestionario'
    );

    const botaoAdicionarQuestaoQuestionario = document.querySelector(
        '#botaoAdicionarQuestaoQuestionario'
    );

    const modalCriarQuestoes = document.querySelector(
        '#modalCriarQuestoes'
    );

    const opcoesFiltroQuestionario = document.querySelector(
        '#opcoesFiltroQuestionario'
    );

    const opcoesEixoQuestionario = document.querySelectorAll(
        '.opcaoFiltroQuestionario'
    );

    const nomeFiltroQuestionario = document.querySelector(
        '#nomeFiltroQuestionario'
    );

    const listaQuestoesQuestionario = document.querySelector(
        '#listaQuestoesQuestionario'
    );

    const quantidadeSelecionadaQuestionario = document.querySelector(
        '.quantidadeSelecionadaQuestionario'
    );

    const quantidadeEmpreendedorQuestionario = document.querySelector(
        '#quantidadeEmpreendedorQuestionario'
    );

    const quantidadeTecnologiaQuestionario = document.querySelector(
        '#quantidadeTecnologiaQuestionario'
    );

    const quantidadeCapitalQuestionario = document.querySelector(
        '#quantidadeCapitalQuestionario'
    );

    const quantidadeMercadoQuestionario = document.querySelector(
        '#quantidadeMercadoQuestionario'
    );

    const quantidadeGestaoQuestionario = document.querySelector(
        '#quantidadeGestaoQuestionario'
    );

    const nomeQuestionario = document.querySelector(
        '#nomeQuestionario'
    );

    const descricaoQuestionario = document.querySelector(
        '#descricaoQuestionario'
    );

    const contadorCaracteresQuestionario = document.querySelector(
        '.contadorCaracteresQuestionario'
    );

    const revisaoNomeQuestionario = document.querySelector(
        '#revisaoNomeQuestionario'
    );

    const revisaoDescricaoQuestionario = document.querySelector(
        '#revisaoDescricaoQuestionario'
    );

    const revisaoQuantidadeQuestionario = document.querySelector(
        '#revisaoQuantidadeQuestionario'
    );

    const botoesEditarRevisaoQuestionario = document.querySelectorAll(
        '.botaoEditarRevisaoQuestionario'
    );


    let etapaAtualQuestionario = 1;
    let eixoAtualQuestionario = 'todos';


    function normalizarTexto(texto) {

        return texto
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .toLowerCase()
            .trim();
    }


    function escaparHTML(texto) {

        const elemento = document.createElement('div');

        elemento.textContent = texto ?? '';

        return elemento.innerHTML;
    }


    function pegarCheckboxesQuestionario() {

        return document.querySelectorAll(
            '.checkboxQuestaoQuestionario'
        );
    }


    function pegarItensQuestionario() {

        return document.querySelectorAll(
            '.itemQuestaoQuestionario'
        );
    }


    async function carregarQuestoesQuestionario() {

        try {

            const questoesSelecionadas = new Set(
                Array.from(
                    document.querySelectorAll(
                        '.checkboxQuestaoQuestionario:checked'
                    )
                ).map(checkbox => checkbox.value)
            );

            listaQuestoesQuestionario.innerHTML = `
                <p>Carregando questões...</p>
            `;


            const resposta = await fetch(
                '/ParkTec/questao/listar'
            );


            if (!resposta.ok) {

                throw new Error(
                    'Não foi possível carregar as questões.'
                );
            }


            const questoes = await resposta.json();


            listaQuestoesQuestionario.innerHTML = '';


            if (questoes.length === 0) {

                listaQuestoesQuestionario.innerHTML = `
                    <p>Nenhuma questão cadastrada.</p>
                `;

                return;
            }


            questoes.forEach((questao, indice) => {

                const eixos = questao.eixos
                    ? questao.eixos
                        .split(',')
                        .map(eixo => normalizarTexto(eixo))
                    : [];


                const eixosTexto = eixos.join(',');


                listaQuestoesQuestionario.insertAdjacentHTML(
                    'beforeend',
                    `
                        <label
                            class="itemQuestaoQuestionario"
                            data-eixos="${eixosTexto}"
                        >

                            <div class="textoQuestaoQuestionario">

                                <span>
                                    ${indice + 1}
                                </span>

                                <p>
                                    ${escaparHTML(questao.pergunta)}
                                </p>

                            </div>

                            <input
                                type="checkbox"
                                name="questoes[]"
                                value="${questao.id}"
                                data-eixos="${eixosTexto}"
                                class="checkboxQuestaoQuestionario"
                                ${questoesSelecionadas.has(String(questao.id)) ? 'checked' : ''}
                            >

                        </label>
                    `
                );

            });


            atualizarQuantidadesQuestionario();
            filtrarQuestoesQuestionario();


        } catch (erro) {

            console.error(erro);

            listaQuestoesQuestionario.innerHTML = `
                <p>
                    Não foi possível carregar as questões.
                </p>
            `;
        }
    }


    function atualizarTelaQuestionario() {

        telasQuestionario.forEach(tela => {

            const numeroTela = Number(
                tela.dataset.tela
            );

            tela.classList.toggle(
                'telaAtivaQuestionario',
                numeroTela === etapaAtualQuestionario
            );
        });


        etapasQuestionario.forEach(etapa => {

            const numeroEtapa = Number(
                etapa.dataset.tela
            );

            etapa.classList.remove(
                'etapaAtivaQuestionario',
                'etapaConcluidaQuestionario'
            );


            if (numeroEtapa === etapaAtualQuestionario) {

                etapa.classList.add(
                    'etapaAtivaQuestionario'
                );
            }


            if (numeroEtapa < etapaAtualQuestionario) {

                etapa.classList.add(
                    'etapaConcluidaQuestionario'
                );
            }
        });


        if (etapaAtualQuestionario === 3) {

            atualizarRevisaoQuestionario();
        }
    }


    botoesAvancarQuestionario.forEach(botao => {

        botao.addEventListener('click', () => {

            if (etapaAtualQuestionario === 1) {

                const nome =
                    nomeQuestionario.value.trim();


                if (nome === '') {

                    alert(
                        'Digite um nome para o questionário.'
                    );

                    nomeQuestionario.focus();

                    return;
                }
            }


            if (etapaAtualQuestionario === 2) {

                const questoesSelecionadas =
                    document.querySelectorAll(
                        '.checkboxQuestaoQuestionario:checked'
                    );


                if (questoesSelecionadas.length === 0) {

                    alert(
                        'Selecione pelo menos uma questão.'
                    );

                    return;
                }


                if (questoesSelecionadas.length > 50) {

                    alert(
                        'O questionário pode possuir no máximo 50 questões.'
                    );

                    return;
                }
            }


            if (etapaAtualQuestionario < 3) {

                etapaAtualQuestionario++;

                atualizarTelaQuestionario();
            }
        });
    });


    botoesVoltarQuestionario.forEach(botao => {

        botao.addEventListener('click', () => {

            if (etapaAtualQuestionario > 1) {

                etapaAtualQuestionario--;

                atualizarTelaQuestionario();
            }
        });
    });


    if (botaoVoltarPrimeiraEtapa) {

        botaoVoltarPrimeiraEtapa.addEventListener(
            'click',
            () => {

                modalNovoQuestionario.close();

                resetarQuestionario();
            }
        );
    }


    botaoFiltroQuestionario.addEventListener(
        'click',
        event => {

            event.stopPropagation();

            opcoesFiltroQuestionario.classList.toggle(
                'abertoQuestionario'
            );
        }
    );


    if (botaoAdicionarQuestaoQuestionario) {

        botaoAdicionarQuestaoQuestionario.addEventListener(
            'click',
            () => {

                if (!modalCriarQuestoes) {

                    return;
                }

                modalCriarQuestoes.dataset.origem =
                    'questionario';

                modalCriarQuestoes.showModal();
            }
        );
    }


    document.addEventListener(
        'questaoCadastradaQuestionario',
        () => {
            carregarQuestoesQuestionario();
        }
    );


    opcoesEixoQuestionario.forEach(opcao => {

        opcao.addEventListener('click', () => {

            eixoAtualQuestionario =
                opcao.dataset.eixo;


            nomeFiltroQuestionario.textContent =
                opcao.textContent.trim();


            opcoesFiltroQuestionario.classList.remove(
                'abertoQuestionario'
            );


            filtrarQuestoesQuestionario();
        });
    });


    function filtrarQuestoesQuestionario() {

        const itens = pegarItensQuestionario();


        itens.forEach(questao => {

            const eixos = (
                questao.dataset.eixos || ''
            )
                .split(',')
                .filter(eixo => eixo !== '');


            const mostrar =
                eixoAtualQuestionario === 'todos' ||
                eixos.includes(eixoAtualQuestionario);


            questao.style.display =
                mostrar ? 'flex' : 'none';
        });
    }


    function atualizarQuantidadesQuestionario() {

        const selecionadas =
            document.querySelectorAll(
                '.checkboxQuestaoQuestionario:checked'
            );


        const contagem = {
            empreendedor: 0,
            tecnologia: 0,
            capital: 0,
            mercado: 0,
            gestao: 0
        };


        selecionadas.forEach(checkbox => {

            const eixos = (
                checkbox.dataset.eixos || ''
            )
                .split(',')
                .filter(eixo => eixo !== '');


            eixos.forEach(eixo => {

                if (contagem[eixo] !== undefined) {

                    contagem[eixo]++;
                }
            });
        });


        quantidadeSelecionadaQuestionario.textContent =
            `${selecionadas.length} selecionadas`;


        quantidadeEmpreendedorQuestionario.textContent =
            contagem.empreendedor;


        quantidadeTecnologiaQuestionario.textContent =
            contagem.tecnologia;


        quantidadeCapitalQuestionario.textContent =
            contagem.capital;


        quantidadeMercadoQuestionario.textContent =
            contagem.mercado;


        quantidadeGestaoQuestionario.textContent =
            contagem.gestao;
    }


    listaQuestoesQuestionario.addEventListener(
        'change',
        event => {

            if (
                event.target.classList.contains(
                    'checkboxQuestaoQuestionario'
                )
            ) {

                atualizarQuantidadesQuestionario();
            }
        }
    );


    descricaoQuestionario.addEventListener(
        'input',
        () => {

            contadorCaracteresQuestionario.textContent =
                `${descricaoQuestionario.value.length}/500`;
        }
    );


    function atualizarRevisaoQuestionario() {

        const selecionadas =
            document.querySelectorAll(
                '.checkboxQuestaoQuestionario:checked'
            );


        revisaoNomeQuestionario.value =
            nomeQuestionario.value.trim();

        revisaoNomeQuestionario.readOnly =
            true;

        revisaoNomeQuestionario.classList.remove(
            'campoRevisaoEditandoQuestionario'
        );


        revisaoDescricaoQuestionario.value =
            descricaoQuestionario.value.trim();

        revisaoDescricaoQuestionario.readOnly =
            true;

        revisaoDescricaoQuestionario.classList.remove(
            'campoRevisaoEditandoQuestionario'
        );


        revisaoQuantidadeQuestionario.textContent =
            `${selecionadas.length} questões`;
    }

    if (revisaoNomeQuestionario) {

        revisaoNomeQuestionario.addEventListener(
            'input',
            () => {

                nomeQuestionario.value =
                    revisaoNomeQuestionario.value;
            }
        );
    }


    if (revisaoDescricaoQuestionario) {

        revisaoDescricaoQuestionario.addEventListener(
            'input',
            () => {

                descricaoQuestionario.value =
                    revisaoDescricaoQuestionario.value;

                contadorCaracteresQuestionario.textContent =
                    `${descricaoQuestionario.value.length}/500`;
            }
        );
    }


    botoesEditarRevisaoQuestionario.forEach(botao => {

        botao.addEventListener(
            'click',
            () => {

                const campo =
                    botao.parentElement.querySelector(
                        '.inputRevisaoQuestionario'
                    );

                if (!campo) {

                    return;
                }

                campo.readOnly =
                    false;

                campo.classList.add(
                    'campoRevisaoEditandoQuestionario'
                );

                campo.focus();

                const tamanhoValor =
                    campo.value.length;

                campo.setSelectionRange?.(
                    tamanhoValor,
                    tamanhoValor
                );
            }
        );
    });


    botaoSalvarQuestionario.addEventListener(
        'click',
        async () => {

            const selecionadas =
                document.querySelectorAll(
                    '.checkboxQuestaoQuestionario:checked'
                );


            if (nomeQuestionario.value.trim() === '') {

                alert(
                    'Digite o nome do questionário.'
                );

                return;
            }


            if (selecionadas.length === 0) {

                alert(
                    'Selecione pelo menos uma questão.'
                );

                return;
            }


            if (selecionadas.length > 50) {

                alert(
                    'O questionário pode possuir no máximo 50 questões.'
                );

                return;
            }


            const dados = new FormData();


            dados.append(
                'nome',
                nomeQuestionario.value.trim()
            );


            dados.append(
                'descricao',
                descricaoQuestionario.value.trim()
            );


            selecionadas.forEach(checkbox => {

                dados.append(
                    'questoes[]',
                    checkbox.value
                );
            });


            try {

                botaoSalvarQuestionario.disabled = true;


                const resposta = await fetch(
                    '/ParkTec/questionario/adicionar',
                    {
                        method: 'POST',
                        body: dados
                    }
                );


                const resultado = await resposta.json();


                if (!resposta.ok) {

                    alert(
                        resultado.mensagem ||
                        'Não foi possível cadastrar o questionário.'
                    );

                    return;
                }


                alert(
                    resultado.mensagem ||
                    'Questionário cadastrado com sucesso.'
                );


                modalNovoQuestionario.close();


                resetarQuestionario();


                window.location.reload();


            } catch (erro) {

                console.error(erro);

                alert(
                    'Ocorreu um erro ao cadastrar o questionário.'
                );


            } finally {

                botaoSalvarQuestionario.disabled = false;
            }
        }
    );


    document.addEventListener(
        'click',
        event => {

            if (
                !botaoFiltroQuestionario.contains(
                    event.target
                ) &&
                !opcoesFiltroQuestionario.contains(
                    event.target
                )
            ) {

                opcoesFiltroQuestionario.classList.remove(
                    'abertoQuestionario'
                );
            }
        }
    );


    function resetarQuestionario() {

        etapaAtualQuestionario = 1;
        eixoAtualQuestionario = 'todos';


        nomeQuestionario.value = '';
        descricaoQuestionario.value = '';


        contadorCaracteresQuestionario.textContent =
            '0/500';


        pegarCheckboxesQuestionario().forEach(
            checkbox => {

                checkbox.checked = false;
            }
        );


        nomeFiltroQuestionario.textContent =
            'Todos os eixos';


        atualizarQuantidadesQuestionario();
        filtrarQuestoesQuestionario();
        atualizarTelaQuestionario();
    }


    carregarQuestoesQuestionario();

    atualizarTelaQuestionario();

});
