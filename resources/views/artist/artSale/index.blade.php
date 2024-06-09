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
