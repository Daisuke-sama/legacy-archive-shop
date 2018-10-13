<?php include_once ROOT . '/views/layouts/header.php' ?>

    <section id="form" style="margin-top: 0px;"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">

                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach($errors as $error): ?>
                                <li><?= $error; ?></li>
                            <? endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form"><!--sign up form-->
                        <h2>Log in!</h2>
                        <form action="#" method="post">
                            <input type="email" name="email" placeholder="Email" value="<?= $email ?>"/>
                            <input type="password" name="password" placeholder="Password" value="<?= $password ?>"/>
                            <input type="submit" name="submit" class="btn btn-success" value="Signup">
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->

<?php include_once ROOT . '/views/layouts/footer.php' ?>