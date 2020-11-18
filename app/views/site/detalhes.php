<?php $this->view("site/include/header"); ?>

    <style>
        .dec-review-topbar a.active
        {
            color: #2485d2 !important;
        }
        .dec-review-topbar a:before
        {
            background-color: #2485d2 !important;
        }
        .product-details-content .pro-details-price span.new-price
        {
            color: #2485d2 !important;
            font-weight: 700;
        }
    </style>

    <!-- BREADCRUMP -->
    <div class="breadcrumb-area bg-gray">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="<?= BASE_URL; ?>">Home</a>
                    </li>
                    <li class="active" style="color: #2485d2"><?= $produto->nome ?></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- FIM >> BREADCRUMP -->

    <!-- DETALHES DO PRODUTO -->
    <div class="product-details-area pt-120 pb-115">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-tab">
                        <div class="pro-dec-big-img-slider">

                            <?php if (!empty($imagens)) : ?>
                                <?php foreach ($imagens as $imagem) : ?>
                                    <div class="easyzoom-style">
                                        <div>
                                            <img width="100%" src="<?= $imagem->imagem ?>" alt="<?= $produto->nome ?>">
                                        </div>
                                        <a class="easyzoom-pop-up img-popup" href="<?= $imagem->imagem ?>"><i class="icon-size-fullscreen"></i></a>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                        <div class="product-dec-slider-small product-dec-small-style1">

                            <?php if (!empty($imagens)) : ?>
                                <?php $x = 0; ?>
                                <?php foreach ($imagens as $img) : ?>
                                    <div class="product-dec-small <?= ($x == 0) ? 'active' : '' ?>">
                                        <img src="<?= $img->imagem ?>" alt="<?= $produto->nome ?>">
                                    </div>
                                    <?php $x++; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-content pro-details-content-mrg">
                        <h2 class="mb-2"><?= $produto->nome ?></h2>
                        <p><?= $produto->descricao_curta ?></p>

                        <div class="pro-details-price">
                            <span class="new-price"><?= ($produto->vendido == true) ? '<b style="color: red;">VENDIDO</b>' : 'R$' . number_format($produto->valor, 2, ",","."); ?></span>
                        </div>

                        <?php if($produto->vendido == false): ?>
                            <div class="pro-details-action-wrap">
                                <div class="pro-details-add-to-cart">
                                    <a style="background-color: #06cc84" title="Comprar" href="https://wa.me/<?= WHATS ?>?text=Quero dar um lance no produto (<?=  $produto->nome; ?>)">COMPRAR</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM >> DETALHES DO PRODUTO -->

    <!-- DESCRIÇÃO -->
    <div class="description-review-wrapper pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="dec-review-topbar nav mb-45">
                        <a class="active" data-toggle="tab" href="#des-details1">Descrição</a>
                    </div>
                    <div class="tab-content dec-review-bottom">
                        <div id="des-details1" class="tab-pane active">
                            <div class="description-wrap">
                                <p><?= $produto->descricao; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM >> DESCRIÇÃO -->

<?php $this->view("site/include/footer"); ?>