<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head><title>Wachtwoord vergeten op <?php echo $site_name; ?>?</title></head>
    <body>
        <div style="max-width: 1000px; margin: 0; padding: 30px 0;">
            <table width="80%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="5%"></td>
                    <td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
                        <h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Nieuw wachtwoord aanmaken</h2>
                        <br />
                        Om een nieuw wachtwoord in te stellen klikt u op onderstaande link.<br />
                        <br />
                        <big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/auth/reset_password/' . $user_id . '/' . $new_pass_key); ?>" style="color: #3366cc;">Nieuw wachtwoord aanmaken</a></b></big><br />
                        <br />
                        Werkt de link niet? Kopieer de onderstaande link in de navigatiebalk van uw browser.<br />
                <nobr><a href="<?php echo site_url('/auth/reset_password/' . $user_id . '/' . $new_pass_key); ?>" style="color: #3366cc;"><?php echo site_url('/auth/reset_password/' . $user_id . '/' . $new_pass_key); ?></a></nobr><br />
                <br />
                <br />
                U ontving deze mail doordat u aangaf uw wachtwoord voor <a href="<?php echo site_url(''); ?>" style="color: #3366cc;"><?php echo $site_name; ?></a> vergeten te zijn.
                Indien u geen nieuw wachtwoord hebt aangevraagd gelieve dan deze mail te negeren. Uw wachtwoord blijft hetzelfde.<br />
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