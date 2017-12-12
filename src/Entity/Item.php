<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 */
class Item
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
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $link;

    /**
     * @var ItemType
     * @ORM\ManyToOne(targetEntity="ItemType", inversedBy="items")
     * @ORM\JoinColumn(name="itemType_id", referencedColumnName="id")
     */
    private $itemType;

    /**
     * @var WishList
     * @ORM\ManyToOne(targetEntity="WishList", inversedBy="items")
     * @ORM\JoinColumn(name="wishList_id", referencedColumnName="id")
     */
    private $wishList;

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
     * @return string
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return ItemType
     */
    public function getItemType(): ?ItemType
    {
        return $this->itemType;
    }

    /**
     * @param ItemType $itemType
     */
    public function setItemType(ItemType $itemType): void
    {
        $this->itemType = $itemType;
    }

    /**
     * @return WishList
     */
    public function getWishList(): ?WishList
    {
        return $this->wishList;
    }

    /**
     * @param WishList $wishList
     */
    public function setWishList(WishList $wishList): void
    {
        $this->wishList = $wishList;
    }

    public function __toString()
    {
        return $this->name;
    }
}
