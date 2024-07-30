<?php
// Definindo o layout
$this->layout = 'main';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= h($post->title) ?> - Xtra Blog</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="<?= $this->Url->build('/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= $this->Url->build('/css/templatemo-xtra-blog.css'); ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
                </ul>
            </nav>
        </div>
    </header>
    <div class="container-fluid">
        <main class="tm-main">

            <div class="row tm-row">
                <div class="col-lg-8 tm-post-col">
                    <div class="tm-post-full">
                        <div class="mb-4">
                            <h2 class="pt-2 tm-color-primary tm-post-title"><?= h($post->title) ?></h2>
                            <p class="tm-mb-40"><?= h($post->created->format('F j, Y')) ?> posted by <?= h($post->user_id) ?></p>
                            <!-- Exibindo imagens associadas ao post -->
                            <?php if (!empty($post->images)) : ?>
                                <?php foreach ($post->images as $image) : ?>
                                    <img src="<?= h($image->path) ?>" alt="Image" class="img-fluid tm-img-top tm-medium-img">
                                <?php endforeach; ?>
                                <?php else : ?>
                                        <img src="<?= $this->Url->build('/img/img-01.jpg'); ?>" alt="Image" class="img-fluid">
                            <?php endif; ?>
                            <p><?= h($post->body) ?></p>
                            <span class="d-block text-right tm-color-primary">Creative . Design . Business</span>
                        </div>
                        <hr class="mb-4">
                    </div>
                </div>
                <footer class="row tm-row">
                    <div class="col-md-6 col-12 tm-color-gray">
                        Design: <a rel="nofollow" target="_parent" href="https://templatemo.com" class="tm-external-link">TemplateMo</a>
                    </div>
                    <div class="col-md-6 col-12 tm-color-gray tm-copyright">
                        Copyright 2020 Xtra Blog Company Co. Ltd.
                    </div>
                </footer>
        </main>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/templatemo-script.js"></script>
</body>

</html>
