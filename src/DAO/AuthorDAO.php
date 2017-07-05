<?php

namespace Bookiii\DAO;

use Doctrine\DBAL\Connection;
use Bookiii\Domain\Author;

class AuthorDAO extends DAO
{
  /**
     * Return a list of all books, sorted by date (most recent first).
     *
     * @return array A list of all books.
     */

    public function find ($auth_id) {

        $sql = "select * from author where auth_id = ?";
        $row = $this->getDb()->fetchAssoc($sql, array($auth_id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No author matching id " . $auth_id);
    }

    /**
     * Creates a Book object based on a DB row.
     *
     * @param array $row The DB row containing Book data.
     * @return \Bookiii\Domain\Book
     */

    protected function buildDomainObject(array $row) {
        $author = new Author();
        $author->setId($row['auth_id']);
        $author->setFName($row['auth_first_name']);
        $author->setLName($row['auth_last_name']);

        return $author;

    }
}

/**
*
*
