<!--+----------------------------------------------------------
| Alumni
+----------------------------------------------------------
| KHK - 2 TI - 2012-2013
+----------------------------------------------------------
| main_login View
|
+----------------------------------------------------------
| Groep 28
| Glenn Van Rymenant
| Giel Reijns
| Sander Vanelven
| Yoeri Stessens
+------------------------------------------------------------>

<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script type="text/javascript">

    $(function() {
        $(".buttons").button();
    });

</script>
<?php
if (!$recht) {
    ?>
    <td><?php echo anchor('/home/login', 'Aanmelden'); ?></td>
    <?php
} else {
    ?>
    <table>
        <tr>
            <td>Ingelogd als <b><?php echo $username; ?></b></td>
            <td></td>
            <td> <?php echo anchor('/alumnus/profiel', 'Profiel'); ?> </td>
            <td> | </td>
            <td><?php echo anchor('/user/afmelden', 'Afmelden'); ?></td>
        </tr>
    </table>
    <?php
}
?>