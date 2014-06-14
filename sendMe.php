<?php
     // Plusieurs destinataires
     $to  = 'zaki.oussama@gmail.com'; // notez la virgule
     //$to .= ', '.'wez@example.com';

     // Sujet
     $subject = 'Calendrier des anniversaires pour Août';

     // message
     $message = '
     <html>
      <head>
       <title>Calendrier des anniversaires pour Août</title>
      </head>
      <body>
       <p>Voici les anniversaires à venir au mois d\'Août !</p>
       <table>
        <tr>
         <th>Personne</th><th>Jour</th><th>Mois</th><th>Année</th>
        </tr>
        <tr>
         <td>Josiane</td><td>3</td><td>Août</td><td>1970</td>
        </tr>
        <tr>
         <td>Emma</td><td>26</td><td>Août</td><td>1973</td>
        </tr>
       </table>
      </body>
     </html>
     ';

     // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
     $headers  = 'MIME-Version: 1.0' . "\r\n";
     $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

     // En-têtes additionnels
     $headers .= 'To: Zaki <zaki.oussama@gmail.com>' . "\r\n";
     $headers .= 'From: Wijhaty <wijhaty@gmail.com>' . "\r\n";
 $headers .= 'Cc: anniversaire_archive@example.com' . "\r\n";
     $headers .= 'Bcc: anniversaire_verif@example.com' . "\r\n";
     // Envoi
     if(mail($to, $subject, $message, $headers))
        echo "ok";
     else
         echo "echec"
?>