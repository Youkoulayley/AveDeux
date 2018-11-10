<?php
declare(strict_types=1);

/**
 * Découpage du résumé
 *
 * @param $resume
 * @return string
 */
function cutResume($resume) {
    $nombreCaracResume = config('param.nombreCaracResume');

    // On insère des marqueurs "***" dans le texte
    $text = wordwrap($resume, $nombreCaracResume, '***', true);

    $tcut = explode('***', $text);

    // La première partie du tableau est celle qui nous intéresse
    $part1 = $tcut[0];
    $part2 = '';

    for($i=1, $iMax = count($tcut); $i< $iMax; $i++) {
        $part2 .= $tcut[$i].' ';
    }

    // On vérifie si il y a une balise spoiler dans le texte
    if(strpos($part1, '<div class="spoiler">') !== false) {

        // On vérifie qu'elle est fermée
        if(strpos($part1, '</div></div>') !== false) {
            return $part1 . ' ...';
        }
        else {
            return "Le résumé de cet avis contient des spoilers, cliquez sur \"Lire l'avis complet\" pour le consulter.";
        }
    }
    else {
        return $part1 . ' ...';
    }
}

/**
 * Convertion d'une array en string
 *
 * @param $objects
 * @return string
 * @internal param $objets
 */
function formatRequestInVariable($objects) {
    $list = '';

    // Pour chaque chaine on incrémente dans une variable
    foreach ($objects as $object){
        $list.= $object->name . ', ';
    }

    // On enlève la dernière virgule
    $list = substr($list, 0, -2);

    return $list;
}

/**
 * Convertion d'une array en string
 *
 * @param $objects
 * @return string
 * @internal param $objets
 */
function formatRequestInVariableUsernameNoSpace($objects) {
    $list = '';

    // Pour chaque chaine on incrémente dans une variable
    foreach ($objects as $object){
        $list.= $object->username . ',';
    }

    // On enlève la dernière virgule
    $list = substr($list, 0, -1);

    return $list;
}

/**
 * Convertion d'une array en string sans espace
 *
 * @param $objects
 * @return string
 * @internal param $objets
 */
function formatRequestInVariableNoSpace($objects) {
    $list = '';

    // Pour chaque chaine on incrémente dans une variable
    foreach ($objects as $object){
        $list.= $object->name . ',';
    }

    // On enlève la dernière virgule
    $list = substr($list, 0, -1);

    return $list;
}

/**
 * Génére un format de date
 *
 * @param $lenght
 * @param $date
 * @return false|string
 */
function formatDate($lenght, $date) {
    setlocale(LC_TIME, 'french');

    switch ($lenght){
        case 'short':
            $format = '%d %h %Y';
            break;
        case 'long':
            $format = '%d %B %Y';
            break;
        case 'full':
            $format = '%d %B %Y &agrave; %H:%M';
            break;
        default:
            $format = '%d %M %Y';
            break;
    }
    $date = (string) $date;
    $date_format = strftime($format, strtotime($date));

    return utf8_encode($date_format);
}

/**
 * Calculate the reading time fo a content
 *
 * @param $content
 * @return string
 */
function calculateReadingTime($content) {
    $word = str_word_count(strip_tags($content));
    $m = floor($word / 200);
//    $s = floor($word % 200 / (200 / 60));
    $est = $m . ' minute' . ($m == 1 ? '' : 's');

    return $est;
}

function affichageUsername($id) {
    $user = \App\Models\User::findOrFail($id);
    return $user->username;
}