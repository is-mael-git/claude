function posicionarModalNotificacao(modal) {
    const botaoNotificacao = document.querySelector(
        '[data-modal="modalNotificacao"]'
    );

    if (!botaoNotificacao) {
        return;
    }

    const posicaoBotao =
        botaoNotificacao.getBoundingClientRect();

    modal.style.top =
        `${posicaoBotao.bottom + 20}px`;

    modal.style.left =
        `${posicaoBotao.left + (posicaoBotao.width / 2) - (modal.offsetWidth / 2)}px`;
}


function posicionarModalPerfil(modal) {
    const botaoTrocaPerfil = document.querySelector(
        '[data-modal="modalPerfil"]'
    );

    if (!botaoTrocaPerfil) {
        return;
    }

    const posicaoBotao =
        botaoTrocaPerfil.getBoundingClientRect();

    modal.style.top =
        `${posicaoBotao.bottom + 10}px`;

    modal.style.left =
        `${posicaoBotao.right - 50}px`;
}


function abrirModal(idModal) {
    const modal = document.getElementById(idModal);

    if (!modal) {
        console.warn(
            `[modal.js] Modal não encontrado: #${idModal}`
        );

        return;
    }

    modal.showModal();

    if (idModal === 'modalNotificacao') {
        posicionarModalNotificacao(modal);
    }

    if (idModal === 'modalPerfil') {
        posicionarModalPerfil(modal);
    }
}


function fecharModal(idModal) {
    const modal = document.getElementById(idModal);

    if (!modal) {
        console.warn(
            `[modal.js] Modal não encontrado: #${idModal}`
        );

        return;
    }

    modal.close();
}


document.addEventListener('DOMContentLoaded', () => {

    document.addEventListener('click', (e) => {

        const abrir = e.target.closest('.abrirModal');

        if (abrir) {
            abrirModal(abrir.dataset.modal);
            return;
        }


        const fechar = e.target.closest('.fecharModal');

        if (fechar) {
            fecharModal(fechar.dataset.modal);
            return;
        }

    });


    document.querySelectorAll('dialog').forEach(modal => {

        let iniciouForaDoModal = false;

        modal.addEventListener('pointerdown', (e) => {
            const rect = modal.getBoundingClientRect();

            iniciouForaDoModal =
                e.clientX < rect.left ||
                e.clientX > rect.right ||
                e.clientY < rect.top ||
                e.clientY > rect.bottom;
        });

        modal.addEventListener('pointerup', (e) => {
            const rect = modal.getBoundingClientRect();

            const terminouForaDoModal =
                e.clientX < rect.left ||
                e.clientX > rect.right ||
                e.clientY < rect.top ||
                e.clientY > rect.bottom;

            if (iniciouForaDoModal && terminouForaDoModal) {
                fecharModal(modal.id);
            }

            iniciouForaDoModal = false;
        });

    });

});