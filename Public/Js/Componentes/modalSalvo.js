const TEMPO_MODAL_SALVO = 2000;

document.addEventListener('DOMContentLoaded', () => {

    const modalSalvo = document.querySelector('.modalSalvo');

    if (!modalSalvo) {
        return;
    }

    let saindo = false;

    function fecharModalSalvo() {
        if (saindo) {
            return;
        }

        saindo = true;
        modalSalvo.classList.add('modalSalvoSaindo');
        modalSalvo.remove()
    }

    modalSalvo.querySelector('.btnXClaro')?.addEventListener('click', fecharModalSalvo);

    setTimeout(fecharModalSalvo, TEMPO_MODAL_SALVO);

});
