<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function paginate ($request, $perPage = [] ){

        $condition['keyword'] = $request->input('keyword');
        $users = $this->userRepository->pagination(
            $this->paginateSelect(),
            $condition, 
            [] ,
            ['path' => 'user/index'], 
            $perPage
        );
        
        return $users;
    }

    public function updateStatus($post = []){
        DB::beginTransaction();
        try {
            $payload = [$post['field'] =>(($post['value'] == 1) ? 0 : 1)]; 
            $user = $this->userRepository->update($post['modelId'], $payload);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function updateStatusAll($post){
        DB::beginTransaction();
        try {
            $payload = [$post['field'] => $post['value']]; 
            $flag = $this->userRepository->updateByWhereIn('id', $post['id'], $payload);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function create($request){
        DB::beginTransaction();
        try {
            $payload = $request->except('_token','send','re_password');
            $payload['password'] = Hash::make($request->input('password'));

            $user = $this->userRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function update($id, $request){
        DB::beginTransaction();
        try {
            $payload = $request->except('_token','send');
            $payload['birthday'] = $this->convertBirthdayDate($payload['birthday']);
            
            $user = $this->userRepository->update($id, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function destroy($id){
        DB::beginTransaction();
        try {
            
            $user = $this->userRepository->delete($id);
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
    
    private function paginateSelect(){
       return [
            'id',
            'name',
            'email',
            'phone',
            'address',
            'publish'
       ];
    }
}
 