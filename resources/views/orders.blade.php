@extends('master')

@section('title', 'Orders')

@section('style')
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="customers-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice number</th>
                        <th>Customer</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($orders as $i => $order)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $order->invoice_number }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>$ {{ $order->total_amount }}</td>
                            <td>{{ $order->status }}</td>
                            <td><a href="{{ route('orders.details', $order->invoice_number) }}">View</a></td>
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
            $('#customers-table').DataTable();
        });
    </script>
@endsection
