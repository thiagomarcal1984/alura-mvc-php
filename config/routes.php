<?php

// Imports agrupados.
use Alura\Cursos\Controller\{
    CursosEmJson,
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
    '/novo-curso' => FormularioInsercao::class,
    '/salvar-curso' => Persistencia::class,
    '/alterar-curso' => FormularioEdicao::class,
    '/excluir-curso' => Exclusao::class,
    '/login' => FormularioLogin::class,
    '/realiza-login' => RealizarLogin::class,
    '/logout' => Deslogar::class,
    '/buscarCursosEmJson' => CursosEmJson::class,
];
