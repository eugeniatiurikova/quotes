<?php
class User
{
    private string $username;
    private string $name;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    // Сделаем методы получения и установки свойств
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