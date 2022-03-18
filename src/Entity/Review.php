<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReviewRepository::class)
 */
class Review
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $message;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rating;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $createdat;

    /**
     * @ORM\ManyToOne(targetEntity=restaurant::class, inversedBy="reviews")
     */
    private $restaurantid;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="reviews")
     */
    private $userid;

    public function __construct()
    {
        $this->createdAt= new \DateTime('now');
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getCreatedat(): ?\DateTimeInterface
    {
        return $this->createdat;
    }

    public function setCreatedat(?\DateTimeInterface $createdat): self
    {
        $this->createdat = $createdat;

        return $this;
    }

    public function getRestaurantid(): ?restaurant
    {
        return $this->restaurantid;
    }

    public function setRestaurantid(?restaurant $restaurantid): self
    {
        $this->restaurantid = $restaurantid;

        return $this;
    }

    public function getUserid(): ?user
    {
        return $this->userid;
    }

    public function setUserid(?user $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

}
