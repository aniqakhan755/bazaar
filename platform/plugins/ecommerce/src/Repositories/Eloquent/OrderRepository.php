<?php

namespace Botble\Ecommerce\Repositories\Eloquent;

use Botble\Ecommerce\Repositories\Interfaces\OrderInterface;
use Botble\Payment\Enums\PaymentStatusEnum;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Illuminate\Support\Facades\Auth;
use DB;

class OrderRepository extends RepositoriesAbstract implements OrderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getRevenueData($startDate, $endDate, $select = [])
    {
        if (empty($select)) {
            $select = [
                DB::raw('DATE(payments.created_at) AS date'),
                DB::raw('SUM(COALESCE(payments.amount, 0) - COALESCE(payments.refunded_amount, 0)) as revenue'),
            ];
        }
        $user = Auth::user();
        if(count($user->roles) > 0)
        {
            $role_name = $user->roles[0]->slug;
            if($role_name  == 'vendor')
            {
                $user_id = Auth::user()->id;
                $data = $this->model
                    ->join('payments', 'payments.id', '=', 'ec_orders.payment_id')
                    ->leftJoin('ec_order_product', 'ec_orders.id', '=', 'ec_order_product.order_id')
                    ->leftJoin('ec_products', 'ec_order_product.product_id', '=', 'ec_products.id')
                    ->where('ec_products.user_id',$user_id)
                    ->whereDate('payments.created_at', '>=', $startDate)
                    ->whereDate('payments.created_at', '<=', $endDate)
                    ->where('payments.status', PaymentStatusEnum::COMPLETED)
                    ->groupBy('date')
                    ->select($select);
            }
            else{
                $data = $this->model
                ->join('payments', 'payments.id', '=', 'ec_orders.payment_id')
                ->whereDate('payments.created_at', '>=', $startDate)
                ->whereDate('payments.created_at', '<=', $endDate)
                ->where('payments.status', PaymentStatusEnum::COMPLETED)
                ->groupBy('date')
                ->select($select);
            }
        }
        else
        {
            $data = $this->model
            ->join('payments', 'payments.id', '=', 'ec_orders.payment_id')
            ->whereDate('payments.created_at', '>=', $startDate)
            ->whereDate('payments.created_at', '<=', $endDate)
            ->where('payments.status', PaymentStatusEnum::COMPLETED)
            ->groupBy('date')
            ->select($select);
        }

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function countRevenueByDateRange($startDate, $endDate)
    {
        $user = Auth::user();
        if(count($user->roles) > 0)
        {
            $role_name = $user->roles[0]->slug;
            if($role_name  == 'vendor')
            {
                $user_id = Auth::user()->id;
                $data = $this->model
                ->join('payments', 'payments.id', '=', 'ec_orders.payment_id')
                ->leftJoin('ec_order_product', 'ec_orders.id', '=', 'ec_order_product.order_id')
                ->leftJoin('ec_products', 'ec_order_product.product_id', '=', 'ec_products.id')
                ->where('ec_products.user_id',$user_id)
                ->where('payments.created_at', '>=', $startDate)
                ->where('payments.created_at', '<=', $endDate)
                ->where('payments.status', PaymentStatusEnum::COMPLETED);
            }else{
                $data = $this->model
                ->join('payments', 'payments.id', '=', 'ec_orders.payment_id')
                ->where('payments.created_at', '>=', $startDate)
                ->where('payments.created_at', '<=', $endDate)
                ->where('payments.status', PaymentStatusEnum::COMPLETED);
            }
        }else
        {
            $data = $this->model
            ->join('payments', 'payments.id', '=', 'ec_orders.payment_id')
            ->where('payments.created_at', '>=', $startDate)
            ->where('payments.created_at', '<=', $endDate)
            ->where('payments.status', PaymentStatusEnum::COMPLETED);
        }

        return $this
            ->applyBeforeExecuteQuery($data)
            ->sum(DB::raw('COALESCE(payments.amount, 0) - COALESCE(payments.refunded_amount, 0)'));
    }
}
