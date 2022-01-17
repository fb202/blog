<?php 
use App\Connection;
use App\Table\PostTable;
use App\Validators\PostValidator;
use App\HTML\Form;
use App\ObjectHelper;

$pdo = Connection::getPDO();
$postTable = new PostTable($pdo);
$post = $postTable->find($params['id']);
$success = false;

$errors = [];


if(!empty($_POST)) {
    $v = new PostValidator($_POST, $postTable, $post->getID());
    ObjectHelper::hydrate($post, $_POST, ['name', 'content', 'slug', 'created_at']);
    if($v->validate()) {
        $postTable->updatePost($post);
        $success = true;
    } else 
    {
       $errors = $v->errors();
    }
}
$form = new Form($post,$errors);

?>

<?php if($success): ?>
<div class="alert alert-success">
    Edit was processed
</div>
<?php endif; ?>

<?php if(isset($_GET['created'])): ?>
<div class="alert alert-success">
    Article was created
</div>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        Article was not modified, please rectify your mistakes
    </div>
<?php endif; ?>

<h1>Edit Article: <?= e($post->getName()) ?></h1>

<?php require ('_form.php'); ?>