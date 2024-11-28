document.addEventListener("DOMContentLoaded", function () {
  // Seleciona todos os campos com a classe 'form-control'
  const formControls = document.querySelectorAll(".form-control");

  // Adiciona o atributo 'required' e eventos a cada campo
  formControls.forEach(function (input) {
    input.setAttribute("required", "required");

    // Evento blur para verificar o campo quando perde o foco
    input.addEventListener("blur", function () {
      if (input.value.trim() === "") {
        input.classList.add("is-invalid");
      }
    });

    // Evento input para remover 'is-invalid' assim que o usuário digitar algo
    input.addEventListener("input", function () {
      if (input.value.trim() !== "") {
        input.classList.remove("is-invalid");
      }
    });
  });

  // Validação no envio do formulário
  document.querySelector("form").addEventListener("submit", function () {
    formControls.forEach(function (input) {
      if (input.value.trim() === "") {
        input.classList.add("is-invalid");
      } else {
        input.classList.remove("is-invalid");
      }
    });
  });
});
