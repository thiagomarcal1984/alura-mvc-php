<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

// class CursosEmJson implements RequestHandlerInterface
class CursosEmJson implements InterfaceControladorRequisicao
{
    /** @var ObjectRepository */
    private $repositorioDeCursos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeCursos = $entityManager
            ->getRepository(Curso::class);
    }

    // public function __construct(EntityManagerInterface $entityManager)
    // {
    //     $this->repositorioDeCursos = $entityManager
    //         ->getRepository(Curso::class);
    // }

    public function processaRequisicao(): void
    {
        $cursos = $this->repositorioDeCursos->findAll();
        echo json_encode($cursos);
    }
    
    // public function handle(ServerRequestInterface $request): ResponseInterface
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $cursos = $this->repositorioDeCursos->findAll();
        return new Response(200, [], json_encode($cursos));
    }
}
