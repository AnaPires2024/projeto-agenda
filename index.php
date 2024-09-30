<?php
include_once("config/url.php");
include_once("config/process.php");

if (isset($_SESSION['msg'])) {
    $printMsg = $_SESSION['msg'];
    $_SESSION['msg'] = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/styles.css">
    <title>Formulario de login</title>
</head>

<body id="bg-login" class="d-flex align-items-center py-4">

    <main class="w-100 m-auto form-container">

        <?php if (isset($printMsg) && $printMsg != ''): ?>
            <p id="msg" class="bg bg-warning"><?= $printMsg ?></p>
        <?php endif; ?></br>

        <form action="<?= $BASE_URL ?>config/process.php" method="post">
            <input type="hidden" name="type" value="login">
            <img src="./img/logo.svg" alt="Minha agenda" class="mb-4" height="57" width="72" />
            <h1 class="h3 mb-3 fw-normal">Agenda de Contatos</h1>
            <div class="form-floating">
                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="email" required />
                <label for="floatingInput">E-mail</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="senha" id="floatingInput" placeholder="senha" required />
                <label for="floatingInput">Senha</label>
            </div>
            <div class="text-start my-3 text-white">
                <a href="./formLogin.php">
                    cadastra-se
                </a>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2">Logar</button>

        </form>
    </main>

</body>

</html>