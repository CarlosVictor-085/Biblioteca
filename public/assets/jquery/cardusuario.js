document.addEventListener("DOMContentLoaded", function () {
  const openCardButton = document.getElementById("openCard");
  const deleteCard = document.getElementById("deleteCard");
  const checkbox = document.getElementById("accountActivation");
  const deactivateButton = document.getElementById("deactivateButton");
  // Mostrar o card ao clicar no botão "Excluir"
  openCardButton.addEventListener("click", function () {
    deleteCard.style.display = "block";
  });
  // Habilitar/desabilitar o botão "Desativar conta" com base na checkbox
  checkbox.addEventListener("change", function () {
    if (checkbox.checked) {
      deactivateButton.classList.remove("disabled");
      deactivateButton.style.pointerEvents = "auto";
      deactivateButton.style.opacity = "1";
    } else {
      deactivateButton.classList.add("disabled");
      deactivateButton.style.pointerEvents = "none";
      deactivateButton.style.opacity = "0.6";
    }
  });
});
