@extends('layouts.dashboard')
@section('title')
    Transaction
@endsection

@push('styles')
    @vite('resources\css\artist\transactions\artistTransactions.css')
@endpush

@section('content')
    <div class="tab">
        <div style="margin-top: 62px;">
            <ul class="nav nav-pills" id="myTab">

                <li class="nav-item tab-link tab-active">
                    <a class="" href="#">Packing</a>
                </li>
                <li class="nav-item tab-link">
                    <a class="" href="#">Shipping</a>
                </li>
                <li class="nav-item tab-link">
                    <a class="" href="#">Finished</a>
                </li>
                <li class="nav-item tab-link">
                    <a class="" href="#">Returned</a>
                </li>
                <li class="nav-item tab-link">
                    <a class="" href="#">Cancelled</a>
                </li>

            </ul>
        </div>
    </div>
    <div class="container packing-container">

        <table class="table table-borderless data-table packing-table">
            <thead class="packing-table-head">
                <tr>
                    <th class="packing-table-title">No</th>
                    <th class="packing-table-title">Order ID</th>
                    <th class="packing-table-title">End Date</th>
                    <th class="packing-table-title">Total Price</th>
                    <th class="packing-table-title">Quantity</th>
                    <th class="packing-table-title">Title</th>
                    <th class="packing-table-title" width="100px">Action</th>
                </tr>
            </thead>
        </table>

    </div>
    <script type="text/javascript">
        $(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('artist-transactions.index') }}",
                columns: [{
                        data: null,
                        name: 'no',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'order_id',
                        name: 'order_id'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
                    {
                        data: 'total_price',
                        name: 'total_price'
                    },
                    {
                        // how to call quantity from order_items table
                        data: null,
                        name: 'quantity',
                        render: function(data, type, row) {
                            // Assuming 'orderDetails' is accessible in row data
                            if (row.hasOwnProperty('order_detail') && row.order_detail.length > 0) {
                                return row.order_detail[0]
                                .quantity; // Access first order detail's quantity
                            } else {
                                return 0; // Handle cases where no order details exist (optional)
                            }
                        }
                    },
                    {
                        data: null,
                        name: 'title',
                        render: function(data, type, row) {
                            // Assuming 'orderDetails' is accessible in row data
                            if (row.hasOwnProperty('order_detail') && row.order_detail.length > 0) {
                                return row.order_detail[0].product.title
                            } else {
                                return 0; // Handle cases where no order details exist (optional)
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
