<?php

namespace App\Services;

use App\Services\Interfaces\UserRoleServiceInterface;
use App\Repositories\Interfaces\UserRoleRepositoryInterface as UserRoleRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class UserRoleService implements UserRoleServiceInterface
{
    protected $userRoleRepository;
    protected $userRepository;

    public function __construct(
        UserRoleRepository $userRoleRepository,
        UserRepository $userRepository
    ) {
        $this->userRoleRepository = $userRoleRepository;
        $this->userRepository = $userRepository;
    }

    public function paginate ($request, $perPage = [] ){

        $condition['keyword'] = $request->input('keyword');
        $condition['publish'] = $request->integer('publish');
        $userRoles = $this->userRoleRepository->pagination(
            $this->paginateSelect(), $condition, [] , ['path' => 'user/role/index'], $perPage, ['users']
        );
        
        return $userRoles;
    }

    public function updateStatus($post = []){
        DB::beginTransaction();
        try {
            $payload = [$post['field'] =>(($post['value'] == 1) ? 2 : 1)]; 
            $user = $this->userRoleRepository->update($post['modelId'], $payload);
            $this->changeUserStatus($post, $payload[$post['field']]);

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
            $flag = $this->userRoleRepository->updateByWhereIn('id', $post['id'], $payload);
            $this->changeUserStatus($post, $post['value']);


            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    private function changeUserStatus($post, $value){
        DB::beginTransaction();
        try {
            $array = [];
            if(isset($post['modelId'])) {
                $array[] = $post['modelId'];
            }else{
                $array = $post['id'];
            }
           $payload[$post['field']] = $value;
           $this->userRepository->updateByWhereIn('user_role_id', $array, $payload);
           

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
            $payload = $request->except('_token','send');

            $user = $this->userRoleRepository->create($payload);
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
            
            $user = $this->userRoleRepository->update($id, $payload);
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
            
            $user = $this->userRoleRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    private function paginateSelect(){
       return [
            'id',
            'name',
            'description',
            'publish',
       ];
    }
}
 