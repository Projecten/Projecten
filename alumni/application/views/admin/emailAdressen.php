<?php
//+----------------------------------------------------------
//| Alumni
//+----------------------------------------------------------
//| KHK - 2 TI - 2012-2013
//+----------------------------------------------------------
//| emailAdressen View
//|
//+----------------------------------------------------------
//| Groep 28
//| Glenn Van Rymenant
//| Giel Reijns
//| Sander Vanelven
//| Yoeri Stessens
//+----------------------------------------------------------
?>
<script type="text/javascript">

    $(function() {
        $(".buttons").button();
    });
</script>
<?php
$begunstigden = "";
foreach ($logins as $login) {
    $begunstigden .= $login->emailadres . ' ';
}
echo form_open('admin/emailSturen');
?>
<h1>Alumni mailen</h1>
    <table>
        <tr><td><label for="onderwerp">Onderwerp:</label></td>
            <td><input type="text" name="onderwerp"/></td></tr>
        <tr><td><label for="begunstigden">Begunstigden:</label></td>
            <td><textarea name="begunstigden" rows="3" cols="80" readonly><?php echo $begunstigden; ?></textarea></td><td><button class="buttons">Opslaan als mailinglijst</button></td></tr>
        <tr><td></td><td><a href="" >Bijlage toevoegen</a></td></tr>
        <tr><td></td><td><textarea name="mail" rows="15" cols="80"></textarea></td></tr>
        <tr><td></td><td><input type="submit" class="buttons" value="Volgende"/></td></tr>
    </table>
</form>