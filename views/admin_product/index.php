<?php include_once ROOT . '/views/layouts/admin_header.php' ?>

<section class="container">
    <h1>All products</h1>
    <table class="table table-responsive">
        <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>CODE</th>
            <th>PRICE</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($prodList as $prod): ?>

            <tr>
                <td><?= $prod['id']; ?></td>
                <td><?= $prod['name']; ?></td>
                <td><?= $prod['price']; ?></td>
                <td><?= $prod['code']; ?></td>
                <td><a href="/product/update/<?= $prod['id']; ?>">Edit</a></td>
                <td><a href="/product/delete/<?= $prod['id']; ?>">Delete</a></td>
            </tr>

        <?php endforeach; ?>

        </tbody>
    </table>
</section>

<?php include_once ROOT . '/views/layouts/footer.php' ?>