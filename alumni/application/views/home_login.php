<?php 
//+----------------------------------------------------------
//| Alumni
//+----------------------------------------------------------
//| KHK - 2 TI - 2012-2013
//+----------------------------------------------------------
//| home_login View
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
        $(".button").button();
    });
</script>

<?php
$attributes = array('name' => 'myform');
echo form_open('user/aanmelden', $attributes);
?>
<table>
    <tr>
        <td><?php echo form_label('E-mailadres:', 'email'); ?></td>
        <td><?php echo form_input(array('name' => 'email', 'id' => 'email', 'size' => '30')); ?></td>
    </tr>
    <tr>
        <td><?php echo form_label('Wachtwoord:', 'password'); ?></td>
        <td><?php
            $data = array('name' => 'password', 'id' => 'password', 'size' => '30');
            echo form_password($data);
            ?></td>
    </tr>
    <tr>
        <td></td>
        <?php if(isset($foutmelding)){ ?>
            <td class="foutmelding"><?php echo $foutmelding; ?></td>
        <?php } ?>
        
    </tr>
    <tr>
        <td></td>
        <td><?php echo form_submit('mysubmit', 'Aanmelden', 'class="button"'); ?></td>
    </tr>
</table>

<?php echo form_close(); ?>