<?php

// Imports agrupados.

use Alura\Cursos\Controller\{Exclusao, FormularioInsercao, ListarCursos};

return [
    '/novo-curso' => FormularioInsercao::class,
    '/excluir-curso' => Exclusao::class,
];
