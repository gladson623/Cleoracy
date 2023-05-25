function flash(type, message) {

    Swal.fire({
    icon: type === 'error' ? 'error' : 'success',
    title: type === 'error' ? 'Erro' : 'Sucesso',
    text: message
    });

}
