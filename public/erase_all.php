<?php
	/**
     * erase_all.php
     *
     * Second Home.
     *
     * Erases all categories and items.
     */
     
    // configuration
    require("../includes/config.php"); 

                
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("erase_category_form.php", ["title" => "erase category"]);
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST")            
	{   
        query ("DELETE FROM items WHERE id = ?;", $_SESSION["id"]);
        
        // redirect to portfolio
        redirect("/");
    }