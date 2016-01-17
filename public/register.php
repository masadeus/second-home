<?php
	/**
     * register.php
     *
     * Second Home
     *
     * Registers user and redirects to lists.
     */
     
    // configutation
    require("../includes/config.php");
    
    // if user reched page via GET
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // render form
        render("register_form.php", ["title" => "Register"]);
    }
    
    // else if user reached page via POST
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        // validate submission
        if (empty($_POST["house_name"]))
        {
            apologize("You must provide your house name.");
        }
        
        else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && $_POST["email"] != null)
        {
            apologize("You must provide a valid email address.");
        }
        
        if (!ctype_alnum($_POST["house_name"]))
        {
            apologize("The house name should consist of alphanumeric characters, you know... letters and numbers.");
        }
        
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
        
        else if (empty($_POST["confirmation"]))
        {
            apologize("You must confirm your password.");
        }
        
        if ($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Passwords don't match.");
        }
                
        // INSERT the new row for the new user in the data table.
        $rows = query("INSERT INTO houses (house_name, email, hash) VALUES(?, ?, ?)", $_POST["house_name"], $_POST["email"], password_hash($_POST["password"], PASSWORD_DEFAULT));
        
        // check username's uniqueness
        if ($rows === false)
        {
            apologize("This house name is already in use. Pick another one please");
        }
        
        // log user in
        $rows = query("SELECT LAST_INSERT_ID() AS id");
        $id = $rows[0]["id"];
        
        // remember that user's now logged in by storing user's ID in session
        $_SESSION["id"] = $id;

        // redirect to portfolio
        redirect("/");
    }
?>
