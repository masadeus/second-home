<?php
	/**
     * login.php
     *
     * Second Home
     *
     * Queries categories and outputs JSON object.
     */
     
    // configuration
    require("../includes/config.php"); 
       
    $categories_dirt = query("SELECT category FROM items WHERE id = ?;", $_SESSION["id"]);
	
	$categories_clean = [];
	
	foreach ($categories_dirt as $category)
	{
    	if(in_array($category, $categories_clean) === false) 
		{
    		array_push($categories_clean, $category);
    	}	  
	}
	
	sort($categories_clean);
		
	// ++++++++++++++++++++ Output json object +++++++++++++++++++++++++++++++++


	// output places as JSON (pretty-printed for debugging convenience)
	header("Content-type: application/json");
	print(json_encode(	$categories_clean, JSON_PRETTY_PRINT));

	// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	// redirect to portfolio
	// redirect("/");
?>
		