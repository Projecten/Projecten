<!--+----------------------------------------------------------
| Alumni
+----------------------------------------------------------
| KHK - 2 TI - 2012-2013
+----------------------------------------------------------
| evenementenZoeken View
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

            $.datepicker.regional[""].dateFormat = 'dd/mm/yy';
            $.datepicker.setDefaults($.datepicker.regional['']);


            $(".buttons").button();


            $("#dialog-delete-fout").dialog({
                autoOpen: false,
                resizable: false,
                width: 400,
                height: 200,
                modal: true,
                buttons: {
                    "OK": function() {
                        $(this).dialog("close");
                    }
                }
            });


            // delete dialoog
            $("#dialog-delete").dialog({
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
                            data: {id: deleteid},
                            success: function(result) {
                                if (result == '0') {
                                    // verwijderen is mislukt, foutmelding tonen
                                    $("#dialog-delete-fout").dialog("open");
                                    $("#dialog-delete").dialog("close");
                                } else {
                                    location.href = site_url + "/admin/delete/" + deleteid;
                                    $("#dialog-delete").dialog("close");
                                }
                            }
                        });
                    },
                    "Neen": function() {
                        $(this).dialog("close");
                    }
                }
            });


            $(".verwijder").click(function(e) {
                e.preventDefault();
                deleteid = $(this).attr("id").valueOf();
                naam = $(this).attr("name").valueOf();
                document.getElementById("dialogverwijder").innerHTML = "Het evenement '" + naam + "' wordt verwijderd. Ben je zeker?";
                document.getElementById("dialogverwijder-fout").innerHTML = "Het evenement '" + naam + "' kan niet verwijderd worden omdat er nog alumni ingeschreven zijn voor het evenement.";
                $("#dialog-delete").dialog("open");
            });


            $('.datatable').dataTable({
                //Standaard sorteren op de 2de kolom (aaSorting is een array dus index start vanaf 0!) => 1        
                "aaSorting": [[1, "asc"]],
                "oLanguage": {
                    "sLengthMenu": "Laat _MENU_ records per pagina zien",
                    "sZeroRecords": "Niets gevonden - sorry",
                    "sEmptyTable": "Geen records gevonden in de tabel",
                    "sInfo": "_START_ tot _END_ van _TOTAL_  records",
                    "sInfoEmpty": "0 tot 0 van 0 totale records",
                    "sInfoFiltered": "(gefilterd van _MAX_ records)",
                    "sSearch": "Alles zoeken:",
                    "oPaginate": {
                        "sFirst": "<<",
                        "sLast": ">>",
                        "sNext": ">",
                        "sPrevious": "<"
                    }
                },
                //"bJQueryUI": true,
                "sPaginationType": "full_numbers"
            })
                    .columnFilter({
                aoColumns: [
                    {type: "text"},
                    {type: "date-range"},
                    {type: "select"}
                ]
            });

        });
    });
</script>

<div id="dialog-delete" title="Verwijderen">
    <div align="center"><span style="float:left; margin:0px 0px 0px 0px;">
            <img height="50" width="50" src="<?php echo base_url() . APPPATH; ?>css/images/deletedialog.png" />
        </span>
        <span id="dialogverwijder"></span>
    </div>
</div>

<div id="dialog-delete-fout" title="Fout">
    <div align="center"><span style="float:left; margin:0px 0px 0px 0px;">
            <img height="50" width="50" src="<?php echo base_url() . APPPATH; ?>css/images/deletedialog.png" />
        </span>
        <span id="dialogverwijder-fout"></span>
    </div>
</div>

<?php
// Zorgt ervoor dat de datums in het nederlands worden weergegeven
setlocale(LC_ALL, 'nl_NL');
?>

<table>
    <tr>
        <td width='85%'><h1>Evenementen</h1></td>
        <?php
        if ($recht == 3) {
            echo '<td>' . anchor('admin/evenementBewerken/' . 0, "Nieuw evenement", "class='buttons'") . '</td>' . "\n";
        }
        ?>
    </tr>
</table>

<table class="datatable">
    <thead>
        <tr>
            <th>Naam</th>
            <th>Datum</th>
            <th>Plaats</th>
            <?php
            if ($recht == 3) {
                echo '<th></th>' . "\n";
                echo '<th></th>' . "\n";
            } else if ($recht == 1) {
                echo '<th>Inschrijven</th>' . "\n";
            } else {
                echo '<th></th>' . "\n";
                echo '<th>Inschrijven</th>' . "\n";
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($evenementen as $evenement) {
            echo '<tr>' . "\n";
            //$id = $evenement->id, $naam = $evenement->naam
            echo '<td>' . Anchor('alumnus/evenementdetail/' . $evenement->id, $evenement->naam) . '</td>' . "\n";
            echo '<td>' . strftime("%d/%m/%Y", strtotime($evenement->begintijd)) . '</td>' . "\n";
            echo '<td>' . $evenement->plaats->locatie . '</td>' . "\n";
            //echo '<td>' . $evenement->actie . '</td>';
            //controle op gebruiker en naargelang juiste knop aanbieden
            if ($recht == 3) {
                //Knoppen voor editten en verwijderen             
                echo '<td>' . anchor('admin/evenementBewerken/' . $evenement->id, '<img height="20" width= "20" src="' . base_url() . APPPATH . 'css/images/aanpassen.png" />', 'title="Bewerken"') . '</td>' . "\n";
                echo '<td><a title="Verwijderen" class="verwijder" id="' . $evenement->id . '" name="' . $evenement->naam . '">' . '<img height="20" width= "20" src="' . base_url() . APPPATH . 'css/images/verwijderen.png" />' . '</a></td>' . "\n";
            } elseif ($recht == 1) {
                //indien een gewone alumnus => zichzelf kunnen inschrijven + uitschrijven;
                echo '<td align="center">' . anchor('alumnus/inschrijven/' . $evenement->id . "/" . $evenement->actie, $evenement->actie, "class='buttons'") . '</td>' . "\n";
            } elseif ($recht == 2) {
                //docenten mogen aanpassen en inschrijven
                echo '<td>' . anchor('admin/evenementBewerken/' . $evenement->id, '<img height="20" width= "20" src="' . base_url() . APPPATH . 'css/images/aanpassen.png" />', 'title="Bewerken"') . '</td>' . "\n";
                echo '<td align="center">' . anchor('alumnus/inschrijven/' . $evenement->id, "Inschrijven", "class='buttons'") . '</td>' . "\n";
            }
            echo '</tr>' . "\n";
        }
        ?>      
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <?php if ($recht == 3 || $recht == 2) { ?>
                <th></th>
            <?php } ?>
        </tr>
    </tfoot>
</table>
