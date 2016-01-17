<?php
	/**
     * edit_item.php
     *
     * Second Home
     *
     * Edits item and outputs a JSON object.
     */
     
	// configuration
	require("../includes/config.php");
	
	$url = $_SERVER['REQUEST_URI'];
	
	$q = explode('?', $url);
	
	$pair = explode('&', $q[1]);
	
	$categ_casi = explode('=', $pair[0]);
	
	$category = htmlentities(urldecode($categ_casi[1]));
	
	$quantity_casi = explode('=', $pair[1]);
	
	$quantity = $quantity_casi[1];
	
	$item_casi = explode('=', $pair[2]);
	
	$item = htmlentities(urldecode($item_casi[1]));
	
	$prev_item_casi = explode('=', $pair[3]);
	
	$prev_item = htmlentities(urldecode($prev_item_casi[1]));
	
	// acutes
	$category === mb_strtolower($category);
	$item = mb_strtolower($item);
	
	if (empty($quantity) && $quantity != 0)
	{
		apologize("You must enter a quantity.");
	}
	
	else if (empty($item))
		{
			apologize("You must enter an item.");
		}
	
	else
	{
		query ("UPDATE items SET quantity = ? WHERE id = ? AND category = ? AND item = ?;"
			, $quantity, $_SESSION["id"], $category, $item);
	
	
		/* in case item needs to be edited
		else {
			// var_dump("NOT EQUAL");
	
			query ("DELETE FROM items WHERE id = ? AND category=? AND item = ?;"
				, $_SESSION["id"], $category, $prev_item);
	
			query ("INSERT INTO items (id, item, quantity, category) VALUES(?, ?, ?, ?)
				ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity);"
				, $_SESSION["id"], $item, $quantity, $category);
	
		}
		*/
	
		// ++++++++++++++++++++ Output json object +++++++++++++++++++++++++++++++++
	
	
		// OPTIONAL, would be faster no to query
		// make the query
		$new_values = query("SELECT item, quantity, category FROM items WHERE id = ? AND category = ? AND item=?;", $_SESSION["id"], $category, $item);
	
		// output places as JSON (pretty-printed for debugging convenience)
		header("Content-type: application/json");
		print(json_encode($new_values, JSON_PRETTY_PRINT));
	
		// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
		// redirect to portfolio
		// redirect("/");
	}

?>