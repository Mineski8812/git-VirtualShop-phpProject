<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
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
    private $Name;

    /**
     * @ORM\Column(type="integer")
     */
    protected $blog_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Blog",inversedBy="article")
     * @ORM\JoinColumn(name="blog_id",referencedColumnName="id")
     */
    protected $blog;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBlogId()
    {
        return $this->blog_id;
    }

    /**
     * @param mixed $blog_id
     */
    public function setBlogId($blog_id): void
    {
        $this->blog_id = $blog_id;
    }

    /**
     * @return mixed
     */
    public function getBlog()
    {
        return $this->blog;
    }

    /**
     * @param mixed $blog
     */
    public function setBlog($blog): void
    {
        $this->blog = $blog;
    }
}
