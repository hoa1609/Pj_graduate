<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Services\Interfaces\SlideServiceInterface as SlideService;
use App\Repositories\Interfaces\OrderRepositoryInterface as OrderRepository;
use App\Enums\SlideEnum;
use App\Http\Requests\CodeRequest;
use Illuminate\Http\Request;


class OtherController extends FrontendController
{

    protected $slideService;
    protected $orderRepository;

    public function __construct(
        SlideService $slideService,
        OrderRepository $orderRepository,
    ){
       $this->slideService = $slideService;
       $this->orderRepository = $orderRepository;
        parent::__construct();
    }

    public function intro(){
        $slides = $this->slideService->getSlide([SlideEnum::INTRO, SlideEnum::INTRO2], $this->language);
        $seo = [
            'meta_title' => 'Giới thiệu',
            'meta_keyword' => '',
            'meta_description' => '',
            'canonical' => write_url('gioi-thieu', true, true),
        ];
        return view('frontend.other.intro', compact(
            'seo',
            'slides',
        ));
    }

    public function order(){
        $seo = [
            'meta_title' => 'Tìm kiếm đơn hàng',
            'meta_keyword' => '',
            'meta_description' => '',
            'canonical' => write_url('don-hang', true, true),
        ];
        return view('frontend.other.formfind', compact(
            'seo',
        ));
    }

    public function find(CodeRequest $request){
        $code = $request->code;
        $order = $this->orderRepository->findByCondition([
            ['code', '=', $code]
        ], false, ['products']);
        
        $config['method'] = 'find';
        $seo = [
            'meta_title' => 'Đơn hàng',
            'meta_keyword' => '',
            'meta_description' => '',
            'canonical' => write_url('tim-kiem-don-hang', true, true),
        ];
        if($order){
            return view('frontend.cart.success', compact(
                'order',
                'seo',
                'config',
            ));
        }
        return redirect()->back()->with('error', 'Không tìm thấy đơn hàng !');
    }

}
