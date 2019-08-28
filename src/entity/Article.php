<?php

namespace App\Entity;

class Article
{
    // Database column name :
    private $columns;
    // Object attributes :
    private $id;
    private $createdBy;
    private $createdAt;
    private $modifiedBy;
    private $modifiedAt;

    public function __construct()
    {
        $this->columns = [
            "id" => "id",
            "createdBy" => "created_by",
            "createdAt" => "created_at",
            "modifiedBy" => "modified_by",
            "modifiedAt" => "modified_at",
        ];
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

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
    public function setId(int $id): Article
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of createdBy
     */
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    /**
     * Set the value of createdBy
     *
     * @return  self
     */
    public function setCreatedBy(int $createdBy): Article
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */
    public function setCreatedAt(\DateTime $createdAt = null): Article
    {
        if (empty($createdAt)) {
            $this->createdAt = new \DateTime();
        } else {
            $this->createdAt = $createdAt;
        }
        return $this;
    }

    /**
     * Get the value of modifiedBy
     */
    public function getModifiedBy(): ?int
    {
        return $this->modifiedBy;
    }

    /**
     * Set the value of modifiedBy
     *
     * @return  self
     */
    public function setModifiedBy(?int $modifiedBy): Article
    {
        $this->modifiedBy = $modifiedBy;
        return $this;
    }

    /**
     * Get the value of modifiedAt
     */
    public function getModifiedAt(): ?\DateTime
    {
        return $this->modifiedAt;
    }

    /**
     * Set the value of modifiedAt
     *
     * @return  self
     */
    public function setModifiedAt(?\DateTime $modifiedAt): Article
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }
}
