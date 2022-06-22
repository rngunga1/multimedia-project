<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriaRepository::class)
 */
class Categoria
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $nome;

    /**
     * @ORM\OneToMany(targetEntity=Filme::class, mappedBy="categoria")
     */
    private $filmes;

    public function __construct()
    {
        $this->filmes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return Collection<int, Filme>
     */
    public function getFilmes(): Collection
    {
        return $this->filmes;
    }

    public function addFilme(Filme $filme): self
    {
        if (!$this->filmes->contains($filme)) {
            $this->filmes[] = $filme;
            $filme->setCategoria($this);
        }

        return $this;
    }

    public function removeFilme(Filme $filme): self
    {
        if ($this->filmes->removeElement($filme)) {
            // set the owning side to null (unless already changed)
            if ($filme->getCategoria() === $this) {
                $filme->setCategoria(null);
            }
        }

        return $this;
    }
}
