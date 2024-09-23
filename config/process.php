<?php

session_start();

include_once("connection.php");
include_once("url.php");

$data = $_POST;

//MODIFICAÇÃO NO BANCO
if (!empty($data)) {

        if($data["type"] === "create") {

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
        } else if($data["type"] === "delete"){

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

        }  else if($data["type"] === "update"){
        
            $id = $data["id"];
            $name = $data["name"];
            $email = $data["email"];
          
            $query = "UPDATE tb_contatos SET NAME = :name, EMAIL = :email
                      WHERE ID = :id";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":id", $id);

            try {
                $stmt->execute();
               // header("Location:" . $BASE_URL . "../home.php");
                $_SESSION["msg"] = "Contato Atualizado com sucesso!";

            } catch (PDOException $e) {
                //erro na conexão
                $error = $e->getMessage();
                echo "erro: $error";
            }
        }
    
    //SELEÇÃO DE DADOS
    } else {

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
