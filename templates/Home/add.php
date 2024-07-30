<?php
// Definindo o layout
$this->layout = 'main';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="<?= $this->Url->build('/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= $this->Url->build('/css/templatemo-xtra-blog.css'); ?>" rel="stylesheet">
</head>

<body>
    <header class="tm-header" id="tm-header">
        <div class="tm-header-wrapper">
            <button class="navbar-toggler" type="button" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="tm-site-header">
                <div class="mb-3 mx-auto tm-site-logo"><i class="fas fa-times fa-2x"></i></div>
                <h1 class="text-center">Xtra Blog</h1>
            </div>
            <nav class="tm-nav" id="tm-nav">
                <ul>
                    <li class="tm-nav-item"><a href="<?= $this->Url->build('/'); ?>" class="tm-nav-link">
                            <i class="fas fa-home"></i>
                            Blog Home
                        </a></li>

                    <li class="tm-nav-item"><a href="<?= $this->Url->build('/posts/add'); ?>" class="tm-nav-link">
                        <i class="fas fa-plus"></i>
                        Add Post
                    </a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container-fluid">
        <main class="tm-main">
            <div class="row tm-row">
                <h1 class="col-12 tm-color-primary tm-post-title tm-mb-60 center">Add New Post</h1>
                <?= $this->Form->create($post, ['type' => 'file', 'class' => 'tm-form']); ?>
                <fieldset>
                    <legend><?= __('Add Post') ?></legend>
                    <?= $this->Form->control('title', ['class' => 'form-control', 'label' => 'Title']); ?>
                    <?= $this->Form->control('body', ['type' => 'textarea', 'class' => 'form-control', 'label' => 'Body']); ?>
                    <?= $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]); ?>
                    <?= $this->Form->control('image', ['type' => 'file', 'label' => 'Upload Image']); ?>
                </fieldset>
                <?= $this->Form->button(__('Save Post'), ['class' => 'btn btn-success']); ?>
                <?= $this->Form->end(); ?>
            </div>
            <footer class="row tm-row">

            </footer>
        </main>
    </div>

    <script src="<?= $this->Url->build('/js/jquery.min.js'); ?>"></script>
    <script src="<?= $this->Url->build('/js/bootstrap.min.js'); ?>"></script>
</body>

</html>
