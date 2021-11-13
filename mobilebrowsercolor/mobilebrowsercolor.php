<?php
if (!defined("WHMCS"))
    die("This file cannot be accessed directly");

use Illuminate\Database\Capsule\Manager as Capsule;

function mobilebrowsercolor_config()
{
    $configarray = array(
        "name" => "Mobile Browser Color",
        "description" => "Module changes color of browser search tab on mobile devices",
        "version" => "1.0.0",
        "author" => "Farzad Khaledi",
        "language" => "english",
        "fields" => array()
    );
    return $configarray;
}

function mobilebrowsercolor_activate()
{
    \WHMCS\Config\Setting::setValue('FKMBCSTATUS', '');
    \WHMCS\Config\Setting::setValue('FKMBCCOLOR', '#FF1F1F');
    return array("status" => "success", "description" => "Mobile Browser Color has been activated.");
}

function mobilebrowsercolor_deactivate()
{
    return array("status" => "success", "description" => "Mobile Browser Color has been deactivated.");
}

function mobilebrowsercolor_output($vars)
{
    if (isset($_POST['save'])) {
        check_token("WHMCS.admin.default");
        \WHMCS\Config\Setting::setValue('FKMBCSTATUS', (isset($_REQUEST['status']) ? 'ON' : ''));
        \WHMCS\Config\Setting::setValue('FKMBCCOLOR', ((isset($_REQUEST['color']) && $_REQUEST['color'] != '') ? $_REQUEST['color'] : ''));
        redir('module=mobilebrowsercolor&saved=1');
    }
    if (isset($_REQUEST['saved'])) {
        echo '<div class="alert alert-success">Changes saved successfully.</div>';
    }

    global $CONFIG;
    echo '<form action="" method="post">
        <input type="hidden" name="save" value="1">
        <table class="form" width="100%" cellspacing="2" cellpadding="3" border="0">
        <tbody><tr>
            <td class="fieldlabel" style="min-width:200px;">Enable Theme Color</td>
            <td class="fieldarea">
                <label class="checkbox-inline">
                    <input ' . ((\WHMCS\Config\Setting::getValue('FKMBCSTATUS')) ? 'checked="checked"' : '') . ' type="checkbox" name="status">
                    Tick this box to enable mobile browser theme color</label>
            </td>
        </tr>
        <tr>
            <td class="fieldlabel">Theme Color:</td>
            <td class="fieldarea">
                <input ' . ((\WHMCS\Config\Setting::getValue('FKMBCCOLOR')) ? 'value="' . \WHMCS\Config\Setting::getValue('FKMBCCOLOR') . '"' : '') . ' type="text" name="color" value="" class="colorpicker">
                Enter your custom background theme color</td>
        </tr>

    </tbody></table>
    <div class="btn-container">
    <input id="saveChanges" type="submit" value="Save Changes" class="btn btn-primary">
</div></form>';

    echo '<script type="text/javascript" src="' . $CONFIG['SystemURL'] . '/assets/js/jquery.miniColors.js"></script>
        <link rel="stylesheet" type="text/css" href="' . $CONFIG['SystemURL'] . '/assets/css/jquery.miniColors.css" /><script>$(document).ready(function(){
$(".colorpicker").miniColors();
            });</script>';
}
