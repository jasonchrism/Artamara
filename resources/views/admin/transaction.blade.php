@extends('layouts.dashboard')
@section('header_title')
    Transactions
@endsection

@push('styles')
    @vite('resources/css/artist/transactions/artistTransactions.css')
@endpush

@section('content')
    <div class="tab">
        <div style="margin-top: 62px;">
            <ul class="nav nav-pills" id="myTab">
                <li class="nav-item tab-link tab-active">
                    <a class="tabs" href="{{ route('admintabs', 'CONFIRMED') }}"
                        data-ajax-url="{{ route('admintabs', 'CONFIRMED') }}">Confirmed</a>
                </li>
                <li class="nav-item tab-link">
                    <a class="tabs" href="{{ route('admintabs', 'RETURNED') }}"
                        data-ajax-url="{{ route('admintabs', 'RETURNED') }}">Returned</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container packing-container">
        <table class="table table-borderless data-table packing-table">
            <thead class="packing-table-head">
                <tr id="table-headers">
                    <!-- Default headers for CONFIRMED status -->
                    <th class="packing-table-title">No</th>
                    <th class="packing-table-title">Order ID</th>
                    <th class="packing-table-title">Buyer Name</th>
                    <th class="packing-table-title">End Date</th>
                    <th class="packing-table-title">Payment Method</th>
                    <th class="packing-table-title">Total Price</th>
                    <th class="packing-table-title" width="100px"></th>
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
                ajax: {
                    url: '{!! route('admintabs', 'CONFIRMED') !!}',
                    data: function(d) {
                        d.status = 'CONFIRMED';
                    }
                },
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
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
                    {
                        data: 'payment.payment_method.name',
                        name: 'payment.payment_method.name'
                    },
                    {
                        data: 'total_price',
                        name: 'total_price'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('a.tabs').on('click', function(e) {
                e.preventDefault();
                var ajaxUrl = $(this).data('ajax-url');
                var status = $(this).text().toUpperCase();

                // Update DataTables AJAX with the new URL
                table.ajax.url(ajaxUrl).load();

                // Update the columns dynamically based on the status
                if (status === 'RETURNED') {
                    table.clear().destroy();
                    $('#table-headers').html(`
                        <th class="packing-table-title">No</th>
                        <th class="packing-table-title">Order ID</th>
                        <th class="packing-table-title">Buyer Name</th>
                        <th class="packing-table-title">Request Date</th>
                        <th class="packing-table-title">Status</th>
                        <th class="packing-table-title" width="100px"></th>
                    `);
                    table = $('.data-table').DataTable({
                        processing: true,
                        serverSide: true,
                        responsive: true,
                        ajax: {
                            url: ajaxUrl,
                            data: function(d) {
                                d.status = 'RETURNED';
                            }
                        },
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
                                data: 'user.name',
                                name: 'user.name'
                            },
                            {
                                data: 'refund.created_at',
                                name: 'refund.created_at',
                                render: function(data, type, row) {
                                    if (type === 'display') {
                                        // Convert the ISO date string to a JavaScript Date object
                                        let date = new Date(data);
                                        // Format the date as needed, e.g., 'dd-mm-yyyy hh:mm:ss'
                                        return date.toLocaleDateString('en-GB') + ' ' + date
                                            .toLocaleTimeString('en-GB');
                                    }
                                    return data;
                                }
                            },
                            {
                                data: 'status',
                                name: 'status'
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            }
                        ]
                    });
                } else {
                    table.clear().destroy();
                    $('#table-headers').html(`
                        <th class="packing-table-title">No</th>
                        <th class="packing-table-title">Order ID</th>
                        <th class="packing-table-title">Buyer Name</th>
                        <th class="packing-table-title">End Date</th>
                        <th class="packing-table-title">Payment Method</th>
                        <th class="packing-table-title">Total Price</th>
                        <th class="packing-table-title" width="100px"></th>
                    `);
                    table = $('.data-table').DataTable({
                        processing: true,
                        serverSide: true,
                        responsive: true,
                        ajax: {
                            url: ajaxUrl,
                            data: function(d) {
                                d.status = 'CONFIRMED';
                            }
                        },
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
                                data: 'user.name',
                                name: 'user.name'
                            },
                            {
                                data: 'end_date',
                                name: 'end_date'
                            },
                            {
                                data: 'payment.payment_method.name',
                                name: 'payment.payment_method.name'
                            },
                            {
                                data: 'total_price',
                                name: 'total_price'
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            }
                        ]
                    });
                }

                // Remove active class from all tabs
                $('li.nav-item').removeClass('tab-active');

                // Add active class to the clicked tab's parent li
                $(this).parent('li').addClass('tab-active');
            });
        });
    </script>
@endsection
