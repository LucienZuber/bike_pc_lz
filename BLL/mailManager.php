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
class MailManager
{
    function sendMailBookings($subject, $intro, $to, $sender, $nbBikes, $email, $startStation, $endStation, $startDate, $endDate, $phone, $token = '-')
    {
        $mail = $this->initializePHPMailer('resabikepclz@gmail.com', $to, $subject);
        $mail->Body = '
        <p>' . $intro . '</p>
        <ul>
            <li>Nom : ' . $sender . '</li>
            <li>Nombre de vélos : ' . $nbBikes . '</li>
            <li>Départ : ' . $startStation . '</li>
            <li>Arrivée : ' . $endStation . '</li>
            <li>Heure de départ : ' . $startDate . '</li>
            <li>Heure de départ : ' . $endDate . '</li>
            <li>Adresse e-mail : ' . $email . '</li>
            <li>N° de téléphone : ' . $phone . '</li>
        </ul>';
        $mail->Body .= '<p>Si vous désirez annuler votre réservation, il vous suffit d\'envoyer un mail à resabikepclz@gmail.com</p>';

        $this->sendMail($mail);
        $mail->SmtpClose();
        unset($mail);
    }

    function sendMail($mail)
    {
        if (!$mail->Send()) // Teste le return code de la fonction
            echo $mail->ErrorInfo; // Affiche le message d'erreur
    }

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