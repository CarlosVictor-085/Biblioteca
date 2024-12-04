document.getElementById('quantidade').addEventListener('input', function() {
    // Limitar a quantidade a um máximo de 100
    if (this.value > 100) {
        this.value = 100; // Define o valor máximo como 100
    }
    var quantidade = parseInt(this.value);
    var container = document.getElementById('tomboContainer');
    container.innerHTML = ''; // Limpa qualquer campo de tombo previamente adicionado
    if (!isNaN(quantidade) && quantidade > 0) {
        for (var i = 1; i <= quantidade; i++) {
            // Cria o rótulo do campo
            var label = document.createElement('label');
            label.className = 'form-label';
            label.setAttribute('for', 'tombo' + i);
            label.innerHTML = 'Tombamento ' + i + ':';
            // Cria o campo de input para o tombamento
            var input = document.createElement('input');
            input.className = 'form-control';
            input.type = 'text';
            input.name = 'tombo[]'; // Armazena os valores como um array
            input.id = 'tombo' + i;
            // Adiciona um evento de input para verificar duplicatas enquanto o usuário digita
            input.addEventListener('input', verificarDuplicatas);
            // Adiciona o campo de input ao container
            container.appendChild(label);
            container.appendChild(input);
        }
    }
});
// Função para verificar duplicatas de tombamento
function verificarDuplicatas() {
    var tombos = document.querySelectorAll("input[name='tombo[]']");
    var valores = [];
    var hasDuplicate = false;
    tombos.forEach(function(tombo) {
        var valor = tombo.value.trim();
        if (valor !== '' && valores.includes(valor)) {
            tombo.classList.add('is-invalid'); // Destaca o campo com duplicata
            hasDuplicate = true;
        } else {
            tombo.classList.remove('is-invalid'); // Remove o destaque se não for duplicata
            valores.push(valor);
        }
    });
    // Desabilita o botão de envio se houver duplicatas
    var submitButton = document.querySelector("button[type='submit']");
    submitButton.disabled = hasDuplicate;
}