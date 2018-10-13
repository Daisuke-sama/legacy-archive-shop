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


                <div class="col-sm-9">

                    <?php if (isset($result) && $result) : ?>

                        <p>Order was successfully sent.</p>

                    <?php else: ?>

                        <h1>Order confirmation</h1>

                        <p>In your cart products quantity of <?= $totalQuantity; ?>. Total: <?= $totalPrice; ?>.</p>

                        <?php if (isset($errors) && is_array($errors)): ?>
                            <ul>
                                <?php foreach($errors as $error): ?>
                                    <li><?= $error; ?></li>
                                <? endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <p>Fill the form below. Our sales manager will contact you for finishing the order.</p>

                        <div class="signup-form"><!--sign up form-->
                            <form action="#" method="post">
                                <input type="text" name="name" placeholder="Name" value="<?= $name; ?>"/>
                                <input type="text" name="phone" placeholder="Phone" value="<?= $phone; ?>"/>
                                <input type="text" name="comment" placeholder="Comment" value="<?= $comment; ?>"/>

                                <input type="submit" name="submit" class="btn btn-success" value="Buy">
                            </form>
                        </div><!--/sign up form-->

                    <?php endif; ?>

                </div>

            </div>
        </div>
    </section>

<?php include_once ROOT . '/views/layouts/footer.php'; ?>