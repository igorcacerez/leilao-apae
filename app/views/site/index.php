<?php $this->view("site/include/header"); ?>

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

        <div class="product-area section-padding-1 pt-115 pb-75">
            <div class="container-fluid">
                <div class="section-title">
                    <h2 class="mb-5">Produtos</h2>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="single-product-wrap mb-35">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="product-details.html">
                                    <img src="<?= BASE_URL; ?>assets/theme/site/images/product/product-1.jpg" alt="">
                                </a>
                                <div class="product-action-wrap">
                                    <div class="product-action-left">
                                        <button><i class="icon-basket-loaded"></i>Add to Cart</button>
                                    </div>
                                    <div class="product-action-right tooltip-style">
                                        <button data-toggle="modal" data-target="#exampleModal"><i class="icon-size-fullscreen icons"></i><span>Quick View</span></button>
                                        <button class="font-inc"><i class="icon-refresh"></i><span>Compare</span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-content-left">
                                    <h4><a href="product-details.html">Simple Black T-Shirt</a></h4>
                                    <div class="product-price">
                                        <span>$56.20</span>
                                    </div>
                                </div>
                                <div class="product-content-right tooltip-style">
                                    <button class="font-inc"><i class="icon-heart"></i><span>Wishlist</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php $this->view("site/include/footer"); ?>