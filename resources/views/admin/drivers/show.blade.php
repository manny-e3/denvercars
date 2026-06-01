@extends('layouts.admin')
@section('title', 'Driver — ' . $driver->name)

@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">

                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Driver Profile</h3>
                        </div>
                        <div class="nk-block-head-content d-flex gap-2">
                            <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-primary btn-sm">
                                <em class="icon ni ni-edit"></em><span>Edit</span>
                            </a>
                            <a href="{{ route('admin.drivers.index') }}" class="btn btn-outline-light btn-sm">
                                <em class="icon ni ni-arrow-left"></em><span>Back</span>
                            </a>
                        </div>
                    </div>
                </div>

                @php
                    $licStatus = $driver->licenseStatus();
                    $medStatus = $driver->medicalCardStatus();
                    $compStatus = $driver->complianceStatus();
                @endphp

                {{-- Compliance Banner --}}
                @if($compStatus === 'expired')
                <div class="alert alert-danger alert-icon mb-4">
                    <em class="icon ni ni-alert-circle"></em>
                    <strong>Compliance Issue:</strong> This driver has one or more expired documents. Action required before they can operate.
                </div>
                @elseif($compStatus === 'expiring_soon')
                <div class="alert alert-warning alert-icon mb-4">
                    <em class="icon ni ni-alarm"></em>
                    <strong>Document Renewal Needed:</strong> One or more documents are expiring within 30 days.
                </div>
                @endif

                <div class="row g-4">

                    {{-- Profile Card --}}
                    <div class="col-lg-4">
                        <div class="card card-bordered h-100">
                            <div class="card-inner text-center py-4">
                                @if($driver->photo)
                                    <img src="{{ $driver->photo }}" alt="{{ $driver->name }}" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-bottom: 1rem; border: 3px solid #6576ff;">
                                @else
                                    <div class="user-avatar user-avatar-xl bg-primary-dim mx-auto mb-3" style="width:80px;height:80px;font-size:1.75rem;">
                                        <span>{{ strtoupper(substr($driver->name, 0, 2)) }}</span>
                                    </div>
                                @endif
                                <h5 class="mb-1">{{ $driver->name }}</h5>
                                <p class="text-soft mb-2">{{ $driver->license_type }}</p>

                                @if($driver->status === 'Active')
                                    <span class="badge bg-success text-white px-3">Active</span>
                                @elseif($driver->status === 'Inactive')
                                    <span class="badge bg-secondary text-white px-3">Inactive</span>
                                @else
                                    <span class="badge bg-danger text-white px-3">Suspended</span>
                                @endif

                                <hr>

                                <ul class="list-unstyled text-start">
                                    @if($driver->email)
                                    <li class="mb-2"><em class="icon ni ni-mail text-primary me-2"></em>{{ $driver->email }}</li>
                                    @endif
                                    @if($driver->phone)
                                    <li class="mb-2"><em class="icon ni ni-call text-primary me-2"></em>{{ $driver->phone }}</li>
                                    @endif
                                    @if($driver->vehicle)
                                    <li class="mb-2"><em class="icon ni ni-truck text-primary me-2"></em>{{ $driver->vehicle->name }}</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Details --}}
                    <div class="col-lg-8">
                        <div class="row g-3">

                            {{-- License Card --}}
                            <div class="col-12">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="overline-title text-primary mb-0">License Details</h6>
                                            @if($licStatus === 'expired')
                                                <span class="badge bg-danger text-white">Expired</span>
                                            @elseif($licStatus === 'expiring_soon')
                                                <span class="badge bg-warning text-dark">Expiring Soon</span>
                                            @else
                                                <span class="badge bg-success text-white">Valid</span>
                                            @endif
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <span class="sub-text">License Number</span>
                                                <p class="fw-medium mb-0">{{ $driver->license_number }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <span class="sub-text">License Type</span>
                                                <p class="fw-medium mb-0">{{ $driver->license_type }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <span class="sub-text">Expiry Date</span>
                                                <p class="fw-medium mb-0 {{ $licStatus === 'expired' ? 'text-danger' : ($licStatus === 'expiring_soon' ? 'text-warning' : '') }}">
                                                    {{ $driver->license_expiry->format('M d, Y') }}
                                                    @if($licStatus !== 'expired')
                                                        <small class="text-soft">({{ $driver->license_expiry->diffForHumans() }})</small>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- CDL Certifications --}}
                            <div class="col-12">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <h6 class="overline-title text-primary mb-3">CDL Certifications</h6>
                                        @if($driver->cdl_certifications && count($driver->cdl_certifications) > 0)
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach($driver->cdl_certifications as $cert)
                                                    <span class="badge badge-dim bg-primary text-primary px-3 py-2">
                                                        <em class="icon ni ni-check-circle me-1"></em>{{ $cert }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-soft mb-0">No CDL certifications on file.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Medical Card --}}
                            <div class="col-12">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="overline-title text-primary mb-0">Medical Card</h6>
                                            @if($medStatus === 'none')
                                                <span class="badge bg-secondary text-white">Not on File</span>
                                            @elseif($medStatus === 'expired')
                                                <span class="badge bg-danger text-white">Expired</span>
                                            @elseif($medStatus === 'expiring_soon')
                                                <span class="badge bg-warning text-dark">Expiring Soon</span>
                                            @else
                                                <span class="badge bg-success text-white">Valid</span>
                                            @endif
                                        </div>
                                        @if($driver->medical_card_expiry)
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <span class="sub-text">Card Number</span>
                                                <p class="fw-medium mb-0">{{ $driver->medical_card_number ?? '—' }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <span class="sub-text">Expiry Date</span>
                                                <p class="fw-medium mb-0 {{ $medStatus === 'expired' ? 'text-danger' : ($medStatus === 'expiring_soon' ? 'text-warning' : '') }}">
                                                    {{ $driver->medical_card_expiry->format('M d, Y') }}
                                                    <small class="text-soft">({{ $driver->medical_card_expiry->diffForHumans() }})</small>
                                                </p>
                                            </div>
                                        </div>
                                        @else
                                            <p class="text-soft mb-0">No medical card information on file.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Notes --}}
                            @if($driver->notes)
                            <div class="col-12">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <h6 class="overline-title text-primary mb-2">Notes</h6>
                                        <p class="text-soft mb-0">{{ $driver->notes }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
