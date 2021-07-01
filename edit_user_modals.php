<?php foreach (User::getAll() as $user) { ?>
    <div class="modal fade" id="editUserModal<?= $user->id; ?>" tabindex="-1" aria-labelledby="editUserModalFade<?= $user->id; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="php/action/edit_user.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editer un utilisateur - <?= $user->email; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" required value="<?= $user->firstName ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" required value="<?= $user->lastName ?>">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required value="<?= $user->email ?>">
                            <div id="emailHelp" class="form-text">L'adresse doit être unique.</div>
                        </div>
                        <input type="text" name="id" hidden value="<?= $user->id ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button name="submit" type="submit" class="btn btn-primary">Enregister</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
