<?php
	/**
     * erase_category.php
     *
     * Second Home
     *
     * Erases category and outputs a JSON object.
     */
     
    // configuration
    require("../includes/config.php");
    
    $url = $_SERVER['REQUEST_URI'];
    
    //var_dump($url);
    
    $q = explode("?", $url);
    
    $category = explode('=', $q[1]);
    
    $category = htmlentities(urldecode($category[1]));
    
	 // so that it doesn't get tricky with the accents     
    $category = mb_strtolower($category);
        
    $deleted_category = query ("DELETE FROM items WHERE id = ? AND category = ?;", $_SESSION["id"], $category);
	
	// output places as JSON (pretty-printed for debugging convenience)
    header("Content-type: application/json");
    print(json_encode($deleted_category, JSON_PRETTY_PRINT));             
?>
