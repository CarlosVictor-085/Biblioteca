document.addEventListener("DOMContentLoaded", function () {
  // Seleciona todos os campos com a classe 'form-control'
  const formControls = document.querySelectorAll(".form-control");

  // Adiciona o atributo 'required' a cada campo
  formControls.forEach(function (input) {
    input.setAttribute("required", "required");

    // Adiciona o evento de blur para verificar se o campo está vazio
    input.addEventListener("blur", function () {
      if (input.value.trim() === "") {
        input.classList.add("is-invalid");
      } else {
        input.classList.remove("is-invalid");
      }
    });
  });

  // Validação no envio do formulário
  document.querySelector("form").addEventListener("submit", function (event) {
    let formValid = true;

    formControls.forEach(function (input) {
      if (input.value.trim() === "") {
        input.classList.add("is-invalid");
        formValid = false;
      } else {
        input.classList.remove("is-invalid");
      }
    });

    // Impede o envio do formulário se algum campo estiver vazio
    if (!formValid) {
      event.preventDefault();
    }
  });
});
