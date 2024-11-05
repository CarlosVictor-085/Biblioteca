$(document).ready(function() {
    function fetchUsuarios(query = '') {
        $.ajax({
            url: '<?= site_url('Usuario/pesquisar') ?>',
            type: 'POST',
            data: { pesquisa: query },
            dataType: 'json',
            success: function(data) {
                let rows = '';
                $.each(data.listaUsuarios, function(index, usuario) {
                    rows += `<tr onclick="location.href='<?= base_url('Usuario/editar/') ?>${usuario.id}'" role="button">
                                <td>${usuario.id}</td>
                                <td>${usuario.nome}</td>
                                <td>${usuario.email}</td>
                                <td>${usuario.telefone}</td>
                            </tr>`;
                });
                $('#tabela-usuarios tbody').html(rows);
                
                let pager = data.pager.links('default', 'pager');
                $('#pager').html(pager);
            },
            error: function(xhr, status, error) {
                console.error("Houve um erro: " + error);
            }
        });
    }

    // Fetch initial data
    fetchUsuarios();

    // Search on input change
    $('#pesquisa').on('keyup', function() {
        fetchUsuarios($(this).val());
    });
    
    // Search button click
    $('#btn-pesquisar').on('click', function() {
        fetchUsuarios($('#pesquisa').val());
    });
});