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

    <!-- grid system -->
    <link rel="stylesheet" type="text/css" href="/public/css/vendors/grid.css">

    <!-- http://jquery.com/ -->
    <script src="/public/js/jquery-1.11.1.min.js"></script>
    <!-- <script src="http://code.jquery.com/jquery-latest.min.js"></script> -->

    <!-- google fonts -->
    <link href='https://fonts.googleapis.com/css?family=Lato:300,100,300italic,400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="/public/css/styles_login.css" rel="stylesheet" />

    <!-- media queries -->
    <link rel="stylesheet" type="text/css" href="/public/css/queries.css">

    <!-- app's own js -->
    <script src="/public/js/scripts.js"></script>

    <title>Second Home: login</title>
</head>
<body>
    <header>
        <div id="top" class="header">
            <a href="/"><h1>Second<br>Home</h1></a>
        </div>
        <div class="img_login">
            <form action="login.php" method="post" class="form-group" onsubmit="return check_form_login(this);">
                <fieldset>
                    <div>
                        <input autofocus class="form-control" name="username" placeholder="Enter your house name" type="text" required/>
                    </div>
                    <div>
                        <input class="form-control" name="password" placeholder="Password" type="password" required/>
                    </div>
                    <div>
                        <button type="submit" class="btn-sub">Log In</button>
                    </div>
                </fieldset>
            </form>
            <div class="extra"> or <a href="#register">sign up</a> for a new account
            </div>
            <div class="chevron">
                <a href="#register"><i class="ion-chevron-down"></i></a>
            </div>
        </div>
    </header>
    <section class="section-features">
        <div class="row">
            <h2>List sharing made easy</h2>
            <p class="long-copy">
                Second home helps you keeping track of the items you have in whatever space you are using to temporally live, work, study or play. If you are into lists
                <i>Second House</i> is your thing. It comes specially handy for the following cases:
                <p>
        </div>
        <div class="row">
            <div class="col span-1-of-3 box">
                <h3><i class="ion-home icon-big"></i>
                    vacation house</h3>
                <p>
                    Allow all the members of the family or friends know what is already there and what needs to be bought before they get there.
                </p>
            </div>

            <div class="col span-1-of-3 box">
                <h3><i class="ion-ios-people icon-big"></i>
                    Shared house</h3>
                <p>
                    Whether it is a shared house or a student dorm all roommates can create and edit lists on the server. And forget about the fridge notes ;)
                </p>
            </div>

            <div class="col span-1-of-3 box">
                <h3><i class="ion-plane icon-big"></i>
                    Working abroad</h3>
                <p>
                    No need to be in a shared household to take full advantage of <i>Second House</i>, second house provides a fast way to what you are storing in your city apartment or weekend house.
                </p>
            </div>
        </div>
    </section>
    <section class="section-register">
        <div class="row">
            <h4>JUST TRY IT, IT'S FREE.</h4>
            <form id="register" action="register.php" method="post" onsubmit="return check_form_reg(this);">
                <div class="form-group">
                    <input class="form-control" name="email" placeholder="email (optional)" type="text" />
                </div>

                <div class="form-group">
                    <input class="form-control" name="house_name" placeholder="house name" type="text" required/>
                </div>
                <!--<input type="password" style="display:none">-->
                <div class="form-group">
                    <input class="form-control" id="pass-reg" name="password" placeholder="password" type="password" required/>
                </div>
                <div class="form-group">
                    <input class="form-control" id="pass-reg-conf" name="confirmation" placeholder="confirmation" type="password" required/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-sub">Sign up *</button>
                </div>
            </form>
        </div>
    </section>
    <footer id="bottom" class="f_login">

        <p>
            *Second House database can be erased anytime, for this is just my <a href="https://www.edx.org/course/introduction-computer-science-harvardx-cs50x" target="_blank">CS50</a> project. If you think that you could use it or want to give me feedback, I will be glad to <a href="mailto:almaslac@gmail.com?Subject=Second%20House">hear about it</a>.
        </p>
        <p class="copyright">
            Copyright &#169; Albert Mas Lacarra 2015.
        </p>
    </footer>
</body>
</html>