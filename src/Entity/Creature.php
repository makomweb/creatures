<?php

namespace App\Entity;

use App\Repository\CreatureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CreatureRepository::class)
 */
class Creature
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Attack;

    /**
     * @ORM\Column(type="integer")
     */
    private $Defense;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttack(): ?int
    {
        return $this->Attack;
    }

    public function setAttack(int $Attack): self
    {
        $this->Attack = $Attack;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->Defense;
    }

    public function setDefense(int $Defense): self
    {
        $this->Defense = $Defense;

        return $this;
    }
}
