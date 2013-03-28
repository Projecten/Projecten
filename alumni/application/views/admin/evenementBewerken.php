<!--+----------------------------------------------------------
| Alumni
+----------------------------------------------------------
| KHK - 2 TI - 2012-2013
+----------------------------------------------------------
| evenementenBewerken View
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
        $("button").button();
    });

    $(function() {
        $("#opslaan").button();
    });

    $(function() {
        $(".datum").datepicker({dateFormat: 'dd-mm-yy'});
    });

    $(function() {
        $(".timepicker").timepicker({showPeriodLabels: false});
    });

    $(document).ready(function() {
        $('#annuleer').click(function() {
            history.go(-1);
        });
    });


//controleren naar fouten
    var ok = true;

    $(function() {

        function validatieOK()
        {
            //Beginparameter meegeven, deze start op true
            ok = true;


            //Veld naam controleren
            if ($("#naam").val() === "") {
                $("#naam").addClass("ui-state-error");
                ok = false;
            } else {
                $('#naam').removeClass('ui-state-error');
            }

            //Veld omschrijving controleren
            if ($("#omschrijving").val() == "") {
                $("#omschrijving").addClass("ui-state-error");
                ok = false;
            } else {
                $("#omschrijving").removeClass("ui-state-error");
            }

            //Veld plaats controleren
            if ($('#plaats').val() == 0) {
                $('#plaats').addClass('ui-state-error');
                ok = false;
            } else {
                $("#plaats").removeClass("ui-state-error");
            }

            //Veld datum controleren
            if ($('#datumbegin').val() == " ") {
                $("#datumbegin").addClass("ui-state-error");
                ok = false;
            } else {
                $("#datumbegin").removeClass("ui-state-error");
            }

            //Veld startuur controleren
            if ($('#startuur').val() == " ") {
                $("#startuur").addClass("ui-state-error");
                ok = false;
            } else {
                $("#startuur").removeClass("ui-state-error");
            }

            //Veld datum controleren
            if ($('#datumeind').val() == " ") {
                $("#datumeind").addClass("ui-state-error");
                ok = false;
            } else {
                $("#datumeind").removeClass("ui-state-error");
            }

            //Veld startuur controleren
            if ($('#einduur').val() == " ") {
                $("#einduur").addClass("ui-state-error");
                ok = false;
            } else {
                $("#einduur").removeClass("ui-state-error");
            }

            //Veld deadline datum controleren
            if ($('#deadlineInschrijving').val() == " ") {
                $("#deadlineInschrijving").addClass("ui-state-error");
                ok = false;
            } else {
                $("#deadlineInschrijving").removeClass("ui-state-error");
            }

            return ok;
        }

        $("#opslaan").click(function(e) {
            e.preventDefault();
            if (validatieOK()) {
                $("#myform").submit();
            }
        });

    });

</script>

<style rel="stylesheet" type="text/css">
    textarea{
        resize: none;
    }
</style>

<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php
$naam = array(
    'name' => 'naam',
    'id' => 'naam',
    'value' => ($evenement->naam == NULL) ? '' : $evenement->naam
);

$omschrijving = array(
    'name' => 'omschrijving',
    'id' => 'omschrijving',
    'value' => $evenement->omschrijving,
    'cols' => 40,
    'rows' => 5,
    'resize' => FALSE
);

$plaats = array(
    'name' => 'plaats',
    'id' => 'plaats',
    'value' => ''
);

$datumbegin = array(
    'name' => 'datumbegin',
    'id' => 'datumbegin',
    'class' => 'datum',
    'value' => ($evenement->begintijd == NULL) ? strftime("%d-%m-%Y", strtotime($evenement->begintijd)) : ' '
);

$datumeind = array(
    'name' => 'datumeind',
    'id' => 'datumeind',
    'class' => 'datum',
    'value' => ($evenement->eindtijd == NULL) ? strftime("%d-%m-%Y", strtotime($evenement->eindtijd)) : ' '
);

$startuur = array(
    'name' => 'startuur',
    'id' => 'startuur',
    'class' => 'timepicker',
    'value' => ($evenement->begintijd == NULL) ? strftime("%Hu%M", strtotime($evenement->begintijd)) : ' '
);

$einduur = array(
    'name' => 'einduur',
    'id' => 'einduur',
    'class' => 'timepicker',
    'value' => ($evenement->eindtijd == NULL) ? strftime("%Hu%M", strtotime($evenement->eindtijd)) : ' '
);

$deadlineInschrijving = array(
    'name' => 'deadlineInschrijving',
    'id' => 'deadlineInschrijving',
    'class' => 'datum',
    'value' => ($evenement->deadlineInschrijving == NULL) ? strftime("%d-%m-%Y", strtotime($evenement->deadlineInschrijving)) : ' '
);
?>

<div>    
    <?php
    $attributes = array('name' => 'myform', 'id' => 'myform');
    echo form_open('admin/update', $attributes);
    echo form_hidden('id', $evenement->id);
    ?>

    <table>
        <tr>
            <td><?php echo form_label('Naam', $naam['id']); ?></td>
            <td><?php echo form_input($naam); ?></td>
        </tr>
        <tr>
            <td><?php echo form_label('Omschrijving:', $omschrijving['id']); ?></td>
            <td colspan="3"><?php echo form_textarea($omschrijving); ?></td>
        </tr>
        <tr>
            <td><?php echo form_label('Plaats:', $plaats['id']); ?></td>
            <!--"id=" . $plaats['id'] //  "id=" . $plaats['id']  -->
            <td colspan="3"><?php echo form_dropdown($plaats['name'], $plaatsen, $evenement->plaatsId, 'id=' . $plaats['id']); ?></td>
        </tr>
        <tr>
            <td><?php echo form_label('Startdatum:', 'datumbegin'); ?></td>
            <td><?php echo form_input($datumbegin); ?></td>

            <td><?php echo form_label('Startuur:', 'startuur'); ?></td>
            <td><?php echo form_input($startuur); ?></td>
        </tr>
        <tr>
            <td><?php echo form_label('Einddatum:', 'datumeind'); ?></td>
            <td><?php echo form_input($datumeind); ?></td>

            <td><?php echo form_label('Einduur:', 'einduur'); ?></td>
            <td><?php echo form_input($einduur); ?></td>
        </tr>
        <tr>
            <td><?php echo form_label('Deadline voor inschrijvingen:', 'deadlineInschrijving'); ?></td>
            <td><?php echo form_input($deadlineInschrijving); ?></td>

            <td></td>
            <td>(bijvoorbeeld : 8u30)</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?php echo form_submit('Opslaan', $actie, 'id="opslaan"', 'class="buttons ui-button ui-widget ui-state-default ui-corner-all"'); ?>
                <?php echo form_button('annuleer', 'Annuleren', 'id="annuleer"'); ?>
            </td>
        </tr>
    </table>

    <?php echo form_close(); ?>
</div>
