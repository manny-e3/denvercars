@extends('layouts.admin')

@section('title', 'Ride — ' . $ride->reference)

@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">

                {{-- Breadcrumb --}}
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <nav>
                                <ol class="breadcrumb breadcrumb-arrow">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.rides.index') }}">Rides</a></li>
                                    <li class="breadcrumb-item active">{{ $ride->reference }}</li>
                                </ol>
                            </nav>
                            <h3 class="nk-block-title page-title">Ride Details</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <span class="badge badge-lg bg-{{ $ride->status_color }}">{{ ucfirst($ride->status) }}</span>
                        </div>
                    </div>
                </div>

                <div class="nk-block">
                    <div class="row g-4">

                        {{-- Booking Summary --}}
                        <div class="col-lg-8">
                            <div class="card card-bordered h-100">
                                <div class="card-header">
                                    <h6 class="card-title">Booking Summary — <span class="text-primary">{{ $ride->reference }}</span></h6>
                                </div>
                                <div class="card-inner">
                                    <div class="row gy-3">
                                        <div class="col-sm-6">
                                            <div class="text-soft overline-title mb-1">Service Type</div>
                                            <div class="fw-medium">{{ $ride->service_type === 'airport' ? '✈ Airport Transfer' : '⏱ Hourly Directed' }}</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-soft overline-title mb-1">Vehicle</div>
                                            <div class="fw-medium">{{ $ride->vehicle_name }}</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-soft overline-title mb-1">Pickup Location</div>
                                            <div>{{ $ride->pickup }}</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-soft overline-title mb-1">Drop-off Location</div>
                                            <div>{{ $ride->dropoff ?? '— As-Directed Hourly —' }}</div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="text-soft overline-title mb-1">Date</div>
                                            <div>{{ $ride->date->format('M d, Y') }}</div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="text-soft overline-title mb-1">Time</div>
                                            <div>{{ $ride->time }}</div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="text-soft overline-title mb-1">Passengers</div>
                                            <div>{{ $ride->passengers }}</div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="text-soft overline-title mb-1">Luggage</div>
                                            <div>{{ $ride->luggage }} bags</div>
                                        </div>
                                        @if($ride->distance_miles)
                                        <div class="col-sm-3">
                                            <div class="text-soft overline-title mb-1">Distance</div>
                                            <div>{{ $ride->distance_miles }} mi</div>
                                        </div>
                                        @endif
                                        @if($ride->duration)
                                        <div class="col-sm-3">
                                            <div class="text-soft overline-title mb-1">Duration</div>
                                            <div>{{ $ride->duration }} hrs</div>
                                        </div>
                                        @endif
                                        @if($ride->flight_number)
                                        <div class="col-sm-6">
                                            <div class="text-soft overline-title mb-1">Flight Number</div>
                                            <div>{{ $ride->flight_number }}</div>
                                        </div>
                                        @endif
                                        <div class="col-sm-6">
                                            <div class="text-soft overline-title mb-1">Payment Method</div>
                                            <div class="text-capitalize">{{ str_replace('_', ' ', $ride->payment_method) }}</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-soft overline-title mb-1">Total Fare</div>
                                            <div class="fs-5 fw-bold text-success">${{ number_format($ride->total_fare, 2) }}</div>
                                        </div>
                                        @if($ride->notes)
                                        <div class="col-12">
                                            <div class="text-soft overline-title mb-1">Notes</div>
                                            <div class="alert alert-light">{{ $ride->notes }}</div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Right Column: Customer + Actions --}}
                        <div class="col-lg-4">

                            {{-- Customer Card --}}
                            <div class="card card-bordered mb-3">
                                <div class="card-header">
                                    <h6 class="card-title">Customer</h6>
                                </div>
                                <div class="card-inner">
                                    <div class="user-card mb-3">
                                        <div class="user-avatar bg-primary">
                                            <span>{{ strtoupper(substr($ride->customer->first_name, 0, 1) . substr($ride->customer->last_name, 0, 1)) }}</span>
                                        </div>
                                        <div class="user-info">
                                            <span class="lead-text">{{ $ride->customer->full_name }}</span>
                                            <span class="sub-text">{{ $ride->customer->email }}</span>
                                        </div>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            <em class="icon ni ni-call me-2"></em> {{ $ride->customer->phone ?? 'N/A' }}
                                        </li>
                                        <li class="list-group-item px-0">
                                            <em class="icon ni ni-calendar me-2"></em> Customer since {{ $ride->customer->created_at->format('M Y') }}
                                        </li>
                                    </ul>
                                    <a href="{{ route('admin.customers.show', $ride->customer) }}" class="btn btn-outline-primary btn-sm mt-3 w-100">
                                        View Full Profile
                                    </a>
                                </div>
                            </div>

                            {{-- Update Status --}}
                            <div class="card card-bordered">
                                <div class="card-header">
                                    <h6 class="card-title">Update Status</h6>
                                </div>
                                <div class="card-inner">
                                    <form method="POST" action="{{ route('admin.rides.status', $ride) }}">
                                        @csrf @method('PATCH')
                                        <div class="form-group mb-3">
                                            <label class="form-label">Set Status</label>
                                            <select name="status" class="form-select">
                                                @foreach(['pending','confirmed','completed','cancelled'] as $s)
                                                <option value="{{ $s }}" {{ $ride->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Update Status</button>
                                    </form>

                                    <div class="divider mt-3"></div>

                                    <form method="POST" action="{{ route('admin.rides.destroy', $ride) }}"
                                          onsubmit="return confirm('Permanently delete ride {{ $ride->reference }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm w-100 mt-2">
                                            <em class="icon ni ni-trash me-1"></em> Delete Booking
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
