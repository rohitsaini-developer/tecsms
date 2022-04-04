@extends('layouts.admin')

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
                    @can('package-add')
                    <a href="{{ route('admin.packages.create') }}" class="btn btn-primary me-1 add-btn">
                        <i class="fas fa-plus"> </i> Add Package
                    </a>
                    @endcan
                </div>
            </div>
        </div>
        <!-- End title-header section -->
        <script>
            @if(session()->has('success'))
                Swal.fire(
                    'Success!',
                    '{{ session()->get('success') }}',
                    'success'
                ).then(function() {
                    // location.reload();
                });
            @endif

            @if(session()->has('error'))
                Swal.fire(
                    'Error!',
                    '{{ session()->get('error') }}',
                    'error'
                ).then(function() {
                    // location.reload();
                });
            @endif
            
        </script>
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">       
                        <div class="table-responsive dt-responsive">
                            {{$dataTable->table(['class' => 'table dt-responsive nowrap', 'style' => 'width:100%;'])}}
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
@parent
{!! $dataTable->scripts() !!}

<script type="text/javascript">
  $(document).ready( function(){
    $(document).on('submit', '.deletePackageForm', function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        var url = $(this).attr('action');
    
        Swal.fire({
        title: "Are you sure?",
        icon: "question",
        text: "Do you want to delete package?",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'delete',
                    url: url,
                    data: formData,
                    dataType: 'JSON',
                    success: function (response) {
                        if (response.success == true) {
                            Swal.fire(
                                'Success!',
                                response.message,
                                'success'
                            );
                            $('#packages-table').DataTable().ajax.reload(null, false);
                        } else {
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            );
                        }
                    }
                });

            } else {
                e.dismiss;
            }
        });
    });
  });
</script>
@endsection