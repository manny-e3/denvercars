@extends('layouts.admin')

@section('title', $customer->full_name)

@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">

                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <nav>
                                <ol class="breadcrumb breadcrumb-arrow">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Customers</a></li>
                                    <li class="breadcrumb-item active">{{ $customer->full_name }}</li>
                                </ol>
                            </nav>
                            <h3 class="nk-block-title page-title">Customer Profile</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <form method="POST" action="{{ route('admin.customers.destroy', $customer) }}"
                                  onsubmit="return confirm('Delete this customer and all their bookings?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <em class="icon ni ni-trash me-1"></em> Delete Customer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="nk-block">
                    <div class="row g-4">

                        {{-- Profile Card --}}
                        <div class="col-lg-4">
                            <div class="card card-bordered">
                                <div class="card-inner text-center py-4">
                                    <div class="user-avatar xl bg-primary mx-auto mb-3" style="width:72px;height:72px;font-size:1.5rem">
                                        <span>{{ strtoupper(substr($customer->first_name,0,1) . substr($customer->last_name,0,1)) }}</span>
                                    </div>
                                    <h5 class="mb-0">{{ $customer->full_name }}</h5>
                                    <div class="text-soft">{{ $customer->email }}</div>

                                    <div class="mt-3">
                                        <span class="badge bg-info">{{ $customer->rideBookings->count() }} Booking(s)</span>
                                    </div>
                                </div>
                                <div class="card-inner border-top">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 d-flex align-items-center gap-2">
                                            <em class="icon ni ni-call text-primary"></em>
                                            <span>{{ $customer->phone ?? 'No phone on file' }}</span>
                                        </li>
                                        <li class="list-group-item px-0 d-flex align-items-center gap-2">
                                            <em class="icon ni ni-calendar text-primary"></em>
                                            <span>Customer since {{ $customer->created_at->format('M d, Y') }}</span>
                                        </li>
                                        @if($customer->notes)
                                        <li class="list-group-item px-0">
                                            <em class="icon ni ni-notes text-primary me-2"></em>
                                            <span class="text-soft">{{ $customer->notes }}</span>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- Booking History --}}
                        <div class="col-lg-8">
                            <div class="card card-bordered">
                                <div class="card-header">
                                    <h6 class="card-title">Booking History</h6>
                                </div>
                                <div class="card-inner p-0">
                                    <div class="nk-tb-list">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col"><span>Reference</span></div>
                                            <div class="nk-tb-col tb-col-md"><span>Service</span></div>
                                            <div class="nk-tb-col tb-col-md"><span>Date</span></div>
                                            <div class="nk-tb-col tb-col-md"><span>Fare</span></div>
                                            <div class="nk-tb-col"><span>Status</span></div>
                                            <div class="nk-tb-col nk-tb-col-tools"></div>
                                        </div>

                                        @forelse($customer->rideBookings as $ride)
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col">
                                                <span class="fw-bold text-primary">{{ $ride->reference }}</span>
                                                <div class="text-soft small">{{ Str::limit($ride->pickup, 28) }}</div>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="text-capitalize text-soft small">{{ $ride->service_type }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span>{{ $ride->date->format('M d, Y') }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="fw-medium">${{ number_format($ride->total_fare, 2) }}</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="badge badge-sm badge-dim bg-{{ $ride->status_color }}">
                                                    {{ ucfirst($ride->status) }}
                                                </span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-col-tools">
                                                <a href="{{ route('admin.rides.show', $ride) }}" class="btn btn-icon btn-sm btn-trigger" title="View">
                                                    <em class="icon ni ni-eye"></em>
                                                </a>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col">
                                                <div class="text-center py-4 text-soft">No bookings yet.</div>
                                            </div>
                                        </div>
                                        @endforelse
                                    </div>
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
