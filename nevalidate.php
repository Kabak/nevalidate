<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=standalone
[END_COT_EXT]
==================== */

/* @var $db CotDB */
/* @var $cache Cache */
/* @var $t Xtemplate */

/**
 * @package envalidate
 * @version 0.0.1
 * @author Aliaksei Kobak
 * @copyright Copyright (c) Aliaksei Kobak 2014
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

require_once cot_langfile('nevalidate', 'plug');
//require_once cot_incfile('nevalidate', 'plug');

header('Content-Type: text/xml');

// сгенерировать заголовок XML
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
// создать элемент <response>
echo '<response>';
// получить имя пользователя
//$n = $_GET['name'];
//$e = $_GET['email'];

$name['user_name'] = cot_import('name','G','TXT');
$email['user_email'] = cot_import('email','G','TXT');

if (trim($name['user_name']) == ''){
    $mail = true;
    $e = $db->query("SELECT COUNT(*) FROM $db_users WHERE user_email=? LIMIT 1", array($email['user_email']))->fetchColumn() > 0;
}
else if (trim($email['user_email']) == ''){
    $mail = false;
    $n = $db->query("SELECT COUNT(*) FROM $db_users WHERE user_name=? LIMIT 1", array($name['user_name']))->fetchColumn() > 0;
}

if( !$mail ){
if( $n ){
        echo '<NameFound>';
        echo 'true';
        echo '</NameFound>';
        echo '<Unswer>';
        echo $L['name_used']; 
        echo '</Unswer>';  
}        
else{
        echo '<NameFound>';
        echo 'false';
        echo '</NameFound>';        
}
}       
else if( $e ){
        echo '<EmailFound>';
        echo 'true';
        echo '</EmailFound>';
        echo '<Unswer>';
        echo $L['email_used']; 
        echo '</Unswer>';               
}
else{
        echo '<EmailFound>';
        echo 'false';
        echo '</EmailFound>'; 
}
        echo '</response>';   
        exit;  
