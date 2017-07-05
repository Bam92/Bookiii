<?php

namespace Bookiii\Domain;

/**
 * This is a POPO of Book of our app
 */
class Author
{
  /**
  * Author id
  *
  * @var integer
  */
  private $id;

  /**
  * Author first name
  *
  * @var string
  */
  private $fName;

  /**
  * Book last name
  *
  * @var integer
  */
  private $lName;

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

		public function fName ()
		{
			return $this->fName;
		}

		public function setFName ($fName)
		{
			$this->fName = $fName;
		}

    public function lName ()
		{
			return $this->lName;
		}

		public function setLName ($lName)
		{
			$this->lName = $lName;
		}
}
