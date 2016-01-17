<?php

    /**
     * config.php
	 *
	 * Second Home
	 *
     * Configures pages.
     */

    // display errors, warnings, and notices
    ini_set("display_errors", true);
    error_reporting(E_ALL);

    // requirements
    require("constants.php");
    require("functions.php");

    // enable sessions
    session_start();

 	if (!in_array($_SERVER["PHP_SELF"], ["/public/login.php", "/public/logout.php", "/public/register.php"]))
    {
        if (empty($_SESSION["id"]))
        {
            redirect("/public/login.php");
        }
    }

?>
