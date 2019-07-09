<?php

namespace App\Entity;

class MenuTranslation
{
    private $id;
    private $menuId;
    private $langugaeId;
    private $translation;

    /**
     * Get the value of id
     */ 
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of menuId
     */ 
    public function getMenuId() : int
    {
        return $this->menuId;
    }

    /**
     * Set the value of menuId
     *
     * @return  self
     */ 
    public function setMenuId(int $menuId)
    {
        $this->menuId = $menuId;

        return $this;
    }

    /**
     * Get the value of langugaeId
     */ 
    public function getLangugaeId() : int
    {
        return $this->langugaeId;
    }

    /**
     * Set the value of langugaeId
     *
     * @return  self
     */ 
    public function setLangugaeId(int $langugaeId)
    {
        $this->langugaeId = $langugaeId;

        return $this;
    }

    /**
     * Get the value of translation
     */ 
    public function getTranslation() : string
    {
        return $this->translation;
    }

    /**
     * Set the value of translation
     *
     * @return  self
     */ 
    public function setTranslation(string $translation)
    {
        $this->translation = $translation;

        return $this;
    }
}