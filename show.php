<?php
    include_once("templates/header.php");
?>

<div class="container" id="base-container">
    <?php include_once("templates/btn-voltar.html") ?>
    <h1 id="main-title">Contato</h1>

    <label class="bold">Nome:</label>
    <?= $contact["NAME"] ?><br/>
    <label class="bold">E-MAIL:</label>
    <?= $contact["EMAIL"] ?>

    <div>
        <h5>Telefones:</h5>
        <div class="lista-contato">
            <label class="bold"> Tipo: </label>
            <?= $contact["TIPO"] ?><br />

            <label class="bold"> DDD: </label>
            <?= $contact["DDD"] ?><br />

            <label class="bold"> Numero: </label>
            <?= $contact["NUMERO"] ?><br />
        </div>
    </div>
</div>

<?php
    include_once("templates/footer.php");
?>