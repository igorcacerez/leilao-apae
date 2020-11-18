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
                        <h4 class="page-title">Inserir Produto</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel">Produtos</a></li>
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

                            <h4 class="mt-0 header-title">Cadastrar Produtos</h4>
                            <p class="sub-title">Cadastre um novo produto a ser leiloado.</p>

                            <form id="formInserirProduto" data-alerta="swal">

                                <!-- NOME E NIVEL -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nome do Produto</label>
                                            <input type="text" class="form-control" name="nome" value="" required/>
                                        </div>


                                        <div class="col-md-6">
                                            <label>Valor</label>
                                            <input type="text" class="form-control maskValor" name="valor" value="" required/>
                                        </div>
                                    </div>
                                </div>


                                <!-- Descricao curta -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Descrição curta</label>
                                            <textarea name="descricao_curta" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>


                                <!-- Descricao completa -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Descrição completa</label>
                                            <textarea id="textarea" name="descricao" class="form-control summernote" maxlength="200" rows="3" placeholder="Descrição do produto aqui."></textarea>
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
