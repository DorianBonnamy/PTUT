<?php

namespace DUT\Models;

class Article
{
    protected $id;
    protected $titre;
    protected $texte;
    protected $image;

    public function __construct($titre, $texte, $image){
        $this->titre = $titre;
        $this->texte=$texte;
        $this->image=$image;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getTexte()
    {
        return $this->texte;
    }

    public function getImage()
    {
        return $this->image;
    }
}