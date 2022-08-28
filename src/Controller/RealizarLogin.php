<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\Persistence\ObjectRepository;

class RealizarLogin implements InterfaceControladorRequisicao
{
    /** @var ObjectRepository */
    private $repositorioDeUsuarios;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeUsuarios = $entityManager->getRepository(Usuario::class);
    }
    
    public function processaRequisicao(): void
    {
        $email = filter_input(
            INPUT_POST, 
            'email', 
            FILTER_VALIDATE_EMAIL
        );
        
        if ($email === null || $email === false) {
            echo "O e-mail não é um e-mail válido.";
            return;
        }
        
        $senha = filter_input(
            INPUT_POST, 
            'senha', 
            FILTER_SANITIZE_STRING
        );

        /** @var Usuario $usuário */
        $usuario = $this->repositorioDeUsuarios
            ->findOneBy(['email' => $email]);

        if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            echo "E-mail ou senha inválidos.";
            return;
        }

        header('Location: /listar-cursos');
    }
}
