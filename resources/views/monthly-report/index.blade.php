@extends('layouts.app', [
    'class' => $class ?? '',
    'elementActive' => $elementActive ?? 'sales-order-report'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Monthly Sales Order Report</h4>
                        <a href="{{ route('sales.monthly.report.download', ['month' => $selectedMonth ?? '', 'year' => $selectedYear ?? '']) }}" class="btn btn-primary">Download Report</a>
                    </div>

                    <div class="card-body">

                        <form id="reportForm" action="{{ route('sales.monthly.report') }}" method="GET" class="mb-3">
                            <div class="form-group">
                                <label for="month">Select Month:</label>
                                <select name="month">
                                    @foreach (range(1, 12) as $month)
                                        <option value="{{ $month }}" {{ $selectedMonth == $month ? 'selected' : '' }}>
                                            {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="year">Select Year:</label>
                                <select name="year">
                                    @foreach (range(date('Y'), 2020) as $year)
                                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Show Report</button>
                        </form>

                        <p>Report Period: {{ $startDate->format('F Y') }}</p>

                        <div class="table-responsive">
                            <table class="table" id="orders-table"> <!-- Added id attribute -->
                                <thead class="text-primary">
                                    <th>Order ID</th>
                                    <th>Customer Name</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        @foreach ($order->items as $item)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->user->name }}</td>
                                                <td>{{ $item->product->product_name }}</td>
                                                <td>{{ $item->product_quantity }}</td>
                                                <td>{{ $item->product_quantity * $item->product->product_sellingprice }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#orders-table').DataTable({
                responsive: true,
                autoWidth: true,
            });
        });
    </script>
    @endpush

    <script>
        document.querySelector('button[type="submit"]').addEventListener('click', function() {
            document.getElementById('reportForm').submit();
        });
    </script>

@endsection
