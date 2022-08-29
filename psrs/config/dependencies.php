<?php

use Alura\Cursos\Infra\EntityManagerCreator;
use DI\ContainerBuilder;
use Doctrine\ORM\EntityManagerInterface;

$containerBuilder = new ContainerBuilder();

// As definições acrescentadas no $containerBuilder se compõem de um array
// associativo que tem como chaves as classes, e como valor as funções de 
// criação do objeto que será injetado.
$containerBuilder->addDefinitions([
    EntityManagerInterface::class => function () {
        return (new EntityManagerCreator())->getEntityManager();
    },
]);

// Este método constrói o container, após as definições acima serem feitas.
return $containerBuilder->build();
