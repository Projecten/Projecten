<!--+----------------------------------------------------------
| Alumni
+----------------------------------------------------------
| KHK - 2 TI - 2012-2013
+----------------------------------------------------------
| main_menu View
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
//    $(document).ready(function() {
//        var path = window.location.pathname;
//        $('#navlist li a').each(function() {
//            if (path === '/' + this.id) { // EDIT: This was the problem with the if
//                $(this).addClass('active'); // "this" is a DOM element, not a jQuery object
//            } else {
//                $('#home').addClass('active'); // you missed the $
//                alert(path + "     /" + this.id);
//            }
//        }); // always get in the habit of being explicit with your semicolons
//    });

    function test() {
        var pathname = window.location.pathname;
        alert(pathname + "     " + this.id);
    }
</script>

<div id="menu">
    <ul id ="navlist">
        <li><a href="<?php echo base_url() . 'index.php/'; ?>" id="home">Home</a></li>
        <?php if ($recht != 0) { ?>
            <li><a href = "<?php echo base_url() . 'index.php/user/alumniZoeken'; ?>" id="alumni">Alumni</a></li>
            <li><a href = "<?php echo base_url() . 'index.php/user/evenementenZoeken'; ?>" id="evenementenZoeken">Evenementen</a></li>
                <?php
            }
            if ($recht == 3) {
                ?>
            <li><a href="<?php echo base_url() . 'index.php/admin/alumniZoekenMail'; ?>">Mailen</a></li>
            <?php
        }
        ?>
    </ul>
</div>
