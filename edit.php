<?php
    include_once("templates/header.php");
?>
<div class="container" id="base-container">
    <?php include_once("templates/btn-voltar.html") ?>
    <h1 id="main-title">Editar contato</h1>
    <form action="<?= $BASE_URL ?>config/process.php" method="POST">
        <input type="hidden" name="type" value="atualizar">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <div class="form-group">
            <label class="form-name" for="name">Nome do contato:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Digite um nome" value="<?= $contact["NAME"] ?> " requerid>
        </div><br />
        <div class="form-group">
            <label class="form-name" for="email">Email do contato:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" value="<?= $contact["EMAIL"] ?> " required>
        </div><br />

        <h5>Telefone</h5>
        <div class="form-group">
            <label class="form-name" for="tipo">Tipo: </label>
            <input type="text" class="form-control" id="tipo" name="tipo" width="10px" placeholder="Tipo de Telefone" value="<?= $contact["TIPO"] ?> " required>
        </div><br />
        <div class="form-group">
            <label class="form-name" for="ddd">DDD: </label>
            <input type="text" class="form-control" id="ddd" name="ddd" placeholder="Tipo de Telefone" value="<?= $contact["DDD"] ?> " required>
        </div><br />
        <div class="form-group">
            <label class="form-name" for="numero">Numero: </label>
            <input type="text" class="form-control" id="numero" name="numero" placeholder="Tipo de Telefone" value="<?= $contact["NUMERO"] ?> " required>
        </div><br />
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>
<?php
    include_once("templates/footer.php");
?>