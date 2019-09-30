<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MobileRepository")
 * 
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "mobile_show",
 *          absolute = true,
 *          parameters = { "id" = "expr(object.getId())" }
 *      )
 * )
 * @Hateoas\Relation(
 *      "list",
 *      href = @Hateoas\Route(
 *          "mobile_all",
 *          absolute = true
 *      )
 * )
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "user_show",
 *          absolute = true,
 *          parameters = { "id" = "expr(object.getId())" }
 *      )
 * )
 * @Hateoas\Relation(
 *      "list",
 *      href = @Hateoas\Route(
 *          "user_all",
 *          absolute = true
 *      )
 * )
 * @Hateoas\Relation(
 *      "create",
 *      href = @Hateoas\Route(
 *          "user_new",
 *          absolute = true
 *      )
 * )
 
 */
class Mobile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $screen;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $design;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $colour;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $android;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $processor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ram;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private $camera;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $storage;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $drums;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $simCard;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $compatibility;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sav;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getScreen(): ?string
    {
        return $this->screen;
    }

    public function setScreen(string $screen): self
    {
        $this->screen = $screen;

        return $this;
    }

    public function getDesign(): ?string
    {
        return $this->design;
    }

    public function setDesign(string $design): self
    {
        $this->design = $design;

        return $this;
    }

    public function getColour(): ?string
    {
        return $this->colour;
    }

    public function setColour(string $colour): self
    {
        $this->colour = $colour;

        return $this;
    }

    public function getAndroid(): ?string
    {
        return $this->android;
    }

    public function setAndroid(string $android): self
    {
        $this->android = $android;

        return $this;
    }

    public function getProcessor(): ?string
    {
        return $this->processor;
    }

    public function setProcessor(string $processor): self
    {
        $this->processor = $processor;

        return $this;
    }

    public function getRam(): ?string
    {
        return $this->ram;
    }

    public function setRam(string $ram): self
    {
        $this->ram = $ram;

        return $this;
    }

    public function getCamera(): ?string
    {
        return $this->camera;
    }

    public function setCamera(string $camera): self
    {
        $this->camera = $camera;

        return $this;
    }

    public function getStorage(): ?string
    {
        return $this->storage;
    }

    public function setStorage(string $storage): self
    {
        $this->storage = $storage;

        return $this;
    }

    public function getDrums(): ?string
    {
        return $this->drums;
    }

    public function setDrums(string $drums): self
    {
        $this->drums = $drums;

        return $this;
    }

    public function getSimCard(): ?string
    {
        return $this->simCard;
    }

    public function setSimCard(string $simCard): self
    {
        $this->simCard = $simCard;

        return $this;
    }

    public function getCompatibility(): ?string
    {
        return $this->compatibility;
    }

    public function setCompatibility(string $compatibility): self
    {
        $this->compatibility = $compatibility;

        return $this;
    }

    public function getSav(): ?string
    {
        return $this->sav;
    }

    public function setSav(string $sav): self
    {
        $this->sav = $sav;

        return $this;
    }
}
