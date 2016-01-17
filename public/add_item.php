<?php
	/**
     * add_item.php
     *
     * Second Home
     *
     * Adds item to DB and outputs a JSON object.
     */
     
	// configuration
	require("../includes/config.php");
	
	$url = $_SERVER['REQUEST_URI'];
	
	$q = explode('?', $url);
	
	$pair = explode('&', $q[1]);
	
	$categ_casi = explode('=', $pair[0]);
	
	$category = strtolower(htmlentities(urldecode($categ_casi[1])));
	
	$quantity_casi = explode('=', $pair[1]);
	
	$quantity = $quantity_casi[1];
	
	$item_casi = explode('=', $pair[2]);
	
	$item = htmlentities(urldecode($item_casi[1]));
	
	if (empty($quantity))
		{
			$quantity = 0;
		}
		
	if (empty($item))
		{
			apologize("You must enter an item.");
		}
	
	
		// all good with acutes
		$category === mb_strtolower($category);
		$item = mb_strtolower($item);
	
		query ("INSERT INTO items (id, item, quantity, category) VALUES(?, ?, ?, ?)
	        ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity);"
			, $_SESSION["id"], $item, $quantity, $category);
	
	
		// ++++++++++++++++++++ Output json object +++++++++++++++++++++++++++++++++
	
		// make the query
		$new_category = query("SELECT item, quantity, category FROM items WHERE id = ? AND category = ? AND item=?;", $_SESSION["id"], $category, $item);
	
		// output places as JSON (pretty-printed for debugging convenience)
		header("Content-type: application/json");
		print(json_encode($new_category, JSON_PRETTY_PRINT));
	
		// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

		// redirect to portfolio
		// redirect("/");
?>