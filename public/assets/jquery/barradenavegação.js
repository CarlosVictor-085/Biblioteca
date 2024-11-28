// Função para formatar a primeira letra em maiúscula
function capitalize(word) {
  return word.charAt(0).toUpperCase() + word.slice(1);
}

// Obter o caminho da URL após "public" e dividi-lo em segmentos
const pathArray = window.location.pathname
  .split("/")
  .filter((segment) => segment && segment !== "public");
// Selecionar o elemento do breadcrumb
const breadcrumbContainer = document.getElementById("breadcrumb");
// Adicionar "Biblioteca" como primeiro item
const libraryItem = document.createElement("li");
libraryItem.classList.add("breadcrumb-item", "nav-item");
libraryItem.textContent = "Biblioteca";
breadcrumbContainer.appendChild(libraryItem);
// Verificar se a URL termina com "editar"
const isEditing = pathArray.includes("editar");
// Montar breadcrumbs com base nos segmentos da URL após "public"
pathArray.forEach((segment, index) => {
  const name = capitalize(segment);
  const url = "/public/" + pathArray.slice(0, index + 1).join("/");
  const listItem = document.createElement("li");
  listItem.classList.add("breadcrumb-item", "nav-item");
  // Verificar se a URL é a página inicial (Home)
  if (pathArray.length === 1 && pathArray[0] === "Home") {
    // Não adiciona nenhum outro item, pois já temos "Biblioteca"
    return;
  } else if (isEditing && index === pathArray.length - 1) {
    // Para páginas de edição
    listItem.classList.add("active");
    listItem.setAttribute("aria-current", "page");
    listItem.textContent = name; // Exibe o nome do segmento
  } else {
    // Para outras páginas, substituir "index" por "Início"
    if (name === "Index") {
      // Não faz nada para não adicionar "Início" no breadcrumb
      return;
    } else {
      const link = document.createElement("a");
      link.href = url;
      link.textContent = name; // Mantém o nome formatado dos outros itens
      listItem.appendChild(link);
    }
  }
  breadcrumbContainer.appendChild(listItem);
});
