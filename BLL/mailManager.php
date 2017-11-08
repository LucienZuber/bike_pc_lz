<?php
/**
 * Created by PhpStorm.
 * User: uadmin
 * Date: 07.11.2017
 * Time: 16:17
 */
require_once '../_lib/Exception.php';
require_once '../_lib/PHPMailer.php';
require_once '../_lib/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//this class use phpmailer to send an email
class MailManager
{
    //the structure of the mail
    function sendMailBookings($subject, $intro, $to, $sender, $nbBikes, $email, $startStation, $endStation, $startDate, $endDate, $phone, $token = '-')
    {
        $mail = $this->initializePHPMailer('resabikepclz@gmail.com', $to, 'Confimation/Bestätigung');
        $mail->Body = '
        <p>Thank you for using our reservation system. Here is your confirmation:</p>
        <ul>
            <li>Name : ' . $sender . '</li>
            <li>Phone: ' . $phone . '</li>
            <li>Mail: ' . $email . '</li>
            <li>Number of Bikes: ' . $nbBikes . '</li>
            <li>Departure: ' . $startStation . '</li>
            <li>Arrival: ' . $endStation . '</li>
            <li>Departure Time: ' . $startDate . '</li>
            <li>Arrival Time: ' . $endDate . '</li>
        </ul>
        <p>If you want to cancel your booking, simply send an email to resabikepclz@gmail.com.</p>
        
        <p>---------------------------------------------------------------------------------------------------------</p>
        
        <p>Merci d\'avoir utilisé notre système de réservation. Voici votre confirmation :</p>
            <ul>
            <li>Nom : ' . $sender . '</li>
            <li>Téléphone : ' . $phone . '</li>
            <li>Mail : ' . $email . '</li>
            <li>Nombre de vélos : ' . $nbBikes . '</li>
            <li>Départ : ' . $startStation . '</li>
            <li>Arrivéee : ' . $endStation . '</li>
            <li>Heure de départ: ' . $startDate . '</li>
            <li>Heure d\'arrivée: ' . $endDate . '</li>

        </ul>
        <p>Si vous désirez annuler votre réservation, il vous suffit d\'envoyer un mail à resabikepclz@gmail.com.</p>
        
        <p>---------------------------------------------------------------------------------------------------------</p>
        
        <p>Vielen Dank für die Verwendung unseres Reservierungssystem. Hier ist Ihre Bestätigung :</p>
            <ul>
            <li>Name : ' . $sender . '</li>
            <li>Telefon : ' . $phone . '</li>
            <li>Mail: ' . $email . '</li>
            <li>Anzahl Fahrräder : ' . $nbBikes . '</li>
            <li>Abreise : ' . $startStation . '</li>
            <li>Ankunft : ' . $endStation . '</li>
            <li>Abreise Zeit : ' . $startDate . '</li>
            <li>Ankunftszeit : ' . $endDate . '</li>
        </ul>
        <p>Wenn Sie Ihre Buchung stornieren möchten, senden Sie einfach eine e-Mail an resabikepclz@gmail.com.</p>';

        $this->sendMail($mail);
        $mail->SmtpClose();
        unset($mail);
    }

    //This function send the mail
    function sendMail($mail)
    {
        if (!$mail->Send()) // Teste le return code de la fonction
            echo $mail->ErrorInfo; // Affiche le message d'erreur
    }
    //This function prepare the headers of the mail
    function initializePHPMailer($from, $to, $subject)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; // or 465
        $mail->Username = "resabikepclz@gmail.com";
        $mail->Password = "AdminHevs01";
        $mail->IsHTML(true);
        $mail->From = $from;
        $mail->AddAddress($to);
        $mail->AddReplyTo($from);
        $mail->Subject = 'Resabike: ' . utf8_decode($subject);
        return $mail;
    }
}