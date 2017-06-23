<?php

namespace Bookiii\DAO;

use Doctrine\DBAL\Connection;
use Bookiii\Domain\Book;

class BookDAO
{
  /**
  * Database Connexion
  *
  * @var \Doctrine\DBAL\Connection
  */
  private $db;

  /**
  * Constructor
  *
  * @param \Doctrine\DBAL\Connection The db connection object
  */
  public function __construct(Connection $db) {
    $this->db = $db;
  }

  public function getDb() {
    return $this->db;
  }
  /**
     * Return a list of all books, sorted by date (most recent first).
     *
     * @return array A list of all books.
     */

    public function findBooks() {

        $sql = "select * from book order by book_id desc";
        $result = $this->db->fetchAll($sql);

        // Convert query result to an array of domain objects
        $books = array();

        foreach ($result as $row) {
            $bookId = $row['book_id'];
            $books[$bookId] = $this->buildBook($row);
        }
        return $books;
    }

    /**
     * Creates a Book object based on a DB row.
     *
     * @param array $row The DB row containing Book data.
     * @return \Bookiii\Domain\Book
     */

    private function buildBook(array $row) {
        $book = new Book();
        $book->setId($row['book_id']);
        $book->setTitle($row['book_title']);
        $book->setSummary($row['book_summary']);
        $book->setIsbn($row['book_isbn']);
        $book->setAuthorId($row['auth_id']);

        return $book;

    }
}

/**
*
*
