<?php
	/**
     * index.php
     *
     * Second Home
     */
     
    // configuration
    require("../includes/config.php"); 
    
	// get the data for one user 
    $rows = query("SELECT item, quantity, category FROM items WHERE id = ?;", $_SESSION["id"]);
    
    if ($rows === false)
    {
        apologize("No items found for this house");
    }
    
    // so far $rows carries all the info
    
    else
    {
        $positions = [];

        // assign a new variable $row to each element of $rows
        foreach ($rows as $row)
        {
	        
	        $positions[] = [
	            "item" => $row["item"],
	            "quantity" => $row["quantity"],
	            "category" => $row["category"]
	        ];
        }

        // build array of categories
        $categories = [];
		
		foreach ($positions as $position)
		{
			// turn it non case sensitive
			$position["category"] = mb_strtolower($position["category"]);
			
			if(in_array($position["category"], $categories) === false) 
			{
		    	$categories[] = $position["category"];	  
			}
		}

		// sort alphabeticaly
		sort($categories);

        $positions_sort = [];
        
        // sort the array by categories
        for($i = 0; $i < count($categories); $i++)
        {
	        foreach ($positions as $position)
	        {
		        if($position["category"] === $categories[$i])
		        {
			        array_push($positions_sort, $position);;
		        }
	        }
        }
        
        // query house name for the header title
        $title = query("SELECT house_name FROM houses WHERE id = ?;", $_SESSION["id"]);
        
        // ...aaand action!!
        render_categories("portfolio.php", ["title" => $title[0]["house_name"], "positions" => $positions_sort], $categories);
    }

?>


