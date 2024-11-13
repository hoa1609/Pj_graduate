<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\CustomerServiceInterface as CustomerService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\CustomerRepositoryInterface as CustomerRepository;
use App\Repositories\Interfaces\CustomerCatalogueRepositoryInterface as CustomerCatalogueRepository;
use App\Repositories\Interfaces\SourceRepositoryInterface as SourceRepository;

use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use Illuminate\Http\Request;


class CustomerController extends Controller{

    protected $customerService;
    protected $provinceRepository;
    protected $customerRepository;
    protected $customerCatalogueRepository;
    protected $sourceCatalogueRepository;

    public function __construct(
        CustomerService $customerService,
        ProvinceRepository $provinceRepository,
        CustomerRepository $customerRepository,
        CustomerCatalogueRepository $customerCatalogueRepository,
        SourceRepository $sourceRepository,
    ) {
        $this->customerService = $customerService;
        $this->provinceRepository = $provinceRepository;
        $this->customerRepository = $customerRepository;
        $this->customerCatalogueRepository = $customerCatalogueRepository;
        $this->sourceRepository = $sourceRepository;
    }

    public function index(Request $request){
        $this->authorize('modules', 'customer.index');

        // $customerCatalogues = $this->customerService->getCustomerCatalogue();
        $customerCatalogues = $this->customerCatalogueRepository->all();
        $sources = $this->sourceRepository->all();
        $perPage = $request->integer('perPage', 10);
        $customers = $this->customerService->paginate($request, $perPage);

        $config['seo'] = config('apps.customer.index');
        $template = 'backend.customer.customer.index';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'customers',
            'customerCatalogues',
            'sources',
        ));
    }


    public function create(){
        $this->authorize('modules', 'customer.create');

        $customerCatalogues = $this->customerCatalogueRepository->all();
        $sources = $this->sourceRepository->all();
        $provinces = $this->provinceRepository->all();
        $config['method'] = 'create';
        $config['seo'] = config('apps.customer.create');

        $template = 'backend.customer.customer.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'provinces',
            'customerCatalogues',
            'sources',
        ));
    }


    public function store(StoreCustomerRequest $request){
        if ($this->customerService->create($request)) {
            return redirect()->route('customer.index')->with('success', 'Thêm bản ghi thành công !');
        }
        return redirect()->route('customer.index')->with('error', 'Thêm bản ghi thất bại !');
    }


    public function edit($id){
        $this->authorize('modules', 'customer.edit');

        $customerCatalogues = $this->customerCatalogueRepository->all();
        $sources = $this->sourceRepository->all();
        $customer = $this->customerRepository->findById($id);
        $provinces = $this->provinceRepository->all();
        $config['method'] = 'edit';
        $config['seo'] = config('apps.customer.edit');

        $template = 'backend.customer.customer.store';
        return view('backend.dashboard.layout', compact(
            'config',
            'template',
            'provinces',
            'customer',
            'customerCatalogues',
            'sources',
        ));
    }

    public function delete($id){
        $this->authorize('modules', 'customer.delete');
        $customer = $this->customerRepository->findById($id);
        $template = 'backend.customer.customer.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'customer',
        ));
    }


    public function update($id, UpdateCustomerRequest $request){
        if ($this->customerService->update($id, $request)) {
            return redirect()->route('customer.index')->with('success', 'Cập nhập bản ghi thành công !');
        }
        return redirect()->route('customer.index')->with('error', 'Cập nhập bản ghi thất bại !');
    }


    public function destroy($id){
        $this->authorize('modules', 'customer.destroy');

        if ($this->customerService->destroy($id)) {
            return redirect()->route('customer.index')->with('success', 'Xóa bản ghi thành công !');
        }
        return redirect()->route('customer.index')->with('error', 'Xóa bản ghi thất bại !');
    }
}
