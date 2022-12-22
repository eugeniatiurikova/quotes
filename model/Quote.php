<?php
require_once 'User.php';

class Quote
{
    private bool $archived = false;
//    private ?DateTimeInterface $dateCreated = null;
//    private ?DateTimeInterface $dateUpdated = null;
//    private ?DateTimeInterface $dateDone = null;
    private int $id;
    private ?string $user_name = null;
//    private array $comments = [];

    public function __construct(
        private ?string $user = null,
        private ?string $author = null,
        private ?string $description = null
    ) {
//    $this->dateCreated = $dateCreated ?? new DateTime();
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
//        $this->dateUpdated = new DateTime();
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
//        $this->dateUpdated = new DateTime();
//        $this->datedone = null;
        return $this;
    }

    public function markArchived(): self
    {
        $this->archived = true;
//        $this->dateUpdated = new DateTime();
//        $this->dateDone = new DateTime();
        return $this;
    }

    public function getUser(): string
    {
        return $this->user;
    }



//    public function getComments(): array
//    {
//        return $this->comments;
//    }
//
//    public function setComments(array $comments): self
//    {
//        $this->comments = $comments;
//        return $this;
//    }
//
//    public function getDateCreated(): DateTimeInterface
//    {
//        return $this->dateCreated;
//    }
//
//    public function getDateUpdated(): DateTimeInterface
//    {
//        return $this->dateUpdated;
//    }
//
//    public function getDateDone(): DateTimeInterface
//    {
//        return $this->dateDone;
//    }
}