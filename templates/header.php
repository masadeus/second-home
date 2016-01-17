<!DOCTYPE html>
<html>
    <head>  
	    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
		
		<!-- CSS reset -->
        <link rel="stylesheet" type="text/css" href="/public/css/vendors/normalize.css">
        
		<!-- so that small devices don't zoom out the website -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
        <link rel="stylesheet" type="text/css" href="/public/css/vendors/ionicons.min.css">
        
        <!-- get jQuery -->
        <!-- http://jquery.com/ -->
        <script src="/public/js/jquery-1.11.1.min.js"></script>
        <!-- <script src="http://code.jquery.com/jquery-latest.min.js"></script> -->	
        
        <!-- google fonts -->
        <link href='https://fonts.googleapis.com/css?family=Lato:300,100,300italic,400' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        
        <!-- styles -->
        <link href="/public/css/styles.css" rel="stylesheet"/>
        
        <!-- media queries -->
        <link rel="stylesheet" type="text/css" href="/public/css/queries.css">
        
        <!-- app's own js -->
        <script src="/public/js/scripts.js"></script>

        <?php if (isset($title)): ?>
            <title>Second Home: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Second Home</title>
        <?php endif ?>
    </head>
    <body>
		<nav class="nav_elts">
			<ul>				
				<li>
					<a href="logout.php" id="logout">Logout</a>
				</li>
			</ul>
		</nav>
        <div class="container">
            <div id="top">
                <a href="/"><h1>Second Home</h1></a>
            </div>
            <div id="middle">
