@extends('layouts.admin')

@section('styles')

<!-- data tables css -->

<link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}">

@endsection
@section('content')

<div class="page-wrapper">

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">{{ pageTitle() }}</h3>

                    <!-- [ breadcrumb ] start -->

                    @include('admin.partials.breadcrumb')

                    <!-- [ breadcrumb ] end -->
                </div>
                <div class="col-auto">
                    <a href="{{ route('settings.create') }}" class="btn btn-primary me-1 add-btn">
                        <i class="fas fa-plus"></i> 
                        Add Settings 
                    </a>
                </div>
            </div>
        </div>

        <!-- [ Main Content ] start -->

        <div class="row">

            <div class="col-sm-12 p-0">

                <div class="card">


                    <div class="card-body">
                        <script>
                           @if(session()->has('success'))
                               Swal.fire(
                                   'Success!',
                                   '{{ session()->get('success') }}',
                                   'success'
                               ).then(function() {
                                   location.reload();
                               });
                           @endif

                           @if(session()->has('error'))
                               Swal.fire(
                                   'Error!',
                                   '{{ session()->get('error') }}',
                                   'error'
                               ).then(function() {
                                   location.reload();
                               });
                           @endif
                        </script>



                        <div class="table-responsive dt-responsive">

                            <table id="admin-setting-table" class="datatable table table-stripped">

                                <thead class="thead-light" >

                                    <tr>

                                        <th>Id</th>

                                        <th>Key</th>

                                        <th>Group</th>

                                        <th>Status</th>

                                        <th>Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- [ Main Content ] end -->

    </div>

</div>

@endsection



@section('scripts')

<!-- datatable Js -->

<script src="{{ URL::asset('plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables/datatables.min.js') }}"></script>
<script type="text/javascript">
'use strict';
    if ($('.datatable').length > 0) {
        $('.datatable').DataTable({
            processing: true,

            serverSide: true,

            ajax: "{!! route('settings.index') !!}",

            columns: [

                { data: 'DT_RowIndex', name: 'DT_RowIndex' },

                { data: 'key', name: 'key' },

                { data: 'group', name: 'group' },

                { data: 'status', name: 'status' },

                { data: 'action', name: 'action' },
            ],

            columnDefs: [

                 { orderable: false, serachable: false, targets: [2] },

            ]

        });
    }

</script>


@endsection

