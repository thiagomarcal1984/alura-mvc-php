<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioEdicao implements RequestHandlerInterface
{
    use FlashMessageTrait;
    use RenderizadorDeHtmlTrait;

    /** @var EntityRepository */
    private $repositorioCursos;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioCursos = $entityManager
            ->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );

        $resposta =  new Response(302, ['Location: /listar-cursos']);
        if ($id === null || $id === false) {
            $this->defineMensagem("danger", "Curso inexistente.");
            return $resposta;
        }

        $curso = $this->repositorioCursos->find($id);

        $html = $this->renderizaHtml('cursos/formulario.php', ["titulo" => "Alterar título do curso " . $curso->getId(), "curso" => $curso]);

        return new Response(200, [], $html);
    }
}
