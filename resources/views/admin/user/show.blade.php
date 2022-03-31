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
                        <div class="card-body-border">
                            <div class="form-group mb-0">
                                <div class="row align-items-center pb-2">
                                    <label class="col-form-label py-0 col-12 col-md-3">Id :</label>
                                    <div class="col-12 col-md-9">

                                       <p> {{ $user->id }}</p>

                                    </div>

                                </div>

                            </div>

                            <div class="form-group mb-0">
                                <div class="row align-items-center">

                                    <label class="col-12 col-md-3 col-form-label">Name :</label>

                                    <div class="col-12 col-md-9">

                                       <p> {{ $user->name }}</p>

                                    </div>

                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <div class="row align-items-center">
                                    <label class="col-12 col-md-3 col-form-label">Email :</label>
                                    <div class="col-12 col-md-9">

                                       <p> {{ $user->email }}</p>

                                    </div>

                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row align-items-center pt-2">
                                    <label class="col-12 col-md-3 col-form-label py-0">Role :</label>
                                    <div class="col-12 col-md-9">

                                       <p> {{ $user->roles->first()->name }}</p>

                                    </div>

                                </div>
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

