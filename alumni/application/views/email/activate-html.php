<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head><title>Welkom bij <?php echo $site_name; ?>!</title></head>
    <body>
        <div style="max-width: 1000px; margin: 0; padding: 30px 0;">
            <table width="80%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="5%"></td>
                    <td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
                        <h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Welkom bij <?php echo $site_name; ?>!</h2>
                        Bedankt voor uw registratie op de  applicatie van de oud-studenten toegepaste informatica aan de Thomas More hogeschool in Geel!<br />
                        <p></p>
                        Onderaan vindt u uw persoonlijke gebruikersnaam en wachtwoord. Gelieve deze zorgvuldig te bewaren.<br />
                        <p></p>
                        Om uw account te activeren dient u eerst uw e-mailadres te verifiëren door op onderstaande link te klikken.<br />
                        <br />
                        <big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/auth/activate/' . $user_id . '/' . $new_email_key); ?>" style="color: #3366cc;">E-mailadres verifiëren</a></b></big><br />
                        <br />
                        Werkt de link niet? Kopieer de onderstaande link in de navigatiebalk van uw browser.<br />

                <nobr><a href="<?php echo site_url('/auth/activate/' . $user_id . '/' . $new_email_key); ?>" style="color: #3366cc;"><?php echo site_url('/auth/activate/' . $user_id . '/' . $new_email_key); ?></a></nobr><br />
                <br />
                Gelieve uw e-mailadres te verifiëren binnen <?php echo $activation_period; ?> uur, anders wordt uw registratie teniet gedaan en zal u opnieuw moeten registreren op de applicatie!<br />
                <br />
                <br />
                <?php if (strlen($username) > 0) { ?><?php //echo $username; ?><br /><?php } ?>
                Uw gebruikersnaam : <?php echo $email; ?><br />
                <?php if (isset($password)) { ?>Uw wachtwoord : <?php echo $password; ?><br /><?php } ?>
                <br />
                <br />
                Met vriendelijke groeten<br />

                Het <?php echo $site_name; ?> Team
                </td>
                </tr>
            </table>
        </div>
    </body>
</html>