const textarea = document.querySelector(".biografiaInput textarea");
const contador = document.querySelector(".qtdCaracter");

const limite = 500;

textarea.addEventListener("input", () => {
  const qtdAtual = textarea.value.length;

  contador.textContent = `${qtdAtual}/${limite}`;

  if (qtdAtual === limite) {
    contador.classList.add("limiteAtingido");
  } else {
    contador.classList.remove("limiteAtingido");
  }
});

const radioModalidade = document.querySelectorAll('input[name="modalidade"]');

radioModalidade.forEach((radio) => {
  radio.addEventListener("change", () => {
    console.log(radio.value);
  });
});

document.addEventListener("change", () => {
  const areaDrop = document.querySelector(".dropHorarios");
  const button = areaDrop.querySelector(".dropDisponibilidade");
  const checkboxes = areaDrop.querySelectorAll('input[name="horario"]');
  console.log(checkboxes);
  console.log(button);
  console.log(areaDrop);

  function atualizarTextoBotao() {
    // Obter o texto dos labels cujos checkboxes estão marcados
    console.log("b");

    const selecionados = Array.from(checkboxes)
      .filter((chk) => chk.checked)
      .map((chk) =>
        chk
          .closest(".itemDadoDrop")
          .querySelector(".selecaoItemNome")
          .textContent.trim(),
      );

    // Atualizar o HTML do botão mantendo o ícone
    if (selecionados.length > 0) {
      button.innerHTML = `${selecionados.join(", ")}`;
    } else {
      button.innerHTML = `Selecione <i class="fa-solid fa-chevron-down"></i>`;
    }
  }

  // Escutar a mudança em cada checkbox
  checkboxes.forEach((chk) => {
    chk.addEventListener("change", atualizarTextoBotao);
  });
});

document.addEventListener("change", () => {
  const areaDrop = document.querySelector(".dropModalidade");
  const button = areaDrop.querySelector(".dropDisponibilidade");
  const checkboxes = areaDrop.querySelectorAll('input[name="modalidade"]');
  console.log(checkboxes);
  console.log(button);
  console.log(areaDrop);

  function atualizarTextoBotao() {
    // Obter o texto dos labels cujos checkboxes estão marcados
    console.log("b");

    const selecionados = Array.from(checkboxes)
      .filter((chk) => chk.checked)
      .map((chk) =>
        chk
          .closest(".itemDadoDrop")
          .querySelector(".selecaoItemNome")
          .textContent.trim(),
      );

    // Atualizar o HTML do botão mantendo o ícone
    if (selecionados.length > 0) {
      button.innerHTML = `${selecionados.join(", ")} `;
    } else {
      button.innerHTML = `Selecione <i class="fa-solid fa-chevron-down"></i>`;
    }
  }

  // Escutar a mudança em cada checkbox
  checkboxes.forEach((chk) => {
    chk.addEventListener("change", atualizarTextoBotao);
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const modal = document.querySelector(".areaModalCentral");
  if (!modal) return;

  const btnAvancarCard = modal.querySelector(".btnAvancarCard");
  const btnVoltarCard = modal.querySelector(".btnVoltarCard");
  const totalPassos = 3;

  function irPara(passo) {
    modal.dataset.step = passo;
  }

  function validarPassoAtual() {
    const passo = Number(modal.dataset.step);
    const secaoAtual = modal.querySelector(`[data-card="${passo}"]`);
    if (!secaoAtual) return true;

    const camposObrigatorios = secaoAtual.querySelectorAll("[required]");
    for (const campo of camposObrigatorios) {
      if (!campo.checkValidity()) {
        campo.reportValidity();
        return false;
      }
    }
    return true;
  }

  btnAvancarCard.addEventListener("click", () => {
    const atual = Number(modal.dataset.step);
    if (!validarPassoAtual()) return;
    if (atual < totalPassos) irPara(atual + 1);
  });

  btnVoltarCard.addEventListener("click", () => {
    const atual = Number(modal.dataset.step);
    if (atual > 1) irPara(atual - 1);
  });
});
