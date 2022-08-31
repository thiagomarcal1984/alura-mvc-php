<?php
namespace Alura\Cursos\Entity; // Correção do namespace.
/**
 * @Entity
 * @Table(name="usuarios")
 */
class Usuario
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;
    /**
     * @Column(type="string")
     */
    private $email;
    /**
     * @Column(type="string")
     */
    private $senha;

    public function senhaEstaCorreta(string $senhaPura): bool
    {
        // Compara a senha pura com o hash armazenado no banco de dados.
        return password_verify($senhaPura, $this->senha); 
    }
}
