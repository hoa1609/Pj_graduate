<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\ReviewServiceInterface as ReviewService;
use App\Repositories\Interfaces\ReviewRepositoryInterface as ReviewRepository;

use Illuminate\Http\Request;


class ReviewController extends Controller{

    protected $reviewService;
    protected $reviewRepository;

    public function __construct(
        ReviewService $reviewService,
        ReviewRepository $reviewRepository,
    ) {
        $this->reviewService = $reviewService;
        $this->reviewRepository = $reviewRepository;
    }

    public function index(Request $request){
        $this->authorize('modules', 'review.index');

        $perPage = $request->integer('perPage', 10);
        $reviews = $this->reviewService->paginate($request, $perPage, 1);

        $template = 'backend.review.index';
        $config['seo'] = config('apps.review.index');
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'reviews',
        ));
    }

    public function delete($id){
        $this->authorize('modules', 'review.delete');
        $review = $this->reviewRepository->findById($id);
        $template = 'backend.review.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'review',

        ));
    }
    public function destroy($id){
        if ($this->reviewService->destroy($id)) {
            return redirect()->route('review.index')->with('success', 'Xóa bình luận thành công!');
        }
        return redirect()->route('review.index')->with('error', 'Xóa bình luận thất bại!');
    }



}
