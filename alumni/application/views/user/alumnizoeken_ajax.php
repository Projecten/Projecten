<!--+----------------------------------------------------------
| Alumni
+----------------------------------------------------------
| KHK - 2 TI - 2012-2013
+----------------------------------------------------------
| alumniZoeken_ajax View
|
+----------------------------------------------------------
| Groep 28
| Glenn Van Rymenant
| Giel Reijns
| Sander Vanelven
| Yoeri Stessens
+------------------------------------------------------------>


<script type="text/javascript">
    var deleteid = 0;
    $(document).ready(function() {
        $(function() {
            $( ".buttons" ).button();
        }); 
    
        $(function(){

            $( "#dialog-delete-fout" ).dialog({
                autoOpen: false,
                resizable: false,
                width: 400,
                height: 200,
                modal: true,
                buttons: {
                    "OK": function() {
                        $( this ).dialog( "close" );
                    }
                }
            });

            // delete dialoog

            $( "#dialog-delete" ).dialog({
                autoOpen: false,
                resizable: false,
                height: 200,
                modal: true,
                buttons: {
                    "Ja": function() {
                        // gegevens verwijderen via ajax
                        $.ajax({
                            type: "GET",
                            url: site_url + "/admin/controleDelete",
                            async: false,
                            data : { id : deleteid },
                            success : function(result){
                                if (result == '0') {
                                    // verwijderen is mislukt, foutmelding tonen
                                    $( "#dialog-delete-fout" ).dialog( "open" );
                                    $( "#dialog-delete" ).dialog( "close" );
                                } else {
                                    location.href = site_url + "/admin/delete/" + deleteid;
                                    $( "#dialog-delete" ).dialog( "close" );
                                }
                            }
                        });
                    },
                    "Neen": function() {
                        $( this ).dialog( "close" );
                    }
                }
            });

            $( ".verwijder" ).click(function(e) {
                e.preventDefault();
                deleteid = $( this ).attr("id").valueOf();
                naam = $( this ).attr("name").valueOf();
                document.getElementById("dialogverwijder").innerHTML = "Het evenement '" + naam + "' wordt verwijderd. Ben je zeker?";
                document.getElementById("dialogverwijder-fout").innerHTML = "Het evenement '" + naam + "' kan niet verwijderd worden omdat er nog alumni ingeschreven zijn voor het evenement.";
                $( "#dialog-delete" ).dialog( "open" );
            });

        });
        
        
        $("#start").click(function(e){
            e.preventDefault();
            aantal = document.getElementById("aantal").value;
            $.ajax({
                type: "GET",
                url: site_url + "/user/alumnusZoeken",
                async: false,
                data : { aantal : aantal },
                success : function(result){
                    alert(aantal + " " + site_url + "/user/alumnusZoeken");
                }
            });
        });
    });
     
</script>

<?php
if (count($alumni) != 0) {
    echo "<table class='fancy sortable'>";
    echo '<colgroup>';
    echo '<col width="250px" />';
    echo '<col width="250px" />';
    echo '<col width="250px" />';
    echo '<col />';
    echo '<col />';
    echo '</colgroup>';
    echo '<tr>';
    echo '<th>Naam</th>';
    echo '<th>Afstudeerjaar</th>';
    /*if ($recht == 3) {
        echo '<th colspan="2">Beheren</th>';
    } else if ($recht == 1) {
        echo '<th colspan="2">Inschrijven</th>';
    }*/

//controle op gebruiker en naargelang juiste header tonen
    echo '</tr>';
    foreach ($alumni as $alumnus) {
        echo '<tr>';
        echo '<td>' . divAnchor('user/alumnusdetails/' . $alumnus->userId, $alumnus->user->voornaam . ' ' . $alumnus->user->achternaam, $id = $alumnus->userId, $naam = $alumnus->user->voornaam . ' ' . $alumnus->user->achternaam) . '</td>';
        echo '<td>' . $alumnus->afstudeerjaar . '</td>';
        //controle op gebruiker en naargelang juiste knop aanbieden
        /*if ($recht == 3) {
            //Knoppen voor editten en verwijderen
            echo '<td>' . anchor('admin/evenementBewerken/' . $evenement->id, '<img src="' . base_url() . APPPATH . 'css/images/edit.png"/>') . '</td>';
            echo '<td><a class="verwijder" href="#" id="' . $evenement->id . '" name="' . $evenement->naam . '"><img src="' . base_url() . APPPATH . 'css/images/delete.png"/></a></td>';
        } elseif ($recht == 1) {
            //indien een gewone alumnus => zichzelf kunnen inschrijven
            echo '<td>' . anchor('alumnus/inschrijven/' . $evenement->id, "In- Uitschrijven", "class='buttons'") . '</td>';
        } elseif ($recht == 2) {
            //docenten mogen aanpassen
            echo '<td>' . anchor('admin/evenementBewerken/' . $evenement->id, '<img src="' . base_url() . APPPATH . 'css/images/edit.png"/>') . '</td>';
        }*/
        echo '</tr>';
    }
    echo "</table>";

    //Pagination tonen + input aantal records per pagina
    echo form_open("user/alumnusZoekactie");
    echo "<table>";
    echo "<tr><td>";
    if (isset($links) && $links != NULL) {
        echo "<p>" . $links . "</p>";
        echo "</td><td>";
    }
   
    echo "</table>";

} else {
    echo "<p>Geen resultaten gevonden.</p>";
}
?>