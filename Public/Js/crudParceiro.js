
const ENDPOINT_BUSCAR_PARCEIRO = '/ParkTec/parceiros/buscar';
const ACAO_ADICIONAR_PARCEIRO = '/ParkTec/parceiros/adicionar';
const ACAO_ATUALIZAR_PARCEIRO = '/ParkTec/parceiros/atualizar';
const UPLOAD_PARCEIROS = '/ParkTec/Public/Upload/Parceiros/';

const CAMPOS_PARCEIRO = {
    nome: 'nome',
    cnpj: 'cnpj',
    telefone: 'telefone',
    instagram: 'instagram',
    site: 'site',
    linkedin: 'linkedin',
    nomeRepresentante: 'nome_representante',
    telefoneRepresentante: 'telefone_representante',
    cargoRepresentante: 'cargo_representante',
    emailRepresentante: 'email_representante',
    idAreaAtuacao: 'id_area_atuacao'
};

document.addEventListener('DOMContentLoaded', () => {

    const modalParceiro = document.getElementById('modalCadastroParceiro');
    const formParceiro = modalParceiro?.querySelector('form');
    const inputIdParceiro = document.getElementById('idParceiro');
    const inputFoto = document.getElementById('foto');
    const previewFoto = document.getElementById('previewFotoParceiro');
    const selectArea = document.getElementById('idAreaAtuacao');
    const inputNovaArea = document.getElementById('novaAreaAtuacao');
    const botaoNovaArea = modalParceiro?.querySelector('.botaoAreaAtuacao');

    if (!modalParceiro || !formParceiro) {
        return;
    }

    const secaoEmpresa = modalParceiro.querySelector('.secaoDadosEmpresa');
    const secaoRepresentante = modalParceiro.querySelector('.secaoRepresentanteLegal');
    const campoLogo = modalParceiro.querySelector('.wrapperDescLogoParceiro');
    const campoArea = selectArea?.closest('.inputWrapperParceiros');
    const etapasParceiro = modalParceiro.querySelectorAll('.etapaParceiro');

    // A validação nativa olha o formulário inteiro, e aqui sempre existe uma etapa
    // escondida com campos required — o navegador travaria o envio reclamando de
    // campo não focável. Quem valida etapa por etapa daqui pra baixo é o JS.
    formParceiro.noValidate = true;

    const fotoPadrao = previewFoto ? previewFoto.src : '';

    let urlTemporaria = null;

    function mostrarPreviewFoto(src) {
        if (!previewFoto) {
            return;
        }

        if (urlTemporaria) {
            URL.revokeObjectURL(urlTemporaria);

            urlTemporaria = null;
        }

        previewFoto.src = src || fotoPadrao;

        previewFoto.classList.toggle('comFoto', Boolean(src));
    }

    if (inputFoto && previewFoto) {
        inputFoto.addEventListener('change', () => {
            const arquivo = inputFoto.files[0];

            if (!arquivo) {
                mostrarPreviewFoto('');

                return;
            }

            const urlArquivo = URL.createObjectURL(arquivo);

            mostrarPreviewFoto(urlArquivo);

            urlTemporaria = urlArquivo;
        });
    }

    function caixaDaLista() {
        return selectArea?.closest('.selectCustomizadoParceiros') ?? selectArea;
    }

    function mostrarCampoNovaArea(mostrar) {
        const caixa = caixaDaLista();

        if (!caixa || !inputNovaArea) {
            return;
        }

        caixa.hidden = mostrar;
        inputNovaArea.hidden = !mostrar;

        // a área é obrigatória dos dois jeitos: required acompanha quem está na tela
        inputNovaArea.required = mostrar;

        if (selectArea) {
            selectArea.required = !mostrar;
        }

        limparErro(campoArea);

        if (botaoNovaArea) {
            botaoNovaArea.classList.toggle('girado', mostrar);

            botaoNovaArea.title = mostrar ? 'Escolher uma área já cadastrada' : 'Cadastrar nova área';
        }

        if (mostrar) {
            inputNovaArea.focus();

            return;
        }

        inputNovaArea.value = '';
    }

    if (botaoNovaArea && inputNovaArea) {
        botaoNovaArea.addEventListener('click', () => {
            mostrarCampoNovaArea(inputNovaArea.hidden);
        });
    }

    /* ---------------------------------------------------------------- */
    /* Validação das etapas                                              */
    /* ---------------------------------------------------------------- */

    // quantos caracteres úteis a máscara pede para o campo estar completo
    const TAMANHOS_MASCARA = {
        cnpj: [14],
        telefone: [10, 11]
    };

    const MENSAGEM_OBRIGATORIO = 'Campo obrigatório.';
    const MENSAGEM_INCOMPLETO = 'Preencha o campo por completo.';
    const MENSAGEM_EMAIL = 'Informe um e-mail válido.';
    const MENSAGEM_CNPJ = 'CNPJ inválido.';

    function mostrarErro(wrapper, mensagem) {
        if (!wrapper) {
            return;
        }

        let erro = wrapper.querySelector('.erroCampoParceiro');

        if (!erro) {
            erro = document.createElement('span');

            erro.className = 'erroCampoParceiro';

            // dentro do label o aviso corre inline, logo a direita do texto dele
            (wrapper.querySelector('.labelAddParceiros') ?? wrapper).appendChild(erro);
        }

        erro.textContent = mensagem;
    }

    function limparErro(wrapper) {
        wrapper?.querySelector('.erroCampoParceiro')?.remove();
    }

    function limparErros(secao) {
        secao.querySelectorAll('.erroCampoParceiro').forEach(erro => erro.remove());
    }

    /** Limpa as duas etapas: a escondida guarda avisos que ninguém mais vai apagar. */
    function limparAvisosParceiro() {
        limparErros(secaoEmpresa);

        limparErros(secaoRepresentante);
    }

    /**
     * Campo mascarado só está pronto com a máscara inteira. Mascara.remover devolve
     * os caracteres úteis mesmo depois do envio tirar a máscara da tela.
     */
    function mascaraCompleta(campo) {
        const tamanhos = TAMANHOS_MASCARA[campo.dataset.mascara];

        if (!tamanhos) {
            return true;
        }

        return tamanhos.includes(window.Mascara?.remover(campo).length ?? 0);
    }

    /** Qual aviso o campo merece, ou string vazia quando está tudo certo. */
    function erroDoCampo(campo) {
        if (campo.validity.valueMissing) {
            return MENSAGEM_OBRIGATORIO;
        }

        // vazio e opcional: não há o que cobrar, nem máscara pela metade
        if (campo.value === '') {
            return '';
        }

        if (campo.validity.typeMismatch && campo.type === 'email') {
            return MENSAGEM_EMAIL;
        }

        if (!campo.validity.valid || !mascaraCompleta(campo)) {
            return MENSAGEM_INCOMPLETO;
        }

        // com a máscara inteira dá para conferir os dígitos verificadores
        if (campo.dataset.mascara === 'cnpj' && window.Validador?.cnpj(campo.value) === false) {
            return MENSAGEM_CNPJ;
        }

        return '';
    }

    /** Aponta de uma vez todos os campos pendentes da seção e foca o primeiro deles. */
    function camposValidos(secao) {
        const campos = secao.querySelectorAll('input:not([type="file"]), select, textarea');

        let primeiroPendente = null;

        for (const campo of campos) {
            // escondido não tem onde mostrar aviso nem como receber foco
            if (campo.hidden || campo.closest('[hidden]')) {
                continue;
            }

            const mensagem = erroDoCampo(campo);

            if (!mensagem) {
                continue;
            }

            mostrarErro(campo.closest('.inputWrapperParceiros'), mensagem);

            primeiroPendente = primeiroPendente ?? campo;
        }

        primeiroPendente?.focus();

        return primeiroPendente === null;
    }

    function areaAtuacaoPreenchida() {
        if (inputNovaArea && !inputNovaArea.hidden) {
            return inputNovaArea.value.trim() !== '';
        }

        return (selectArea?.value ?? '') !== '';
    }

    /** Na edição a logo já cadastrada continua valendo, não precisa reenviar. */
    function logoPreenchida() {
        if (!inputFoto?.required) {
            return true;
        }

        return inputFoto.files.length > 0 || previewFoto?.classList.contains('comFoto') === true;
    }

    function etapaEmpresaValida() {
        limparErros(secaoEmpresa);

        const logoOk = logoPreenchida();
        const areaOk = areaAtuacaoPreenchida();

        if (!logoOk) {
            mostrarErro(campoLogo, MENSAGEM_OBRIGATORIO);
        }

        if (!areaOk) {
            mostrarErro(campoArea, MENSAGEM_OBRIGATORIO);
        }

        const camposOk = camposValidos(secaoEmpresa);

        // logo e lista de áreas não recebem foco: sobrando só elas, traz o aviso pra vista
        if (camposOk) {
            secaoEmpresa.querySelector('.erroCampoParceiro')?.scrollIntoView({ block: 'nearest' });
        }

        return logoOk && areaOk && camposOk;
    }

    function etapaRepresentanteValida() {
        limparErros(secaoRepresentante);

        return camposValidos(secaoRepresentante);
    }

    /** Trilha do topo: escuro na etapa da vez, verde nas que já ficaram para tras. */
    function marcarEtapa(numeroAtual) {
        etapasParceiro.forEach(etapa => {
            const numero = Number(etapa.dataset.etapa);

            etapa.classList.toggle('etapaAtivaParceiro', numero === numeroAtual);

            etapa.classList.toggle('etapaConcluidaParceiro', numero < numeroAtual);
        });
    }

    function mostrarEtapa(secao) {
        secaoEmpresa.classList.toggle('active', secao === secaoEmpresa);

        secaoRepresentante.classList.toggle('active', secao === secaoRepresentante);

        marcarEtapa(secao === secaoRepresentante ? 2 : 1);
    }

    function avancarParceiro() {
        if (!etapaEmpresaValida()) {
            return;
        }

        mostrarEtapa(secaoRepresentante);
    }

    function voltarParceiro() {
        mostrarEtapa(secaoEmpresa);
    }

    // os botões do modal chamam essas duas pelo onclick
    window.avancarParceiro = avancarParceiro;
    window.voltarParceiro = voltarParceiro;

    formParceiro.addEventListener('submit', (evento) => {
        // a etapa 1 está escondida no envio, então o erro só aparece depois de voltar
        if (!etapaEmpresaValida()) {
            evento.preventDefault();

            voltarParceiro();

            etapaEmpresaValida();

            return;
        }

        if (!etapaRepresentanteValida()) {
            evento.preventDefault();
        }
    });

    // mexer no campo apaga o aviso dele: digitar, escolher na lista ou anexar a logo
    const limparAvisoDoAlvo = (evento) => limparErro(evento.target.closest('.inputWrapperParceiros'));

    formParceiro.addEventListener('input', limparAvisoDoAlvo);

    formParceiro.addEventListener('change', limparAvisoDoAlvo);

    inputFoto?.addEventListener('change', () => limparErro(campoLogo));

    // fechar pelo X, cancelar, clique fora ou Esc não pode deixar aviso pendurado
    modalParceiro.addEventListener('close', limparAvisosParceiro);

    function trocarTituloModal(texto) {
        const titulo = modalParceiro.querySelector('.modal-titulo');

        if (!titulo) {
            return;
        }

        const noTexto = Array.from(titulo.childNodes)
            .reverse()
            .find(no => no.nodeType === Node.TEXT_NODE && no.nodeValue.trim() !== '');

        if (noTexto) {
            noTexto.nodeValue = ` ${texto} `;
        }
    }

    function resetarModalParceiro() {
        formParceiro.reset();

        if (inputIdParceiro) {
            inputIdParceiro.value = '';
        }

        formParceiro.action = ACAO_ADICIONAR_PARCEIRO;

        mostrarPreviewFoto('');

        mostrarCampoNovaArea(false);

        limparAvisosParceiro();

        voltarParceiro();

        trocarTituloModal('Adicionar Parceiros');
    }

    function preencherModalParceiro(parceiro) {
        Object.entries(CAMPOS_PARCEIRO).forEach(([idCampo, chave]) => {
            const campo = document.getElementById(idCampo);

            if (campo) {
                campo.value = parceiro[chave] ?? '';

                if (campo.tagName === 'SELECT') {
                    campo.dispatchEvent(new Event('change'));
                }
            }
        });

        window.Mascara?.formatar(formParceiro);

        if (inputIdParceiro) {
            inputIdParceiro.value = parceiro.id;
        }

        if (inputFoto) {
            inputFoto.value = '';
        }

        mostrarCampoNovaArea(false);

        mostrarPreviewFoto(parceiro.foto ? `${UPLOAD_PARCEIROS}${parceiro.foto}` : '');

        limparAvisosParceiro();

        voltarParceiro();
    }

    async function abrirEdicaoParceiro(id) {
        try {
            const resposta = await fetch(`${ENDPOINT_BUSCAR_PARCEIRO}?id=${encodeURIComponent(id)}`);
            const dados = await resposta.json();

            if (!dados.sucesso || !dados.parceiro) {
                alert(dados.erro || 'Não foi possível carregar esse parceiro.');

                return;
            }

            preencherModalParceiro(dados.parceiro);

            formParceiro.action = ACAO_ATUALIZAR_PARCEIRO;

            trocarTituloModal('Editar Parceiro');

            abrirModal('modalCadastroParceiro');
        } catch (erro) {
            alert('Erro de conexão ao carregar o parceiro.');
        }
    }

    document.addEventListener('click', (evento) => {
        const botaoEditar = evento.target.closest('.botaoEditarParceiro');

        if (botaoEditar) {
            abrirEdicaoParceiro(botaoEditar.dataset.id);

            return;
        }

        if (evento.target.closest('.botaoAddParceiro')) {
            resetarModalParceiro();
        }
    });

});