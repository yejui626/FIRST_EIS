<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Items;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;
use DateInterval;
use DatePeriod;
use DateTime;


class SalesController extends Controller
{
    public function dashboard(Request $request)
{
    $selectedYear = $request->input('year') ?? date('Y');
    $selectedCategory = $request->input('category') ?? '';
    $categoryname = '';

    if (!empty($selectedCategory)) {
        $categoryname = DB::table('product_category')
            ->where('category_id', $selectedCategory)
            ->value('category_name');
    }

    $yearList = DB::table('orders')
        ->select(DB::raw('YEAR(created_at) as year'))
        ->distinct()
        ->orderBy('year', 'desc')
        ->pluck('year');
        
    $categoryList = DB::table('product_category')
        ->pluck('category_name', 'category_id');


    $totalOrdersQuery = DB::table('orders')
        ->join('items', 'orders.id', '=', 'items.order_id')
        ->join('products', 'items.product_id', '=', 'products.id')
        ->join('product_category', 'products.product_category', '=', 'product_category.category_id')
        ->whereYear('orders.created_at', $selectedYear);
    $totalRevenueQuery = DB::table('orders')
        ->join('items', 'orders.id', '=', 'items.order_id')
        ->join('products', 'items.product_id', '=', 'products.id')
        ->join('product_category', 'products.product_category', '=', 'product_category.category_id')
        ->whereYear('orders.created_at', $selectedYear);
    $totalCostQuery = DB::table('orders')
        ->join('items', 'orders.id', '=', 'items.order_id')
        ->join('products', 'items.product_id', '=', 'products.id')
        ->join('product_category', 'products.product_category', '=', 'product_category.category_id')
        ->whereYear('orders.created_at', $selectedYear);
    
    if (!empty($selectedCategory)) {
        $totalOrdersQuery->where('product_category.category_id', $selectedCategory);
        $totalRevenueQuery->where('product_category.category_id', $selectedCategory);
        $totalCostQuery->where('product_category.category_id', $selectedCategory);

    }

    $totalOrders = $totalOrdersQuery
    ->select(DB::raw('COUNT(DISTINCT orders.id) as total_orders'))
    ->first()->total_orders;

    $totalRevenue = $totalRevenueQuery
        ->select(DB::raw('SUM(items.product_quantity * products.product_sellingprice) as total_revenue'))
        ->first()->total_revenue;

    $totalCost = $totalCostQuery
        ->select(DB::raw('SUM(items.product_quantity * products.product_supplierprice) as total_cost'))
        ->first()->total_cost;

    $totalProfit = $totalRevenue - $totalCost;
    $profitPercentage = ($totalRevenue != 0) ? ($totalProfit / $totalRevenue) * 100 : 0;

    $salesDataQuery = Order::query()
        ->join('items', 'orders.id', '=', 'items.order_id')
        ->join('products', 'items.product_id', '=', 'products.id')
        ->join('product_category', 'products.product_category', '=', 'product_category.category_id');
    
    if (!empty($selectedYear)) {
        $salesDataQuery->whereYear('orders.created_at', $selectedYear);
    }
    
    if (!empty($selectedCategory)) {
        $salesDataQuery->where('product_category.category_id', $selectedCategory);
    }
    
    $salesData = $salesDataQuery
        ->select(DB::raw("DATE_FORMAT(orders.created_at, '%M') as month"), DB::raw('IFNULL(SUM(items.product_quantity * products.product_sellingprice), 0) as sales'))
        ->groupBy('month')
        ->orderByRaw('MONTH(orders.created_at)')
        ->get();
    
    $chartLabels = $this->generateMonthRange(date('Y-m-01', strtotime('-5 months')), date('Y-m-t'), 'F');
    $chartData = [];
    
    foreach ($chartLabels as $label) {
        $monthSales = $salesData->firstWhere('month', $label);
    
        if ($monthSales) {
            $chartData[] = $monthSales->sales;
        } else {
            $chartData[] = 0;
        }
    }

    // Get the product categories for the pie chart
    $productCategories = ProductCategory::pluck('category_name');
    $pieChartLabels = $productCategories->toArray();
    $pieChartData = [];

    foreach ($productCategories as $category) {
        $categorySalesQuery = Items::query()
            ->join('products', 'items.product_id', '=', 'products.id')
            ->join('product_category', 'products.product_category', '=', 'product_category.category_id')
            ->where('product_category.category_name', $category);

        if (!empty($selectedYear)) {
            $categorySalesQuery->whereYear('items.created_at', $selectedYear);
        }
        if (!empty($selectedCategory)) {
            $categorySalesQuery->where('product_category.category_id', $selectedCategory);
        }

        $categorySales = $categorySalesQuery
            ->select(DB::raw('SUM(items.product_quantity * products.product_sellingprice) as totalprice'))
            ->first()->totalprice;

        $pieChartData[] = $categorySales;
    }

    return view('sales.dashboard', [
        'totalOrders' => $totalOrders,
        'totalRevenue' => number_format($totalRevenue, 2),
        'totalProfit' => number_format($totalProfit, 2),
        'profitPercentage' => number_format($profitPercentage, 2),
        'chartLabels' => $chartLabels,
        'chartData' => $chartData,
        'pieChartLabels' => $pieChartLabels,
        'pieChartData' => $pieChartData,
        'selectedYear' => $selectedYear,
        'yearList' => $yearList,
        'categoryList' => $categoryList,
        'selectedCategory' => $selectedCategory,
        'categoryname' => $categoryname,
    ]);
}

    /**
     * Generate an array of months within a specified range.
     *
     * @param string $startDate
     * @param string $endDate
     * @param string $format
     * @return array
     */
    private function generateMonthRange($startDate, $endDate, $format = 'Y-m')
    {
        $startMonth = new DateTime($startDate);
        $endMonth = new DateTime($endDate);
        $interval = DateInterval::createFromDateString('1 month');
        $period = new DatePeriod($startMonth, $interval, $endMonth);
        $months = [];

        foreach ($period as $dt) {
            $months[] = $dt->format($format);
        }

        return $months;
    }


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
