<?php
	/**
     * add_category.php
     *
     * Second Home
     *
     * Adds category to DB and outputs a JSON object.
     */
     
    // configuration
    require("../includes/config.php"); 
    
    $url = $_SERVER['REQUEST_URI'];
    
    $q = explode("?", $url);
    
    $category = explode('=', $q[1]);
    
    $category = htmlentities(urldecode($category[1]));
    
    if (empty($category) || $category === "New category")
    {
        apologize("You must select a category.");
    }
            
    else
    {      
        $item = "empty";
        $quantity = 0;
        
        query ("INSERT INTO items (id, item, quantity, category) VALUES(?, ?, ?, ?);", $_SESSION["id"], $item, $quantity, $category);
        
		// ++++++++++++++++++++ Output json object +++++++++++++++++++++++++++++++++
			
            // make the query
		    $new_category = query("SELECT category FROM items WHERE id = ? AND category = ?;", $_SESSION["id"], $category);
		    
		    // output places as JSON (pretty-printed for debugging convenience)
		    header("Content-type: application/json");
		    print(json_encode($new_category, JSON_PRETTY_PRINT));
            
        // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            
            
        // redirect to portfolio
        // redirect("/");
    }   
?>