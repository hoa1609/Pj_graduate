<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class DashboardController extends Controller
{
    protected $language;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $locale = app()->getLocale(); // vn en cn
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language->id;
            return $next($request);
        });
    }


    public function changeStatus(Request $request)
    {
        $post = $request->input();
        $serviceInterfaceNamespace = '\App\Services\\' . ucfirst($post['model']) . 'Service';
        if (class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }

        $flag = $serviceInstance->updateStatus($post);

        return response()->json(['flag' => $flag, 'success' => true]);
    }

    public function changeStatusAll(Request $request)
    {
        $post = $request->input();
        $serviceInterfaceNamespace = '\App\Services\\' . ucfirst($post['model']) . 'Service';
        if (class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }
        $flag = $serviceInstance->updateStatusAll($post);

        return response()->json(['flag' => $flag]);
    }

    public function getMenu(Request $request)
{
    // Xác thực tham số 'model'
    $request->validate([
        'model' => 'required|string|alpha_dash',
    ]);

    $model = $request->input('model');
    $serviceInterfaceNamespace = '\App\Repositories\\' . ucfirst($model) . 'Repository';

    // Kiểm tra xem repository class có tồn tại không
    if (!class_exists($serviceInterfaceNamespace)) {
        Log::error("Repository class does not exist: {$serviceInterfaceNamespace}");
        return response()->json(['error' => "Repository {$serviceInterfaceNamespace} does not exist."], 404);
    }

    // Tạo instance của repository
    $serviceInstance = app($serviceInterfaceNamespace);

    // Lấy các tham số phân trang
    $arguments = $this->paginationArguments($model);

    // Kiểm tra xem phương thức phân trang có tồn tại trong repository không
    if (!method_exists($serviceInstance, 'pagination')) {
        Log::error("Pagination method does not exist in repository: {$serviceInterfaceNamespace}");
        return response()->json(['error' => 'Pagination method does not exist in the repository.'], 500);
    }

    // Gọi phương thức phân trang
    $object = $serviceInstance->pagination(...array_values($arguments));

    // Trả về dữ liệu hoặc mảng rỗng nếu không có dữ liệu
    if (empty($object)) {
        return response()->json(['data' => []]);
    }

    return response()->json(['data' => $object]);
}



    private function paginationArgument(string $model = ''): array
    {
        $model = \Illuminate\Support\Str::snake($model);
        $join = [
            [$model . '_language as tb2', 'tb2.' . $model . '_id', '=', $model . 's.id'],
        ];

        // Handle catalogue model join if applicable
        if (strpos($model, '_catalogue') === false) {
            $join[] = [$model . '_catalogue_' . $model . ' as tb3', $model . 's.id', '=', 'tb3.' . $model . '_id'];
        }

        return [
            'select' => ['id', 'name'],
            'condition' => [
                'where' => [
                    ['tb2.language_id', '=', $this->language ?? 'default_language_id'],
                ]
            ],
            'perpage' => 10,
            'paginationConfig' => [
                'path' => $model . '.index',
                'groupBy' => ['id', 'name']
            ],
            'orderBy' => [$model . 's.id', 'DESC'],
            'join' => $join,
            'relations' => [],
        ];
    }
}
