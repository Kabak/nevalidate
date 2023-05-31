<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=rc
[END_COT_EXT]
==================== */

/**
 *  for Cotonti
 *
 * @package nevalidate
 * @version 1.0.0
 * @author Aliaksei Kobak
 * @copyright Copyright (c) Aliaksei Kobak 2014 - 2023
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

if (isset($_GET['e']) && $_GET['e'] == 'users' && isset($_GET['m']) && $_GET['m'] == 'register') {
    Resources::linkFileFooter(Cot::$cfg['plugins_dir'] . '/nevalidate/js/GetUserInfo.js', 'js');
    Resources::embedFooter('
        $(document).ready(function()
        {
            $("input[name=rusername]").after("<div id=\"divMy_Name\"></div>").blur(process_name);
            $("input[name=ruseremail]").after("<div id=\"divEmail\"></div>").blur(process_email);
        });
    ');
}