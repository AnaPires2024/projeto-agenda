<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <title>Formulario de login</title>

</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="w-100 m-auto form-container">
        <form action="<?= $BASE_URL ?>config/process.php" method="GET">
            <img src="./img/logo.svg" alt="Minha agenda" class="mb-4" height="57" width="72" />
            <h1 class="h3 mb-3 fw-normal">Minha agenda</h1>
            <div class="form-floating">
                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="email" />
                <label for="floatingInput">E-mail</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="senha"  id="floatingInput" placeholder="senha" />
                <label for="floatingInput">Senha</label>
            </div>
            <div class="text-start my-3">
                <a href="./formLogin.php">
                    cadastra-se
                </a>
            </div>
            <button class="btn btn-primary w-100 py-2">Logar</button>
        </form>
    </main>
</body>

</html>