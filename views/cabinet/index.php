<?php include_once ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <h1>User's account</h1>
            <h3>Hello <?= $user['name']; ?></h3>
            <ul>
                <li>
                    <a href="/cabinet/edit">Edit private data</a>
                </li>
                <li>
                    <a href="/cabinet/history">Order list</a>
                </li>
            </ul>
        </div>
    </div>
</section>

<?php include_once ROOT . '/views/layouts/footer.php'; ?>