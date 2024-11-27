<?php

namespace App\Repositories;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    protected $model;

    public function __construct(
        Order $model
    ) {
        $this->model = $model;
    }

    public function getOrderByTime($month, $year)
    {
        return $this->model
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->count();
    }

    public function getTotalOrder()
    {
        return $this->model->count();
    }

    public function getCancelOrder()
    {
        return $this->model->where('confirm', '=', 'cancelled')->count();
    }
    public function getOrderRevenue()
    {
        return $this->model
            ->join('order_product', 'order_product.order_id', '=', 'orders.id')
            ->where('orders.payment', '=', 'paid')
            ->sum(DB::raw('order_product.price * order_product.qty'));
    }

    public function revenueByYear($year)
    {
        return DB::table(DB::raw('
            (SELECT 1 AS month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION
             SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) AS months
        '))
            ->select(
                'months.month',
                DB::raw('
                COALESCE(SUM(JSON_UNQUOTE(JSON_EXTRACT(orders.cart, "$.cartTotal"))), 0) AS monthly_revenue
            ')
            )
            ->leftJoin('orders', function ($join) use ($year) {
                $join->on(DB::raw('months.month'), '=', DB::raw('MONTH(orders.created_at)'))
                    ->where('orders.payment', 'paid')
                    ->where(DB::raw('YEAR(orders.created_at)'), $year);
            })
            ->groupBy('months.month')
            ->orderBy('months.month')
            ->get();
    }

    // public function revenue7Day($year)
    // {
    //     return $this->model
    //     ->select(DB::raw('
    //         dates.date,
    //         COALESCE(SUM(JSON_UNQUOTE(JSON_EXTRACT(orders.cart, "$.cartTotal"))), 0) AS daily_revenue
    //     '))
    //     ->from(DB::raw('(
    //         SELECT CURDATE() - INTERVAL (a.a + (10*b.a) + (100 * c.a)) DAY as date
    //         FROM (
    //             SELECT 0 AS a UNION ALL
    //             SELECT 1 UNION ALL
    //             SELECT 2 UNION ALL
    //             SELECT 3 UNION ALL
    //             SELECT 4 UNION ALL
    //             SELECT 5 UNION ALL
    //             SELECT 6 UNION ALL
    //             SELECT 7 UNION ALL
    //             SELECT 8 UNION ALL
    //             SELECT 9
    //         ) as a
    //          CROSS JOIN (
    //          SELECT 0 AS a UNION ALL
    //             SELECT 1 UNION ALL
    //             SELECT 2 UNION ALL
    //             SELECT 3 UNION ALL
    //             SELECT 4 UNION ALL
    //             SELECT 5 UNION ALL
    //             SELECT 6 UNION ALL
    //             SELECT 7 UNION ALL
    //             SELECT 8 UNION ALL
    //             SELECT 9
    //         ) as b
    //          CROSS JOIN (
    //          SELECT 0 AS a UNION ALL
    //             SELECT 1 UNION ALL
    //             SELECT 2 UNION ALL
    //             SELECT 3 UNION ALL
    //             SELECT 4 UNION ALL
    //             SELECT 5 UNION ALL
    //             SELECT 6 UNION ALL
    //             SELECT 7 UNION ALL
    //             SELECT 8 UNION ALL
    //             SELECT 9
    //         ) as c
    //  )as dates'))
    //     ->ledtJoin('order', function($join){
    //         $join->on(DB::raw('DATE(orders.created_at)'), '=', DB::raw('dates.date'))
    //         ->where9('orders.payment', '=', 'paid');
    //  })->where(DB::raw('dates.date'), '>=', DB::raw('CURDATE() - INTERVAL 6 DAY'))
    //  ->groupBY(DB::raw('dates.date'))
    //  ->orderBy(DB::raw('dates.date'), 'ASC')
    //  ->get();
    // }
}
