// Função para criar e exibir um alerta
function showAlert(type, message) {
    const alertContainer = document.getElementById('alert-container');

    // Cria um elemento de alerta com título fixo e usa a URL da imagem
    const alert = document.createElement('div');
    alert.className = `alert alert-${type} alert-dismissible fade show custom-alert`;
    alert.role = 'alert';
    alert.innerHTML = `
        <img src="${alertIconUrl}" class="alert-image" alt="Alerta" /> <!-- Imagem do alerta -->
        <strong>ALERTA DO SISTEMA</strong><br> <!-- Título fixo -->
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

    // Adiciona o alerta ao contêiner
    alertContainer.appendChild(alert);

    // Remove o alerta automaticamente após 5 segundos
    setTimeout(() => {
        alert.classList.remove('show');
        alert.addEventListener('transitionend', () => alert.remove());
    }, 5000);
}

// Função para verificar e mostrar os alertas da sessão
document.addEventListener('DOMContentLoaded', function () {
    if (typeof sessionSuccessMessage !== 'undefined' && sessionSuccessMessage) {
        showAlert('success', sessionSuccessMessage);
    }
    if (typeof sessionErrorMessage !== 'undefined' && sessionErrorMessage) {
        showAlert('danger', sessionErrorMessage);
    }
});
