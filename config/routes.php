<?php

// Imports agrupados.
use Alura\Cursos\Controller\{
    Exclusao,
    FormularioEdicao,
    FormularioInsercao,
    FormularioLogin,
    ListarCursos,
    Persistencia
};

return [
    '/listar-cursos' => ListarCursos::class,
    '/novo-curso' => FormularioInsercao::class,
    '/salvar-curso' => Persistencia::class,
    '/alterar-curso' => FormularioEdicao::class,
    '/excluir-curso' => Exclusao::class,
    '/login' => FormularioLogin::class,
];
