<?php

//+----------------------------------------------------------
//| Alumni
//+----------------------------------------------------------
//| KHK - 2 TI - 2012-2013
//+----------------------------------------------------------
//| home_index View
//|
//+----------------------------------------------------------
//| Groep 28
//| Glenn Van Rymenant
//| Giel Reijns
//| Sander Vanelven
//| Yoeri Stessens
//+----------------------------------------------------------
?>

<?php

// Homepage met verschillende melding per gebruikersgroup
switch ($recht) {
    case 1:
        echo
        "<h2>Welkom, $username</h2>
        
                <p>Welkom op de applicatie voor oud-studenten van de opleiding toegepaste informatica aan de Thomas More Kempen (voorheen KHK). 
                Oud-studenten kunnen hier informatie van medestudenten opzoeken en raadplegen evenals aankomende evenementen bekijken en zich hiervoor inschrijven.</p>";

        break;
    case 2:
        echo
        "<h2>Welkom, $username</h2>
        
                <p>Welkom op de applicatie voor oud-studenten van de opleiding toegepaste informatica aan de Thomas More Kempen (voorheen KHK). 
                Oud-studenten kunnen hier informatie van medestudenten opzoeken en raadplegen evenals aankomende evenementen bekijken en zich hiervoor inschrijven.</p>";

        break;
    case 3:
        echo
        "<h2>Welkom, $username</h2>
            
                <p>Welkom op de applicatie voor oud-studenten van de opleiding toegepaste informatica aan de Thomas More Kempen (voorheen KHK). 
                Oud-studenten kunnen hier informatie van medestudenten opzoeken en raadplegen evenals aankomende evenementen bekijken en zich hiervoor inschrijven.</p>";

        break;
    default:
        echo
        "<h2>Welkom</h2>
            
                <p>Welkom op de applicatie voor oud-studenten van de opleiding toegepaste informatica aan de Thomas More Kempen (voorheen KHK). 
                Oud-studenten kunnen hier informatie van medestudenten opzoeken en raadplegen evenals aankomende evenementen bekijken en zich hiervoor inschrijven.</p>";
        break;
}
?>
