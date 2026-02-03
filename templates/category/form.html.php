<h1><?= $category->id ? 'Edit category' : 'Create category' ?></h1>

<form method="post" action="<?= $router->generatePath($action, isset($id) ? ['id' => $id] : []) ?>">
    <label>
        Name:
        <input type="text" name="category[name]" value="<?= htmlspecialchars($category->name) ?>" required>
    </label>

    <button type="submit">Save</button>
</form>

<p>
    <a href="<?= $router->generatePath('category-index') ?>">Back</a>
</p>