<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Hateoas\Configuration\Annotation as Hateoas;
use Nelmio\ApiDocBundle\Annotation as Doc;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation as Serializer;
use Swagger\Annotations as SWG;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "user_show",
 *          absolute = true,
 *          parameters = { "id" = "expr(object.getId())" }
 *      
 *      ),
 *  exclusion = @Hateoas\Exclusion(groups = {"details", "list"})
 * )
 * @Hateoas\Relation(
 *      "list",
 *      href = @Hateoas\Route(
 *          "user_all",
 *          absolute = true
 *      ),
 * exclusion = @Hateoas\Exclusion(groups = {"details", "list"})
 * )
 * @Hateoas\Relation(
 *      "create",
 *      href = @Hateoas\Route(
 *          "user_new",
 *          absolute = true
 *      ),
 * exclusion = @Hateoas\Exclusion(groups = {"details", "list"})
 * )
 * @Hateoas\Relation(
 *      "DELETE",
 *      href = @Hateoas\Route(
 *          "user_delete",
 *          absolute = true,
 *          parameters = { "id" = "expr(object.getId())" }
 *      ),
 * exclusion = @Hateoas\Exclusion(groups = {"details", "list"})
 * )
 */

class User 
{
    /**
     *@ORM\Id()
     *@ORM\GeneratedValue()
     *@ORM\Column(type="integer")
     *@Serializer\Groups({"list", "details"})
     *@SWG\Property(description="The unique identifier of the user.")
     *@Serializer\Since("1.0")
     */
    private $id;

    /**
     *@ORM\Column(type="string", length=255)
     *@Serializer\Groups({"list", "details"})
     *@SWG\Property(description="First name of new user.", example="Gerard")
     *@Serializer\Since("1.0")
     */
    private $first_name;

    /**
     *@ORM\Column(type="string", length=255)
     *@Serializer\Groups({"list", "details"})
     *@SWG\Property(description="Name of new user.", example="Dupont")
     *@Serializer\Since("1.0")
     */
    private $name;

    /**
     *@ORM\Column(type="string", length=255)
     *@Serializer\Groups({"list", "details"})
     *@SWG\Property(description="Email of new user.", example="GerardDupont@gmail.fr")
     *@Serializer\Since("1.0")
     */
    private $email;

    /**
     *@ORM\Column(type="string", length=255)
     *@SWG\Property(description="Password of new user.", example="GerardDupont")
     *@Serializer\Since("1.0")
     *@Serializer\Groups({"password"})
     */
    private $password;

    /**
     *@ORM\Column(type="string", length=255)
     *@Serializer\Groups({"details"})
     *@SWG\Property(description="Country of new user.", example="France")
     *@Serializer\Since("1.0")
     */
    private $country;

    /**
     *@ORM\Column(type="string", length=255)
     *@Serializer\Groups({"details"})
     *@SWG\Property(description="City of new user.", example="Paris")
     *@Serializer\Since("1.0")
     */
    private $city;


    /**
     *@ORM\Column(type="string", length=255)
     *@Serializer\Groups({"details"})
     *@SWG\Property(description="Adresse of new user.", example="15 General street Leclerc")
     *@Serializer\Since("1.0")
     */
    private $adresse;

    /**
     *@ORM\Column(type="string", length=255)
     *@Serializer\Groups({"details"})
     *@SWG\Property(description="Zip code of new user.", example="75008")
     *@Serializer\Since("1.0")
     */
    private $zip_code;

    /**
     *@ORM\ManyToOne(targetEntity="App\Entity\Client",
     *inversedBy="user", cascade={"persist"})
     *@ORM\JoinColumn(name="client", referencedColumnName="id")
     *@Serializer\Since("1.0") 
     *@SWG\Property(description="Users customer.", example="Users customer Maxime number 1 = *GerardDupont")
     *@Serializer\Groups({"details"})
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zip_code;
    }

    public function setZipCode(string $zip_code): self
    {
        $this->zip_code = $zip_code;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
