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
     * @ORM\ManyToOne(targetEntity=Categoria::class, inversedBy="filmes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoria;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descricao;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $views;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $postDate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="uploadedFilms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $uploadUser;

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


    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function setViews(?int $views): self
    {
        $this->views = $views;

        return $this;
    }

    public function getPostDate(): ?\DateTimeInterface
    {
        return $this->postDate;
    }

    public function setPostDate(?\DateTimeInterface $postDate): self
    {
        $this->postDate = $postDate;

        return $this;
    }

    public function getUploadUser(): ?User
    {
        return $this->uploadUser;
    }

    public function setUploadUser(?User $uploadUser): self
    {
        $this->uploadUser = $uploadUser;

        return $this;
    }
}
