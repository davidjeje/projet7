<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Hateoas\Configuration\Annotation as Hateoas;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MobileRepository")
 * 
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "mobile_show",
 *          absolute = true,
 *          parameters = { "id" = "expr(object.getId())" }
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups = {"details", "list"})
 * )
 * @Hateoas\Relation(
 *      "list",
 *      href = @Hateoas\Route(
 *          "mobile_all",
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups = {"details", "list"})
 * )
 *
 * @Hateoas\Relation(
 *      "create",
 *      href = @Hateoas\Route(
 *          "mobile_new",
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups = {"details", "list"})
 * )
 * @Hateoas\Relation(
 *      "DELETE",
 *      href = @Hateoas\Route(
 *          "mobile_delete",
 *          absolute = true,
 *          parameters = { "id" = "expr(object.getId())" }
 *      ),
 * exclusion = @Hateoas\Exclusion(groups = {"details", "list"})
 * )
 */
class Mobile
{
    /**
     *@ORM\Id()
     *@ORM\GeneratedValue()
     *@ORM\Column(type="integer")
     *@Serializer\Groups({"list", "details"})
     *@SWG\Property(description="The unique identifier of the mobile.")
     *@Serializer\Since("1.0")
     */
    private $id;

    /**
     *@ORM\Column(type="string", length=255)
     *@Assert\NotBlank
     *@Serializer\Groups({"list", "details"})
     *@SWG\Property(description="Name of new mobile.", example="Samsumg, iphone *etc...")
     *@Serializer\Since("1.0")
     */
    private $name;

    /**
     *@ORM\Column(type="string", length=255)
     *@Serializer\Groups({"details"})
     *@SWG\Property(description="Characteristic of the screen.", example="Resolution, *pitch, response time, brightness, contrast, viewing angle and connection type.")
     *@Serializer\Since("1.0")
     */
    private $screen;

    /**
     *@ORM\Column(type="string", length=255)
     *@Serializer\Groups({"details"})
     *@SWG\Property(description="Design of the screen.", example="Screen size, *ratio, *resolution.")
     *@Serializer\Since("1.0")
     */
    private $design;

    /**
     *@ORM\Column(type="string", length=255)
     *@Serializer\Groups({"details"})
     *@SWG\Property(description="Colour of the new mobile.", example="Black, white, *brown *etc...")
     *@Serializer\Since("1.0")
     */
    private $colour;

    /**
     *@ORM\Column(type="string", length=255)
     *@Assert\NotBlank
     *@Serializer\Groups({"details"})
     *@SWG\Property(description="the operating system integrate into the phone.", *example="android 10, android 9, android 8.")
     *@Serializer\Since("1.0")
     */
    private $android;

    /**
     *@ORM\Column(type="string", length=255)
     *@Serializer\Groups({"details"})
     *@SWG\Property(description="the processor integrate into the phone.", *example="processor i9, processor i7, processor i9, processor amd ryzen 5.")
     *@Serializer\Since("1.0")
     */
    private $processor;

    /**
     *@ORM\Column(type="string", length=255)
     *@Serializer\Groups({"details"})
     *@SWG\Property(description="RAM is the computer memory in which * can be stored, *then *erased, information processed by a computer device. RAM is written as *opposed to ROM *or direct access memory as opposed to sequential access.", *example=" type DDR, DDR2 *or DDR3.")
     *@Serializer\Since("1.0")
     */
    private $ram;

    /**
     *@ORM\Column(type="text", length=255)
     *@Serializer\Groups({"details"})
     *@SWG\Property(description="the camera integrate into the phone.", example="12 MP *camera and for video, the recording is done in 720p HD at 30 frames per second, *1080p *HD at 30 or 60 frames per second and finally, in 4K at 24, 30 or 60 *frames per *second.")
     *@Serializer\Since("1.0")
     */
    private $camera;

    /**
     *@ORM\Column(type="string", length=255)
     *@Assert\NotBlank
     *@Serializer\Groups({"details"})
     *@SWG\Property(description="MEMORY ROM: THE HARD DISK OF YOUR SMARTPHONE
     *Your desktop has a hard drive, which hosts your operating system and all your *data: *software, files, photos, videos, etc ...
     *ROM (Read-Only Memory) is the hard disk of your computer. You will store the *applications you install, photos and selfies that you will realize and many *other data *(SMS, downloaded files ...).Having a high storage memory allows you *to install more *applications, to make more *photos and videos, to record your *favorite music tracks", *example=" 16GA, 32GA, 64GA, 128GA")
     *@Serializer\Since("1.0")
     */
    private $storage;

    /**
     *@ORM\Column(type="string", length=255)
     *@Assert\NotBlank
     *@Serializer\Groups({"details"})
     *@SWG\Property(description="the drums integrate into the phone.", *example="Original *Samsung EB-BG360BBE 2000mAh Battery for Samsung Galaxy Core *Prime, 
     *Battery Original LG Model BL-44JH / EAC61839001 for LG Optimus L7")
     *@Serializer\Since("1.0")
     */
    private $drums;

    /**
     *@ORM\Column(type="string", length=255)
     *@Serializer\Groups({"details"})
     *@SWG\Property(description="the drums integrate into the phone.", example="THE *SIM *CARD FULL SIZE, THE MINI SIM, THE MICRO SIM, THE NANO SIM, SIM card ONBOARD *(E-SIM)")
     *@Serializer\Since("1.0")
     */
    private $simCard;

    /**
     *@ORM\Column(type="string", length=255)
     *@Assert\NotBlank
     *@Serializer\Groups({"details"})
     *@SWG\Property(description="compatible with 2G, 3G and 4G 4G + networks.")
     *@Serializer\Since("1.0")
     */
    private $compatibility;

    /**
     *@ORM\Column(type="string", length=255)
     *@Serializer\Groups({"details"})
     *@SWG\Property(description="the SAV takes care of the follow-up of the merchandise *after its purchase by the customer. If necessary, it ensures the maintenance, repair *or exchange of a product sold by the company..", example="delivery and setting up of *the property, as well as physical or *telephone assistance to the buyer.")
     *@Serializer\Since("1.0")
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
