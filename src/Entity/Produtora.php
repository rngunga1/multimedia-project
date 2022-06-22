<?php

namespace App\Entity;

use App\Repository\ProdutoraRepository;
use Doctrine\ORM\Mapping as ORM;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;

/**
 * @ORM\Entity(repositoryClass=ProdutoraRepository::class)
 */
class Produtora
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descricao;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricao(): ?text
    {
        return $this->descricao;
    }

    public function setDescricao(text $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }
}
