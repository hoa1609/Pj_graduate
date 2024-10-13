<?php

namespace App\Services;
use App\Services\Interfaces\BaseServiceInterface;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class BaseService  implements BaseServiceInterface
{
    protected $languageRepository;
    

    public function __construct(
    ){
    }

    public function currentLanguage(){
        return 1;
    }

}
