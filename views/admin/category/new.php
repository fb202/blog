<?php 
use App\Connection;
use App\Table\CategoryTable;
use App\Validators\CategoryValidator;
use App\HTML\Form;
use App\ObjectHelper;
use App\Model\Category;
use App\Auth;

Auth::check();

$errors = [];
$item = new Category();

if(!empty($_POST)) {

    $pdo = Connection::getPDO();
    $table = new CategoryTable($pdo);

    $v = new CategoryValidator($_POST, $table);
    ObjectHelper::hydrate($item, $_POST, ['name', 'slug']);
    if($v->validate()) {
        $table->create([
            'name' => $item->getName(),
            'slug' => $item->getSlug()
        ]);
        header('Location: ' . $router->url('admin_categories') . '?created=1');
        exit();
    } else 
    {
       $errors = $v->errors();
    }
}
$form = new Form($item,$errors);

?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        Category was not saved, please rectify your mistakes
    </div>
<?php endif; ?>

<h1>Create a Category: </h1>

<?php require('_form.php'); ?>