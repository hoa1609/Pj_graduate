<?php

namespace App\Services;

use App\Services\Interfaces\SystemServiceInterface;
use App\Repositories\Interfaces\SystemRepositoryInterface as SystemRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class SystemService implements SystemServiceInterface
{
    protected $SystemRepository;

    public function __construct(
        SystemRepository $SystemRepository
    ) {
        $this->SystemRepository = $SystemRepository;
    }
    

   

    

    public function save($request){
        DB::beginTransaction();
        try {
            $payload = $request->except('_token','send',);
           
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }




    private function convertBirthdayDate($birthday = ''){
        $carbonDate = Carbon::createFromFormat('Y-m-d', $birthday);
        $birthday = $carbonDate->format('Y-m-d H:i:s');
        return $birthday;
    }
    
}
 
