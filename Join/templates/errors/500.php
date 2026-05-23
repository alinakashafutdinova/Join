<?php include __DIR__ . '/../header.php'; ?>

    <h1>Хьюстон, у нас проблема!</h1>
    <p><?= htmlspecialchars($error ?? '') ?></p>

<?php include __DIR__ . '/../footer.php'; ?>
