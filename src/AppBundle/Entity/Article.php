<?php

// src/AppBundle/Entity/Article.php
namespace AppBundle\Entity;


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
     * @ORM\Column(type="date")
     */
    protected $published;


}