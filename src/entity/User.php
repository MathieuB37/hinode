<?php

namespace App\Entity;

class User
{
    // DataBase Table Names
    const DB_TABLE_ID = [
        "name" => "id",
        "type" => "int",
        "minlength" => 1,
        "maxlength" => 11,
    ];
    const DB_TABLE_LOGIN = [
        "name" => "login",
        "type" => "string",
        "minlength" => 6,
        "maxlength" => 16,
    ];
    const DB_TABLE_PASSWORD = [
        "name" => "password",
        "type" => "string",
        "minlength" => 6,
        "maxlength" => 255,
    ];
    const DB_TABLE_EMAIL = [
        "name" => "email",
        "type" => "string",
        "minlength" => 6,
        "maxlength" => 60,
    ];
    const DB_TABLE_FIRST_NAME = [
        "name" => "first_name",
        "type" => "string",
        "minlength" => 6,
        "maxlength" => 60,
    ];
    const DB_TABLE_LAST_NAME = [
        "name" => "last_name",
        "type" => "string",
        "minlength" => 6,
        "maxlength" => 60,
    ];

    // Class Attributes
    private $id;
    private $login;
    private $password;
    private $email;
    private $firstName;
    private $lastName;

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
     * Get the value of login
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @return  self
     */
    public function setLogin(string $login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of firstName
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }
}
