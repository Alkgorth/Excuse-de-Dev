<?php
    require_once _ROOTPATH_ . '/templates/head.php';
?>

<div class="container text-center mt-5 mx-auto">
    <h1>Erreur HTTP <?= htmlspecialchars($code) ?></h1>
    <?php if ($excuse){ ?>
        <p class="lead"><?= htmlspecialchars($excuse['message']) ?></p>
        <p class="text-muted">Tag : <?= htmlspecialchars($excuse['tag']) ?></p>
    <?php } else { ?>
        <p class="lead">Aucune excuse trouvée pour ce code</p>
    <?php } ?>
    <a href="index.php" class="btn btn-secondary mt-3">Retour</a>
</div>

<?php
require_once _ROOTPATH_ . '/templates/footer.php';
?>