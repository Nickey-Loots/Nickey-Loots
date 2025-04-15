<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function mailer()
{
    if (isset($_POST["submit"])) {
        $validate = handleForm();
        foreach ($validate as $key => $value) {
            if ($value["fout"] != "") {
                return;
            }
        }
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "hulshofaniek@gmail.com";
            $mail->Password = "yswd naak lxru pmnx";
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;

            $mail->setFrom("hulshofaniek@gmail.com", "Aniek Hulshof");
            $mail->addAddress("hulshofaniek@gmail.com", "Toine Straatman");

            $mail->isHTML(true);
            $mail->Subject = "Nieuw bericht via contactpagina";

            $mail->Body = "<p><strong>Naam:</strong> {$_POST["voornaam"]} {$_POST["achternaam"]}</p>
            <p><strong>Email:</strong> {$_POST["email"]}</p>
            <p><strong>Telefoonnummer:</strong> {$_POST["telefoon"]}</p>
            <p><strong>Bericht:</strong> {$_POST["vraag"]}</p>";

            $mail->send();

            return "Je bericht is verstuurd, je krijgt zo snel mogelijk een reactie!";
        } catch (Exception $e) {
            return ("Er is een probleem opgetreden bij het verzenden van de e-mail: " . $mail->ErrorInfo);
        }
    }
}
