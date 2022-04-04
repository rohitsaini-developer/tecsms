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
                    <h3 class="page-title">{{ pageTitle() }} Show</h3>
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
                                    <div class="col-12 col-md-3 text-md-right">
                                        <label class="col-form-label py-0">Id :</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        {{ $package->id }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-3 text-md-right">
                                        <label class="col-form-label">Name :</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        {{ $package->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-3 text-md-right">
                                        <label class="col-form-label">Price :</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        {{ $package->price }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-3 text-md-right">
                                        <label class="col-form-label">Sale Price :</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        {{ $package->sale_price ?? 'No sale price' }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-3 text-md-right">
                                        <label class="col-form-label">Validity ( In Days ) :</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        {{ $package->validity  }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-3 text-md-right">
                                        <label class="col-form-label">Description:</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        {{ $package->description  }}
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

