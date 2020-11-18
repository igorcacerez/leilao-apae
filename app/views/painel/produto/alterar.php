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
                        <h4 class="page-title">Alterar Produto</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel">Produtos</a></li>
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

                            <h4 class="mt-0 header-title">Alterar Produto</h4>
                            <p class="sub-title">Altere as informações de um produto cadastrado.</p>

                            <form id="formAlterarProduto" data-id="<?= $produto->id_produto; ?>" data-alerta="swal">

                                <!-- NOME E NIVEL -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nome do Produto</label>
                                            <input type="text" class="form-control" name="nome" value="<?= $produto->nome; ?>" required/>
                                        </div>


                                        <div class="col-md-6">
                                            <label>Valor Inicial</label>
                                            <input type="text" class="form-control maskValor" name="valor" value="<?= number_format($produto->valor, 2, '', ''); ?>" required/>
                                        </div>
                                    </div>
                                </div>


                                <!-- Descricao curta -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Descrição curta</label>
                                            <textarea  class="form-control" name="descricao_curta" rows="3" required><?= $produto->descricao_curta; ?></textarea>
                                        </div>
                                    </div>
                                </div>


                                <!-- Descricao completa -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Descrição completa</label>
                                            <textarea id="textarea" name="descricao" class="form-control summernote" maxlength="200" rows="3" placeholder="Descrição do produto aqui."><?= $produto->descricao; ?></textarea>
                                        </div>
                                    </div>
                                </div>


                                <!-- Status -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Qual o status do produto?</label>
                                            <select name="vendido" class="form-control">
                                                <option value="0" <?= ($produto->vendido == false) ? "selected" : ""; ?>>Produto Á Venda</option>
                                                <option value="1" <?= ($produto->vendido == true) ? "selected" : ""; ?>>Produto Vendido</option>
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


            <!-- ADD IMAGEM -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Cadastrar imagem ao produto</h4>
                           <form id="formInserirImagemProduto" data-id="<?= $produto->id_produto; ?>" data-alerta="swal">

                                    <!-- NOME E NIVEL -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Imagem</label>
                                                <input type="file" class="dropify" name="arquivo" value="" required/>
                                            </div>


                                            <div class="col-md-12 pt-4">
                                                <label>Essa imagem é a principal?</label>
                                                <select name="principal" class="form-control">
                                                    <option value="1" selected>Sim</option>
                                                    <option value="0">Não</option>
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


            <!-- START ROW -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4">Imagens</h4>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th scope="col">IMG</th>
                                    <th class="text-center" scope="col">PRINCIPAL</th>
                                    <th class="text-center" scope="col">AÇÕES</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($imagens as $img) : ?>
                                    <tr id="tb_<?= $img->id_imagem ?>">
                                        <td>
                                            <img src="<?= BASE_STORAGE; ?>produto/<?= $produto->id_produto ?>/thumb/<?= $img->imagem ?>" style="width: 70px;" />
                                        </td>

                                        <?php if ($img->principal == 1) : ?>
                                            <td class="text-center"><span class="badge badge-success p-2 font-12">PRINCIPAL</span></td>
                                        <?php else: ?>
                                            <td class="text-center"> - </td>
                                        <?php endif; ?>

                                        <td class="text-center">
                                            <?php if($img->principal != true): ?>
                                                <button data-id="<?= $img->id_imagem; ?>"
                                                        data-toggle="tooltip"
                                                        data-original-title="Deletar Imagem"
                                                        class="deletarImagemProduto btn btn-danger btn-icon btn-sm mr-2">
                                                    <i class="fas fa-window-close"></i>
                                                </button>

                                                <button data-id="<?= $img->id_imagem; ?>"
                                                        data-produto="<?= $produto->id_produto; ?>"
                                                        class="imagemPrincipal btn btn-primary btn-icon btn-sm mr-2">
                                                    <i class="fas fa-star"></i>
                                                </button>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
            <!-- END ROW -->

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
