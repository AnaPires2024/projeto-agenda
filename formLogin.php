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
    <link href="css/styles.css" rel="stylesheet">
    <title>Formulario de login</title>
</head>

<body class="d-flex align-items-center py-4 bg-info">
    <main class="w-100 m-auto form-container">
        <form action="<?= $BASE_URL ?>config/process.php" method="POST">
            <input type="hidden" name="type" value="criar_conta">
            <h1 class="h3 mb-3 fw-normal text-center">Criar Conta</h1>
            <div class="form-floating">
                <input type="name" class="form-control" id="floatingInput" name="name" placeholder="name" required />
                <label for="floatingInput">Nome:</label>
            </div>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="email" required />
                <label for="floatingInput">E-mail:</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="floatingInput" name="senha" placeholder="senha" required />
                <label for="floatingInput">Senha:</label>
            </div>

            <div class="d-flex">
                <button type="submit" class="btn btn-primary w-50 mr-3 btn-form">
                    Salvar
                </button>
                <button type="button" class="btn btn-secondary w-50" onclick="location.href='index.php'">
                    Voltar
                </button>
            </div>
        </form>
    </main>
</body>

</html