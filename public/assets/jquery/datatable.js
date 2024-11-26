$(document).ready(function () {
  $("#table").DataTable({
    responsive: true, // Responsividade ativada
    columnDefs: [
      {
        targets: 1, // Alvo da coluna TÍTULO (0-indexada)
        className: "text-center", // Alinha o texto ao centro
      },
      {
        targets: 0, // Alvo da primeira coluna (ID)
        className: "id-column", // Aplica a classe 'id-column' à primeira coluna
      },
      {
        targets: -2, // Penúltima coluna (a coluna antes da coluna de ações)
        responsivePriority: 1, // Prioridade mais alta para a penúltima coluna
      },
      {
        targets: -1, // Última coluna de Ações
        responsivePriority: 2, // Prioridade alta para a coluna de Ações
      },
    ],
    language: {
      url: baseUrl2 + "assets/js/pt-BR.json", // Usa a URL base para tradução
    },
  });

  // Ajuste de margens
  $("#table_wrapper").css({
    "margin-top": "20px",
    "margin-bottom": "20px",
    "margin-left": "10px",
    "margin-right": "10px",
  });
});
