<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\Persistence\ObjectRepository;

class FormularioEdicao implements InterfaceControladorRequisicao
{
        use RenderizadorDeHtmlTrait;
        
        /** @var EntityManagerInterface */
        private $entityManager;
        /** @var ObjectRepository */
        private $repositorioCursos;

        public function __construct()
        {
            $this->entityManager = (new EntityManagerCreator())
                ->getEntityManager();
            $this->repositorioCursos = $this->entityManager
                ->getRepository(Curso::class);
        }
    
        public function processaRequisicao(): void
        {
            $id = filter_input(
                INPUT_GET,
                'id',
                FILTER_VALIDATE_INT
            );

            if (is_null($id) || $id === false) {
                header('Location: /listar-cursos');
                return;
            }

            $curso = $this->repositorioCursos->find($id);
            echo $this->renderizaHtml("cursos/formulario.php", [
                'curso' => $curso, 
                'titulo' => $titulo = "Alterar curso " . $curso->getDescricao()
            ]);
        }    
}
