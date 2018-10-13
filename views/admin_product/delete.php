<?php include_once ROOT . '/views/layouts/admin_header.php' ?>

<section class="container">
    <h1>Delete?</h1>
    <p>Product with and id = <?= $id; ?></p>
    <form method="post">
        <input type="submit" name="submit" value="Delete">
    </form>
</section>

<?php include_once ROOT . '/views/layouts/footer.php' ?>