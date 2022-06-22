<?php

namespace App\Entity;

use App\Repository\FilmeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FilmeRepository::class)
 */
class Filme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $produtora;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $titulo;

    /**
     * @ORM\ManyToMany(targetEntity=Pessoa::class, mappedBy="filmesFavoritos")
     */
    private $pessoasFilmeFavorito;

    /**
     * @ORM\ManyToOne(targetEntity=Utilizador::class, inversedBy="filmesPostados")
     * @ORM\JoinColumn(nullable=false)
     */
    private $uploadUtilizador;

    /**
     * @ORM\ManyToOne(targetEntity=Categoria::class, inversedBy="filmes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoria;

    public function __construct()
    {
        $this->pessoasFilmeFavorito = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProdutora(): ?string
    {
        return $this->produtora;
    }

    public function setProdutora(string $produtora): self
    {
        $this->produtora = $produtora;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * @return Collection<int, Pessoa>
     */
    public function getPessoasFilmeFavorito(): Collection
    {
        return $this->pessoasFilmeFavorito;
    }

    public function addPessoasFilmeFavorito(Pessoa $pessoasFilmeFavorito): self
    {
        if (!$this->pessoasFilmeFavorito->contains($pessoasFilmeFavorito)) {
            $this->pessoasFilmeFavorito[] = $pessoasFilmeFavorito;
            $pessoasFilmeFavorito->addFilmesFavorito($this);
        }

        return $this;
    }

    public function removePessoasFilmeFavorito(Pessoa $pessoasFilmeFavorito): self
    {
        if ($this->pessoasFilmeFavorito->removeElement($pessoasFilmeFavorito)) {
            $pessoasFilmeFavorito->removeFilmesFavorito($this);
        }

        return $this;
    }

    public function getUploadUtilizador(): ?Utilizador
    {
        return $this->uploadUtilizador;
    }

    public function setUploadUtilizador(?Utilizador $uploadUtilizador): self
    {
        $this->uploadUtilizador = $uploadUtilizador;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }
}
