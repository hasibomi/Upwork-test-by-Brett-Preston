@extends('master')

@section('title', 'Products')

@section('style')
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="products-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>In Stock</th>
                    </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $i => $product)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>£ {{ $product->price }}</td>
                                <td>
                                    @if ($product->in_stock)
                                        <input type="checkbox" checked disabled>
                                    @else
                                        <input type="checkbox">
                                    @endif
                                </td>
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
            $('#products-table').DataTable();
        });
    </script>
@endsection
