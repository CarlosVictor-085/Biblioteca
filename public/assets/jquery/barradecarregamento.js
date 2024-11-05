document.addEventListener("DOMContentLoaded", function() {
    // Ao carregar o DOM, exibe o preloader e esconde o conteúdo
    document.getElementById("main-content").style.display = "none";
    document.getElementById("preloader").style.display = "flex";
});

window.onload = function() {
    // Após carregar todos os recursos, esconde o preloader e exibe o conteúdo
    document.getElementById("preloader").style.display = "none";
    document.getElementById("main-content").style.display = "block";

};
// Função para verificar e mostrar os alertas da sessão
