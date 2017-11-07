<?php
/**
 * Created by PhpStorm.
 * User: patrickclivaz
 * Date: 07.11.17
 * Time: 13:16
 */

header('Cache-control: private'); // Internet Explorer 6 fix

if(isSet($_GET['lang']))
{
    $lang = $_GET['lang'];

// register the session and set the cookie
    $_SESSION['lang'] = $lang;

    setcookie('lang', $lang, time() + (3600 * 24 * 30));
}
else if(isSet($_SESSION['lang']))
{
    $lang = $_SESSION['lang'];
}
else if(isSet($_COOKIE['lang']))
{
    $lang = $_COOKIE['lang'];
}
else
{
    $lang = 'default';
}

switch ($lang) {
    case 'default':
        $lang_file = 'default.php';
        break;

    case 'french':
        $lang_file = 'french.php';
        break;

    case 'german':
        $lang_file = 'german.php';
        break;

    default:
        $lang_file = 'default.php';

}

include_once '../languages/'.$lang_file;
?>