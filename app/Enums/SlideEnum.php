<?php

namespace App\Enums;

enum SlideEnum: string {
    
    const MAIN = 'slide_main';
    const SELLER = 'banner_seller';

    public static function toArray(){
        return [
            self::MAIN => 'slide_main',
            self::SELLER => 'banner_seller',
        ];
    }
}
