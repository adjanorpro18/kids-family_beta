<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActivityRepository::class)
 */
class Activity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    /**
     * @ORM\OneToOne(targetEntity=TypeActivity::class, mappedBy="activity", cascade={"persist", "remove"})
     */
    private $typeActivity;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="activities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="activities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=TypeNeeds::class, mappedBy="activity")
     */
    private $typeNeeds;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="activities")
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity=Picture::class, mappedBy="activity")
     */
    private $pictures;

    /**
     * @ORM\OneToMany(targetEntity=Publics::class, mappedBy="activity")
     */
    private $publics;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="activity")
     */
    private $comments;

    public function __construct()
    {
        $this->typeNeeds = new ArrayCollection();
        $this->pictures = new ArrayCollection();
        $this->publics = new ArrayCollection();
        $this->comments = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getTypeActivity(): ?TypeActivity
    {
        return $this->typeActivity;
    }

    public function setTypeActivity(TypeActivity $typeActivity): self
    {
        // set the owning side of the relation if necessary
        if ($typeActivity->getActivity() !== $this) {
            $typeActivity->setActivity($this);
        }

        $this->typeActivity = $typeActivity;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|TypeNeeds[]
     */
    public function getTypeNeeds(): Collection
    {
        return $this->typeNeeds;
    }

    public function addTypeNeed(TypeNeeds $typeNeed): self
    {
        if (!$this->typeNeeds->contains($typeNeed)) {
            $this->typeNeeds[] = $typeNeed;
            $typeNeed->setActivity($this);
        }

        return $this;
    }

    public function removeTypeNeed(TypeNeeds $typeNeed): self
    {
        if ($this->typeNeeds->removeElement($typeNeed)) {
            // set the owning side to null (unless already changed)
            if ($typeNeed->getActivity() === $this) {
                $typeNeed->setActivity(null);
            }
        }

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setActivity($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getActivity() === $this) {
                $picture->setActivity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Publics[]
     */
    public function getPublics(): Collection
    {
        return $this->publics;
    }

    public function addPublic(Publics $public): self
    {
        if (!$this->publics->contains($public)) {
            $this->publics[] = $public;
            $public->setActivity($this);
        }

        return $this;
    }

    public function removePublic(Publics $public): self
    {
        if ($this->publics->removeElement($public)) {
            // set the owning side to null (unless already changed)
            if ($public->getActivity() === $this) {
                $public->setActivity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setActivity($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getActivity() === $this) {
                $comment->setActivity(null);
            }
        }

        return $this;
    }
}
