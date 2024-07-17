@vite('resources/css/artist/rating.css')
@extends('layouts.dashboard')
@section('title')
    Rating
@endsection

@section('content')
<div class="container user-container">
        <table class="table table-borderless data-table user-table">
            <thead class="user-table-head">
                <tr>
                    <th class="text-center" width="30px">No</th>
                    <th class="text-center" width="120px">Order ID</th>
                    <th class="text-center" width="150px">Buyer</th>
                    <th class="utext-center" width="60px">Rating</th>
                    <th class="text-center" width="200px">Comment</th>
                    <th class="" width="60px"></th>

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
                ajax: "{{ route('rating.index') }}",
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
                        data: 'buyer',
                        name: 'buyer'
                    },
                    {
                        data: 'rating',
                        name: 'rating'
                    },
                    {
                        data: 'comment',
                        name: 'comment'
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
