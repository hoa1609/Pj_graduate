<?php

namespace App\Enums;

enum SlideEnum: string {
    
    const MAIN = 'slide_main';
    const SELLER = 'banner_seller';
    const INTRO = 'intro_slider';
    const INTRO2 = 'intro_2';

    public static function toArray(){
        return [
            self::MAIN => 'slide_main',
            self::SELLER => 'banner_seller',
            self::INTRO => 'intro_slider',
            self::INTRO2 => 'intro_2',
        ];
    }
}
