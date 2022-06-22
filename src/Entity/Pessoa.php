<?php

namespace App\Entity;

use App\Repository\PessoaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PessoaRepository::class)
 */
class Pessoa
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
     * @ORM\Column(type="integer")
     */
    private $idade;

    /**
     * @ORM\OneToOne(targetEntity=Utilizador::class, mappedBy="pessoa", cascade={"persist", "remove"})
     */
    private $Utilizador;

    /**
     * @ORM\ManyToMany(targetEntity=Filme::class, inversedBy="pessoasFilmeFavorito")
     */
    private $filmesFavoritos;

    /**
     * @ORM\ManyToMany(targetEntity=Pessoa::class)
     */
    private $listaDeConexoes;

    public function __construct()
    {
        $this->filmesFavoritos = new ArrayCollection();
        $this->listaDeConexoes = new ArrayCollection();
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

    public function getIdade(): ?int
    {
        return $this->idade;
    }

    public function setIdade(int $idade): self
    {
        $this->idade = $idade;

        return $this;
    }

    public function getUtilizador(): ?Utilizador
    {
        return $this->Utilizador;
    }

    public function setUtilizador(Utilizador $Utilizador): self
    {
        // set the owning side of the relation if necessary
        if ($Utilizador->getPessoa() !== $this) {
            $Utilizador->setPessoa($this);
        }

        $this->Utilizador = $Utilizador;

        return $this;
    }

    /**
     * @return Collection<int, Filme>
     */
    public function getFilmesFavoritos(): Collection
    {
        return $this->filmesFavoritos;
    }

    public function addFilmesFavorito(Filme $filmesFavorito): self
    {
        if (!$this->filmesFavoritos->contains($filmesFavorito)) {
            $this->filmesFavoritos[] = $filmesFavorito;
        }

        return $this;
    }

    public function removeFilmesFavorito(Filme $filmesFavorito): self
    {
        $this->filmesFavoritos->removeElement($filmesFavorito);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getListaDeConexoes(): Collection
    {
        return $this->listaDeConexoes;
    }

    public function addListaDeConexo(self $listaDeConexo): self
    {
        if (!$this->listaDeConexoes->contains($listaDeConexo)) {
            $this->listaDeConexoes[] = $listaDeConexo;
        }

        return $this;
    }

    public function removeListaDeConexo(self $listaDeConexo): self
    {
        $this->listaDeConexoes->removeElement($listaDeConexo);

        return $this;
    }
}
