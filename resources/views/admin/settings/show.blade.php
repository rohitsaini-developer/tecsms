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
            <div class="col-sm-12 p-0">
                <div class="card">
                    <div class="card-body show-details-page">
                        <table class="table table-striped table-bordered datatable table-responsive-sm">
                            <tbody>
                                <tr>
                                    <th>
                                        Group
                                    </th>
                                    <td>
                                        <span class="badge badge-info label-many">{{ $setting->group ?? ''}}</span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        Type
                                    </th>
                                    <td>
                                        <span class="badge badge-info label-many">{{ $setting->type ?? '' }}</span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        Key
                                    </th>
                                    <td>
                                        {{ $setting->key ?? '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        Value
                                    </th>
                                    <td>
                                        @if($setting->type == 'image')
                                            @php
                                            $image = asset('assets/img/no_image_available.jpg');
                                            if(isset($setting) && isset($setting->uploads->first()->path) && Storage::disk('public')->exists($setting->uploads->first()->path)){
                                            $image = asset('storage/'.$setting->uploads->first()->path);
                                            }
                                            @endphp
                                            
                                            <a href="{{ $image }}" data-lightbox="image-{{$setting->id}}" ><img src="{{ $image }}" class="img-thumbnail viwe-page"></a>
                                        @else
                                                  {{ $setting->value ?? '' }}
                                        @endif
                                        
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        Display Name
                                    </th>
                                    <td>
                                        {{ $setting->display_name ?? '' }}
                                    </td>
                                </tr>

                                @if($setting->details != null)
                                <tr>
                                    <th>
                                        Details
                                    </th>
                                    <td>
                                        {{ $setting->details ?? '' }}
                                    </td>
                                </tr>
                                @endif

                                <tr>
                                    <th>
                                        Status
                                    </th>
                                    <td>
                                        <span class="badge badge-info label-many">{{ $setting->getStatus() ?? '' }}</span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        created At
                                    </th>
                                    <td>
                                        {{ $setting->created_at->format('d-M-Y H:i A') ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <a class="btn btn-primary" href="{{ route('settings.index') }}" data-toggle="tooltip" rel="tooltip" data-placement="top" title="back"><i class="cil-account-logout"></i></a> -->
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

