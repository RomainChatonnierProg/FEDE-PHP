<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    /**
     * @var Collection<int, Group>
     */
    #[ORM\ManyToMany(targetEntity: Group::class, mappedBy: 'contacts')]
    private Collection $groups;

    /**
     * @var Collection<int, CustomField>
     */
    #[ORM\OneToMany(targetEntity: CustomField::class, mappedBy: 'contact', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $customFields;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->customFields = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function setDynamicFields(?string $dynamic_fields): static
    {
        $this->dynamic_fields = $dynamic_fields;

        return $this;
    }

    /**
     * @return Collection<int, Group>
     */
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(Group $group): static
    {
        if (!$this->groups->contains($group)) {
            $this->groups->add($group);
            $group->addContact($this);
        }

        return $this;
    }

    public function removeGroup(Group $group): static
    {
        if ($this->groups->removeElement($group)) {
            $group->removeContact($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, CustomField>
     */
    public function getCustomFields(): Collection
    {
        return $this->customFields;
    }

    public function addCustomField(CustomField $customField): static
    {
        if (!$this->customFields->contains($customField)) {
            $this->customFields->add($customField);
            $customField->setContact($this);
        }

        return $this;
    }

    public function removeCustomField(CustomField $customField): static
    {
        if ($this->customFields->removeElement($customField)) {
            // set the owning side to null (unless already changed)
            if ($customField->getContact() === $this) {
                $customField->setContact(null);
            }
        }

        return $this;
    }
}
