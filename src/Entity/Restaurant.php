<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=city::class, inversedBy="restaurants")
     */
    private $cityid;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $createdat;

    /**
     * @ORM\OneToMany(targetEntity=RestaurantPicture::class, mappedBy="restaurantid")
     */
    private $restaurantPictures;

    /**
     * @ORM\OneToMany(targetEntity=Review::class, mappedBy="restaurantid")
     */
    private $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->restaurantPictures = new ArrayCollection();
        $this->createdAt= new \DateTime('now');

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCityid(): ?city
    {
        return $this->cityid;
    }

    public function setCityid(?city $cityid): self
    {
        $this->cityid = $cityid;

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

    /**
     * @return Collection<int, RestaurantPicture>
     */
    public function getRestaurantPictures(): Collection
    {
        return $this->restaurantPictures;
    }

    public function addRestaurantPicture(RestaurantPicture $restaurantPicture): self
    {
        if (!$this->restaurantPictures->contains($restaurantPicture)) {
            $this->restaurantPictures[] = $restaurantPicture;
            $restaurantPicture->setRestaurantid($this);
        }

        return $this;
    }

    public function removeRestaurantPicture(RestaurantPicture $restaurantPicture): self
    {
        if ($this->restaurantPictures->removeElement($restaurantPicture)) {
            // set the owning side to null (unless already changed)
            if ($restaurantPicture->getRestaurantid() === $this) {
                $restaurantPicture->setRestaurantid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setRestaurantid($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getRestaurantid() === $this) {
                $review->setRestaurantid(null);
            }
        }

        return $this;
    }
}
