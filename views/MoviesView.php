<?php
require_once dirname(__FILE__)."/../config/config.php";

class MoviesView
{
	public static function output($movie)
	{
		echo '<div class="col-md-3"><div class="card card-block">
		<h4 class="card-title">'.$movie->getTitle().'</h4>
		<p class="card-text">'.$movie->getPrice().'</p>
		<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <!-- Identify your business so that you can collect the payments. -->
        <input type="hidden" name="business" value="'.ClientEmail.'">

        <!-- Specify a Buy Now button. -->
        <input type="hidden" name="cmd" value="_xclick">

        <!-- Specify details about the item that buyers will purchase. -->
        <input type="hidden" name="item_name" value="'.$movie->getTitle().'">
        <input type="hidden" name="item_number" value="'.$movie->getId().'">
        <input type="hidden" name="amount" value="'.$movie->getPrice().'">
        <input type="hidden" name="currency_code" value="USD">

        <!-- Specify URLs -->
        <input type="hidden" name="cancel_return" value="http://localhost/paypal/cancel.php">
        <input type="hidden" name="return" value="http://localhost/paypal/success.php">

        <!-- Display the payment button. -->
        <input type="image" name="submit" border="0"
        src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
        <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
    </form>
		';
	}
	public static function input()
	{
		echo '<form action="add" method="post">
		  <div class="form-group">
		    <label for="Title">Title:</label>
		    <input type="text" class="form-control" name="title" id="Title">
		  </div>
		  <div class="form-group">
		    <label for="price">Price</label>
		    <input type="text" class="form-control" name="price" id="price">
		  </div>
		  <button type="submit" class="btn btn-default">Submit</button>
		</form>';
	}
}
?>
