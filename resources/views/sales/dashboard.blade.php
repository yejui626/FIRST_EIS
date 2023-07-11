@extends('layouts.app', [
    'class' => $class ?? '',
    'elementActive' => 'dashboard'
])
<style>
    .pagination .page-link {
        font-size: 14px; /* Adjust the font size as needed */
    }
    .card-height {
        height: 150px;
    }
</style>

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats card-height">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fa fa-shopping-bag text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Total Orders</p>
                                    <p class="card-title">{{ $totalOrders }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i>
                            @if ($selectedYear!=null) {{ $selectedYear }} @else {{ date('Y') }} @endif
                            @if ($categoryname!=null) {{ $categoryname }} @else All Categories @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats card-height">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fa fa-dollar text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Total Revenue</p>
                                    <p class="card-title">${{ $totalRevenue }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i>
                            @if ($selectedYear!=null) {{ $selectedYear }} @else {{ date('Y') }} @endif
                            @if ($categoryname!=null) {{ $categoryname }} @else All Categories @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats card-height">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fa fa-money text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Total Profit</p>
                                    <p class="card-title">${{ $totalProfit }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i>
                            @if ($selectedYear!=null) {{ $selectedYear }} @else {{ date('Y') }} @endif
                            @if ($categoryname!=null) {{ $categoryname }} @else All Categories @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats card-height" >
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fa fa-percent text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Profit Percentage</p>
                                    <p class="card-title">{{ $profitPercentage }} %</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i>
                            @if ($selectedYear!=null) {{ $selectedYear }} @else {{ date('Y') }} @endif
                            @if ($categoryname!=null) {{ $categoryname }} @else All Categories @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card " style="height:450px;">
                    <div class="card-header ">
                        <h5 class="card-title">Sales by Category </h5>
                        <p class="card-category">
                            @if ($selectedYear!=null) {{ $selectedYear }} @else {{ date('Y') }} @endif
                            @if ($categoryname!=null) {{ $categoryname }} @else All Categories @endif
                        </p>
                    </div>
                    <div class="card-body ">
                        <canvas id="chartEmail" height="100%"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card card-chart" style="height:450px;">
                    <div class="card-header">
                        <h5 class="card-title">Sales Trend</h5>         
                    </div>
                    <div class="card-description">
                        <div class="form-row">
                            <div class="form-group col-6 pl-4 pr-2">
                                <form id="yearFilterForm" method="GET" action="{{ route('sales.dashboard') }}">
                                    <label for="yearFilter">Year:</label>
                                    <select class="form-control" id="yearFilter" name="year" onchange="document.getElementById('yearFilterForm').submit()">
                                        <!--<option value="">All Years</option>-->
                                        @foreach ($yearList as $year)
                                            <option value="{{ $year }}" @if ($selectedYear == $year) selected @endif>{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                            <div class="form-group col-6 pl-2 pr-4">
                                <form id="categoryFilterForm" method="GET" action="{{ route('sales.dashboard') }}">
                                    <label for="categoryFilter">Category:</label>
                                    <select name="category" id="categoryFilter" class="form-control" onchange="document.getElementById('categoryFilterForm').submit()">
                                        <option value="">All Categories</option>
                                        @foreach ($categoryList as $categoryId => $categoryName)
                                            <option value="{{ $categoryId }}" {{ $selectedCategory == $categoryId ? 'selected' : '' }}>
                                                {{ $categoryName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <canvas id="speedChart" height="100%"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var chartLabels = @json($chartLabels);
            var chartData = @json($chartData);
            var pieChartLabels = @json($pieChartLabels);
            var pieChartData = @json($pieChartData);
            var selectedYear = @json($selectedYear);

            var speedChart = document.getElementById('speedChart').getContext('2d');
            var chartConfig = {
                type: 'line',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Year',
                        data: chartData,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Sales'
                            }
                        }
                    }
                }
            };

            var lineChart = new Chart(speedChart, chartConfig);

            var chartEmail = document.getElementById('chartEmail').getContext('2d');
            var pieChart = new Chart(chartEmail, {
                type: 'pie',
                data: {
                    labels: pieChartLabels,
                    datasets: [{
                        data: pieChartData,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 205, 86, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(201, 203, 207, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });

            function applyYearFilter(year) {
                // Update the selected year
                selectedYear = year;

                // Make an API request or update the chart and card data based on the selected year
                // You can use AJAX or fetch to fetch the updated data from the server

                // Update the chart labels and data
                lineChart.data.labels = chartLabels;
                lineChart.data.datasets[0].data = chartData;

                // Update the pie chart data
                pieChart.data.labels = pieChartLabels;
                pieChart.data.datasets[0].data = pieChartData;

                // Update the chart and card data
                lineChart.update();
                pieChart.update();
            }
        });
    </script>
@endpush
