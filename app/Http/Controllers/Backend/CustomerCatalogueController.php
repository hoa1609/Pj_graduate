<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Interfaces\CustomerCatalogueServiceInterface  as CustomerCatalogueService;
use App\Repositories\Interfaces\CustomerCatalogueRepositoryInterface  as CustomerCatalogueRepository;
use App\Http\Requests\Customer\StoreCustomerCatalogueRequest;


class CustomerCatalogueController extends Controller
{
    protected $customerCatalogueService;
    protected $customerCatalogueRepository;
    protected $permissionRepository;

    public function __construct(
        CustomerCatalogueService $customerCatalogueService,
        CustomerCatalogueRepository $customerCatalogueRepository,
    ){
        $this->customerCatalogueService = $customerCatalogueService;
        $this->customerCatalogueRepository = $customerCatalogueRepository;
    }

    public function index(Request $request){
        $this->authorize('modules', 'customer.catalogue.index');
        $customerCatalogues = $this->customerCatalogueService->paginate($request);
        $config['seo'] = config('apps.customercatalogue.index');
        $template = 'backend.customer.catalogue.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'customerCatalogues'
        ));
    }

    public function create(){
        $this->authorize('modules', 'customer.catalogue.create');
        $config['seo'] = config('apps.customercatalogue.create');
        $config['method'] = 'create';
        $template = 'backend.customer.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
        ));
    }

    public function store(StoreCustomerCatalogueRequest $request){
        if($this->customerCatalogueService->create($request)){
            return redirect()->route('customer.catalogue.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('customer.catalogue.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){
        $this->authorize('modules', 'customer.catalogue.update');
        $customerCatalogue = $this->customerCatalogueRepository->findById($id);
        $config['seo'] = config('apps.customercatalogue.edit');
        $config['method'] = 'edit';
        $template = 'backend.customer.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'customerCatalogue',
        ));
    }

    public function update($id, StoreCustomerCatalogueRequest $request){
        if($this->customerCatalogueService->update($id, $request)){
            return redirect()->route('customer.catalogue.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('customer.catalogue.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){
        $this->authorize('modules', 'customer.catalogue.destroy');
        $config['seo'] = config('apps.customercatalogue.delete');
        $customerCatalogue = $this->customerCatalogueRepository->findById($id);
        $template = 'backend.customer.catalogue.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'customerCatalogue',
            'config',
        ));
    }

    public function destroy($id){
        if($this->customerCatalogueService->destroy($id)){
            return redirect()->route('customer.catalogue.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('customer.catalogue.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
    }


}
