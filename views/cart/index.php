<?php include_once ROOT . '/views/layouts/header.php' ?>

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
                                        <a href="/category/<?= $category['id']; ?>">
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
                <?php if($totalPrice != 0): ?>

                    <table>
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $product['name']; ?></td>
                                <td><?= $_SESSION['products'][$product['id']]; ?></td>
                                <td><?= $product['price']; ?></td>
                                <td><a href="/cart/delete/<?= $product['id']; ?>">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>

                        <tr>
                            <td></td>
                            <td>Total price:</td>
                            <td><?= $totalPrice; ?></td>
                        </tr>

                        </tbody>
                    </table>

                <?php else: ?>
                    <p>Добавьте товаров, что ли.</p>
                <?php endif; ?>
            </div>

            <?php if(!empty($_SESSION['products'])) : ?>
                <a href="/cart/checkout" class="btn btn-primary">Checkout</a>
            <?php endif; ?>

        </div>
    </div>
    <section>

<?php include_once ROOT . '/views/layouts/footer.php' ?>