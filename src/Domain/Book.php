<?php

namespace Bookiii\Domain;

/**
 * This is a POPO of Book of our app
 */
class Book
{
  /**
  * Book id
  *
  * @var integer
  */
  private $id;

  /**
  * Book title
  *
  * @var string
  */
  private $title;

  /**
  * Book isbn
  *
  * @var integer
  */
  private $isbn;

  /**
  * Book summary
  *
  * @var string
  */
  private $summary;

  /**
  * Book author id
  *
  * @var integer
  */
  private $authorId;

  public function id ()
		{
			return $this->id;
		}

		public function setId ($id)
		{
			$id = (int) $id;

			if ($id > 0)
			{
				$this->id = $id;
			}
		}

		public function title ()
		{
			return $this->title;
		}

		public function setTitle ($title)
		{
			$this->title = $title;
		}

		public function isbn ()
		{
			return $this->isbn;
		}

		public function setIsbn ($isbn)
		{
			$this->isbn = $isbn;
		}

		public function summary ()
		{
			return $this->summary;
		}

		public function setSummary ($summary)
		{
			$this->summary = $summary;
		}

		public function author ()
		{
			return $this->authorId;
		}

		public function setAuthorId ($author)
		{
			$this->authorId = $author;
		}




}
