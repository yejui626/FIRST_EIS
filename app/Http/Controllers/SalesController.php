<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;

class SalesController extends Controller
{
    public function viewOrderDetail()
    {
        $orders = Order::orderBy('id', 'ASC')->get();
        return view('order_detail.index', compact('orders'));
    }

    public function viewWeeklySales(Request $request)
    {
        // Retrieve the selected week from the request
        $selectedWeek = $request->input('week');
    
        // Get the start and end dates for the selected week
        if ($selectedWeek) {
            $startDate = now()->setISODate(date('Y'), $selectedWeek)->startOfWeek();
            $endDate = now()->setISODate(date('Y'), $selectedWeek)->endOfWeek();
        } else {
            $startDate = null;
            $endDate = null;
        }
    
        $salesQuery = DB::table('orders')
            ->join('items', 'orders.id', '=', 'items.order_id')
            ->join('products', 'items.product_id', '=', 'products.id')
            ->select('products.product_name', DB::raw('SUM(items.product_quantity * products.product_sellingprice) as total_sales'))
            ->groupBy('products.product_name')
            ->orderBy('total_sales', 'desc');
    
        // Apply product filter if provided
        $productFilter = $request->input('product');
        if ($productFilter) {
            $salesQuery->where('products.product_name', $productFilter);
        }

        if ($startDate && $endDate) {
            $salesQuery->whereBetween('orders.created_at', [$startDate, $endDate]);
        }
    
        $sales = $salesQuery->get();
    
        // Get the list of weeks for the year
        $weeks = $this->getWeeks();
    
        $products = Product::pluck('product_name', 'id');
    
        return view('weekly_sales.index', [
            'class' => '',
            'elementActive' => 'total-sales',
            'sales' => $sales,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'productFilter' => $productFilter,
            'weeks' => $weeks,
            'selectedWeek' => $selectedWeek,
            'products' => $products,
        ]);
    }
    
    private function getWeeks()
    {
        $weeks = [];
    
        for ($week = 1; $week <= 52; $week++) {
            $startDate = now()->setISODate(date('Y'), $week)->startOfWeek();
            $endDate = now()->setISODate(date('Y'), $week)->endOfWeek();
            $weeks[$week] = $startDate->format('M d, Y') . ' - ' . $endDate->format('M d, Y');
        }
    
        return $weeks;
    }

    public function generateMonthlyReport(Request $request)
    {
        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');
    
        $startDate = now()->setYear($selectedYear)->setMonth($selectedMonth)->startOfMonth();
        $endDate = now()->setYear($selectedYear)->setMonth($selectedMonth)->endOfMonth();
    
        $orders = Order::with('items.product')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();
    
        return view('monthly-report.index', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'orders' => $orders,
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
        ]);
    }
    
    public function downloadMonthlyReport(Request $request)
    {
        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');
    
        $startDate = now()->setYear($selectedYear)->setMonth($selectedMonth)->startOfMonth();
        $endDate = now()->setYear($selectedYear)->setMonth($selectedMonth)->endOfMonth();
    
        $orders = Order::with('items.product')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();
    
        $totalSales = 0;

        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $totalSales += $item->product_quantity * $item->product->product_sellingprice;
            }
        }   

        $file = $this->generateMonthlyReportFile($startDate, $endDate, $orders, $totalSales);
    
        $headers = [
            'Content-Type' => 'application/pdf', 
            'Content-Disposition' => 'attachment; filename="monthly_report.pdf"', 
        ];
    
        return response()->download($file, 'monthly_report.pdf', $headers); 
    }
    


    private function generateMonthlyReportFile($startDate, $endDate, $orders, $totalSales)
    {
        $dompdf = new Dompdf();

        $html = view('monthly-report.show', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'orders' => $orders,
            'totalSales' => $totalSales,
        ])->render();

        $dompdf->loadHtml($html);

        $dompdf->render();

        $canvas = $dompdf->getCanvas();

        $logoPath = public_path('storage/images/logo.png');
        $logoWidth = 100;
        $logoHeight = 0; 
        $logoX = 20;
        $logoY = 20;

        $canvas->image($logoPath, $logoX, $logoY, $logoWidth, $logoHeight);

        $filePath = storage_path('app/reports/monthly_report.pdf');
        file_put_contents($filePath, $dompdf->output());

        return $filePath;
    }

    


}