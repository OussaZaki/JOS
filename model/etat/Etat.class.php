<?php

class Etat {
    const ONE = 1;
    const TWO = 2;
    const THREE = 3;
    const FOUR = 4;
    const FIVE = 5;
    const SIX = 6;
    const SEVEN = 7;


    public static $enums= array(
        self::ONE => "Article Soumis",
        self::TWO => "Article En Revision",
        self::THREE => "Article accepté et la version finale est conforme au Template",
        self::FOUR => "Article accepté et la version finale n\'est pas conforme au Template",
        self::FIVE => "Article accepté et la version finale est en attente pour rectification",
        self::SIX => "Article accepté et la version finale est en attente pour denière révision",
        self::SEVEN => "Article Refusé"
    );


    public static function __toString($enum) {
        return self::$enums[$enum];
    }
}