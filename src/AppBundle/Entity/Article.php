<?php

// src/AppBundle/Entity/Article.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="article")
 *
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",length=200)
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=300)
     */
    protected $url_alias;

    /**
     * @ORM\Column(type="text")
     */
    protected $content;

    /**
     * @ORM\Column(type="datetimetz")
     */
    protected $published;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set urlAlias
     *
     * @param string $urlAlias
     *
     * @return Article
     */
    public function setUrlAlias($urlAlias)
    {
        $this->url_alias = $urlAlias;

        return $this;
    }

    /**
     * Get urlAlias
     *
     * @return string
     */
    public function getUrlAlias()
    {
        return $this->url_alias;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set published
     *
     * @param \DateTime $published
     *
     * @return Article
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return \DateTime
     */
    public function getPublished()
    {
        return $this->published;
    }
}
