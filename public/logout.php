<?php
	/**
     * logout.php
     *
     * Second Home
     *
     * Logs user out.
     */
     
    // configuration
    require("../includes/config.php"); 

    // log out current user, if any
    logout();

    // redirect user
    redirect("/");

?>
