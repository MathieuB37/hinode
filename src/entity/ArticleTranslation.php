<?php

namespace App\Entity;

class ArticleTranslation
{

    private $id;
    private $articleId;
    private $languageId;
    private $title;
    private $content;

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId(int $id): ArticleTranslation
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of articleId
     */
    public function getArticleId(): int
    {
        return $this->articleId;
    }

    /**
     * Set the value of articleId
     *
     * @return  self
     */
    public function setArticleId($articleId): ArticleTranslation
    {
        $this->articleId = $articleId;

        return $this;
    }

    /**
     * Get the value of languageId
     */
    public function getLanguageId(): int
    {
        return $this->languageId;
    }

    /**
     * Set the value of languageId
     *
     * @return  self
     */
    public function setLanguageId(int $languageId): ArticleTranslation
    {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle(string $title): ArticleTranslation
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */
    public function setContent(string $content): ArticleTranslation
    {
        $this->content = $content;

        return $this;
    }
}
