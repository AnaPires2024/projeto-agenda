<?php

session_start();

include_once("connection.php");
include_once("url.php");

$data = $_POST;

//MODIFICAÇÃO NO BANCO
if (!empty($data)) {

    //criar contato
    if ($data["type"] === "create") {

        $name = $data["name"];
        $email = $data["email"];
        $tipo = $data["tipo"];
        $numero = $data["numero"];
        $ddd = $data["ddd"];

        //Iniciar a transação
        $conn->beginTransaction();

        $query = "INSERT INTO tb_contatos(name, email) VALUES (:name, :email)";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        //Pegando o Id do ultimo dado inserido 
        $idContato = $conn->lastInsertId();

        $query = "INSERT INTO tb_telefone(TIPO, NUMERO, DDD, CONTATO_ID) VALUES (:tipo, :numero, :ddd, :idcontato)";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(":tipo", $tipo);
        $stmt->bindParam(":numero", $numero);
        $stmt->bindParam(":ddd", $ddd);
        $stmt->bindParam(":idcontato", $idContato);
        $stmt->execute();

        $conn->commit();

        try {
            //Redireciona para tela Home
            $_SESSION["msg"] = "Contato criado com sucesso!";
            header("Location:" . $BASE_URL . "../home.php");
        } catch (PDOException $e) {
            //erro na conexão
            $error = $e->getMessage();
            echo "erro: $error";
        }
    } else if ($data["type"] === "delete") {

        //Deletar contato

        $id = $data["id"];

        $query = "DELETE FROM tb_telefone WHERE CONTATO_ID = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $query = "DELETE FROM tb_contatos WHERE ID = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);

        try {
            $stmt->execute();
            header("Location:" . $BASE_URL . "../home.php");
            $_SESSION["msg"] = "Contato Removido com sucesso!";
        } catch (PDOException $e) {
            //erro na conexão
            $error = $e->getMessage();
            echo "erro: $error";
        }
    } else if ($data["type"] === "atualizar") {

        //Atualizar contato

        $name =  $data["name"];
        $email = $data["email"];
        $tipo =  $data["tipo"];
        $ddd =   $data["ddd"];
        $numero = $data["numero"];
        $id = $data["id"];

        $query = "UPDATE tb_contatos 
                    SET NAME = :name, EMAIL = :email
                    WHERE ID = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $query = "UPDATE tb_telefone 
                    SET TIPO = :tipo, NUMERO = :numero, DDD = :ddd
                    WHERE CONTATO_ID = :contatoId";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":tipo", $tipo);
        $stmt->bindParam(":ddd", $ddd);
        $stmt->bindParam(":numero", $numero);
        $stmt->bindParam(":contatoId", $id);

        try {
            $stmt->execute();
            header("Location:" . $BASE_URL . "../home.php");
            $_SESSION["msg"] = "Contato Atualizado com sucesso!";
        } catch (PDOException $e) {
            //erro na conexão
            $error = $e->getMessage();
            echo "erro: $error";
        }

    } else if ($data["type"] === "login") {                                             

        $email = $data["email"];
        $senha = $data["senha"];

        $query = "SELECT * FROM tb_usuario 
                     WHERE EMAIL = :email AND SENHA = :senha";


        $stmt = $conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);

        try {
            $stmt->execute();
            $user = $stmt->fetch();

            if ($user != null) {
                header("Location:" . $BASE_URL . "../home.php");
            } else {
                header("Location:" . $BASE_URL . "../index.php");
                $_SESSION["msg"] = "Email ou senha inválida!";
            }
        } catch (PDOException $e) {
            //erro na conexão
            $error = $e->getMessage();
            echo "erro: $error";
        }

    } else if ($data["type"] === "criar_conta") {

        $name = $data["name"];
        $email = $data["email"];
        $senha = $data["senha"];

        $query = "INSERT INTO tb_usuario(NAME, EMAIL, SENHA) VALUES (:name, :email, :senha)";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);
    
        try {
            $stmt->execute();
            header("Location:" . $BASE_URL . "../index.php");
            $_SESSION["msg"] = "Conta criada com sucesso!";

        } catch (PDOException $e) {
            //erro na conexão
            $error = $e->getMessage();
            echo "erro: $error";
        }
    }
} else {
    //SELEÇÃO DE DADOS
    $id;

    if (!empty($_GET)) {
        $id = $_GET["id"];
    }

    //RETORNA OS DADOS DE UM CONTATO
    if (!empty($id)) {

        $query = "SELECT c.NAME, c.EMAIL, t.TIPO, t.NUMERO, t.DDD FROM tb_contatos c
                      INNER JOIN tb_telefone t 
                      on t.CONTATO_ID = c.ID 
                      WHERE c.ID = :id ";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $contact = $stmt->fetch();
    } else {

        //RETORNA DADOS DE TODOS OS CONTATOS
        $contacts = [];
        $query = "SELECT * FROM tb_contatos";

        $stmt = $conn->prepare($query);
        $stmt->execute();

        $contacts = $stmt->fetchAll();
    }
}

//FECHAR CONEXÃO 
$conn = null;
