<form action="" method="POST">
    <?= $form->input('name','Title') ?>
    <?= $form->input('slug','URL') ?>
    <button class="btn btn-primary">
        <?php if($item->getID() !== null) : ?>
            Modify
        <?php else: ?>
            Create
        <?php endif; ?>
    </button>
</form>