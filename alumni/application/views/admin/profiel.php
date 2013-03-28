<!--+----------------------------------------------------------
| Alumni
+----------------------------------------------------------
| KHK - 2 TI - 2012-2013
+----------------------------------------------------------
| profiel admin View
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
    });

    $(document).ready(function() {
        $('#annuleer').click(function() {
            history.back();
        });
    });
</script>

<?php
if ($recht == 3) {
    $naam = array(
        'name' => 'naam',
        'id' => 'naam',
        'value' => $login->voornaam . ' ' . $login->achternaam,
        'size' => '50'
    );
} else {
    $naam = array(
        'name' => 'naam',
        'id' => 'naam',
        'value' => $login->voornaam . ' ' . $login->achternaam,
        'disabled' => 'disabled',
        'size' => '50'
    );
}

$emailadres = array(
    'name' => 'emailadres',
    'id' => 'emailadres',
    'value' => $login->emailadres,
    'size' => '50'
);
?>

<div>
    <?php
    $attributes = array('name' => 'myform', 'id' => 'myform');
    echo form_open('admin/updateProfiel', $attributes);
    echo form_hidden('id', $login->id);
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
            <td></td>
            <td><?php echo form_submit('Opslaan', 'Opslaan', 'id="opslaan"', 'class="buttons ui-button ui-widget ui-state-default ui-corner-all"'); ?>
                <?php echo form_button('annuleer', 'Annuleren', 'id="annuleer"'); ?>
            </td>
        </tr>
    </table>

    <?php echo form_close(); ?>
</div>

<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
