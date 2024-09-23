<?php
    include_once("templates/header.php");
?>
<div class="container" id="base-container">
    <?php include_once("templates/btn-voltar.html") ?>
    <h1 id="main-title">Editar contato</h1>

    <form action="<?= $BASE_URL ?>config/process.php" method="POST">

        <input type="hidden" name="type" value="atualizar">
        <input type="hidden" name="id" value="<?= $contact["ID"] ?>">

        <div class="form-group">
            <label class="form-name" for="name">Nome do contato:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Digite um nome" value="<?= $contact['NAME'] ?>" required>
        </div><br/>
        <div class="form-group">
            <label class="form-name" for="email">Email do contato:</label>
            <input type="text" class="form-control" id="email" name="email" value="<?= $contact['EMAIL'] ?>" placeholder="Digite seu e-mail" required>
        </div><br/>

        <h5>Telefone</h5>
        <div class="form-group">
            <label class="form-name" for="tipo">Tipo: </label>
            <input type="text" class="form-control" id="tipo" name="tipo" width="10px" value="<?= $contact['TIPO'] ?>" placeholder="Tipo de Telefone" required>
        </div><br/>

        <div class="form-group">
            <label class="form-name" for="ddd">DDD: </label>
            <input type="text" class="form-control" id="ddd" name="ddd" value="<?= $contact['DDD'] ?>" placeholder="Tipo de Telefone" required>
        </div><br/>

        <div class="form-group">
            <label class="form-name" for="numero">Numero: </label>
            <input type="text" class="form-control" id="numero" name="numero" value="<?= $contact['NUMERO'] ?>" placeholder="Tipo de Telefone" required>
        </div><br/>

        <button type="submit" class="btn btn-primary">
            Atualizar
        </button>
    </form>
</div>
<?php
    include_once("templates/footer.php");
?>