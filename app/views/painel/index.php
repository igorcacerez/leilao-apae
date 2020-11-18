<?php $this->view("painel/include/header"); ?>

<div class="wrapper">
    <div class="container-fluid">

        <div class="row pt-5">

            <!-- Produtos a venda -->
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-heading p-4">
                        <div class="mini-stat-icon float-right">
                            <i class="mdi mdi-cube-outline bg-primary  text-white"></i>
                        </div>
                        <div>
                            <h5 class="font-16">Produtos Ativos</h5>
                        </div>
                        <h3 class="mt-4"><?= $cont["produto_ativo"]; ?></h3>
                        <div class="progress mt-4" style="height: 4px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?= number_format($cont["produto_ativo_porcentagem"],0,'',''); ?>%" aria-valuenow="<?= number_format($cont["produto_ativo_porcentagem"],0,'',''); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="text-muted mt-2 mb-0">
                            Produtos á venda
                            <span class="float-right"><?= number_format($cont["produto_ativo_porcentagem"],2,',',''); ?>%</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Produtos Vendidos -->
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-heading p-4">
                        <div class="mini-stat-icon float-right">
                            <i class="mdi mdi-briefcase-check bg-success text-white"></i>
                        </div>
                        <div>
                            <h5 class="font-16">Produtos Vendidos</h5>
                        </div>
                        <h3 class="mt-4"><?= $cont["produto_vendido"]; ?></h3>
                        <div class="progress mt-4" style="height: 4px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?= number_format($cont["produto_vendido_porcentagem"],0,'',''); ?>%" aria-valuenow="<?= number_format($cont["produto_vendido_porcentagem"],0,'',''); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="text-muted mt-2 mb-0">
                            Produtos vendidos
                            <span class="float-right"><?= number_format($cont["produto_vendido_porcentagem"],2,',',''); ?>%</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Usuários -->
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-heading p-4">
                        <div class="mini-stat-icon float-right">
                            <i class="mdi mdi-tag-text-outline bg-warning text-white"></i>
                        </div>
                        <div>
                            <h5 class="font-16">Usuários</h5>
                        </div>
                        <h3 class="mt-4"><?= $cont["usuario"]; ?></h3>
                        <div class="progress mt-4" style="height: 4px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
                        </div>
                        <p class="text-muted mt-2 mb-0">Usuários do sistema</p>
                    </div>
                </div>
            </div>

            <!-- Total Arrecadado -->
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-heading p-4">
                        <div class="mini-stat-icon float-right">
                            <i class="mdi mdi-cash-multiple bg-danger text-white"></i>
                        </div>
                        <div>
                            <h5 class="font-16">Valor Arrecadado</h5>
                        </div>
                        <h3 class="mt-4">R$<?= number_format($cont["valor"], 2, ",", "."); ?></h3>
                        <div class="progress mt-4" style="height: 4px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"></div>
                        </div>
                        <p class="text-muted mt-2 mb-0">Valor total arrecadado</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- end row -->


        <!-- START ROW -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title mb-4">Produtos Cadastrados</h4>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th scope="col">IMG</th>
                                <th scope="col">PRODUTO</th>
                                <th scope="col">VALOR</th>
                                <th class="text-center" scope="col">STATUS</th>
                                <th class="text-center" scope="col">AÇÕES</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($produtos as $produto) : ?>
                                <tr id="tb_<?= $produto->id_produto ?>">
                                    <td>
                                        <img src="<?= $produto->imagem['thumb']; ?>" style="width: 70px;" />
                                    </td>
                                    <td><?= $produto->nome ?></td>
                                    <td>R$<?= number_format($produto->valor, 2, ',','.'); ?></td>

                                    <?php if ($produto->vendido == 1) : ?>
                                        <td class="text-center"><span class="badge badge-success p-2 font-12">VENDIDO</span></td>
                                    <?php else: ?>
                                        <td class="text-center"><span class="badge badge-danger p-2 font-12">Á VENDA</span></td>
                                    <?php endif; ?>

                                    <td class="text-center">
                                        <button data-id="<?= $produto->id_produto; ?>"
                                                data-toggle="tooltip"
                                                data-original-title="Deletar Produto"
                                                class="deletarProduto btn btn-danger btn-icon btn-sm mr-2">
                                            <i class="fas fa-window-close"></i>

                                        </button>

                                        <a href="<?= BASE_URL; ?>produto/alterar/<?= $produto->id_produto; ?>"
                                           data-toggle="tooltip"
                                           data-original-title="Alterar"
                                           class="btn btn-primary btn-icon btn-sm">
                                            <i class="far fa-edit"></i>
                                        </a>
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
    <!-- end container-fluid -->
</div>
<!-- end wrapper -->

<?php $this->view("painel/include/footer"); ?>

</body>
</html>