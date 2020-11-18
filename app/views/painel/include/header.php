<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Leilão Apae - Sistema Administrativo</title>
    <meta content="Apae" name="author" />
    <link rel="apple-touch-icon" href="https://apae.com.br/apple-touch-icon.png">

    <!-- Summernote css -->
    <link href="<?= BASE_URL; ?>assets/theme/painel/plugins/summernote/summernote-bs4.css" rel="stylesheet" />

    <!-- Colorpicker -->
    <link href="<?= BASE_URL; ?>assets/theme/painel/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="<?= BASE_URL; ?>assets/theme/painel/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?= BASE_URL; ?>assets/theme/painel/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

    <!-- DataTables -->
    <link href="<?= BASE_URL; ?>assets/theme/painel/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= BASE_URL; ?>assets/theme/painel/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= BASE_URL; ?>assets/theme/painel/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <link href="<?= BASE_URL; ?>assets/theme/painel/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL; ?>assets/theme/painel/assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL; ?>assets/theme/painel/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL; ?>assets/theme/painel/assets/css/style.css" rel="stylesheet" type="text/css">

    <?php $this->view("autoload/css"); ?>
</head>

<body>

<style>
    #datatable-buttons_filter
    {
        text-align: right !important;
    }
</style>


<div class="header-bg">
    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main" style="padding: 10px 0px;">
            <div class="container-fluid">

                <!-- Logo-->
                <div>
                    <a href="<?= BASE_URL; ?>painel" class="logo">
                        <span class="logo-light">
                            <img src="<?= BASE_URL; ?>assets/theme/site/images/logo_apae_rodape.png" style="width: 104px;" />
                        </span>
                    </a>
                </div>
                <!-- End Logo-->

                <div class="menu-extras topbar-custom navbar p-0">
                    <ul class="navbar-right ml-auto list-inline float-right mb-0">

                        <li class="dropdown notification-list list-inline-item">
                            <div class="dropdown notification-list nav-pro-img">
                                <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="https://apae.com.br/apple-touch-icon.png" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <a class="dropdown-item" href="<?= BASE_URL; ?>usuario/alterar/<?= $usuario->id_usuario; ?>">
                                        <i class="mdi mdi-account-circle"></i> Perfil
                                    </a>

                                    <a class="dropdown-item" href="<?= BASE_URL; ?>" target="_blank">
                                        <i class="mdi mdi-wallet"></i> Ver Site
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item text-danger" href="<?= BASE_URL; ?>sair">
                                        <i class="mdi mdi-power text-danger"></i> Sair
                                    </a>
                                </div>
                            </div>
                        </li>

                        <li class="menu-item dropdown notification-list list-inline-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>

                    </ul>

                </div>
                <!-- end menu-extras -->

                <div class="clearfix"></div>

            </div>
            <!-- end container -->
        </div>
        <!-- end topbar-main -->

        <!-- MENU Start -->
        <div class="navbar-custom">
            <div class="container-fluid">

                <div id="navigation">

                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">

                        <li class="has-submenu">
                            <a href="<?= BASE_URL; ?>painel"><i class="mdi mdi-cart-outline"></i> Produtos</a>
                        </li>

                        <li class="has-submenu">
                            <a href="<?= BASE_URL; ?>produto/adicionar"><i class="mdi mdi-cart-plus"></i> Novo Produto</a>
                        </li>

                        <li class="has-submenu">
                            <a href="<?= BASE_URL; ?>usuarios"><i class="mdi mdi-account-multiple-outline"></i> Usuários</a>
                        </li>

                        <li class="has-submenu">
                            <a href="<?= BASE_URL; ?>usuario/adicionar"><i class="mdi mdi-account-multiple-plus-outline"></i> Novo Usuário</a>
                        </li>

                    </ul>
                    <!-- End navigation menu -->
                </div>
                <!-- end #navigation -->
            </div>
            <!-- end container -->
        </div>
        <!-- end navbar-custom -->
    </header>
    <!-- End Navigation Bar-->

</div>
<!-- header-bg -->