<?php $this->view("painel/include/header"); ?>


<!-- ============================================================== -->
<!-- INICIO adicionar produto -->
<!-- ============================================================== -->
<div class="content-page" style="padding-top: 140px;">
    <div class="content">
        <div class="container-fluid">

            <!-- BREADCUMP -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Inserir Usuário</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>usuarios">Usuários</a></li>
                            <li class="breadcrumb-item active">Adicionar</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- FIM BREADCUMP -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-30">
                        <div class="card-body">

                            <h4 class="mt-0 header-title">Cadastrar Usuário</h4>
                            <p class="sub-title">Cadastre um novo usuário para gerenciar os produtos.</p>

                            <form id="formInserirUsuario" data-alerta="swal">

                                <!-- NOME E EMAIL -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nome Completo</label>
                                            <input type="text" class="form-control" name="nome" value="" required/>
                                        </div>


                                        <div class="col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="" required/>
                                        </div>
                                    </div>
                                </div>

                                <!-- SENHA E CONFIRMA SENHA -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Senha</label>
                                            <input type="password" class="form-control" name="senha" value="" required/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Confirmar Senha</label>
                                            <input type="password" class="form-control" name="re_senha" value="" required/>
                                        </div>
                                    </div>
                                </div>

                                <!-- STATUS -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Status</label>
                                            <select class="form-control" name="status" required>
                                                <option value="1">Ativo</option>
                                                <option value="0">Desativado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Cadastrar</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- FIM adicionar produto -->
<!-- ============================================================== -->



<?php $this->view("painel/include/footer"); ?>

<script>
    jQuery(document).ready(function(){

        // Basic
        $('.dropify').dropify();

        $('.summernote').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false,                 // set focus to editable area after initializing summernote
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['view', ['fullscreen'/*, 'codeview' */]],   // remove codeview button
            ],
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            }

        });

    });
</script>

</body>
</html>
