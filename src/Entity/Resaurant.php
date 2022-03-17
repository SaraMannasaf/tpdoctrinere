<?php

namespace App\Entity;

use App\Repository\ResaurantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResaurantRepository::class)
 */
class Resaurant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=city::class, inversedBy="restaurants")
     */
    private $city_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCityId(): ?city
    {
        return $this->city_id;
    }

    public function setCityId(?city $city_id): self
    {
        $this->city_id = $city_id;

        return $this;
    }
}
