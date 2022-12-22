<?php

require_once 'User.php';
require_once 'exceptions/UserExistsException.php';

class UserProvider
{
//    private array $accounts = [
//      "admin" => '123'
//    ];
    private PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function registerUser(User $user, string $plainPassword): bool
    {
        $isExistedStatement = $this->pdo->prepare('SELECT id FROM users WHERE username = ?');
        $isExistedStatement->execute([$user->getUsername()]);
        if ($isExistedStatement->fetch()) {
            throw new UserExistsException("This username is already taken");
        }
        $statement = $this->pdo->prepare(
            'INSERT INTO users (id, name, username, password) VALUES (:id, :name, :username, :password)'
        );
        return $statement->execute([
            ':id' => rand(1,10000),
            ':name' => $user->getName(),
            ':username' => $user->getUsername(),
            ':password' => md5($plainPassword)
        ]);
    }

    public function getByUsernameAndPassword(string $username, string $password): ?User
    {
        $statement = $this->pdo->prepare(
            'SELECT * FROM users WHERE username = :username AND password = :password'
        );
        $statement->execute([
            ':username' => $username,
            ':password' => md5($password)
        ]);
        $request = $statement->fetchObject(User::class, [$username]) ?: null;
        return $request;
    }

    public static function getByUsername(string $username, PDO $pdo): ?User
    {
        $statement = $pdo->prepare(
            'SELECT * FROM users WHERE username = :username'
        );
        $statement->execute([
            ':username' => $username,
        ]);
        return $statement->fetchObject(User::class, [$username]) ?: null;;
    }
}