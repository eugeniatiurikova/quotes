<?php
require_once 'User.php';

class Quote
{
    private bool $isDone = false;
    private ?DateTimeInterface $dateCreated = null;
    private ?DateTimeInterface $dateUpdated = null;
    private ?DateTimeInterface $dateDone = null;
    private int $priority = 1;
    private array $comments = [];

    public function __construct(
        private int $key,
        private User $user,
        private string $description
    ) {
    $this->dateCreated = $dateCreated ?? new DateTime();
    }

    public function getKey(): int
    {
        return $this->key;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
        $this->dateUpdated = new DateTime();
    }

    public function isDone(): bool
    {
        return $this->isDone;
    }

    public function markAsUndone(): void
    {
        $this->isDone = false;
        $this->dateUpdated = new DateTime();
        $this->dateDone = null;
    }

    public function markAsDone(): void
    {
        $this->isDone = true;
        $this->dateUpdated = new DateTime();
        $this->dateDone = new DateTime();
    }

    public function getDateCreated(): DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function getDateUpdated(): DateTimeInterface
    {
        return $this->dateUpdated;
    }

    public function getDateDone(): DateTimeInterface
    {
        return $this->dateDone;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getComments(): array
    {
        return $this->comments;
    }

    public function setComments(array $comments): void
    {
        $this->comments = $comments;
    }

}