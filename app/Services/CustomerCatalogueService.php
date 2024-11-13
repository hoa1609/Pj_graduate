<?php

namespace App\Services;

use App\Services\Interfaces\CustomerCatalogueServiceInterface;
use App\Repositories\Interfaces\CustomerCatalogueRepositoryInterface as CustomerCatalogueRepository;
use App\Repositories\Interfaces\CustomerRepositoryInterface as CustomerRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;


/**
 * Class CustomerCatalogueService
 * @package App\Services
 */
class CustomerCatalogueService extends BaseService implements CustomerCatalogueServiceInterface
{
    protected $customerCatalogueRepository;
    protected $customerRepository;

    public function __construct(
        CustomerCatalogueRepository $customerCatalogueRepository,
        CustomerRepository $customerRepository
    ) {
        $this->customerCatalogueRepository = $customerCatalogueRepository;
        $this->customerRepository = $customerRepository;
    }

    private function paginateSelect()
    {
        return [
            'id',
            'name',
            'description',
            'publish'
        ];
    }

    public function paginate($request){

        $perPage = $request->integer('perpage', 10);
        $condition['keyword'] = $request->input('keyword');
        $customerCatalogues = $this->customerCatalogueRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'customerCatalogue/index'],
        );

        return $customerCatalogues;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {

            $payload = $request->except(['_token', 'send']);
            $customer = $this->customerCatalogueRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {

            $payload = $request->except(['_token', 'send']);
            $customer = $this->customerCatalogueRepository->update($id, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $customer = $this->customerCatalogueRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function updateStatus($post = [])
    {
        DB::beginTransaction();
        try {
            // Cập nhật trạng thái cho customerCatalogue
            // Nếu bật thì set thành 2, nếu tắt thì set thành 1
            $payload = [$post['field'] => (($post['value'] == 1) ? 2 : 1)];
            $this->customerCatalogueRepository->update($post['modelId'], $payload);

            // Gọi hàm changecustomerStatus với giá trị 2 hoặc 1 tương ứng
            $this->changeUserStatus($post, ($post['value'] == 1) ? 2 : 1);


            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            // echo $e->getMessage();
            // die();
            return false;
        }
    }

    public function changeUserStatus($post, $value)
    {
        DB::beginTransaction();
        try {
            // Tạo mảng user IDs từ modelId
            $array = is_array($post['modelId']) ? $post['modelId'] : [$post['modelId']];

            // Thiết lập payload cho userRepository
            $payload = [$post['field'] => $value];

            // Cập nhật trạng thái cho user
            $this->customerRepository->updateByWhereIn('customer_catalogue_id', $array, $payload);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die();
            return false;
        }
    }


}
