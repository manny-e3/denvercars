@extends('layouts.admin')
@section('title', 'Driver Profiles')

@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">

                {{-- Page Header --}}
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Driver Profiles</h3>
                            <div class="nk-block-des text-soft">
                                <p>Manage driver licenses, CDL certifications, and medical card compliance.</p>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{ route('admin.drivers.create') }}" class="btn btn-primary">
                                <em class="icon ni ni-plus-circle"></em><span>Add Driver</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Compliance Alert Summary --}}
                @if($counts['expired'] > 0 || $counts['expiring_soon'] > 0)
                <div class="nk-block">
                    <div class="row g-3">
                        @if($counts['expired'] > 0)
                        <div class="col-md-6">
                            <div class="alert alert-danger alert-icon" style="border-radius: 8px;">
                                <em class="icon ni ni-alert-circle"></em>
                                <strong>{{ $counts['expired'] }} driver(s)</strong> have expired licenses or medical cards. Immediate action required.
                            </div>
                        </div>
                        @endif
                        @if($counts['expiring_soon'] > 0)
                        <div class="col-md-6">
                            <div class="alert alert-warning alert-icon" style="border-radius: 8px;">
                                <em class="icon ni ni-alarm"></em>
                                <strong>{{ $counts['expiring_soon'] }} driver(s)</strong> have documents expiring within 30 days.
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                {{-- Stats Row --}}
                <div class="nk-block">
                    <div class="row g-3 mb-3">
                        <div class="col-6 col-md-3">
                            <div class="card card-bordered text-center" style="border-radius: 10px; padding: 1rem;">
                                <div class="fs-1 fw-bold text-primary">{{ $counts['all'] }}</div>
                                <div class="text-soft small">Total Drivers</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card card-bordered text-center" style="border-radius: 10px; padding: 1rem;">
                                <div class="fs-1 fw-bold text-success">{{ $counts['active'] }}</div>
                                <div class="text-soft small">Active</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card card-bordered text-center" style="border-radius: 10px; padding: 1rem;">
                                <div class="fs-1 fw-bold text-warning">{{ $counts['expiring_soon'] }}</div>
                                <div class="text-soft small">Expiring Soon</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card card-bordered text-center" style="border-radius: 10px; padding: 1rem;">
                                <div class="fs-1 fw-bold text-danger">{{ $counts['expired'] }}</div>
                                <div class="text-soft small">Expired Docs</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Filter Bar --}}
                <div class="nk-block">
                    <form method="GET" class="d-flex flex-wrap gap-2 align-items-end mb-3">
                        <div>
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Search name, license, email…" style="min-width: 220px;">
                        </div>
                        <div>
                            <select name="status" class="form-select form-select-sm">
                                <option value="">All Status</option>
                                <option value="Active"    @selected(request('status') === 'Active')>Active</option>
                                <option value="Inactive"  @selected(request('status') === 'Inactive')>Inactive</option>
                                <option value="Suspended" @selected(request('status') === 'Suspended')>Suspended</option>
                            </select>
                        </div>
                        <div>
                            <select name="license_type" class="form-select form-select-sm">
                                <option value="">All License Types</option>
                                <option value="Class A CDL" @selected(request('license_type') === 'Class A CDL')>Class A CDL</option>
                                <option value="Class B CDL" @selected(request('license_type') === 'Class B CDL')>Class B CDL</option>
                                <option value="Class C CDL" @selected(request('license_type') === 'Class C CDL')>Class C CDL</option>
                                <option value="Non-CDL"     @selected(request('license_type') === 'Non-CDL')>Non-CDL</option>
                            </select>
                        </div>
                        <div>
                            <select name="compliance" class="form-select form-select-sm">
                                <option value="">All Compliance</option>
                                <option value="expired"       @selected(request('compliance') === 'expired')>Expired</option>
                                <option value="expiring_soon" @selected(request('compliance') === 'expiring_soon')>Expiring Soon</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary"><em class="icon ni ni-search"></em></button>
                        <a href="{{ route('admin.drivers.index') }}" class="btn btn-sm btn-outline-light">Reset</a>
                    </form>
                </div>

                {{-- Table --}}
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner p-0">
                            <table class="nk-tb-list nk-tb-ulist table table-hover" data-auto-responsive="false">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        <th class="nk-tb-col"><span class="sub-text">Driver</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">License</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">License Expiry</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Medical Card</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Assigned Vehicle</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                                        <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($drivers as $driver)
                                    @php
                                        $licStatus = $driver->licenseStatus();
                                        $medStatus = $driver->medicalCardStatus();
                                    @endphp
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                @if($driver->photo)
                                                    <div class="user-avatar" style="width:40px;height:40px;border-radius:50%;overflow:hidden;flex-shrink:0;">
                                                        <img src="{{ $driver->photo }}" alt="{{ $driver->name }}" style="width:100%;height:100%;object-fit:cover;">
                                                    </div>
                                                @else
                                                    <div class="user-avatar bg-primary-dim">
                                                        <span>{{ strtoupper(substr($driver->name, 0, 2)) }}</span>
                                                    </div>
                                                @endif
                                                <div class="user-info ms-2">
                                                    <span class="tb-lead">{{ $driver->name }}</span>
                                                    <span class="sub-text">{{ $driver->email ?? $driver->phone ?? '—' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="tb-lead">{{ $driver->license_number }}</span>
                                            <span class="sub-text">{{ $driver->license_type }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            @if($licStatus === 'expired')
                                                <span class="badge bg-danger text-white">Expired</span>
                                            @elseif($licStatus === 'expiring_soon')
                                                <span class="badge bg-warning text-dark">Expiring Soon</span>
                                            @else
                                                <span class="badge bg-success text-white">Valid</span>
                                            @endif
                                            <div class="sub-text">{{ $driver->license_expiry->format('M d, Y') }}</div>
                                        </td>
                                        <td class="nk-tb-col">
                                            @if($driver->medical_card_expiry)
                                                @if($medStatus === 'expired')
                                                    <span class="badge bg-danger text-white">Expired</span>
                                                @elseif($medStatus === 'expiring_soon')
                                                    <span class="badge bg-warning text-dark">Expiring Soon</span>
                                                @else
                                                    <span class="badge bg-success text-white">Valid</span>
                                                @endif
                                                <div class="sub-text">{{ $driver->medical_card_expiry->format('M d, Y') }}</div>
                                            @else
                                                <span class="text-soft">—</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col">
                                            @if($driver->vehicle)
                                                <span class="badge badge-dim bg-outline-primary">{{ $driver->vehicle->name }}</span>
                                            @else
                                                <span class="text-soft">Unassigned</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col">
                                            @if($driver->status === 'Active')
                                                <span class="badge badge-dim bg-success text-success">Active</span>
                                            @elseif($driver->status === 'Inactive')
                                                <span class="badge badge-dim bg-secondary text-secondary">Inactive</span>
                                            @else
                                                <span class="badge badge-dim bg-danger text-danger">Suspended</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li>
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="{{ route('admin.drivers.show', $driver->id) }}"><em class="icon ni ni-eye"></em><span>View</span></a></li>
                                                                <li><a href="{{ route('admin.drivers.edit', $driver->id) }}"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                                                <li>
                                                                    <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" id="del-driver-{{ $driver->id }}">
                                                                        @csrf @method('DELETE')
                                                                        <a href="#" onclick="event.preventDefault(); if(confirm('Delete {{ $driver->name }}?')) document.getElementById('del-driver-{{ $driver->id }}').submit();" class="text-danger">
                                                                            <em class="icon ni ni-trash"></em><span>Delete</span>
                                                                        </a>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <em class="icon ni ni-user-x" style="font-size: 2rem; color: #8094ae;"></em>
                                            <p class="text-soft mt-2">No drivers found. <a href="{{ route('admin.drivers.create') }}">Add your first driver</a>.</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-inner border-top">
                            {{ $drivers->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
