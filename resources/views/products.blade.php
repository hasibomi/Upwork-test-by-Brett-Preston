@extends('master')

@section('title', 'Products')

@section('style')
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <p>
                <label for="filter">Filter: </label>

                <select id="filter" class="form-control">
                    <option value="">All Products</option>
                    <option value="1">In Stock</option>
                    <option value="0">Out of Stock</option>
                </select>
            </p>
        </div>
    </div>
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
                                        <input type="checkbox" disabled>
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
            $('#products-table').DataTable({
                destroy: true,
                columnDefs: [{
                    'targets': [3],
                    'orderable': false,
                }],
            });

            $('#filter').change(function () {
                var value = $(this).val();

                $('#products-table').DataTable({
                    destroy: true,
                    ajax: {
                        url: "{{ route('api.products') . '?filter_stock=' }}" + value,
                        dataSrc: function (data) {
                            var return_data = [];

                            for(var i=0;i< data.results.length; i++){
                                var r = data.results[i];

                                return_data.push({
                                    'id': r.id,
                                    'name': r.name,
                                    'price': '£ ' + r.price,
                                    'in_stock' : r.in_stock ? '<input type="checkbox" checked disabled>' : '<input type="checkbox" disabled>'
                                })
                            }

                            return return_data;
                        }
                    },
                    columns: [
                        {data: 'id'},
                        {data: 'name'},
                        {data: 'price'},
                        {data: 'in_stock'},
                    ],
                    columnDefs: [{
                        'targets': [3],
                        'orderable': false,
                    }],
                });
            });
        });
    </script>
@endsection
