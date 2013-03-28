Bestei<?php if (strlen($username) > 0) { ?> <?php echo $username; ?><?php } ?>,

Om een nieuw wachtwoord aan te maken, klik je op onderstaande link.

<?php echo site_url('/auth/reset_password/' . $user_id . '/' . $new_pass_key); ?>


Je hebt deze mail ontvangen omdat je aangaf je wachtwoord vergeten te zijn.

Indien je dit niet gedaan hebt, negeer dan deze mail. Je wachtwoord blijft hetzelfde!


Met vriendelijke groeten

Het <?php echo $site_name; ?> Team