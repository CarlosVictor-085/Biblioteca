// Função para criar e exibir um alerta com a barra de progresso
function showAlert(type, message) {
    const alertContainer = document.getElementById('alert-container');

    // Cria um elemento de alerta com título fixo e usa a URL da imagem
    const alert = document.createElement('div');
    alert.className = `alert alert-${type} alert-dismissible fade show custom-alert`;
    alert.role = 'alert';

    // Criação da barra de progresso
    const progressBarContainer = document.createElement('div');
    progressBarContainer.className = 'progress';
    const progressBar = document.createElement('div');
    progressBar.className = 'progress-bar progress-bar-striped progress-bar-animated';
    progressBar.style.width = '0%';  // Começa com 0% de largura

    // Coloca a barra de progresso dentro da div do alerta
    alert.innerHTML = `
        <img src="${alertIconUrl}" class="alert-image" alt="Alerta" /> <!-- Imagem do alerta -->
        <strong>ALERTA DO SISTEMA</strong><br> <!-- Título fixo -->
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

    // Adiciona a barra de progresso dentro do alerta
    alert.appendChild(progressBarContainer);
    progressBarContainer.appendChild(progressBar);

    // Adiciona um estilo de margem para afastar a barra de progresso da mensagem
    progressBarContainer.style.marginTop = '15px'; // Adiciona um afastamento de 15px para baixo

    // Adiciona o alerta ao contêiner
    alertContainer.appendChild(alert);

    // Incrementa a barra de progresso até 100% em 5 segundos
    let width = 0;
    const interval = setInterval(() => {
        if (width >= 100) {
            clearInterval(interval);  // Para o incremento quando a barra atingir 100%
            setTimeout(() => {
                // Remove a barra de progresso após ela atingir 100%
                progressBarContainer.remove();
            }, 500);  // Dê um pequeno atraso antes de remover a barra
        } else {
            width++;  // Incrementa a largura
            progressBar.style.width = width + '%';  // Atualiza a largura da barra
        }
    }, 50); // Atualiza a cada 50ms para encher a barra ao longo de 5 segundos

    // Remove o alerta automaticamente após 5 segundos
    setTimeout(() => {
        alert.classList.remove('show');
        alert.addEventListener('transitionend', () => {
            alert.remove();  // Remove o alerta depois da animação
        });
    }, 5000);  // Tempo de duração do alerta e barra de progresso
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
