<!doctype html>
<html>
	<head>
			<title>Movie Store</title>
			<meta charset="utf-8">
	 		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	 		<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

			<!-- Optional theme -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	</head>
	<body>
		<div class="container">
			<?php
				$model = $_GET["controller"];
				$controllerName = $model."Controller";
				$method = $_GET["method"];
                require_once(dirname(__FILE__)."/../controllers/$controllerName.php");
				$controller = new $controllerName;


				if(method_exists($controller,$method))
				{
					if($method == 'add' and $model == "Movies")
					{
						require_once(dirname(__FILE__)."/../models/$model.php");
						$movie = new Movies($_POST["title"],$_POST["price"]);
						$controller->add($movie);

					}
					else if($method == "buy")
					{
						$controller->{$method}($_GET["id"]);
					}
					else $controller->{$method}();
				}
				else {
					header('HTTP/1.0 400 Invalid Request');
				}
			?>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>
