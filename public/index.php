<?php
$caminho = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : $_SERVER['REQUEST_URI'];

switch ($caminho) {
    case '/listar-cursos':
        require 'listar-cursos.php';
        break;
        
    case '/novo-curso':
        require 'formulario-novo-curso.php';
        break;
        
    default:
        echo "Erro 404.";
        break;
}
