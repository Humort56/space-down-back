<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CardRepository::class)]
class Card
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $custom = null;

    #[ORM\Column(length: 255)]
    private ?string $created_by = null;

    #[ORM\Column]
    private ?bool $temporary = null;

    #[ORM\ManyToMany(targetEntity: Lobby::class, mappedBy: 'cards')]
    private Collection $lobbies;

    public function __construct()
    {
        $this->lobbies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function isCustom(): ?bool
    {
        return $this->custom;
    }

    public function setCustom(bool $custom): static
    {
        $this->custom = $custom;

        return $this;
    }

    public function getCreatedBy(): ?string
    {
        return $this->created_by;
    }

    public function setCreatedBy(string $created_by): static
    {
        $this->created_by = $created_by;

        return $this;
    }

    public function isTemporary(): ?bool
    {
        return $this->temporary;
    }

    public function setTemporary(bool $temporary): static
    {
        $this->temporary = $temporary;

        return $this;
    }

    /**
     * @return Collection<int, Lobby>
     */
    public function getLobbies(): Collection
    {
        return $this->lobbies;
    }

    public function addLobby(Lobby $lobby): static
    {
        if (!$this->lobbies->contains($lobby)) {
            $this->lobbies->add($lobby);
            $lobby->addCard($this);
        }

        return $this;
    }

    public function removeLobby(Lobby $lobby): static
    {
        if ($this->lobbies->removeElement($lobby)) {
            $lobby->removeCard($this);
        }

        return $this;
    }
}
