<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Hateoas\Configuration\Annotation as Hateoas;
use Symfony\Component\Security\Core\User\UserInterface;
use Swagger\Annotations as SWG;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client implements UserInterface
{
    /**
     *@ORM\Id()
     *@ORM\GeneratedValue()
     *@ORM\Column(type="integer")
     *@SWG\Property(description="The unique identifier of the client.")
     *@Serializer\Since("1.0")
     *@Serializer\Groups({"list"})
     */
    private $id;

    /**
     *@ORM\Column(type="string", length=255)
     *@SWG\Property(description="Name of new client.", example="Dupont")
     *@Serializer\Since("1.0")
     *@Serializer\Groups({"list"})
     */
    private $name;

    /**
     *@ORM\Column(type="string", length=255)
     *@SWG\Property(description="Email of new client.", example="GerardDupont@gmail.fr")
     *@Serializer\Since("1.0")
     *@Serializer\Groups({"list"})
     */
    private $email;

    /**
     *@SWG\Property(type="string", description="Email of new client.", *example="GerardDupont@gmail.fr")
     *@Serializer\Since("1.0")
     *@Serializer\Groups({"login"})
     */
    private $username;

    /**
     *@SWG\Property(type="string", description="Token of new client.", example="eyJ0eXAiOiJKV*1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE1NzI2MDM2NDEsImV4cCI6MTU3MjYwNzI0MSwicm9sZXMiOlsiUk9*MRV9VU0VSIl0sInVzZXJuYW1lIjoidXNlckBhdHRpbmVvcy5jb20ifQ.HfmW0eLX8njI4xp8RbPrHIyVM5xe3lD*6V-kqi6KOIPmx9n0UjLKIFH5pnBGLpbjweh3WLZAHaBeEsve8fUYr3yE6GNgVJy23sxGRSlKUxPkz-hwMXbX1ta*Foau0ZZXZJe9ZsI3foPm7sTx8ghY5_snsPtgquuNJsuOSHx3OzyNX-f_siXNNC7VKeHWAlT_fNy2hj6eUiFJUY4*GVGTmZV8lAmJcV_sdnQebZ-kwXBOzXRDaVMEcQi9wyDB5woJN3OMxFRTSIBOgZtvtRhTNBKWgqYSv2CakyoEUFI*zM4nydPojdUfOp1o6_eLw3AAQN7obm7sOb1V4B1olqRcQTHktZfQLc5wCQTLoWbHDCViTFvLJE7PU_WREIq_zpU*XAYwiqjoKTTBXVrh6Qa3dW7oQWyZxnJuK5hW7Y7URKS9qIempXj69j9nmkFloNG09Mjlnsmo-550hDOJnYYf3YC*_6E4k6LSxJUrmBJUmQTYofGuwP6RX5-LYVEQnImZEyIRG6v_FKF05oNw_1KWYBMII1gn_PshDMyDJK6z9zgC9dw*2417nJjFF9bQgOD20vJqizJkCitgDASIpOb3QNuf3z3jHYHZN1kUlyH1u_15YbL9vSlwLT8BGDBuZhOlOhHgwgk*_stLTkhVY19E4m-i1OxAUdolEj_dyoCx5MCLPpjQCtY")
     *@Serializer\Since("1.0")
     *@Serializer\Groups({"token"})
     */
    private $token;

    /**
     *@ORM\Column(type="string", length=255)
     *@SWG\Property(description="Password of new client.", example="GerardDupont")
     *@Serializer\Since("1.0")
     *@Serializer\Groups({"login", "add"})
     */
    private $password;

    /**
     *@ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="client", cascade={"persist"})
     *@Serializer\Since("1.0")
     *@SWG\Property(description="Customer users.", example="Customer users GerardDupont *number 1 = Maxime")
     *@Serializer\Groups({"list"})
     */
    private $user;

    /**
     *@ORM\Column(type="json")
     *@Serializer\Since("1.0")
     *@SWG\Property(description="Customers role.", example="Customer role ROLE_SUPER_ADMIN *or ROLE_USER.")
     *@Serializer\Groups({"add", "list"})
     */
    private $roles = [];

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

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

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setClient($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getClient() === $this) {
                $user->setClient(null);
            }
        }

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        return null;
    }

    public function getRealUsername(): ?string
    {
        return $this->username;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }
}
