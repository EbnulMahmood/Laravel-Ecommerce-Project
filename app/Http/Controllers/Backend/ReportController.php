<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DateTime;

class ReportController extends Controller
{
    public function AllReports()
    {
        return view('backend.report.report_view');
    }

    public function SearchByDate(Request $request)
    {
        $date = new DateTime($request->date);
        $formatedDate = $date->format('d F Y');
        $orders = Order::where('order_date', $formatedDate)->latest()->get();
        $resultType = 'Date';
        return view('backend.report.report_show', compact('orders', 'resultType'));
    }

    public function SearchByMonth(Request $request)
    {
        $month = date('F', strtotime($request->month));
        $year = date('Y', strtotime($request->month));
        $orders = Order::where('order_month', $month)->where('order_year', $year)->latest()->get();
        $resultType = 'Month';
        return view('backend.report.report_show', compact('orders', 'resultType'));
    }

    public function SearchByYear(Request $request)
    {
        $orders = Order::where('order_year', $request->year)->latest()->get();
        $resultType = 'Year';
        return view('backend.report.report_show', compact('orders', 'resultType'));
    }
}
