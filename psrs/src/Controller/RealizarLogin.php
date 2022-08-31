<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\Persistence\ObjectRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RealizarLogin implements RequestHandlerInterface
{
    use FlashMessageTrait;

    /** @var ObjectRepository */
    private $repositorioDeUsuarios;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeUsuarios = $entityManager->getRepository(Usuario::class);
    }
    
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $email = filter_input(
            INPUT_POST, 
            'email', 
            FILTER_VALIDATE_EMAIL
        );
        
        if ($email === null || $email === false) {
            $this->defineMensagem(
                "danger", 
                "O e-mail digitado não é um e-mail válido."
            );
            return new Response(302, ['Location' => 'login']);
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
            $this->defineMensagem("danger", "E-mail ou senha inválidos.");
            return new Response(302, ['Location' => 'login']);
        }
        $_SESSION['logado'] = true;

        return new Response(302, ['Location' => 'listar-cursos']);
    }
}
