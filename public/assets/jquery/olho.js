function mostrarSenha() {
    var inputPass = document.getElementById('senha');
    var btnShowPass = document.getElementById('btn-senha');

    if (inputPass.type === 'password') {
        inputPass.setAttribute('type', 'text');
        btnShowPass.classList.replace('bx-hide', 'bx-show');
    } else {
        inputPass.setAttribute('type', 'password');
        btnShowPass.classList.replace('bx-show', 'bx-hide');
    }
}
