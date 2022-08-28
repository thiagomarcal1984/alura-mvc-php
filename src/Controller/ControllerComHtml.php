<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Controller\InterfaceControladorRequisicao;


abstract class ControllerComHtml
{
    public function renderizaHtml(string $caminhoTemplate, array $dados): string
    {
        // A função extract declara variáveis e as nomea com índices do array.
        extract($dados); 

        ob_start();
        require __DIR__ . '/../../view/' . $caminhoTemplate;
        $html = ob_get_clean();

        return $html;
    }
}
