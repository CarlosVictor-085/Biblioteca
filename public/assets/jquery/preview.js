document.addEventListener("DOMContentLoaded", function () {
  const inputFoto = document.getElementById("foto");
  const previewContainer = document.getElementById("previewContainer");
  const form = document.getElementById("formAlterarFoto");

  // Adiciona evento ao input de upload para exibir o preview
  inputFoto.addEventListener("change", function (event) {
    // Limpa o preview existente
    previewContainer.innerHTML = "";

    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();

      reader.onload = function (e) {
        const img = document.createElement("img");
        img.src = e.target.result;
        img.className = "w-px-70 h-auto rounded-circle d-block";
        previewContainer.appendChild(img);
      };

      reader.readAsDataURL(file);
    }
  });

  // Certifique-se de que o formulário seja enviado corretamente
  form.addEventListener("submit", function (event) {
    if (!inputFoto.files.length) {
      event.preventDefault(); // Impede o envio se não houver arquivo selecionado
      alert("Por favor, selecione uma imagem antes de salvar.");
    }
  });
});
