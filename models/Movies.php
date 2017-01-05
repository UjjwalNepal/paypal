<?php
class Movies{
	private $id;
	private $title;
	private $price;
	public function __construct($title,$price,$id = NULL)
	 {
    $this->title = $title;
		$this->id = $id;
		$this->price = $price;
  }
	public function getId()
	{
		return $this->id;
	}
	public function getTitle()
	{
		return $this->title;
	}
	public function getPrice()
	{
		return $this->price;
	}
	public function isValid()
	{
		return ($this->title != "") and ($this->price > 0);
	}
	public function setId($id)
	{
		$this->id = $id;
	}
}
 ?>
