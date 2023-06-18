@extends('layouts.app', [
    'class' => $class ?? '',
    'elementActive' => $elementActive ?? 'total-sales'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Total Sales Weekly Sort by Product</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('sales.weekly.sales') }}" method="GET" class="mb-3">
                        <div class="form-group">
                            <label for="week">Filter by Week:</label>
                            <select name="week">
                                <option value="">All Weeks</option>
                                @foreach ($weeks as $weekNumber => $weekRange)
                                    <option value="{{ $weekNumber }}" {{ $selectedWeek == $weekNumber ? 'selected' : '' }}>
                                        Week {{ $weekNumber }} ({{ $weekRange }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product">Filter by Product:</label>
                            <select name="product">
                            <option value="">All Products</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product }}" {{ $productFilter == $product ? 'selected' : '' }}>
                                        {{ $product }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Apply Filter</button>
                    </form>

                    <p>
                        @if ($selectedWeek)
                            Week: {{ $startDate->format('M d, Y') }} - {{ $endDate->format('M d, Y') }}
                        @else
                            Showing all weeks
                        @endif
                    </p>

                    <div class="table-responsive">
                        <table class="table" id="sales-table"> <!-- Added id attribute -->
                            <thead class="text-primary">
                                <th>Product Name</th>
                                <th>Total Sales</th>
                            </thead>
                            <tbody>
                                @forelse ($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->product_name }}</td>
                                        <td>{{ $sale->total_sales }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">No sales data available</td>
                                    </tr>
                                @endforelse
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
        $('#sales-table').DataTable({
            responsive: true,
            autoWidth: true,
        });
    });
</script>
@endpush

@endsection
