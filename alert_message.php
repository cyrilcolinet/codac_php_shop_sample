<?php if (isset($_GET['userAdded'])) { ?>
    <div class="alert alert-<?= $_GET['userAdded'] ? "success" : "danger" ?> mt-3" role="alert">
        <?= $_GET['userAdded']
            ? "Utilisateur ajouté avec succès."
            : "Cet utilisateur existe déjà avec cet email !";
        ?>
    </div>
<?php } ?>

<?php if (isset($_GET['userDeleted'])) { ?>
    <div class="alert alert-<?= $_GET['userDeleted'] ? "success" : "danger" ?> mt-3" role="alert">
        <?= $_GET['userDeleted']
            ? "Utilisateur supprimé avec succès."
            : "Cet utilisateur n'existe pas...";
        ?>
    </div>
<?php } ?>

<?php if (isset($_GET['userEdited'])) { ?>
    <div class="alert alert-<?= $_GET['userEdited'] ? "success" : "danger" ?> mt-3" role="alert">
        <?= $_GET['userEdited']
            ? "Utilisateur modifié avec succès."
            : "Cet utilisateur n'existe pas...";
        ?>
    </div>
<?php } ?>
