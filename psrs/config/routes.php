<?php

// Imports agrupados.
use Alura\Cursos\Controller\{
    Deslogar,
    Exclusao,
    FormularioEdicao,
    FormularioInsercao,
    FormularioLogin,
    ListarCursos,
    Persistencia,
    RealizarLogin
};

return [
    '/listar-cursos' => ListarCursos::class,
    '/salvar-curso' => Persistencia ::class,
    '/alterar-curso' => FormularioEdicao::class,
    '/login' => FormularioLogin::class,
    '/realiza-login' => RealizarLogin::class,
    '/logout' => Deslogar::class,
    '/novo-curso' => FormularioInsercao::class,
    '/excluir-curso' => Exclusao::class,
];
