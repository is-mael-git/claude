<?php
$eixosQuestao =
    $eixos ?? [];

abrirModal(
    'modalCriarQuestoes',
    'Criar Questão',
    '',
    '',
    ''
);
?>


<div class="crudQuestao">

    <div class="blocoQuestao">

        <form
            class="formQuestao"
            method="POST"
            action="/ParkTec/questao/adicionar"
        >

            <!-- PERGUNTA -->

            <div class="campoQuestao">

                <label for="perguntaQuestao">
                    Pergunta
                </label>

                <textarea
                    id="perguntaQuestao"
                    name="pergunta"
                    maxlength="500"
                    placeholder="Digite a pergunta..."
                    rows="4"
                    required
                ></textarea>

                <span class="contadorQuestao">
                    0 / 500
                </span>

            </div>


            <!-- EIXO -->

            <div class="campoQuestao">

                <label>
                    Eixo
                </label>


                <div class="selectCustomizadoQuestao">

                    <!-- SELECT VISÍVEL -->

                    <button
                        type="button"
                        class="selecionadoSelectQuestao"
                    >

                        <span class="textoSelectQuestao">
                            Selecione um eixo
                        </span>

                        <span class="setaSelectQuestao">
                            ▼
                        </span>

                    </button>


                    <!-- OPÇÕES -->

                    <div class="opcoesSelectQuestao">

                        <?php foreach ($eixosQuestao as $eixoQuestao): ?>

                            <div
                                class="opcaoSelectQuestao"
                                data-value="<?= htmlspecialchars($eixoQuestao['id_competencia']) ?>"
                            >
                                <?= htmlspecialchars($eixoQuestao['nome']) ?>
                            </div>

                        <?php endforeach; ?>

                    </div>


                    <!-- VALOR QUE VAI PARA O PHP -->

                    <input
                        type="hidden"
                        name="id_competencia"
                        id="idCompetenciaQuestao"
                    >

                </div>

            </div>


            <!-- BOTÕES -->

            <div class="acoesFormQuestao">

                <button
                    type="button"
                    class="btnCancelarQuestao"
                >
                    Cancelar
                </button>


                <button
                    type="submit"
                    class="btnSalvarQuestao"
                >
                    Salvar
                </button>

            </div>

        </form>

    </div>

</div>


<?php fecharModal(); ?>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const selectQuestao = document.querySelector(
        '.selectCustomizadoQuestao'
    );

    const botaoSelectQuestao = document.querySelector(
        '.selecionadoSelectQuestao'
    );

    const textoSelectQuestao = document.querySelector(
        '.textoSelectQuestao'
    );

    const opcoesQuestao = document.querySelectorAll(
        '.opcaoSelectQuestao'
    );

    const inputCompetencia = document.querySelector(
        '#idCompetenciaQuestao'
    );


    /* ABRIR / FECHAR SELECT */

    botaoSelectQuestao.addEventListener('click', function () {

        selectQuestao.classList.toggle('aberto');

    });


    /* SELECIONAR EIXO */

    opcoesQuestao.forEach(function (opcao) {

        opcao.addEventListener('click', function () {

            textoSelectQuestao.textContent =
                opcao.textContent.trim();


            inputCompetencia.value =
                opcao.dataset.value;


            opcoesQuestao.forEach(function (item) {

                item.classList.remove(
                    'opcaoAtualQuestao'
                );

            });


            opcao.classList.add(
                'opcaoAtualQuestao'
            );


            selectQuestao.classList.remove(
                'aberto'
            );

        });

    });


    /* FECHAR AO CLICAR FORA */

    document.addEventListener('click', function (event) {

        if (!selectQuestao.contains(event.target)) {

            selectQuestao.classList.remove(
                'aberto'
            );

        }

    });


    /* CONTADOR DA PERGUNTA */

    const perguntaQuestao = document.querySelector(
        '#perguntaQuestao'
    );

    const contadorQuestao = document.querySelector(
        '.contadorQuestao'
    );


    perguntaQuestao.addEventListener('input', function () {

        contadorQuestao.textContent =
            perguntaQuestao.value.length + ' / 500';

    });

});

</script>
