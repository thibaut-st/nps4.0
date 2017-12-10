<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WishListRepository")
 * @ORM\Table(name="wish_list")
 */
class WishList
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
     * @var Occasion
     * @ORM\ManyToOne(targetEntity="App\Entity\Occasion", inversedBy="wishLists")
     * @ORM\JoinColumn(name="occasion_id", referencedColumnName="id")
     */
    private $occasion;

    /**
     * @var Item[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Item", mappedBy="wishList", orphanRemoval=true)
     */
    private $items;

    /**
     * WishList constructor.
     * @param Item[]|ArrayCollection $items
     */
    public function __construct($items = array())
    {
        $this->items = $items;
    }

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
     * @return Occasion
     */
    public function getOccasion(): ?object
    {
        return $this->occasion;
    }

    /**
     * @param Occasion $occasion
     */
    public function setOccasion(Occasion $occasion): void
    {
        $this->occasion = $occasion;
    }

    /**
     * @return Item[]|ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param Item[]|ArrayCollection $items
     */
    public function setItems($items): void
    {
        $this->items = $items;
    }

    public function addItem(Item $item)
    {
        $this->items[] = $item;
    }

    public function __toString()
    {
        return $this->name;
    }
}
