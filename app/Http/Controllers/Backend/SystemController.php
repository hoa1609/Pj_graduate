<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes\System;

class SystemController extends Controller
{
    protected $systemLibrary;
    public function __construct(System $systemLibrary){
        $this->systemLibrary = $systemLibrary;
    }

    public function index(){
        $system = $this->systemLibrary->config();
        $config = $this->config();
        $config['seo'] = config('messages.system');
        $template = 'backend.system.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
                    'system',
        ));
    }

    public function store(StoreSystemRequest $request){
        if ($this->SystemService->create($request, $this->language)) {
            return redirect()->route('System.index')->with('success', 'Cập nhật bản ghi thành công !');
        }
        return redirect()->route('System.index')->with('error', 'Cập nhật bản ghi thất bại !');
    }

    
    private function config(){
        return [
            'js' => [
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/library/finder.js',
            ]
        ];
    }

}
