document.addEventListener("DOMContentLoaded", function () {
    // Esconde o conteúdo inicialmente
    document.getElementById("main-content").style.display = "none";
    document.getElementById("preloader").style.display = "flex";
});

window.onload = function () {
    // Após o carregamento, remove o preloader e exibe o conteúdo
    const preloader = document.getElementById("preloader");
    const mainContent = document.getElementById("main-content");

    // Esconde o preloader instantaneamente
    preloader.style.display = "none";

    // Exibe o conteúdo principal
    mainContent.style.display = "block";
};