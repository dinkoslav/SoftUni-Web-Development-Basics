<?php

include_once('DB.php');
include_once('Localization.php');
$db = DB::getInstance();
$res = $db->query("SHOW COLUMNS FROM translations");
$columns = $res->fetchAll(PDO::FETCH_ASSOC);
$possibleLanguages = array();

foreach ($columns as $col=>$val) {
    if(strpos($val['Field'], 'text_') !== false){
        array_push($possibleLanguages,str_replace('text_', '', $val['Field']));
    }
}

Localization::$LANG_DEFAULT = $possibleLanguages[0];

function translate($tag){
    $lang = isset($_COOKIE['lang'])?$_COOKIE['lang']:Localization::$LANG_DEFAULT;
    $query = DB::getInstance()->query("
            SELECT
                text_{$lang}
            FROM
                translations
            WHERE
                tag = '$tag';
        ");

    $row = $query->fetch(PDO::FETCH_NUM);

    return $row[0];
}

function checkLanguage($lang, $possibleLanguages){
    if(!in_array($lang, $possibleLanguages)){
        throw new Exception("Wrong language");
    }

    setcookie('lang', $lang);
    $_COOKIE['lang'] = $lang;
}

$resTranslations = $db->query("SELECT id, tag, text_en, text_bg FROM translations");
$translations = $resTranslations->fetchAll(PDO::FETCH_ASSOC);

foreach($translations as $translation){
    echo '<div class="source-translation">';
    echo $translation['text_en'];
    echo '</div>';
    echo '<textarea name="">';
    echo $translation['text_bg'];
    echo '</textarea>';
}