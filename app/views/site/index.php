<?php $this->view("site/include/header"); ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 style="font-size: 4em; font-weight: bold; padding-top: 15px;">
                        Bem-vindo ao leilão da APAE Birigui/SP
                    </h1>
                </div>
            </div>
        </div>

        <div class="product-area section-padding-1 pt-115 pb-75">
            <div class="container-fluid">
                <div class="section-title">
                    <h2 class="mb-5">Produtos</h2>
                </div>
                <div class="row">
                    <?php if(!empty($produtos)): ?>
                        <?php foreach ($produtos as $prod): ?>
                            <?php $this->view("site/include/card/produto", ["produto" => $prod]); ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-md-12">
                            <p>No momento não possui produto em leilão.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="banner-home" style="background-image: url('<?= BASE_URL ?>assets/theme/site/images/banner-1.jpg')"></div>
            </div>

            <div class="carousel-item">
                <div class="banner-home" style="background-image: url('<?= BASE_URL ?>assets/theme/site/images/banner-2.jpg')"></div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

<?php $this->view("site/include/footer"); ?>