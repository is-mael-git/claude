//CHAMADA de ação para o botao novo perfil

function openModalNovoperfil() {
    document
        .getElementById('overlay')
        .style.display = 'flex';
}

function closeModalNovoperfil() {
    document
        .getElementById('overlay')
        .style.display = 'none';
}

function openStaff() {
    console.log("validar a tela")
    document.getElementById('cadastrarStaff').style.display = 'flex';
}

function closeStaff() {
    document.getElementById('cadastrarStaff').style.display = 'none';
}

const seletor = document.getElementById("seletorCor");
const botao = document.getElementById("meuBotao");
const codigoCor = document.getElementById("codigoCor");

// Abre a paleta personalizada abaixo do botão.
botao.addEventListener("click", () => {
    const caixaCor = seletor.closest('.equipeCaixa');
    const paletaAberta = caixaCor.classList.toggle('equipePaletaCoresAberta');

    botao.setAttribute('aria-expanded', paletaAberta);
});

seletor.addEventListener('input', () => {
    botao.style.backgroundColor = seletor.value;
    codigoCor.value = seletor.value;
    seletor.closest('.equipeCaixa').classList.remove('equipePaletaCoresAberta');
    botao.setAttribute('aria-expanded', 'false');
});

codigoCor.addEventListener('input', () => {
    const cor = codigoCor.value.trim();

    if (/^#[0-9A-Fa-f]{6}$/.test(cor)) {
        seletor.value = cor;
        botao.style.backgroundColor = cor;
    }
});


document
    .getElementById('selectAll')
    .addEventListener('change', function () {

        const permissions =
            document.querySelectorAll(
                '.equipePermission'
            );

        permissions.forEach(item => {

            item.checked = this.checked;

        });

    });


//chamar o documento apartir da foto

document.getElementById('btnAddFoto').addEventListener('click', function () {
    document.getElementById('inputFoto').click();
});

//usado para separar os numeros relacionado ao TELEFONE


const telefone = document.getElementById("telefone");

telefone.addEventListener("input", function () {
    let valor = this.value.replace(/\D/g, "");

    // Limita a 11 números
    if (valor.length > 11) {
        valor = valor.slice(0, 11);
    }

    // Adiciona os parênteses do DDD
    valor = valor.replace(/^(\d{2})(\d)/, "($1) $2");

    // Adiciona o hífen
    valor = valor.replace(/(\d{5})(\d{4})$/, "$1-$2");

    this.value = valor;
});

//usado para separar os numeros relacionado ao CPF

const cpfValidado = document.getElementById("cpf");

cpf.addEventListener("input", function () {
    let valor = this.value.replace(/\D/g, "");

    // Limita a 11 dígitos
    if (valor.length > 11) {
        valor = valor.slice(0, 11);
    }

    // Formata o CPF
    valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
    valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
    valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

    this.value = valor;
});


//JS relacionado ao evento perfis de acesso

const radios = document.querySelectorAll('input[name="perfil"]');

radios.forEach(radio => {
    radio.addEventListener("change", () => {
        console.log(radio.value);
    });
});

//JS relacionado ao evento Modalidade de acesso


const perfilsAcesso = document.querySelectorAll('input[name="modalidade"]');

perfilsAcesso.forEach(radio => {
    radio.addEventListener("change", () => {
        console.log(radio.value);
    });
});

//JS relacionado ao evento Dias da semana de acesso


const diaSemana = document.querySelectorAll('input[name=diaSemana]');

diaSemana.forEach(radio => {
    radio.addEventListener("change", () => {
        console.log(radio.value);
    })
})

//JS relacionado ao evento horarios de acesso

const modalidadeDisponivel = document.querySelectorAll('input[name=modalidadeDisponivel]');

modalidadeDisponivel.forEach(radio => {
    radio.addEventListener("change", () => {
        console.log(radio.value);
    })
})


//adicionar foto de perfil 

const btnAddFoto = document.querySelector('#btnAddFoto');
const inputFoto = document.querySelector('#inputFoto');

btnAddFoto.addEventListener('click', () => {
    inputFoto.click();
});

function lerFoto() {
    const arquivo = inputFoto.files[0];

    if (!arquivo) return;

    const equipeFotoCard = document.querySelector('.equipeFotoCard');

    const imagem = document.createElement('img');

    imagem.src = URL.createObjectURL(arquivo);

    equipeFotoCard.innerHTML = '';
    equipeFotoCard.appendChild(imagem);
}
