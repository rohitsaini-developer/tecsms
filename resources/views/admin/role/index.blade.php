@extends('layouts.admin')


@section('styles')

<!-- data tables css -->

<link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

@endsection

@section('content')

<div class="page-wrapper">

    <div class="content container-fluid">

        <!-- Start title-header section -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">{{ pageTitle() }}</h3>
                    <!-- [ breadcrumb ] start -->

                    @include('admin.partials.breadcrumb')

                    <!-- [ breadcrumb ] end -->
                </div>
                <div class="col-auto">
                    @can('role-add')
                    <a href="{{ route('roles.create') }}" class="btn btn-primary me-1 add-btn">
                        <i class="fas fa-plus"></i>
                        Add Role
                    </a>
                    @endcan
                </div>
            </div>
        </div>
        <!-- End title-header section -->

        <!-- [ Main Content ] start -->

        <div class="row">

            <div class="col-sm-12">

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

                            <table id="admin-role-table" class="datatable table table-stripped">

                                <thead class="thead-light">

                                    <tr>

                                        <th>S.No.</th>

                                        <th>Name</th>

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
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">
'use strict';
if ($('.datatable').length > 0) {
		$('.datatable').DataTable({

    processing: true,

    serverSide: true,

    responsive: true,

    pageLength: 25,
    
    ajax: "{!! route('roles.index') !!}",

    columns: [

        { data: 'DT_RowIndex', name: 'DT_RowIndex' },

        { data: 'name', name: 'name' },

        { data: 'action', name: 'action' },

    ],

    columnDefs: [

        { orderable: false, serachable: false, targets: [2] },

    ]

    });
}

function deleteConfirmation(id){

Swal.fire({
    title: "Are you sure?",
    icon: "question",
    text: "Do you want to delete role?",
    showCancelButton: true,
    confirmButtonText: "Yes",
    cancelButtonText: "No",
}).then((result) => {
    if (result.isConfirmed) {
        // console.log(result);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{!! csrf_token() !!}"
                }
        });
        $.ajax({
            type: 'POST',
            url:  "{{url('/roles')}}/"+id,
            data:{'_method':'DELETE'},
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                if(response.success){
                    Swal.fire(
                        'Success!',
                        response.message,
                        'success'
                    ).then(function() {
                        location.reload();
                    });
                }
            },
            error: function (response) {
                // console.log(response);
            
            }
        });   
    }
});
}
</script>

@endsection

