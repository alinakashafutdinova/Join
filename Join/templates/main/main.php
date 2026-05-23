<?php include __DIR__ . '/../header.php'; ?>

    <?php if (!empty($articles)): ?>
        <?php foreach ($articles as $article): ?>
            <h2>
                <a href="/articles/<?= $article->getId() ?>">
                    <?= htmlspecialchars($article->getName()) ?>
                </a>
            </h2>
            <p><?= htmlspecialchars($article->getText()) ?></p>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Пока нет ни одной статьи.</p>
    <?php endif; ?>

<?php include __DIR__ . '/../footer.php'; ?>
