<!--+----------------------------------------------------------
| Alumni
+----------------------------------------------------------
| KHK - 2 TI - 2012-2013
+----------------------------------------------------------
| evenementendetails View
|
+----------------------------------------------------------
| Groep 28
| Glenn Van Rymenant
| Giel Reijns
| Sander Vanelven
| Yoeri Stessens
+------------------------------------------------------------>

<script type="text/javascript">
    //voor button stijl te geven
    $(function() {
        $( ".buttons" ).button();
    });
    $(document).ready(function(){
        $("#master").click(function(){
            if($("#master").attr("checked")){
                //                        document.getElementsByName('wasAanwezig').attr("checked", checked);
                $("[type='checkbox']").attr("checked", true);
            }else {
                $("[type='checkbox']").attr("checked", false);
            };
        });
    });
    
</script>

<?php
// lokaal gezet op nederlands zodat de datums hun weekdagen en maanden in het nederlands staan
setlocale(LC_ALL, 'nl_NL');
?>
<h1>Details over evenement: <?php echo $evenement->naam; ?></h1>
<table class='fancy'>
    <tr>
        <td> Plaats: </td>
        <td> <?php echo $evenement->plaats->locatie; ?></td>
    </tr>
    <tr>
        <td> Datum: </td>
        <td> <?php echo strftime("%A %e %B %Y", strtotime($evenement->begintijd)) . " tot " . strftime("%A %e %B %Y", strtotime($evenement->eindtijd)); ?></td>
    </tr>
    <tr>
        <td> Duur: </td>
        <td> <?php echo strftime("%Hu%M", strtotime($evenement->begintijd)) . " -" . strftime("%Hu%M", strtotime($evenement->eindtijd)); ?></td>
    </tr>
    <tr>
        <td> Deadline inschrijving: </td>
        <td> <?php echo strftime("%A %e %B %Y", strtotime($evenement->deadlineInschrijving)); ?></td>
    </tr>
    <td> Omschrijving: </td>
    <td> <?php echo $evenement->omschrijving; ?></td>
</tr>
</table>
<table>
    <tr>     
        <td>
            <a class="buttons" id="terug" href="javascript:history.go(-1);">Terug</a>
        </td>
        <?php if ($recht == 1) { ?>
            <td>
                <?php echo anchor('alumnus/inschrijven/' . $evenement->id, "Inschrijven voor dit evenement", "class='buttons'") ?>
            </td>
        <?php } ?>
    </tr>
</table>
<br />

<!--Toon ingeschreven alumni-->
<h3>Ingeschreven alumni:</h3>
<?php
$aanwezig = array(
    'name' => 'aanwezig',
    'id' => 'checkbox',
    'disabled' => 'disabled',
);

$wasAanwezig = array(
    'name' => 'wasAanwezig',
    'id' => 'checkbox',
    'class' => 'checkbox',
);

if ($recht != 3) {
    $wasAanwezig['disabled'] = 'disabled';
}

if (count($uitgenodigden) != 0) {
    echo "<table class='fancy sortable'>";
    echo '<tr>';
    echo '<th>Naam</th>';

    if ($recht == 3) {
        echo '<th>Datum ingeschreven</th>';
        echo '<th>Was aanwezig</th>';
        ;
    }

//controle op gebruiker en naargelang juiste header tonen
    echo '</tr>';
    foreach ($uitgenodigden as $uitgenodigd) {
        echo '<tr>';
        echo '<td>' . $uitgenodigd->login->voornaam . ' ' . $uitgenodigd->login->achternaam . '</td>';

        //controle op gebruiker en naargelang juiste knop aanbieden
        if ($recht == 3) {

            if ($uitgenodigd->datumInschrijving != NULL) {
                echo '<td>' . strftime("%d/%m/%Y", strtotime($uitgenodigd->datumInschrijving)) . '</td>';
            } else {
                echo '<td>&nbsp;</td>';
            }
            echo '<td>' . form_checkbox($wasAanwezig, NULL, ($uitgenodigd->wasAanwezig == 1) ? TRUE : FALSE) . '</td>';
        }
        echo '</tr>';
    }
    echo "</table>";

    if ($recht == 3) {
        ?>
        <table>
            <tr>
                <td><input type="checkbox" id="master" name="master"/>Check alle</td>
            </tr>
        </table>
        <?php
    }
} else {
    //Indien er geen alumnus komen
    echo "<p>Momenteel komen er geen alumni naar dit evenement.</p>";
}
?>
