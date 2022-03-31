@extends('layouts.admin')
@section('styles')

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
            </div>
        </div>
        <!-- End title-header section -->

        

        <!-- [ Main Content ] start -->

        <div class="row">

            <div class="col-sm-12">

                <div class="card">

                    <div class="card-body show-details-page">

                        <div class="row align-items-center mb-3">

                            <div class="col-12 col-md-3 text-md-right">

                                <label>Id :</label>

                            </div>

                            <div class="col-12 col-md-9">

                                {{ $permission->id }}

                            </div>

                        </div>

                        <div class="row align-items-center mb-3">

                            <div class="col-12 col-md-3 text-md-right">

                                <label>Name :</label>

                            </div>

                            <div class="col-12 col-md-9">

                                {{ $permission->name }}

                            </div>

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

@endsection

