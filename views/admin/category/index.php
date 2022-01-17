<?php

use App\Auth;
use App\Connection;
use App\Table\CategoryTable;

Auth::check();


$title = "Category Management";
$pdo = Connection::getPDO();
$link = $router->url('admin_categories');
$items = (new CategoryTable($pdo))->all();
?>

<?php if(isset($_GET['delete'])): ?>
<div class="alert alert-success">
    Article has been deleted.
</div>
<?php endif ?>

<table class="table">
    <thead>
        <th>#</th>
        <th>Title</th>
        <th>URL</th>
        <th>
            <a href="<?= $router->url('admin_category_new') ?>" class="btn btn-primary">New</a>
        </th>
    </thead>
    <tbody>
        <?php foreach($items as $item): ?>
        <tr>
            <td>
                #<?= $item->getID() ?>
            </td>
            <td>
                <a href="<?= $router->url('admin_category', ['id' => $item->getID()]) ?>">
                <?= e($item->getName()) ?>
                </a>
            </td>
            <td>
                <?= $item->getSlug() ?>
            </td>
            <td>
                <a href="<?= $router->url('admin_category', ['id' => $item->getID()]) ?>" class="btn btn-primary">
                Edit 
                </a>
                <form action="<?= $router->url('admin_category_delete', ['id' => $item->getID()]) ?>" method="POST"
                onsubmit = "return confirm('Wanna delete ?')" style="display:inline">
                <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>