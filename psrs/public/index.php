<?php

require __DIR__ . '/../vendor/autoload.php';

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Http\Server\RequestHandlerInterface;

$caminho = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : $_SERVER['REQUEST_URI'];

$rotas = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($caminho, $rotas)) {
    http_response_code(404);
    exit();
}

session_start(); // Grava/recupera o cookie PHPSESSID e inicia a sessão.

// $ehRotaDeLogin = stripos($caminho, 'login');
// if (!isset($_SESSION['logado']) && $ehRotaDeLogin === false) {
//     header('Location: /login');
//     exit();
// }

// Fábrica de Mensagens HTTP.
$psr17Factory = new Psr17Factory();

// Objeto para que o servidor faça requisições Web.
$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);


// Método para criar a requisição a partir das variáveis superglobais do PHP.
$request = $creator->fromGlobals();

$classeControladora = $rotas[$caminho];
/** @var RequestHandlerInterface $controlador */
$controlador = new $classeControladora();
$resposta = $controlador->handle($request);

// O código abaixo, extraído de MessageInterface da implementação da PSR17,
// serve para enviar todos os cabeçalhos que estão na resposta HTTP.
foreach ($resposta->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value));
    }
}

// Imprime o corpo da resposta HTTP.
echo $resposta->getBody();
