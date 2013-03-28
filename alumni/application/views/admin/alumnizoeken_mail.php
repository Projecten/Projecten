<!--+----------------------------------------------------------
| Alumni
+----------------------------------------------------------
| KHK - 2 TI - 2012-2013
+----------------------------------------------------------
| alumnizoeken_mail View
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

        $('#checkall').click(function() {
            $(this).find(':checkbox').attr('checked', this.checked);
        });

        $('.datatable').dataTable({
            "oLanguage": {
                "sLengthMenu": "Laat _MENU_ records per pagina zien",
                "sZeroRecords": "Niets gevonden - sorry",
                "sEmptyTable": "Geen records gevonden in de tabel",
                "sInfo": "_START_ tot _END_ van _TOTAL_ totale records",
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
            "bAutoWidth": false,
            "aoColumns": [
                {"sWidth": "15px"},
                {"sWidth": "150px"},
                {"sWidth": "150px"},
                {"sWidth": "150px"}
            ],
            //"bJQueryUI": true,
        }).columnFilter({
            aoColumns: [
                null,
                {type: "text"},
                {type: "text"},
                {type: "select"}
            ]
        });
    });

</script>
<?php
if (isset($test)) {
    foreach ($test as $testlol) {
        echo $testlol;
    }
}
?>
<h1>Alumni selecteren om te mailen</h1>
<?php

$checkall = array(
                'name' =>'checkall',
                'id' => 'checkall',
            );

echo form_button($checkall,'Check/uncheck alles');
echo form_open('admin/emailAdressen');

$submit = array(
    'id' => 'mailen',
    'name' => 'mailen',
    'class' => 'buttons',
);
?>
<table class="datatable">
    <thead>
        <tr>
            <th></th>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>Afstudeerjaar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($alumni as $alumnus) {
            $checkbox = array(
                'name' => 'ids[]',
                'id' => $alumnus->login->id,
            );
            echo '<tr>';
            echo '<td>' . form_checkbox($checkbox, $alumnus->login->id) . '</td>';
            echo '<td>' . $alumnus->login->voornaam . '</td>';
            echo '<td>' . $alumnus->login->achternaam . '</td>';
            echo '<td>' . $alumnus->afstudeerjaar . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '<tfoot>';
        echo '<tr>';
        echo '<th></th>
            <th></th>
            <th></th>
            <th></th>';
        echo '</tr>';
        echo '</tfoot>';
        echo '</table>';
        echo "<div class='clear'></div>";
        echo form_submit($submit, 'Volgende');
        echo form_close()
        ?>