<?php

use App\Connection;
use App\Table\PostTable;

$title = 'Mon blog';
$pdo = Connection::getPDO();

$table = new PostTable($pdo);
$link = $router->url('home');
[$posts, $pagination] = $table->findPaginated();

?>


<h1>Mon blog</h1>


<div class="row">
    <?php foreach($posts as $post): ?>
        <div class="col-md-3">
            <?php require 'card.php'; ?>
        </div>
    <?php endforeach; ?>
</div>

<div class="d-flex justify-content-between my-4">
    <?= $pagination->previousLink($link); ?>
    <?= $pagination->nextLink($link); ?>
</div>

