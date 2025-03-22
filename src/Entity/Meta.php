<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Post;

#[ORM\Entity]
class Meta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Post::class, inversedBy: 'metas')]
    #[ORM\JoinColumn(nullable: false)]
    private Post $post;

    #[ORM\Column(name: "meta_key", type: "string", length: 255)]
    private string $metaKey; 

    #[ORM\Column(type: 'text')]
    private string $value;

    // 🔹 Getter & Setter for ID
    public function getId(): ?int
    {
        return $this->id;
    }

    // 🔹 Getter & Setter for Post
    public function getPost(): Post
    {
        return $this->post;
    }

    public function setPost(Post $post): self
    {
        $this->post = $post;
        return $this;
    }

    // 🔹 Getter & Setter for MetaKey
    public function getMetaKey(): string
    {
        return $this->metaKey;
    }

    public function setMetaKey(string $metaKey): self
    {
        $this->metaKey = $metaKey;
        return $this;
    }

    // 🔹 Getter & Setter for Value
    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
