<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php if (isset($_SESSION['logado'])) : ?>
<nav class="navbar navbar-dark bg-dark mb-2">
    <a class="navbar-brand" href="/listar-cursos">Home</a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link active" href="/logout">Sair</a>
        </li>
    </ul>
</nav>
<?php endif; ?>
<div class="container">
    <div class="jumbotron">
        <h1><?= $titulo?></h1>
    </div>
    <?php if (isset($_SESSION['mensagem'])) : ?>
    <div class="alert alert-<?= $_SESSION['tipoMensagem']; ?>">
        <?= $_SESSION['mensagem']; ?>
    </div>
    <?php 
        // O código a seguir evita que as mensagens de alerta se repitam ao 
        // atualizar uma página que já recebeu alguma mensagem.
        unset($_SESSION['tipoMensagem']);
        unset($_SESSION['mensagem']);
        endif; 
    ?>
