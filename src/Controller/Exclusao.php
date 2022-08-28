<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;

class Exclusao implements InterfaceControladorRequisicao
{
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
            $_SESSION['tipoMensagem'] = 'danger';
            $_SESSION['mensagem'] = "Curso inexistente.";

            header('Location: /listar-cursos');
            return; // Sem este return, o resto do código continua sendo executado.
        }

        $curso = $this->entityManager->getReference(
            Curso::class, 
            $id
        );
        $this->entityManager->remove($curso);
        $this->entityManager->flush();

        $_SESSION['tipoMensagem'] = 'success';
        $_SESSION['mensagem'] = "Curso excluído com sucesso.";

        header('Location: /listar-cursos');
    }
}
