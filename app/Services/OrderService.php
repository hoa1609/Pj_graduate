<?php

namespace App\Services;

use App\Services\Interfaces\OrderServiceInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface as OrderRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
// use App\Models\OrderCatalogue;


class OrderService extends BaseService implements OrderServiceInterface
{
    protected $orderRepository;

    public function __construct(
        OrderRepository $orderRepository
    ) {
        $this->orderRepository = $orderRepository;
    }

    public function paginate($request, $perPage = [])
    {
        $condition = [
            'keyword' => $request->input('keyword'),
            'publish' => $request->integer('publish'),
            'order_catalogue_id' => $request->integer('order_catalogue_id'),
        ];
        $orders = $this->orderRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perPage,
            ['path' => 'order/index']
        );
        return $orders;
    }

    public function orderStatistic()
    {
        $month = now()->month;
        $year = now()->year;

        $previousMonth = ($month == 1) ? 12 : $month - 1;
        $previousYear = ($month == 1) ? $year - 1 : $year;


        $orderCurrentMonth = $this->orderRepository->getOrderByTime($month, $year);
        $orderPreviousMonth = $this->orderRepository->getOrderByTime($previousMonth, $previousYear);

        return [
            'orderCurrentMonth' => $orderCurrentMonth,
            'orderPreviousMonth' => $orderPreviousMonth,
            'grow' => growth($orderCurrentMonth, $orderPreviousMonth),
            'totalOrder' => $this->orderRepository->getTotalOrder(),
            'cancelOrder' => $this->orderRepository->getCancelOrder(),
            'revenueOrder' => $this->orderRepository->getOrderRevenue(),
            'revenueChart' => convertRevenueChartData($this->orderRepository->revenueByYear($year)),
        ];
    }

    public function ajaxOrderChart($request)
    {
        $type = $request->input('chartType');
        switch ($type) {
            case 1:
                $year = now()->year;
                $response = convertRevenueChartData($this->orderRepository->revenueByYear($year));
                break;
            case 7:
                $response = $this->orderRepository->revenue7Day($year);
                break;
            case 30:
                $response = $this->orderRepository->revenueCurrentMonth();
                break;
            default:
        }
        dd($response);
    }



    private function paginateSelect()
    {
        return [
            'id',
            'name',
            'email',
            'image',
            'phone',
            'address',
            'publish',
            'order_catalogue_id',
            'source_id',
        ];
    }
}
