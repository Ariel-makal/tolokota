<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use ApiPlatform\Metadata\GetCollection;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['post.read']],
    denormalizationContext: ['groups' => ['post.write']]
)]
#[ApiResource(
    uriTemplate: '/post/all',
    operations: [
        new GetCollection(),
    ],
    paginationEnabled: false
)]
#[ApiFilter(
    OrderFilter::class,
    properties: ['createdAt']
)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['post.read','post.write'])]
    private ?User $owner = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['post.read','post.write'])]
    private ?string $image = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Groups(['post.read','post.write'])]
    private ?string $longitude = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Groups(['post.read','post.write'])]
    private ?string $latitude = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['post.read','post.write'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['post.read','post.write'])]
    private ?\DateTimeInterface $createdAt = null;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(mappedBy: 'post', targetEntity: Comment::class, orphanRemoval: true)]
    #[Groups(['post.read'])]
    private Collection $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getImage(): ?string
    {

        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }

        return $this;
    }
}
