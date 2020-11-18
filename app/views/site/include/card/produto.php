<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
    <div class="single-product-wrap mb-35">
        <div class="product-img product-img-zoom mb-20">
            <a href="<?= $produto->url; ?>">
                <img src="<?= $produto->imagem['thumb']; ?>" alt="<?= $produto->nome; ?>">
            </a>
            <div class="product-action-wrap">
                <div class="product-action-left">
                    <a href="https://wa.me/<?= WHATS ?>?text=Quero dar um lance no produto (<?=  $produto->nome; ?>)">
                        <button>
                            <i class="icon-basket-loaded"></i>DAR LANCE
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <div class="product-content-wrap">
            <div class="product-content-left">
                <h4>
                    <a href="product-details.html">
                        <?= mb_strimwidth($produto->nome, 0, 40, "..."); ?>
                    </a>
                </h4>

                <div class="product-price">
                    <span>R$<?= number_format($produto->valor, 2, ",","."); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>