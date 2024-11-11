<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes\System;
use App\Services\Interfaces\SystemServiceInterface as SystemService;
use App\Models\Language;

class SystemController extends Controller
{
    protected $systemLibrary;
    protected $systemService;
    protected $language;

    public function __construct(
        System $systemLibrary,
        SystemService $systemService,
    ) {
        $this->middleware(middleware: function($request, $next){
            $locale = app()->getLocale(); 
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language ? $language->id : 1;
            return $next($request);
        });

        $this->systemLibrary = $systemLibrary;
        $this->systemService = $systemService;
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

    public function store(Request $request){
        if ($this->systemService->save($request, $this->language)) { // Xóa $this->language nếu không cần
            return redirect()->route('system.index')->with('success', 'Cập nhật bản ghi thành công !');
        }
        return redirect()->route('system.index')->with('error', 'Cập nhật bản ghi thất bại !');
    }

    private function config()
    {
        return [
            'js' => [
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/library/finder.js',
            ]
        ];
    }
}
