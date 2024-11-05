function formatarCPF(cpf) {
    cpf = cpf.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
    if (cpf.length > 11) {
        cpf = cpf.substring(0, 11); // Limita a 11 caracteres
      }
    cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4'); // Formata o CPF
    return cpf;
}
const campoCPF = document.getElementById('cpf');


campoCPF.addEventListener('input', () => {
  const cpf = campoCPF.value;
  if (cpf.length > 14) { // 14 caracteres inclui os pontos e o hífen
    campoCPF.value = cpf.substring(0, 14);
  }
  const cpfFormatado = formatarCPF(cpf);
  campoCPF.value = cpfFormatado;
});
