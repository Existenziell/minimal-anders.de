<?php

/* * ****************************************
  this will return an array composed of a 4 item array for each language the os
  supports
  1. full language abbreviation, like en-ca
  2. primary language, like en
  3. full language string, like English (Canada)
  4. primary language string, like English
 * ***************************************** */

// to call this you only need to use the $feature parameter
function getLanguage($mode) {

    // get the languages array
    $lang_array = languages();
    $index = '';
    $complete = '';
    $default_lang = 'en';

    //prepare user language array
    $user_languages = array();

    //check to see if language is set
    if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {

        //explode languages into array
        $languages = strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"]);
        $languages = explode(",", $languages);

        foreach ($languages as $language_list) {
            // pull out the language, place languages into array of full and primary string structure:
            $temp_array = array();
            // slice out the part before ; on first step, the part before on second, place into array
            $temp_array[0] = substr($language_list, 0, strcspn($language_list, ';'));
            //full language
            $temp_array[1] = substr($language_list, 0, 2);
            // cut out primary language
            //place this array into main $user_languages language array
            $user_languages[] = $temp_array;
        }

        //start going through each one
        for ($i = 0; $i < count($user_languages); $i++) {
            foreach ($lang_array as $index => $complete) {
                if ($index == $user_languages[$i][0]) {
                    // complete language, like english (canada)
                    $user_languages[$i][2] = $complete;
                    // extract working language, like english
                    $user_languages[$i][3] = substr($complete, 0, strcspn($complete, ' ('));
                }
            }
        }
    } else {
    	return $default_lang;
    }

    // return language
    if ($mode == 'single') {
        $user_language = $user_languages[0][1];
        return $user_language;
    } else if ($mode == 'double') {
        $user_language = $user_languages[0][0];
        return $user_language;
    } else if ($mode == 'full') {
        $user_language = $user_languages[1][2];
        return $user_language;
    }
}

// pack abbreviation/language array
function languages() {
    $languages = array(
        'af' => 'Afrikaans',
        'sq' => 'Albanian',
        'ar-dz' => 'Arabic (Algeria)',
        'ar-bh' => 'Arabic (Bahrain)',
        'ar-eg' => 'Arabic (Egypt)',
        'ar-iq' => 'Arabic (Iraq)',
        'ar-jo' => 'Arabic (Jordan)',
        'ar-kw' => 'Arabic (Kuwait)',
        'ar-lb' => 'Arabic (Lebanon)',
        'ar-ly' => 'Arabic (libya)',
        'ar-ma' => 'Arabic (Morocco)',
        'ar-om' => 'Arabic (Oman)',
        'ar-qa' => 'Arabic (Qatar)',
        'ar-sa' => 'Arabic (Saudi Arabia)',
        'ar-sy' => 'Arabic (Syria)',
        'ar-tn' => 'Arabic (Tunisia)',
        'ar-ae' => 'Arabic (U.A.E.)',
        'ar-ye' => 'Arabic (Yemen)',
        'ar' => 'Arabic',
        'hy' => 'Armenian',
        'as' => 'Assamese',
        'az' => 'Azeri',
        'eu' => 'Basque',
        'be' => 'Belarusian',
        'bn' => 'Bengali',
        'bg' => 'Bulgarian',
        'ca' => 'Catalan',
        'zh-cn' => 'Chinese (China)',
        'zh-hk' => 'Chinese (Hong Kong SAR)',
        'zh-mo' => 'Chinese (Macau SAR)',
        'zh-sg' => 'Chinese (Singapore)',
        'zh-tw' => 'Chinese (Taiwan)',
        'zh' => 'Chinese',
        'hr' => 'Croatian',
        'cs' => 'Czech',
        'da' => 'Danish',
        'div' => 'Divehi',
        'nl-be' => 'Dutch (Belgium)',
        'nl' => 'Dutch (Netherlands)',
        'en-au' => 'English (Australia)',
        'en-bz' => 'English (Belize)',
        'en-ca' => 'English (Canada)',
        'en-ie' => 'English (Ireland)',
        'en-jm' => 'English (Jamaica)',
        'en-nz' => 'English (New Zealand)',
        'en-ph' => 'English (Philippines)',
        'en-za' => 'English (South Africa)',
        'en-tt' => 'English (Trinidad)',
        'en-gb' => 'English (United Kingdom)',
        'en-us' => 'English (United States)',
        'en-zw' => 'English (Zimbabwe)',
        'en' => 'English',
        'us' => 'English (United States)',
        'et' => 'Estonian',
        'fo' => 'Faeroese',
        'fa' => 'Farsi',
        'fi' => 'Finnish',
        'fr-be' => 'French (Belgium)',
        'fr-ca' => 'French (Canada)',
        'fr-lu' => 'French (Luxembourg)',
        'fr-mc' => 'French (Monaco)',
        'fr-ch' => 'French (Switzerland)',
        'fr' => 'French (France)',
        'mk' => 'FYRO Macedonian',
        'gd' => 'Gaelic',
        'ka' => 'Georgian',
        'de-at' => 'German (Austria)',
        'de-li' => 'German (Liechtenstein)',
        'de-lu' => 'German (lexumbourg)',
        'de-ch' => 'German (Switzerland)',
        'de' => 'German (Germany)',
        'el' => 'Greek',
        'gu' => 'Gujarati',
        'he' => 'Hebrew',
        'hi' => 'Hindi',
        'hu' => 'Hungarian',
        'is' => 'Icelandic',
        'id' => 'Indonesian',
        'it-ch' => 'Italian (Switzerland)',
        'it' => 'Italian (Italy)',
        'ja' => 'Japanese',
        'kn' => 'Kannada',
        'kk' => 'Kazakh',
        'kok' => 'Konkani',
        'ko' => 'Korean',
        'kz' => 'Kyrgyz',
        'lv' => 'Latvian',
        'lt' => 'Lithuanian',
        'ms' => 'Malay',
        'ml' => 'Malayalam',
        'mt' => 'Maltese',
        'mr' => 'Marathi',
        'mn' => 'Mongolian (Cyrillic)',
        'ne' => 'Nepali (India)',
        'nb-no' => 'Norwegian (Bokmal)',
        'nn-no' => 'Norwegian (Nynorsk)',
        'no' => 'Norwegian (Bokmal)',
        'or' => 'Oriya',
        'pl' => 'Polish',
        'pt-br' => 'Portuguese (Brazil)',
        'pt' => 'Portuguese (Portugal)',
        'pa' => 'Punjabi',
        'rm' => 'Rhaeto-Romanic',
        'ro-md' => 'Romanian (Moldova)',
        'ro' => 'Romanian',
        'ru-md' => 'Russian (Moldova)',
        'ru' => 'Russian',
        'sa' => 'Sanskrit',
        'sr' => 'Serbian',
        'sk' => 'Slovak',
        'ls' => 'Slovenian',
        'sb' => 'Sorbian',
        'es-ar' => 'Spanish (Argentina)',
        'es-bo' => 'Spanish (Bolivia)',
        'es-cl' => 'Spanish (Chile)',
        'es-co' => 'Spanish (Colombia)',
        'es-cr' => 'Spanish (Costa Rica)',
        'es-do' => 'Spanish (Dominican Republic)',
        'es-ec' => 'Spanish (Ecuador)',
        'es-sv' => 'Spanish (El Salvador)',
        'es-gt' => 'Spanish (Guatemala)',
        'es-hn' => 'Spanish (Honduras)',
        'es-mx' => 'Spanish (Mexico)',
        'es-ni' => 'Spanish (Nicaragua)',
        'es-pa' => 'Spanish (Panama)',
        'es-py' => 'Spanish (Paraguay)',
        'es-pe' => 'Spanish (Peru)',
        'es-pr' => 'Spanish (Puerto Rico)',
        'es-us' => 'Spanish (United States)',
        'es-uy' => 'Spanish (Uruguay)',
        'es-ve' => 'Spanish (Venezuela)',
        'es' => 'Spanish (Traditional Sort)',
        'sx' => 'Sutu',
        'sw' => 'Swahili',
        'sv-fi' => 'Swedish (Finland)',
        'sv' => 'Swedish',
        'syr' => 'Syriac',
        'ta' => 'Tamil',
        'tt' => 'Tatar',
        'te' => 'Telugu',
        'th' => 'Thai',
        'ts' => 'Tsonga',
        'tn' => 'Tswana',
        'tr' => 'Turkish',
        'uk' => 'Ukrainian',
        'ur' => 'Urdu',
        'uz' => 'Uzbek',
        'vi' => 'Vietnamese',
        'xh' => 'Xhosa',
        'yi' => 'Yiddish',
        'zu' => 'Zulu');
    return $languages;
}

?>