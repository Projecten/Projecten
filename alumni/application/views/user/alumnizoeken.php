<!--+----------------------------------------------------------
| Alumni
+----------------------------------------------------------
| KHK - 2 TI - 2012-2013
+----------------------------------------------------------
| alumnizoeken View
|
+----------------------------------------------------------
| Groep 28
| Glenn Van Rymenant
| Giel Reijns
| Sander Vanelven
| Yoeri Stessens
+------------------------------------------------------------>

<script type="text/javascript">

    $(function() {
        $(".buttons").button();

        $('.datatable').dataTable({
            //Standaard sorteren op de 2de kolom (aaSorting is een array dus index start vanaf 0!) => 1
            "aaSorting": [[ 1, "desc" ]],
            "oLanguage": {
                "sLengthMenu": "Laat _MENU_ records per pagina zien",
                "sZeroRecords": "Niets gevonden - sorry",
                "sEmptyTable": "Geen records gevonden in de tabel",
                "sInfo": "_START_ tot _END_ van _TOTAL_ records",
                "sInfoEmpty": "0 tot 0 van 0 totale records",
                "sInfoFiltered": "(gefilterd van _MAX_ records)",
                "sSearch": "Alles zoeken:",
                "oPaginate": {
                    "sFirst": " << ",
                    "sLast": " >> ",
                    "sNext": " > ",
                    "sPrevious": " < ",
                },
            },
            "sPaginationType": "full_numbers",
            //"bJQueryUI": true,
        }).columnFilter({
            aoColumns: [
                {type: "text"},
                {type: "text"},
                {type: "select"},
                {type: "select"}
            ]
        });
    });

</script>

<h1>Alumni</h1>
<table class="datatable">
    <thead>
        <tr>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>Afstudeerjaar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($alumni as $alumnus) {
            echo '<tr>' . "\n";
            echo '<td>' . anchor('alumnus/profiel', $alumnus->login->voornaam) . '</td>' . "\n";
            echo '<td>' . anchor('alumnus/profiel', $alumnus->login->achternaam) . '</td>' . "\n";
            echo '<td>' . $alumnus->afstudeerjaar . '</td>' . "\n";
            echo '</tr>' . "\n";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>