<!DOCTYPE html>
<?php
include_once "../BLL/changeLanguage.php";
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
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center deep-orange-text"><?php echo $lang['NEW_BOOK'];?></h1>
        <br><br>
        <div class="header center">
            <button onclick="location.href='bookingAdd.php'" class="btn waves-effect waves-light orange" type="submit" name="submit"><?php echo $lang['SEARCH'];?>
                <i class="material-icons right">search</i>
            </button>
        </div>
    </div>
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
