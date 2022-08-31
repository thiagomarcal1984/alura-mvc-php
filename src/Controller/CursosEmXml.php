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
use SimpleXMLElement;

// class CursosEmJson implements RequestHandlerInterface
class CursosEmXml implements InterfaceControladorRequisicao
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
        $cursosEmXml = new SimpleXMLElement('<cursos/>');
        /** @var Curso[] $cursos */
        foreach ($cursos as $curso) {
            $cursoEmXml = $cursosEmXml->addChild('curso');
            $cursoEmXml->addChild('id', $curso->getId());
            $cursoEmXml->addChild('descricao', $curso->getDescricao());
        }

        echo $cursosEmXml->asXML();
    }
    
    // public function handle(ServerRequestInterface $request): ResponseInterface
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $cursos = $this->repositorioDeCursos->findAll();
        ob_start();
        $this->processaRequisicao();
        $cursosEmXml = ob_get_clean();

        return new Response(200, [], $cursosEmXml);
    }
}
