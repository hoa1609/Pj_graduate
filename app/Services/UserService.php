<?php

namespace App\Services;

use App\Models\UserCatalogue;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository ;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;


/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    private function paginateSelect(){
        return [
             'id',
             'name',
             'email',
             'phone',
             'address',
             'image',
             'publish',
             'user_catalogue_id'
        ];
     }

    public function paginate($request, $perPage = [])
    {
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

    public function create($request)
    {
        DB::beginTransaction();
        try{

            $payload = $request->except(['_token', 'send','re_password']);
            if($payload['birthday'] !=null) {
                $payload['birthday'] = $this->convertBirthDate($payload['birthday']);
            }
            $payload['password'] = Hash::make($request->input('password'));

            $user = $this->userRepository->create($payload);
             DB::commit();
              return true;
            }catch(\Exception $e ){
                DB::rollBack();
                // Log::error($e->getMessage());
                echo $e->getMessage(); die();
                return false;
            }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try{

            $payload = $request->except(['_token', 'send']);
            if($payload['birthday'] !=null) {
                $payload['birthday'] = $this->convertBirthDate($payload['birthday']);
            }
            $user = $this->userRepository->update($id, $payload);
             DB::commit();
              return true;
            }catch(\Exception $e ){
                DB::rollBack();
                // Log::error($e->getMessage());
                echo $e->getMessage(); die();
                return false;
            }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $user = $this->userRepository->delete($id);
             DB::commit();
              return true;
            }catch(\Exception $e ){
                DB::rollBack();
                // Log::error($e->getMessage());
                echo $e->getMessage(); die();
                return false;
            }
    }

    public function updateStatus($post = [])
    {
        DB::beginTransaction();
        try {
            $payload = [$post['field'] =>(($post['value'] == 1) ? 2 : 1)];
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

    public function getMenu()
    {
       return UserCatalogue::where('publish', 2)->get();
    }

    private function convertBirthDate($birthday = '')
    {
        $carbonDate = Carbon::createFromFormat('Y-m-d', $birthday);
        $payload['birthday'] = $carbonDate->format('Y-m-d H:i:s');

        return $birthday;
    }

}
