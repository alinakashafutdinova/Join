<?php include __DIR__ . '/../header.php'; ?>

<div class="page-hero">
    <span class="eyebrow">Лента публикаций</span>
    <h1>Мой блог</h1>
    <p>Площадка для заметок и публикаций. Здесь собраны размышления, гайды и просто интересные тексты.</p>
</div>

<?php if (!empty($articles)): ?>
    <div class="article-list">
        <?php foreach ($articles as $article): ?>
            <article class="article-card">
                <h2>
                    <a href="/articles/<?= $article->getId() ?>">
                        <?= htmlspecialchars($article->getName()) ?>
                    </a>
                </h2>
                <p><?= htmlspecialchars($article->getExcerpt(180)) ?></p>
                <div class="meta">
                    <span>📅 <?= htmlspecialchars(date('d.m.Y', strtotime($article->getCreatedAt()))) ?></span>
                    <a href="/articles/<?= $article->getId() ?>" class="read-more">Читать дальше →</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="error-page">
        <h1>Пока пусто</h1>
        <p>В блоге ещё нет ни одной публикации.</p>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../footer.php'; ?>
