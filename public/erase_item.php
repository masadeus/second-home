<?php
	/**
     * erase_item.php
     *
     * Second Home
     *
     * Erases item and outputs a JSON object.
     */
     
    // configuration
    require("../includes/config.php"); 
    
    $url = $_SERVER['REQUEST_URI'];

    $q = explode('?', $url);
    
    $pair = explode('&', $q[1]);
    
    $categ_casi = explode('=', $pair[0]);
    
    $category = htmlentities(urldecode($categ_casi[1]));
    
    $item_casi = explode('=', $pair[1]);
    
    $item = htmlentities(urldecode($item_casi[1]));
    
	 // acutes    
    $item = mb_strtolower($item);
        
    $deleted_item = query ("DELETE FROM items WHERE id = ? AND category=? AND item = ?;", $_SESSION["id"], $category, $item);
    
    // if a item is repeated in two categories it is only erased in the queried one.
    // this way is better and any remaining problem shoud be solved by cheching duplicates when inserting items. 
    
	 // output places as JSON (pretty-printed for debugging convenience)
    header("Content-type: application/json");
    print(json_encode($deleted_item, JSON_PRETTY_PRINT));          
?>
