<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: BookRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nameCinema = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nameMovie = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getNameCinema(): ?string
    {
        return $this->nameCinema;
    }

    /**
     * @param string|null $nameCinema
     */
    public function setNameCinema(?string $nameCinema): void
    {
        $this->nameCinema = $nameCinema;
    }

    /**
     * @return string|null
     */
    public function getNameMovie(): ?string
    {
        return $this->nameMovie;
    }

    /**
     * @param string|null $nameMovie
     */
    public function setNameMovie(?string $nameMovie): void
    {
        $this->nameMovie = $nameMovie;
    }



}
