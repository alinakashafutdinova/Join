<?php include __DIR__ . '/../header.php'; ?>

<article class="article-page">
    <a href="/" class="back-link">← К списку статей</a>
    <h1><?= htmlspecialchars($article->getName()) ?></h1>

    <div class="byline">
        <?php if (isset($author) && $author !== null): ?>
            <span class="avatar"><?= htmlspecialchars(mb_strtoupper(mb_substr($author->getNickname(), 0, 1))) ?></span>
            <div class="byline-info">
                <b><?= htmlspecialchars($author->getNickname()) ?></b>
                <span><?= htmlspecialchars(date('d.m.Y', strtotime($article->getCreatedAt()))) ?></span>
            </div>
        <?php else: ?>
            <div class="byline-info">
                <b>Опубликовано</b>
                <span><?= htmlspecialchars(date('d.m.Y', strtotime($article->getCreatedAt()))) ?></span>
            </div>
        <?php endif; ?>
    </div>

    <div class="article-body">
        <?php foreach (preg_split('/\n+/', $article->getText()) as $paragraph): ?>
            <?php if (trim($paragraph) !== ''): ?>
                <p><?= htmlspecialchars(trim($paragraph)) ?></p>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</article>

<?php include __DIR__ . '/../footer.php'; ?>
