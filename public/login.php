<?php
	/**
     * login.php
     *
     * Second Home
     *
     * Logs user in.
     */
     
    // configuration
    require("../includes/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        redirect("login_form.php");
    }
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {	
	    $_POST["username"] = trim($_POST["username"]);
	    
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide a house name.");
        }
        
        if (!ctype_alnum($_POST["username"]))
        {
            apologize("The house name should consist of alphanumeric characters, you know... letters and numbers.");
        }
        
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }

        // query database for user
        $rows = query("SELECT * FROM houses WHERE house_name = ?", $_POST["username"]);

        // if we found user, check password
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];

            // compare hash of user's input against hash that's in database
            if (crypt($_POST["password"], $row["hash"]) == $row["hash"])
            {
                // remember that user's now logged in by storing user's ID in session
                $_SESSION["id"] = $row["id"];

                // redirect to portfolio
                redirect("/");
            }
        }

        // else apologize
        apologize("Invalid housename and/or password.");
    }

?>
