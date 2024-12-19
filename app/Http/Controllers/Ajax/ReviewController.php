<?php

namespace App\Http\Controllers\Ajax;

use App\Services\Interfaces\ReviewServiceInterface as ReviewService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    protected $reviewService;


    public function __construct(
        ReviewService $reviewService,
    ){
        $this->reviewService = $reviewService;
    }


    public function create(ReviewRequest $request){
        if (Auth::guard('customer')->check()) {
            $response = $this->reviewService->create($request);
            return response()->json($response);
        }
        return response()->json([], 401);
    }

}
