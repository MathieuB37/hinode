<?php

namespace App\Entity;

class Language
{

    const DB_TABLE_ID = [
        "name" => "id",
        "type" => "int",
        "minlength" => 1,
        "maxlength" => 11,
    ];

    const DB_TABLE_NAME = [
        "name" => "name",
        "type" => "string",
        "minlength" => 2,
        "maxlength" => 2,
    ];

    private $id;
    private $name;

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
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName(string $name): Language
    {
        $this->name = $name;

        return $this;
    }
}
