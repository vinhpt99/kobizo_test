<?php 

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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

    #[ORM\Column(type: 'string', length: 255)]
    private string $key;

    #[ORM\Column(type: 'text')]
    private string $value;

}
