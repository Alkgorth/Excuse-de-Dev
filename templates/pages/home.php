<?php

    require_once _ROOTPATH_ . '/templates/head.php';

?>
<body>
<main class="p-4">
    <section>
        <h2>Page home</h2>
    </section>

    <section class="row d-flex container justify-content-center">

        <form class="m-5 p-4" action="">
            <div class="row-col-1 container-fluid text-center">
                <h1 class="my-2">Mon excuse de dev</h1>
        
                <input class="my-2" type="text" readonly value="Test texte">

                <div>
                    <button class="btn btn-primary my-2" type="button" name="excuses">Générer une nouvelle phrase</button>
                </div>
            </div>

        </form>
        
    </section>
</main>

<?php

    require_once _ROOTPATH_ . '/templates/footer.php';

?>