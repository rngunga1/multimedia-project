<?php

namespace App\Entity;

use App\Repository\UtilizadorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtilizadorRepository::class)
 */
class Utilizador
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
    private $username;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity=Pessoa::class, inversedBy="Utilizador", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $pessoa;

    /**
     * @ORM\OneToMany(targetEntity=Filme::class, mappedBy="uploadUtilizador")
     */
    private $filmesPostados;

    public function __construct()
    {
        $this->filmesPostados = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPessoa(): ?Pessoa
    {
        return $this->pessoa;
    }

    public function setPessoa(Pessoa $pessoa): self
    {
        $this->pessoa = $pessoa;

        return $this;
    }

    /**
     * @return Collection<int, Filme>
     */
    public function getFilmesPostados(): Collection
    {
        return $this->filmesPostados;
    }

    public function addFilmesPostado(Filme $filmesPostado): self
    {
        if (!$this->filmesPostados->contains($filmesPostado)) {
            $this->filmesPostados[] = $filmesPostado;
            $filmesPostado->setUploadUtilizador($this);
        }

        return $this;
    }

    public function removeFilmesPostado(Filme $filmesPostado): self
    {
        if ($this->filmesPostados->removeElement($filmesPostado)) {
            // set the owning side to null (unless already changed)
            if ($filmesPostado->getUploadUtilizador() === $this) {
                $filmesPostado->setUploadUtilizador(null);
            }
        }

        return $this;
    }
}
