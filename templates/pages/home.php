<?php
    require_once _ROOTPATH_ . '/templates/head.php';
?>
<body>
<main class="p-4">

    <section class="row d-flex container justify-content-center mx-auto">
        <div class="m-5 p-4 container-fluid d-flex justify-content-center">
            <div class="container-fluid text-center">
                <h1 class="my-2" id="titreHome">Mon excuse de dev</h1>
                <div id="excuseDisplay" class="p-3 my-2 border rounded text-dark">
                    Cliquez sur le bouton pour générer une excuse.
                </div>
                <div id="loader" class="text-center mt-2">
                    <div class="spinner-border text-primary" role="status" aria-hidden="true"></div>
                    <p>Chargement de l'excuse...</p>
                </div>
                <div>
                    <button class="btn btn-primary my-2" type="button" name="excuses" id="excuses" aria-label="Générer une nouvelle excuse">
                        Générer une nouvelle excuse
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="row d-flex container justify-content-center mx-auto">
        <!-- Bouton ouverture modale -->
         <div class="container-fluid text-center">
            <button type="button" class="btn btn-primary my-2" id="modal" data-bs-toggle="modal" data-bs-target="#excuseModal">
            Ajouter une nouvelle excuse de dev
            </button>

            <!-- Modale -->
            <div class="modal fade" id="excuseModal" tabindex="-1" aria-labelledby="excuseModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="excuseModalLabel">Créez votre excuse</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addExcusesForm" class="m-5 p-4">
                                <div class="mb-3 text-center">
                                    <label for="http_code" class="form-label">http_code</label>
                                        <input type="number" id="http_code" name="http_code" min="001" max="999"
                                            class="form-control <?php echo(isset($error['http_code']) ? 'is-invalid' : '') ?>"
                                            required>
                                        <?php if (isset($error['http_code'])) {?>
                                            <div class="invalid-feedback"><?php echo $error['http_code'] ?></div>
                                        <?php }?>
                                </div>
                                <div class="mb-3 text-center">
                                    <label for="tag" class="form-label">tag</label>
                                        <input type="text" id="tag" name="tag" max="30"
                                            class="form-control <?php echo(isset($error['tag']) ? 'is-invalid' : '') ?>"
                                            required>
                                        <?php if (isset($error['tag'])) {?>
                                            <div class="invalid-feedback"><?php echo $error['tag'] ?></div>
                                        <?php }?>
                                </div>
                                <div class="mb-3 text-center">
                                    <label for="message" class="form-label">message</label>
                                        <input type="text" id="message" name="message" max="50"
                                            class="form-control <?php echo(isset($error['message']) ? 'is-invalid' : '') ?>"
                                            required>
                                        <?php if (isset($error['message'])) {?>
                                            <div class="invalid-feedback"><?php echo $error['message'] ?></div>
                                        <?php }?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" id="saveExcuse" class="btn btn-primary">Sauvegarder l'excuse</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
    require_once _ROOTPATH_ . '/templates/footer.php';
?>