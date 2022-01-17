<form action="" method="POST">
    <?= $form->input('name','Title') ?>
    <?= $form->input('slug','URL') ?>
    <?= $form->textarea('content','Content') ?>
    <?= $form->input('created_at','Creation Date') ?>
    <button class="btn btn-primary">
        <?php if($post->getID() !== null) : ?>
            Modify
        <?php else: ?>
            Create
        <?php endif; ?>
    </button>
</form>