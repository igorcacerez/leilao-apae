<?php $this->view("painel/include/header"); ?>

<div class="wrapper">
    <div class="container-fluid">


        <!-- START ROW -->
        <div class="row" style="margin-top: 80px">
            <div class="col-xl-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title mb-4">Usuários Cadastrados</h4>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th scope="col">NOME</th>
                                <th scope="col">EMAIL</th>
                                <th class="text-center" scope="col">STATUS</th>
                                <th class="text-center" scope="col">AÇÕES</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($usuarios as $usuario) : ?>
                                <tr id="tb_<?= $usuario->id_usuario ?>">
                                    <td><?= $usuario->nome ?></td>
                                    <td><?= $usuario->email ?></td>

                                    <?php if ($usuario->status == 1) : ?>
                                        <td class="text-center"><span class="badge badge-success p-2 font-12">ATIVO</span></td>
                                    <?php else: ?>
                                        <td class="text-center"><span class="badge badge-danger p-2 font-12">DESATIVADO</span></td>
                                    <?php endif; ?>

                                    <td class="text-center">
                                        <button data-id="<?= $usuario->id_usuario; ?>"
                                                data-toggle="tooltip"
                                                data-original-title="Deletar Usuário"
                                                class="deletarUsuario btn btn-danger btn-icon btn-sm mr-2">
                                            <i class="fas fa-window-close"></i>

                                        </button>

                                        <a href="<?= BASE_URL; ?>usuario/alterar/<?= $usuario->id_usuario; ?>"
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