<?php

class QuoteService
{
    private array $quotes = [];

    public function __construct()
    {
        $this->quotes = $_SESSION['quote'] ?? [];
    }

    public static function addComment(User $author, Quote $quote, string $text): void
    {
        $arr = $quote->getComments();
        $newComment = new Comment(
            $author,
            $quote,
            $text
        );
        $arr[] = $newComment;
        $quote->setComments($arr);
    }

    public function getQuotes(): array
    {
        return $this->quotes;
    }

    public function getActual(): array
    {
        $arr = [];
        foreach ($this->quotes as $quote) {
            if (!$quote->isDone()) $arr[] = $quote;
        }
        return $arr;
//        return array_map(function (Quote $quote) {
//           return !$quote->isDone() ?: $quote;
//        }, $this->quotes);
    }

    public function getUnimportant(): array
    {
        $arr = [];
        foreach ($this->quotes as $quote) {
            if ($quote->isDone()) $arr[] = $quote;
        }
        return $arr;
    }

    public function setQuotes(array $quotes): void
    {
        $this->quotes = $quotes;
        $_SESSION['quote'] = $this->quotes;
    }

    public function addQuote(Quote $quote): void
    {
        $this->quotes[] = $quote;
        $_SESSION['quote'][] = $quote;
    }

    public function deleteQuote(int $key): void
    {
        foreach($this->quotes as $ind => $quote){
            if ($quote->getKey() === $key){
                unset($this->quotes[$ind]);
                unset($_SESSION['quote'][$ind]);
            }
        }
    }

    public function markUnActual(int $key): void
    {
        foreach ($this->quotes as $quote) {
            if ($quote->getKey() === $key) $quote->markAsDone();
        }
        $_SESSION['quote'] = $this->quotes;
    }

    public function markActual(int $key): void
    {
        foreach ($this->quotes as $quote) {
            if ($quote->getKey() === $key) $quote->markAsUndone();
        }
        $_SESSION['quote'] = $this->quotes;
    }
}