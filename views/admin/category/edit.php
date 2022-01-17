<?php 
use App\Connection;
use App\Table\PostTable;
use App\Validators\CategoryValidator;
use App\HTML\Form;
use App\ObjectHelper;
use App\Table\CategoryTable;
use App\Auth;

Auth::check();

$pdo = Connection::getPDO();
$table = new CategoryTable($pdo);
$item = $table->find($params['id']);
$success = false;
$errors = [];
$fields = ['name', 'slug'];

if(!empty($_POST)) {
    $v = new CategoryValidator($_POST, $table, $item->getID());
    ObjectHelper::hydrate($item, $_POST, $fields);
    if($v->validate()) {
        $table->update([
            'name' => $item->getName(),
            'slug' => $item->getSlug()
        ], $item->getID());
        $success = true;
    } else 
    {
       $errors = $v->errors();
    }
}
$form = new Form($item,$errors);

?>

<?php if($success): ?>
<div class="alert alert-success">
    Category was modified
</div>
<?php endif; ?>

<?php if(isset($_GET['created'])): ?>
<div class="alert alert-success">
    Category was created
</div>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        Category was not modified, please rectify your mistakes
    </div>
<?php endif; ?>

<h1>Edit Category: <?= e($item->getName()) ?></h1>

<?php require ('_form.php'); ?>