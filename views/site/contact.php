<?php include_once ROOT . '/views/layouts/header.php' ?>

<h1>Contact us</h1>
<?php if (isset($result) && $result): ?>
    <p>Sent!</p>
<?php else: ?>
    <?php if ($result = false): ?>
        <p><b>Didn';'t sent!</b></p>
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
            <input type="email" name="userEmail" placeholder="Email" value="<?= $userEmail; ?>"/>
            <input type="text" name="userText" placeholder="Text" value="<?= $userText; ?>"/>
            <input type="submit" name="submit" class="btn btn-success" value="Send">
        </form>
    </div>

<?php include_once ROOT . '/views/layouts/footer.php' ?>