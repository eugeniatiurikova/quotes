<?php
require_once 'UserProvider.php';
require_once 'model/Quote.php';
class QuoteService
{
    private array $quotes = [];
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getQuotes(): array
    {
        $statement = $this->pdo->prepare(
            'SELECT * FROM quotes WHERE deleted IS NULL'
        );
        $statement->execute([]);
        $result = $statement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Quote::class);
        $this->quotes = $result;
        $_SESSION['quote'] = $result;
        return $result;
    }

    public function getQuote(int $id): Quote
    {
        $statement = $this->pdo->prepare(
            'SELECT * FROM quotes WHERE id = :id'
        );
        $statement->execute([
            ':id' => $id
        ]);
        $tmp = $statement->fetch(PDO::FETCH_ASSOC);
        $quote = new Quote($tmp['user'], $tmp['author'], $tmp['description']);
        $quote->setId($tmp['id'])->setUserName($tmp['user_name'])->setArchived($tmp['archived']);
        return $quote;
    }

    public function getRandom(int $count): array
    {
        $arr = [];
        $keys = array_rand($this->quotes, $count);
        foreach ($keys as $key) {
            $arr[] = $this->quotes[$key];
        }
        return $arr;
    }

    public function getActual(): array
    {
        $arr = [];
        foreach ($this->quotes as $quote) {
            if (!$quote->archived()) $arr[] = $quote;
        }
        return $arr;
    }

    public function getUnimportant(): array
    {
        $arr = [];
        foreach ($this->quotes as $quote) {
            if ($quote->archived()) $arr[] = $quote;
        }
        return $arr;
    }

    public function setQuotes(array $quotes): void
    {
        $this->quotes = $quotes;
        $_SESSION['quote'] = $this->quotes;
    }

    public function addQuote(Quote $quote): bool
    {
        $this->quotes[] = $quote;
        $_SESSION['quote'][] = $quote;
        $statement = $this->pdo->prepare(
            'INSERT INTO quotes (id, author, user, user_name, description, archived) 
                    VALUES (:id, :author, :user, :user_name, :description, :archived)'
        );
        return $statement->execute([
            ':id' => $quote->getId(),
            ':author' => $quote->getAuthor(),
            ':user' => $quote->getUser(),
            ':user_name' => $quote->getUserName(),
            ':description' => $quote->getDescription(),
            ':archived' => $quote->archived() ? 1 : 0
        ]);
    }

    public function deleteQuote(int $id, string $user): bool
    {
        $statement = $this->pdo->prepare(
//            'DELETE FROM quotes WHERE id = :id AND user = :user'
            'UPDATE quotes SET deleted = 1 WHERE id = :id AND user = :user'
        );
        $result = $statement->execute([
            ':id' => $id,
            ':user' => $user
        ]);
        if ($statement->rowCount() == 0) {
            throw new NotThisUsersQuoteException('This quote was not added by ' . $user);
        }
        return $result;
    }

    public function markUnActual(int $id): bool
    {
        $statement = $this->pdo->prepare(
            'UPDATE quotes SET archived = 1 WHERE id = :id'
        );
        return $statement->execute([
            ':id' => $id
        ]);
    }

    public function markActual(int $id): bool
    {
        $statement = $this->pdo->prepare(
            'UPDATE quotes SET archived = 0 WHERE id = :id'
        );
        return $statement->execute([
            ':id' => $id
        ]);
    }
}