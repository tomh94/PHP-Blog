<?php

include '../static/posts.php';

/**
 * Vypiš všechny příspěvky
 *
 * @param array $posts musí být ve správné struktuře v posts.php
 * @return void vygeneruje html
 */
function displayPosts($posts)
{
    if (empty($posts)) {
        echo '<p class="text-center text-muted">Žádné příspěvky k zobrazení.</p>';
        return;
    }

    echo '<div class="container mt-4">';
    echo '<div class="row">';

    foreach ($posts as $post) {
        ?>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="<?= ($post['image']); ?>"
                     class="card-img-top"
                     alt="<?= htmlspecialchars($post['title']); ?>">

                <div class="card-body d-flex flex-column">
                    <span class="badge bg-primary mb-2 align-self-start">
                        <?= htmlspecialchars($post['category']); ?>
                    </span>

                    <h5 class="card-title">
                        <?= htmlspecialchars($post['title']); ?>
                    </h5>

                    <p class="card-text text-muted small">
                        <i class="bi bi-person"></i> <?= htmlspecialchars($post['author']); ?> |
                        <i class="bi bi-calendar"></i> <?= date('d.m.Y', strtotime($post['date'])); ?>
                    </p>

                    <p class="card-text">
                        <?= htmlspecialchars(substr($post['content'], 0, 150)) . '...'; ?>
                    </p>

                    <a href="../pages/detail.php?id=<?= $post['id']; ?>"
                       class="btn btn-outline-primary mt-auto">
                        Číst více
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
    echo '</div>';
    echo '</div>';
}

/**
 * Vypíše jeden post
 *
 * @param array $posts celá array všech příspěvků
 * @param int $id ID příspěvku který vypíše
 *
 * @return void
 */
function displayPost($posts, $id)
{
    $post = null;
    foreach ($posts as $p) {
        if ($p['id'] == $id) {
            $post = $p;
            break;
        }
    }
    if (!$post) {
        echo '<p>Příspěvek nenalezen.</p>';
        exit;
    }
    ?>

    <article style="max-width: 800px; margin: 40px auto; padding: 20px;">
    <span style="display: inline-block; background: #007bff; color: white; padding: 5px 15px; border-radius: 4px; margin-bottom: 15px;">
        <?=htmlspecialchars($post['category']); ?>
    </span>

        <h1><?=htmlspecialchars($post['title']); ?></h1>

        <p style="color: #666; margin-bottom: 20px;">
            <strong>Autor:</strong> <?= htmlspecialchars($post['author']); ?> |
            <strong>Datum:</strong> <?=date('d.m.Y', strtotime($post['date'])); ?>
        </p>

        <img src="<?= htmlspecialchars($post['image']); ?>"
             style="width: 100%; height: auto; border-radius: 8px; margin-bottom: 20px;"
             alt="<?=htmlspecialchars($post['title']); ?>">

        <div style="line-height: 1.6; font-size: 18px;">
            <?=nl2br(htmlspecialchars($post['content'])); ?>
        </div>

        <a href="../pages/index.php"
           style="display: inline-block; margin-top: 30px; padding: 10px 20px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px;">
            ← Zpět na blog
        </a>
    </article>
    <?php
}