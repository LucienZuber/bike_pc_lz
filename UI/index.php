<!DOCTYPE html>
<?php
include_once "../BLL/changeLanguage.php";

//This is the index page

?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title><?php echo $lang['HOME'];?></title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
<?php include("menus.php");?>
<main>

    <div id="index-banner" class="parallax-container">
        <div class="section no-pad-bot">
            <div class="container">
                <br><br>
                <h1 class="header center lime-text"><?php echo $lang['NEW_BOOK'];?></h1>
                <div class="row center">
                    <button onclick="location.href='bookingAdd.php'" class="btn waves-effect waves-light orange" type="submit" name="submit"><?php echo $lang['SEARCH'];?>
                        <i class="material-icons right">search</i>
                    </button>
                </div>
                <br><br>

            </div>
        </div>
        <div class="parallax"><img src="../UI/Images/background1.jpg" alt="Unsplashed background img 1"></div>
    </div>


    <div class="container">
        <div class="section">

            <!--   Icon Section   -->
            <div class="row">
                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center brown-text"><i class="material-icons">flash_on</i></h2>
                        <h5 class="center"><?php echo $lang['HOME_FAST'];?></h5>

                        <p class="light"><?php echo $lang['HOME_FAST_TEXT'];?></p>
                    </div>
                </div>

                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center brown-text"><i class="material-icons">group</i></h2>
                        <h5 class="center"><?php echo $lang['HOME_GROUP'];?></h5>

                        <p class="light"><?php echo $lang['HOME_GROUP_TEXT'];?></p>
                    </div>
                </div>

                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center brown-text"><i class="material-icons">settings</i></h2>
                        <h5 class="center"><?php echo $lang['HOME_CONTACT'];?></h5>

                        <p class="light"><?php echo $lang['HOME_CONTACT_TEXT'];?></p>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="parallax-container valign-wrapper">
        <div class="parallax"><img src="../UI/Images/background2.jpg" alt="Unsplashed background img 2"></div>
    </div>



</main>
<?php include("footer.php"); ?>

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="../js/init.js"></script>
<script src="../js/autocompleteCFF.js"></script>
<script src="../js/datepicker.js"></script>

</body>
</html>
