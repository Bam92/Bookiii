<?php

namespace Bookiii\DAO;

use Doctrine\DBAL\Connection;
use Bookiii\Domain\Book;

class BookDAO extends DAO
{
  /**
  * @var \Bookiii\DAO|AuthorDAO
  */
  protected $authorDAO;

  public function setAuthorDAO(AuthorDAO $authorDAO) {
    $this->authorDAO = $authorDAO;
  }

  /**
     * Return a list of all books, sorted by date (most recent first).
     *
     * @return array A list of all books.
     */

    public function findBooks() {

        $sql = "select * from book order by book_id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $books = array();

        foreach ($result as $row) {
            $bookId = $row['book_id'];
            $books[$bookId] = $this->buildDomainObject($row);
        }
        return $books;
    }

    public function findBooksByAuthor($authorId) {
      // The associated author is retrieved only once
      $author = $this->authorDAO->find($authorId);
      // auth_id is not selected by the SQL query
      // The author won't be retrieved during domain object construction
      $sql = "SELECT * FROM book WHERE auth_id = ? ORDER BY book_id";
      $result = $this->getDb()->fetchAll($sql, arrray($authorId));

      // Convert query result to an array of domain objects
      $books = array();

      foreach ($result as $row) {
          $bookId = $row['book_id'];
          $books = $this->buildDomainObject($row);
          // The associated author is defined for the constructed book
          $book->setAuthor($author);
          $books[$bookId] = $book;
      }
      return $books;

    }

    // Find one book
    public function find($id) {

        $sql = "select * from book where book_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)

            return $this->buildDomainObject($row);
        else
            throw new \Exception("No book matching id " . $id);

    }

    /**
     * Creates a Book object based on a DB row.
     *
     * @param array $row The DB row containing Book data.
     * @return \Bookiii\Domain\Book
     */

    protected function buildDomainObject(array $row) {
        $book = new Book();
        $book->setId($row['book_id']);
        $book->setTitle($row['book_title']);
        $book->setSummary($row['book_summary']);
        $book->setIsbn($row['book_isbn']);
        //$book->setAuthor($row['auth_id']);

      if (array_key_exists('auth_id', $row)) {
          // Find and set the associated author
          $authorId = $row['auth_id'];
          $author = $this->authorDAO->find($authorId);
          $book->setAuthor($author);
        }
        return $book;

    }
}

/**
*
*
