<?php include_once ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">

                        <?php foreach ($categories as $category): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/category/<?= $category['id']; ?>"
                                            class="<?php if($category['id'] == $categoryId) echo 'active'; ?>">
                                            <?= $category['name']; ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Последние товары</h2>
                    <?php foreach ($productsFromCategory as $prod) : ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="/template/images/home/product1.jpg" alt=""/>
                                        <h2><?= $prod['price']; ?></h2>
                                        <p>
                                            <a href="/product/<?= $prod['id']; ?>">
                                                <?= $prod['name']; ?>
                                            </a>
                                        </p>
                                        <a href="#" data-id="<?= $prod['id']; ?>" class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart"></i>В корзину
                                        </a>
                                    </div>
                                    <?php if ($prod['is_new']): ?>
                                        <img src="/template/images/home/new.png" class="new" alt="">
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div><!--features_items-->

                <?= $pagination->get(); ?>
            </div>
        </div>
    </div>
</section>

<?php include_once ROOT . '/views/layouts/footer.php'; ?>
