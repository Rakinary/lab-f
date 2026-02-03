<h1>Categories</h1>

<p>
    <a href="<?= $router->generatePath('category-create') ?>">Create new</a>
</p>

<ul>
    <?php foreach ($categories as $c): ?>
        <li>
            #<?= $c->id ?> — <?= htmlspecialchars($c->name) ?>

            <a href="<?= $router->generatePath('category-edit', ['id' => $c->id]) ?>">Edit</a>
            <a href="<?= $router->generatePath('category-delete', ['id' => $c->id]) ?>"
               onclick="return confirm('Delete?')">Delete</a>
        </li>
    <?php endforeach; ?>
</ul>

<p>
    <a href="<?= $router->generatePath('post-index') ?>">Back to posts</a>
</p>