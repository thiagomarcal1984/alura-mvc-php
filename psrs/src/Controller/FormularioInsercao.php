<?php

namespace Alura\Cursos\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;


class FormularioInsercao implements InterfaceControladorRequisicao
{
    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        $html = "Teste";
        return new Response(200, [], $html); // Parâmetros: statusCode, headers, body.
    }
}
