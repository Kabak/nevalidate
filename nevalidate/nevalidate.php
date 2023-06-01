<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=ajax
[END_COT_EXT]
==================== */

/* @var $db CotDB */

/**
 * @package nevalidate
 * @version 1.0.0
 * @author Aliaksei Kobak
 * @copyright Copyright (c) Aliaksei Kobak 2014 - 2023
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

require_once cot_langfile('nevalidate', 'plug');

$verif_name = cot_import('name', 'G', 'TXT', 100);
$verif_email = cot_import('email', 'G', 'TXT', 64);

if (empty($verif_name)) {
    $mail = true;
    $e = $db->query("SELECT COUNT(*) FROM $db_users WHERE user_email=? LIMIT 1", [$verif_email])->fetchColumn() > 0;
} elseif (empty($verif_email)) {
    $mail = false;
    $n = $db->query("SELECT COUNT(*) FROM $db_users WHERE user_name=? LIMIT 1", [$verif_name])->fetchColumn() > 0;
}

header('Content-Type: text/xml');

echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
echo '<response>';
if (!$mail) {
    if ($n) {
        echo '<NameFound>true</NameFound>';
        echo '<Unswer>'.$L['name_used'].'</Unswer>';
    } else {
        echo '<NameFound>false</NameFound>';
    }
} elseif ($e) {
    echo '<EmailFound>true</EmailFound>';
    echo '<Unswer>'.$L['email_used'].'</Unswer>';
} else {
    echo '<EmailFound>false</EmailFound>';
}
echo '</response>';