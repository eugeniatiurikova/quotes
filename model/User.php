<?php
class User
{
    private string $username;
    private string $name;
    private int $id;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
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

}
//
//class User
//{
//    public function __construct(
//        private string $username,
//        private ?string $name = null,
//        private ?int $age = null,
//) {
//    }
//
//    public function getUsername(): string
//    {
//        return $this->username;
//    }
//
//    public function getName(): string
//    {
//        return $this->name ?? 'Undefined';
//    }
//
//    public function setName(string $name): self
//    {
//        $this->name = $name;
//        return $this;
//    }
//
//
//    public function getAge(): int
//    {
//        return $this->age;
//    }
//
//    public function setAge(?int $age): self
//    {
//        if ($age === null) {
//            $this->age = null;
//        } elseif ($age > 0 && $age <= 125) {
//            $this->age = $age;
//        }
//        return $this;
//    }
//
//}