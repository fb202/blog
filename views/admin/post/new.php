<?php 
use App\Connection;
use App\Table\PostTable;
use App\Validators\PostValidator;
use App\HTML\Form;
use App\ObjectHelper;
use App\Model\Post;

$errors = [];
$post = new Post();
$post->setCreatedAt(date('Y-m-d H:i:s'));

if(!empty($_POST)) {

    $pdo = Connection::getPDO();
    $postTable = new PostTable($pdo);
    $v = new PostValidator($_POST, $postTable, $post->getID());
    ObjectHelper::hydrate($post, $_POST, ['name', 'content', 'slug', 'created_at']);
    if($v->validate()) {
        $postTable->createPost($post);
        header('Location: ' . $router->url('admin_posts', ['id' => $post->getID()]) . '?created=1');
        exit();
    } else 
    {
       $errors = $v->errors();
    }
}
$form = new Form($post,$errors);

?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        Article was not saved, please rectify your mistakes
    </div>
<?php endif; ?>

<h1>Create an Article: </h1>

<?php require('_form.php'); ?>