<?php include_once ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">
                <h1>Change your data</h1>

                <?php if (isset($result) && $result): ?>
                    <p>Data was update.</p>
                <?php else: ?>
                    <?php if ($result = false): ?>
                        <p><b>Data wasn't update.</b></p>
                    <?php endif; ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="signup-form">
                    <form action="#" method="post">
                        <input type="name" name="name" placeholder="Name" value="<?= $userName ?>"/>
                        <input type="password" name="password" placeholder="Password" value="<?= $userPass ?>"/>
                        <input type="submit" name="submit" class="btn btn-success" value="Save">
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php include_once ROOT . '/views/layouts/footer.php'; ?>