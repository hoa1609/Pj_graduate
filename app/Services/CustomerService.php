<?php

namespace App\Services;

use App\Services\Interfaces\CustomerServiceInterface;
use App\Repositories\Interfaces\CustomerRepositoryInterface as CustomerRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\CustomerCatalogue;


class CustomerService extends BaseService implements CustomerServiceInterface
{
    protected $customerRepository;

    public function __construct(
        CustomerRepository $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    public function paginate($request, $perPage = []){
        $condition = [
            'keyword' => $request->input('keyword'),
            'publish' => $request->integer('publish'),
            'customer_catalogue_id' => $request->integer('customer_catalogue_id'),
        ];
        $customers = $this->customerRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'customer/index']
        );
        return $customers;
    }


    public function updateStatus($post = []){
        DB::beginTransaction();
        try {
            $payload = [$post['field'] =>(($post['value'] == 1) ? 2 : 1)];
            $customer = $this->customerRepository->update($post['modelId'], $payload);

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
            $flag = $this->customerRepository->updateByWhereIn('id', $post['id'], $payload);

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

            $customer = $this->customerRepository->create($payload);
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

            $customer = $this->customerRepository->update($id, $payload);
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

            $customer = $this->customerRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    // public function getCustomerCatalogue()
    // {
    //    return CustomerCatalogue::where('publish', 2)->get();
    // }


    private function convertBirthdayDate($birthday = ''){
        $carbonDate = Carbon::createFromFormat('Y-m-d', $birthday);
        $birthday = $carbonDate->format('Y-m-d H:i:s');
        return $birthday;
    }


    public function statictis(){
        return [
            'totalCustomers' => $this->customerRepository->totalCustomer(),
        ];
    }

    private function paginateSelect(){
       return [
            'id',
            'name',
            'email',
            'image',
            'phone',
            'address',
            'publish',
            'customer_catalogue_id',
            'source_id',
       ];
    }
}

