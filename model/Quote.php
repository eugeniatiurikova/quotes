<?php
require_once 'User.php';

class Quote
{
    private bool $archived = false;
    private int $id;
    private ?string $user_name = null;

    public function __construct(
        private ?string $user = null,
        private ?string $author = null,
        private ?string $description = null
    ) {
    }


    public function getUserName(): ?string
    {
        return $this->user_name;
    }

    public function setUserName(?string $user_name): self
    {
        $this->user_name = $user_name;
        return $this;
    }


    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function archived(): bool
    {
        return $this->archived;
    }

    public function setArchived(bool $archived): self
    {
        $this->archived = $archived;
        return $this;
    }

    public function markActive(): self
    {
        $this->archived = false;
        return $this;
    }

    public function markArchived(): self
    {
        $this->archived = true;
        return $this;
    }

    public function getUser(): string
    {
        return $this->user;
    }

}