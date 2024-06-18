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
            console.log('hello');

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax:"{{route('artist-transactions.index')}}",
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
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
            console.log('hello2');
        });
    </script>


@endsection
