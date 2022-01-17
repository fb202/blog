<?php

use App\Connection;
use App\HTML\Form;
use App\Model\User;
use App\Table\Exception\NotFoundException;
use App\Table\UserTable;

$user = new User();
$errors = [];

if(!empty($_POST)) {
    $user->setUsername($_POST['username']);
    $errors['password'] = 'Login failed';

    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        $table = new UserTable(Connection::getPDO());
        try {
            $u = $table->findByUsername($_POST['username']);
            if(password_verify($_POST['password'], $u->getPassword()) === true) {
                session_start();
                $_SESSION['auth'] = $u->getID();
                header('Location: ' . $router->url('admin_posts'));
                exit();
            }
        } catch (NotFoundException $e) {
        }
    }
}

$form = new Form($user, $errors);

?>

<h1>Connect</h1>

<?php if(isset($_GET['forbidden'])): ?>
<div class="alert alert-danger">
    Cannot access this page
</div>
<?php endif; ?>

<form action="<?= $router->url('login') ?>" method="POST">
    <?= $form->input('username', 'User Name'); ?>
    <?= $form->input('password', 'Password'); ?>
    <button type="submit" class="btn btn-primary">Connect</button>
</form>