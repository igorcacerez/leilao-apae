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
                        <h4 class="page-title">Alterar Usuário</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>usuarios">Usuários</a></li>
                            <li class="breadcrumb-item active">Alterar</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- FIM BREADCUMP -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-30">
                        <div class="card-body">

                            <h4 class="mt-0 header-title">Alterar Usuário</h4>
                            <p class="sub-title">Altere os dados do usuário para gerenciar os produtos.</p>

                            <form id="formAlterarUsuario" data-alerta="swal" data-id="<?= $user->id_usuario; ?>" >

                                <!-- NOME E EMAIL -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nome Completo</label>
                                            <input type="text" class="form-control" name="nome" value="<?= $user->nome ?>" required/>
                                        </div>


                                        <div class="col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="<?= $user->email ?>" required/>
                                        </div>
                                    </div>
                                </div>

                                <!-- SENHA E CONFIRMA SENHA -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Senha</label>
                                            <input type="password" class="form-control" name="senha" value=""/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Confirmar Senha</label>
                                            <input type="password" class="form-control" name="re_senha" value=""/>
                                        </div>
                                    </div>
                                </div>

                                <!-- STATUS -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Status</label>
                                            <select class="form-control" name="status" required>
                                                <option <?= ($user->status == 1) ? 'selected' : '' ?> value="1">Ativo</option>
                                                <option <?= ($user->status == 0) ? 'selected' : '' ?> value="0">Desativado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Alterar</button>
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
