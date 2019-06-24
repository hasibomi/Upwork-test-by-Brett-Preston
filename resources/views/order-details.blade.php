@extends('master')

@section('title', 'Showing order ' . $order->invoice_number)

@section('style')
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tbody>
                        <tr>
                            <td>Invoice Number</td>
                            <td>{{ $order->invoice_number }}</td>
                        </tr>

                        <tr>
                            <td>Customer</td>
                            <td>{{ $order->customer->name }}</td>
                        </tr>

                        <tr>
                            <td>Total Order Items</td>
                            <td>{{ count($order->orderItems) }}</td>
                        </tr>

                        <tr>
                            <td>Total Amount</td>
                            <td>£ {{ $order->total_amount }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="order-details-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($order->orderItems as $i => $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>£ {{ $item->quantity *  $item->product->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#order-details-table').DataTable();
        });
    </script>
@endsection
