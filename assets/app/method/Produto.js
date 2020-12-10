import Global from "../global.js"


/**
 * Método responsável por enviar os dados do
 * formulário para a API, para que os dados sejam
 * validados e devidamente inseridos no banco.
 */
$("#formInserirProduto").on("submit", function () {

    // Não atualiza a página
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Url e token
    var url = Global.config.urlApi + "produto/insert";
    var token = Global.session.get("token");

    // Realiza a requisição
    Global.enviaApi("POST", url, form, token.token)
        .then((data) => {

            // Avisa que deu certo
            Global.setSuccess(data.mensagem);

            // Redireciona para a página do produto
            setTimeout(() => {
                location.href = Global.config.url + "produto/alterar/" + data.objeto.id_produto;
            }, 900);
        })
        .catch((error) => {
            // Desbloqueia o formulário
            $(this).removeClass("bloqueiaForm");
        });

    // Não atualiza mesmo
    return false;

});


/**
 * Método responsável por recuperar os dados do
 * formulário e realizar uma requisição para que os
 * dados sejam atualizado no banco.
 */
$("#formAlterarProduto").on("submit", function () {

    // Não atualiza a página
    event.preventDefault();

    // Recupera os dados importantes
    var form = new FormData(this);
    var id = $(this).data("id");

    // Bloqueia o Form
    $(this).addClass("bloqueiaForm");

    if(id === 0 || id === "0")
    {
        id = form.get("id_produto");

        form.delete("id_produto");
    }

    // Url e token
    var url = Global.config.urlApi + "produto/update/" + id;
    var token = Global.session.get("token");

    // Realiza a requisição
    Global.enviaApi("POST", url, form, token.token)
        .then((data) => {
            // Avisa que deu certo
            Global.setSuccess(data.mensagem);

            setTimeout(() => {

                location.href = window.location.href;

            }, 2000);

        })
        .catch((error) => {
            // Desbloqueia o Form
            $(this).removeClass("bloqueiaForm");
        });

    // Não atualiza mesmo
    return false;
});


$(".abreModalLance").on("click", function () {

    // Não atualiza
    event.preventDefault();

    // Recupera o id
    var id = $(this).data("id");

    // Add o valor do id
    $("#idProdutoVal").val(id);

    // Abre a modal
    $("#modalLance").modal("show");

    // Não atualiza mesmo
    return false;

});


/*
* ===========================================================
* IMAGEM DO PRODUTO =========================================
* ===========================================================
*/


/**
 * Método responsável por enviar os dados do
 * formulário para a API, para que os dados sejam
 * validados e devidamente inseridos no banco.
 */
$("#formInserirImagemProduto").on("submit", function () {

    // Não atualiza a página
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);
    var id = $(this).data("id");

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Url e token
    var url = Global.config.urlApi + "imagem/insert/" + id;
    var token = Global.session.get("token");

    // Realiza a requisição
    Global.enviaApi("POST", url, form, token.token)
        .then((data) => {

            // Avisa que deu certo
            Global.setSuccess(data.mensagem);

            // Redireciona para a página do produto
            setTimeout(() => {
                location.href = Global.config.url + "produto/alterar/" + id;
            }, 500);
        })
        .catch((error) => {
            // Desbloqueia o formulário
            $(this).removeClass("bloqueiaForm");
        });

    // Não atualiza mesmo
    return false;

});



/**
 * Método responsável por deletar uma determinada
 * categoria.Enviando a solicitação para a API
 */
$(".deletarImagemProduto").on("click", function () {

    // Não atualiza a página
    event.preventDefault();

    // Recupera as informações
    var id = $(this).data("id");

    // Url e Token
    var url = Global.config.urlApi + "imagem/delete/" + id;
    var token = Global.session.get("token");

    // Pergunta se realmente quer deletar
    Swal.fire({
        title: 'Deletar Imagem',
        text: 'Deseja realmente deletar essa imagem?',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, delete!'
    }).then((result) => {
        if (result.value)
        {
            // Realiza a solicitação
            Global.enviaApi("DELETE", url, null, token.token)
                .then((data) => {

                    // Avisa que deu certo
                    Global.setSuccess(data.mensagem);

                    // Remove da tabela
                    $('#datatable-buttons')
                        .DataTable()
                        .row("#tb_" + id)
                        .remove()
                        .draw(false);


                });
        }
    });


    // Não atualiza mesmo
    return false;
});



/**
 * Método responsável por enviar os dados do
 * formulário para a API, para que os dados sejam
 * validados e devidamente inseridos no banco.
 */
$(".imagemPrincipal").on("click", function () {

    // Não atualiza
    event.preventDefault();

    // Recupera os dados
    var id = $(this).data("id");
    var idProduto = $(this).data("produto");

    // Url e token
    var url = Global.config.urlApi + "imagem/principal/" + id;
    var token = Global.session.get("token");

    // Pergunta se realmente quer deletar
    Swal.fire({
        title: 'Alterar Princial',
        text: 'Deseja tornar essa imagem a principal?',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!'
    }).then((result) => {
        if (result.value)
        {
            // Realiza a solicitação
            Global.enviaApi("PUT", url, null, token.token)
                .then((data) => {

                    // Avisa que deu certo
                    Global.setSuccess(data.mensagem);

                    // Redireciona para a página do produto
                    setTimeout(() => {
                        location.href = Global.config.url + "produto/alterar/" + idProduto;
                    }, 500);

                });
        }
    });

    // Não atualiza
    return false;
});



/**
 * Método responsável por deletar uma determinada
 * categoria.Enviando a solicitação para a API
 */
$(".deletarProduto").on("click", function () {

    // Não atualiza a página
    event.preventDefault();

    // Recupera as informações
    var id = $(this).data("id");

    // Url e Token
    var url = Global.config.urlApi + "produto/delete/" + id;
    var token = Global.session.get("token");

    // Pergunta se realmente quer deletar
    Swal.fire({
        title: 'Deletar Produto',
        text: 'Deseja realmente deletar esse produto?',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, delete!'
    }).then((result) => {
        if (result.value)
        {
            // Realiza a solicitação
            Global.enviaApi("DELETE", url, null, token.token)
                .then((data) => {

                    // Avisa que deu certo
                    Global.setSuccess(data.mensagem);

                    // Remove da tabela
                    $('#datatable-buttons')
                        .DataTable()
                        .row("#tb_" + id)
                        .remove()
                        .draw(false);


                });
        }
    });


    // Não atualiza mesmo
    return false;
});