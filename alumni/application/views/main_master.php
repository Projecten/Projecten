<!--+----------------------------------------------------------
| Alumni
+----------------------------------------------------------
| KHK - 2 TI - 2012-2013
+----------------------------------------------------------
| main_master View
|
+----------------------------------------------------------
| Groep 28
| Glenn Van Rymenant
| Giel Reijns
| Sander Vanelven
| Yoeri Stessens
+------------------------------------------------------------>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
        // +----------------------------------------------------------
        // | Trivial Pursuit - oefening
        // +----------------------------------------------------------
        // | KHK - 2 TI - 201x-201x
        // +----------------------------------------------------------
        // | Main Master
        // |
        // +----------------------------------------------------------
        // | // | Groep 28 // | Glenn Van Rymenant // | Giel Reijns // | Sander Vanelven // | Yoeri Stessens
        // +----------------------------------------------------------
        ?>

        <title><?php echo $title; ?></title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() . APPPATH; ?>css/images/favi.png"/>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . APPPATH; ?>css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . APPPATH; ?>css/ui-lightness/jquery-ui-1.10.1.custom.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . APPPATH; ?>css/ui-lightness/jquery-ui-1.10.1.custom.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . APPPATH; ?>css/jquery.dataTables.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . APPPATH; ?>css/jquery.ui.timepicker.css" />

        <script type="text/javascript" src="<?php echo base_url() . APPPATH; ?>js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . APPPATH; ?>js/jquery-ui-1.10.1.custom.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . APPPATH; ?>js/jquery-ui-1.10.1.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . APPPATH; ?>js/datatables.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . APPPATH; ?>js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . APPPATH; ?>js/jquery.ui.timepicker.js"></script>
        <script type="text/javascript">

            var site_url = '<?php echo site_url(); ?>';
            var img_url = '<?php echo base_url() . APPPATH; ?>';
        </script>

    </head>
    <body>

        <div id="header-wrapper">        
            <div id="header">
                <div id="loginwrapper"><?php echo $login; ?></div>
                <?php echo $header; ?>                
                <?php echo $menu; ?>
            </div>

        </div>
        <div id="page-wrapper">
            <div id="page">

                <div id="sidebar"><?php echo $sidebar; ?> </div>
                <div id="content"><?php echo $content; ?></div>


            </div>
        </div>

        <div id="footer"><?php echo $footer; ?></div>
    </body>
</html>