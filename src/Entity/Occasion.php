<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OccasionRepository")
 */
class Occasion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var WishList[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\WishList", mappedBy="occasion")
     */
    private $wishLists;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return WishList[]|ArrayCollection
     */
    public function getWishLists()
    {
        return $this->wishLists;
    }

    /**
     * @param WishList[]|ArrayCollection $wishLists
     */
    public function setWishLists($wishLists): void
    {
        $this->wishLists = $wishLists;
    }

    public function __toString()
    {
        return $this->name;
    }
}
