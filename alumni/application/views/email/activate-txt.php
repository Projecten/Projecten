Welkom bij <?php echo $site_name; ?>,

Bedankt voor je registratie op de applicatie voor oud-studenten toegepaste informatica aan de Thomas More Hogeschool Geel.
Onderaan vind je jouw persoonlijke gebruikersnaam en wachtwoord. Zorg dat je deze veilig bewaard.

Om je e-mailadres te verifiëren, klik je op onderstaande link.

<?php echo site_url('/auth/activate/' . $user_id . '/' . $new_email_key); ?>


Gelieve je e-mailadres te verifiëren binnen <?php echo $activation_period; ?> uur, anders wordt je registratie teniet gedaan en zal je opnieuw moeten registreren!

<?php if (strlen($username) > 0) { ?>

    <?php //echo $username; ?>
<?php } ?>

Jouw gebruikersnaam  :  <?php echo $email; ?>
<?php if (isset($password)) { /* ?>

  Your password: <?php echo $password; ?>
  <?php */
} ?>



Met vriendelijke groeten

Het <?php echo $site_name; ?> Team