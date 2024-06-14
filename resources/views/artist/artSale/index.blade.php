@extends('layouts.dashboard')


@section('header_title')
    Art Sales
@endsection
@push('styles')
    @vite('resources/css/viewusers.css')
@endpush

@section('content')
    <div class="d-flex flex-column gap-4">
        <div class="d-flex justify-content-end">
            <a class="btn btn-primary" href="{{ route('artist-sales.create') }}">+ New Artwork</a>
        </div>
        <div class="container user-container">
            <table class="table table-borderless data-table user-table">
                <thead class="user-table-head">
                    <tr>
                        <th class="user-table-title">No</th>
                        <th class="user-table-title">Title</th>
                        <th class="user-table-title">Year</th>
                        <th class="user-table-title">Price</th>
                        <th class="user-table-title">Stock</th>
                        <th class="user-table-title">Category</th>
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
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'year',
                        name: 'year'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'category.name',
                        name: 'category.name'
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
        .close{
            color: var(--primary);
            background-color: transparent;
            border: none;
        }
        .button-action-delete{
            display: flex;
            gap: 16px;
        }
        </style>
@endpush
