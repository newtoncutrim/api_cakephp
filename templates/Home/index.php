<?php
// Definindo o layout
$this->layout = 'main';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xtra Blog</title>
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
            <!-- Search form -->
            <div class="row tm-row">
                <div class="col-12">
                    <form method="GET" class="form-inline tm-mb-80 tm-search-form">
                        <input class="form-control tm-search-input" name="query" type="text" placeholder="Search..." aria-label="Search">
                        <button class="tm-search-button" type="submit">
                            <i class="fas fa-search tm-search-icon" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="row tm-row">
                <?php if (!empty($posts)) : ?>
                    <h1 class="col-12 tm-color-primary tm-post-title tm-mb-60 center">Total Posts: <?= count($posts); ?></h1>
                    <?php foreach ($posts as $post) : ?>
                        <?php $post = $post->toArray(); ?>
                        <article class="col-12 col-md-6 tm-post">
                            <hr class="tm-hr-primary">
                            <a href="<?= $this->Url->build('/posts/view/' . $post['id']); ?>" class="effect-lily tm-post-link tm-pt-60">
                                <div class="tm-post-link-inner">
                                    <?php if (!empty($post['images'])) : ?>
                                        <?php foreach ($post['images'] as $image) : ?>
                                            <img src="<?=  $image['path']; ?>" alt="Image" class="img-fluid">
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <img src="<?= $this->Url->build('/img/img-01.jpg'); ?>" alt="Image" class="img-fluid">
                                    <?php endif; ?>
                                </div>
                                <h2 class="tm-pt-30 tm-color-primary tm-post-title"><?= h($post['title']); ?></h2>
                            </a>

                        </article>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No posts found.</p>
                <?php endif; ?>
            </div>
            <footer class="row tm-row">
                <!-- Footer content here -->
            </footer>
        </main>
    </div>
    <script src="<?= $this->Url->build('/js/jquery.min.js'); ?>"></script>
    <script src="<?= $this->Url->build('/js/templatemo-script.js'); ?>"></script>
</body>

</html>
