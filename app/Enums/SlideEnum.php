<?php

namespace App\Enums;

enum SlideEnum: string {
    
    const MAIN = 'slide_main';

    public static function toArray(){
        return [
            self::MAIN => 'slide_main',
        ];
    }
}
