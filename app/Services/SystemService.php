<?php

namespace App\Services;

use App\Services\Interfaces\SystemServiceInterface;
use App\Repositories\Interfaces\SystemRepositoryInterface as SystemRepository;

// use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class SystemService implements SystemServiceInterface
{
    protected $SystemRepository;

    public function __construct(
        SystemRepository $SystemRepository
    ) {
        $this->SystemRepository = $SystemRepository;
    }
    

   

    

    public function save($request,$languageId){
        DB::beginTransaction();
        try {
            $config = $request->input('config') ;
            $payload= [];
            if(count($config)){
                foreach($config as $key => $val){
                    $payload[]=[
                        'keyword' => $key,
                        'content' => $val,
                        'language_id' =>$languageId,
                        'user_id' => Auth::id(),
                    ];
                    $condition = ['keyword' => $key];
                     $this->SystemRepository->update0rInsert($payload,$condition );

                }
            }
           
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
 
