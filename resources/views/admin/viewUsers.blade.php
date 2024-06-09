@extends('layouts.dashboard')
{{-- Extends untuk memanggil layout fix Artamara --}}

{{-- Section title untuk memberikan nama pada website --}}
@section('header_title')
    View User
@endsection
@push('styles')
    @vite('resources/css/viewusers.css')
@endpush


{{-- Ini isi konten view users --}}
@section('content') 

    <div class="container user-container">
        <table class="table table-borderless data-table user-table">
            <thead class="user-table-head">
                <tr>
                    <th class="user-table-title">No</th>
                    <th class="user-table-title">Name</th>
                    <th class="user-table-title">Email</th>
                    <th class="user-table-title">Phone Number</th>
                    <th class="user-table-title">Level</th>
                    <th class="user-table-title">Status</th>
                    <th class="user-table-title" width="100px"></th>

                </tr>
            </thead>
        </table>
    </div>

    <script type="text/javascript">
        $(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('viewAdmin') }}",
                columns: [{
                        data: null,
                        name: 'no',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'role',
                        name: 'role'
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
        }

        .content-body-delete {
            align-self: flex-start;
            padding-top: 16px;
            padding-bottom: 64px;
        }

        .footer-modal-delete {
            align-self: flex-end;
        }
        </style>
@endpush
