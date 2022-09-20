<?php

    $mensagem = "Preencha os dados do formulario";
    $nome = "";
    $email = "";
    $senha = "";

    if (isset($_POST["nome"], $_POST["email"], $_POST["senha"])) {
        $conexao = new PDO("mysql:host=localhost;dbname=formulario", "root", "aluno.ifal");

        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);

        if(!$nome || !$email || !$senha) {
            $mensagem = "Dados invalidos";
        } else {
            $stm = $conexao->prepare('INSERT INTO cadastro (nome, email, senha) VALUES (:nome,:email,:senha)');
            $stm->bindParam('nome', $nome);
            $stm->bindParam('email', $email);
            $stm->bindParam('senha', $senha);
            $stm->execute();

            $mensagem = "Mensagem enviada com sucesso";
        }
    }

?>



<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario</title>
        <link href="form.css" rel="stylesheet">
    </head>
    <body>
        <div class="form_cd">
            <h2>Cadastrar Cliente</h2>
            <form method="post">
                <div><input type="text" name="nome" placeholder="Nome"></div>
                <div><input type="text" name="email" placeholder="E-mail"></div>
                <div><input type="password" name="senha" placeholder="Senha"></div>
                <div><input type="submit" name="cadastrar" value="Cadastrar"></div>
                <div><input type="hidden" name="form" value="f_form"></div>
            </form>
            <div class="mensagem">
                <?=$mensagem?>
            </div>
        </div>
    </body>
</html>