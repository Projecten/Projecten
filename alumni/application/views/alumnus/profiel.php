<!--+----------------------------------------------------------
| Alumni
+----------------------------------------------------------
| KHK - 2 TI - 2012-2013
+----------------------------------------------------------
| profiel View
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
        $(".datum").datepicker({dateFormat: 'dd-mm-yy'});
        
        $(".buttons").button();
    });

    $(document).ready(function() {
        $('#annuleer').click(function() {
            history.back();
        });
    });
</script>

<?php
$naam = array(
    'name' => 'naam',
    'id' => 'naam',
    'value' => $login->voornaam . ' ' . $login->achternaam,
    'disabled' => 'disabled',
    'size' => '50'
);

$emailadres = array(
    'name' => 'emailadres',
    'id' => 'emailadres',
    'value' => $login->emailadres,
    'disabled' => 'disabled',
    'size' => '50'
);

$secundairEmail = array(
    'name' => 'secundairEmailadres',
    'id' => 'secundairEmailadres',
    'value' => $login->alumnus->secundairMail,
    'size' => '50'
);


$werkgever = array(
    'name' => 'werkgever',
    'id' => 'werkgever',
    'value' => $login->alumnus->werkgever,
    'size' => '50'
);

$startdatumWerk = array(
    'name' => 'startdatumWerk',
    'id' => 'startdatumWerk',
    'class' => 'datum',
    'value' => toDDMMYYYY($login->alumnus->startdatumWerk)
);

$jobomschrijving = array(
    'name' => 'jobomschrijving',
    'id' => 'jobomschrijving',
    'value' => $login->alumnus->jobomschrijving,
    'size' => '50'
);

$afstudeerjaar = array(
    'name' => 'afstudeerjaar',
    'id' => 'afstudeerjaar',
    'value' => $login->alumnus->afstudeerjaar,
    'disabled' => 'disabled',
    'size' => '4'
);

$school = array(
    'name' => 'school',
    'id' => 'school',
    'value' => $login->alumnus->school->naam
);

$richting = array(
    'name' => 'richting',
    'id' => 'richting',
    'value' => $login->alumnus->richting->naam,
);

$specialisatie = array(
    'name' => 'specialisatie',
    'id' => 'specialisatie',
    'value' => $login->alumnus->specialisatie->omschrijving,
    'disabled' => 'disabled',
    'size' => '40'
);
?>

<div>
    <?php
    $attributes = array('name' => 'myform', 'id' => 'myform');
    echo form_open('alumnus/updateProfiel', $attributes);
    echo form_hidden('loginId', $login->id);
    echo form_hidden('id', $alumnus->id);
    echo form_hidden('specialisatieId', $login->alumnus->specialisatie->id);
    ?>

    <table>
        <tr>
            <td><?php echo form_label('Naam', $naam['id']); ?></td>
            <td><?php echo form_input($naam); ?></td>
        </tr>
        <tr>
            <td><?php echo form_label('Emailadres:', $emailadres['id']); ?></td>
            <td colspan="3"><?php echo form_input($emailadres); ?></td>
        </tr>
            <tr>
                <td><?php echo form_label('Secundair emailadres:', $secundairEmail['id']); ?></td>
                <td colspan="3"><?php echo form_input($secundairEmail); ?></td>
            </tr>
            <tr>
                <td><?php echo form_label('Werkgever:', $werkgever['id']); ?></td>
                <td><?php echo form_input($werkgever); ?></td>
            </tr>
            <tr>
                <td><?php echo form_label('Startdatum:', $startdatumWerk['id']); ?></td>
                <td><?php echo form_input($startdatumWerk); ?></td>
            </tr>
            <tr>
                <td><?php echo form_label('Job omschrijving:', $jobomschrijving['id']); ?></td>
                <td><?php echo form_input($jobomschrijving); ?></td>
            </tr>
            <tr>
                <td><?php echo form_label('afstudeerjaar:', $afstudeerjaar['id']); ?></td>
                <td><?php echo form_input($afstudeerjaar); ?></td>
            </tr>
            <tr>
                <td><?php echo form_label('school:', $school['id']); ?></td>
                <td colspan="3"><?php echo form_dropdown($school['name'], $scholen, $login->alumnus->school->id, "id='" . $school['id'] . "'"); ?></td>
            </tr>
            <tr>
                <td><?php echo form_label('richting:', $richting['id']); ?></td>
                <td colspan="3"><?php echo form_dropdown($richting['name'], $richtingen, $login->alumnus->richting->id, "id=" . $richting['id']); ?></td>
            </tr>
            <tr>
                <td><?php echo form_label('specialisatie:', $specialisatie['id']); ?></td>
                <td><?php echo form_input($specialisatie); ?></td>
            </tr>
        <tr>
            <td></td>
            <td><?php echo form_submit('Opslaan', 'Opslaan', 'id="opslaan"', 'class="buttons ui-button ui-widget ui-state-default ui-corner-all"'); ?>
                <?php echo form_button('annuleer', 'Annuleren', 'id="annuleer"', 'class="buttons"'); ?>
            </td>
        </tr>
    </table>

    <?php echo form_close(); ?>
</div>

