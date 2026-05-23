<?php include __DIR__ . '/../header.php'; ?>

    <h1><?= htmlspecialchars($article->getName()) ?></h1>

    <?php if (isset($author) && $author !== null): ?>
        <p><strong>Автор:</strong> <?= htmlspecialchars($author->getNickname()) ?></p>
    <?php endif; ?>

    <p><?= htmlspecialchars($article->getText()) ?></p>

<?php include __DIR__ . '/../footer.php'; ?>
