<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        /* Define your CSS styles for the PDF report */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Monthly Sales Order Report</h1>
    
    <p>Report Period: {{ $startDate->format('F Y') }} | Total Sales: {{ $totalSales }}</p>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
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
</body>
</html>
