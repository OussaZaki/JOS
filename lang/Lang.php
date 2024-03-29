<?php

class Lang {
    
    public $phrases;
    public function __construct() {
        $this->load_phrases($this->lang_id());
    }

    public function load_phrases($lang_id) {
        $xml = new DomDocument('1.0');
        $LANG_PATH = 'lang/';
        //path to language directory
        $lang_path = ($LANG_PATH . $lang_id . '.xml');
        $xml->load($lang_path);

        //phrases are inside page tags, first we must get these
        $page = $xml->getElementsByTagName('page');
        $page_num = $page->length;

        for ($i = 0; $i < $page_num; $i++) {
            $page = $xml->getElementsByTagName('page')->item($i);

            //get phase tags and store them into array
            foreach ($page->getElementsByTagName('phase') as $phase) {
                $phase_name = $phase->getAttribute('name');
                $phrases[$phase_name] = $phase->firstChild->nodeValue;
                $phrases[$phase_name] = str_replace('\\n', '<br/>', $phrases[$phase_name]);
            }
        }

        $this->phrases = $phrases;
    }

    public function lang_id() {
        //determine page language
        $lang_id = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'en';

        //set the language cookie and update cookie expiration date
        if (!isset($_COOKIE['lang'])) {
            $expiration_date = time() + 3600 * 24 * 365;
            setcookie('lang', $lang_id, $expiration_date, '/');
        }

        return $lang_id;
    }

    public function change_lang($lang_id) {
        setcookie('lang', $lang_id, $expiration_date, '/');
    }

}
