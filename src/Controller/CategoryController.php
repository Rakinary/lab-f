<?php

namespace App\Controller;

use App\Model\Category;
use App\Service\Router;
use App\Service\Templating;

class CategoryController
{
    public function indexAction(Templating $templating, Router $router): string
    {
        $categories = Category::findAll();

        return $templating->render('category/index.html.php', [
            'categories' => $categories,
            'router' => $router
        ]);
    }

    public function createAction(Templating $templating, Router $router, ?array $requestCategory): string
    {
        if ($requestCategory) {
            $c = new Category();
            $c->name = trim((string)($requestCategory['name'] ?? ''));
            $c->save();

            return $router->redirect('category-index');
        }

        return $templating->render('category/form.html.php', [
            'category' => new Category(),
            'router' => $router,
            'action' => 'category-create'
        ]);
    }

    public function editAction(Templating $templating, Router $router, int $id, ?array $requestCategory): string
    {
        $c = Category::findOne($id);
        if (!$c) {
            return $router->redirect('category-index');
        }

        if ($requestCategory) {
            $c->name = trim((string)($requestCategory['name'] ?? ''));
            $c->save();

            return $router->redirect('category-index');
        }

        return $templating->render('category/form.html.php', [
            'category' => $c,
            'router' => $router,
            'action' => 'category-edit',
            'id' => $id
        ]);
    }

    public function deleteAction(Router $router, int $id): string
    {
        Category::delete($id);
        return $router->redirect('category-index');
    }
}