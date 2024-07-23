@extends('layouts.dashboard')
@section('title')
    Auction
@endsection
@push('styles')
    @vite('resources/css/viewusers.css')
@endpush

@section('content')
<div class="d-flex flex-column gap-4">
    <div class="container user-container">
        <table class="table table-borderless data-table user-table">
            <thead class="user-table-head">
                <tr>
                    <th class="user-table-title">No</th>
                    <th class="user-table-title">Title</th>
                    <th class="user-table-title">Start Date</th>
                    <th class="user-table-title">End Date</th>
                    <th class="user-table-title">Start Bid</th>
                    <th class="user-table-title">Current Bid</th>
                    <th class="user-table-title">Status</th>
                    <th class="user-table-title" width="100px"></th>

                </tr>
            </thead>
        </table>
    </div>
</div>


<script type="text/javascript">
    $(function() {

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [{
                    data: null,
                    name: 'no',
                    // orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'start_date',
                    name: 'start_date'
                },
                {
                    data: 'end_date',
                    name: 'productAuction.end_date'
                },
                {
                    data: 'start_price',
                    name: 'productAuction.start_price'
                },
                {
                    data: 'current_bid',
                    name: 'productAuction.current_bid'
                },
                {
                    data: 'status',
                    name: 'productAuction.status'
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
@push('styles')
    <style>
       .bidstatus .status-container{
            padding: 5px 10px 5px 10px;
        }

        .bidstatus .status-container p{
            font-size: 11px;
            text-align:center;
            font-weight: bold;
            color: var(--text-secondary);
        } 
        .modal-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            color: var(--text-primary);
            pointer-events: auto;
            background-color: var(--bg-overlay-1);
            background-clip: padding-box;
            border: var(--bs-modal-border-width) solid var(--bs-modal-border-color);
            outline: 0;
            padding: 24px 24px 24px 24px;
            align-items: flex-start;
        }

        .content-body-delete {
            align-self: flex-start;
            padding-top: 16px;
            padding-bottom: 16px;
        }

        .footer-modal-delete {
            align-self: flex-end;
        }

        .modal-title {
            align-items: flex-start;
        }

        .close {
            color: var(--primary);
            background-color: transparent;
            border: none;
        }

        .button-action-delete {
            display: flex;
            gap: 16px;
        }
    </style>
@endpush
