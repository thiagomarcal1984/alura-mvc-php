<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class Persistencia implements InterfaceControladorRequisicao
{
    /** @var Doctrine\ORM\EntityManagerInterface */
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())
            ->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        $descricao = filter_input(
            INPUT_POST, 
            'descricao',
            FILTER_SANITIZE_STRING
        );

        $curso = new Curso();
        $curso->setDescricao($descricao);

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (!is_null($id) && $id !== false) {
            $curso->setId($id);
            $this->entityManager->merge($curso); 
            // O método merege faz com que o Doctrine passe a gerenciar a 
            // entidade, como se tivesse sido recuperada do banco.
            $_SESSION['mensagem'] = "Curso atualizado com sucesso.";
        } else {
            $this->entityManager->persist($curso);
            $_SESSION['mensagem'] = "Curso inserido com sucesso.";
        }
        $this->entityManager->flush();

        $_SESSION['tipoMensagem'] = "success";
        header('Location: /listar-cursos', true, 302);
    }
}
