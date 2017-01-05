<?php
	require_once(dirname(__FILE__)."/../config/config.php");
	require_once(dirname(__FILE__)."/../models/Movies.php");
	require_once(dirname(__FILE__)."/../views/MoviesView.php");
	class MoviesController
	{
		private $db;
		public function __construct()
		{
			$this->db = mysqli_connect(DBServer,DBUSerName,DBPassword,DBName);
			if($this->db->connect_error)
			{
				die("Connection Failed".$this->db->connect_error);
			}
		}

		public function create()
		{
			MoviesView::input();
		}

		public function add($movie)
		{
			if(!$movie->isValid()) return false;

			$title = $movie->getTitle();
			$price = $movie->getPrice();
			$addStatement = $this->db->prepare("Insert into tbl_movie (id,title,price) values (NULL,?,?)");
			//echo $this->db->error;

			$addStatement->bind_param("si",$title,$price);

			if($addStatement->execute())
			{
				$movie->setId($this->db->insert_id);
				echo MoviesView::output($movie);
			}
			else
			{
				return false;
			}
		}

		public function buy($id)
		{
			$movie = $this->getById($id);
			if($movie != false)
			{
				makePayPalPayment($movie->getTitle(),$movie->getPrice());
			}
			else {
				//Show errro;
			}
		}
		public function getById($id)
		{
			$getStatement = $this->db->prepare("SELECT id,title,price from tbl_movie where id=?");
			$getStatement->bind_param($id);
			if($getStatement->execute())
			{
				$getStatement->bind_result($id,$title,$price);
				if($getStatement->fetch())
				{
					$movie = new Movies($title,$price,$id);
					return $movie;
				}
				else {
					return false;
				}
			}
		}

		public function get()
		{
			$html = "";
			$getStatement = $this->db->prepare("SELECT id,title,price from tbl_movie");
			if($getStatement->execute())
			{
				$getStatement->bind_result($id,$title,$price);
				while($getStatement->fetch())
				{
					$movie = new Movies($title,$price,$id);
					MoviesView::output($movie);
				}
			}
		}

	}
?>
