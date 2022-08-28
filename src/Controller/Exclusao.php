<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;

class Exclusao implements InterfaceControladorRequisicao
{
    use FlashMessageTrait;
    
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id === null || $id === false) {

            $this->defineMensagem("danger", "Curso inexistente.");

            header('Location: /listar-cursos');
            return; // Sem este return, o resto do código continua sendo executado.
        }

        $curso = $this->entityManager->getReference(
            Curso::class, 
            $id
        );
        $this->entityManager->remove($curso);
        $this->entityManager->flush();

        $this->defineMensagem("success", "Curso excluído com sucesso.");

        header('Location: /listar-cursos');
    }
}
