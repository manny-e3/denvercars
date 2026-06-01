@extends('layouts.admin')

@section('title', 'Ride Bookings')

@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">

                {{-- Page Header --}}
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Ride Bookings</h3>
                            <div class="nk-block-des text-soft">
                                <p>All customer ride reservations submitted through the booking flow.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Stats Row --}}
                <div class="nk-block">
                    <div class="row g-3 mb-3">
                        <div class="col-6 col-md col-lg">
                            <a href="{{ route('admin.rides.index') }}" class="card card-bordered text-center py-3 d-block {{ !request('status') ? 'bg-primary text-white' : '' }}">
                                <div class="fw-bold fs-4">{{ $counts['all'] }}</div>
                                <div class="text-soft small">All Rides</div>
                            </a>
                        </div>
                        @foreach(['pending'=>'warning','confirmed'=>'info','completed'=>'success','cancelled'=>'danger'] as $s => $color)
                        <div class="col-6 col-md col-lg">
                            <a href="{{ route('admin.rides.index', ['status'=>$s]) }}" class="card card-bordered text-center py-3 d-block {{ request('status')===$s ? "bg-{$color} text-white" : '' }}">
                                <div class="fw-bold fs-4">{{ $counts[$s] }}</div>
                                <div class="text-soft small">{{ ucfirst($s) }}</div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Filters --}}
                <div class="nk-block">
                    <div class="card card-bordered mb-3">
                        <div class="card-inner">
                            <form method="GET" action="{{ route('admin.rides.index') }}" class="row g-2 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label form-label-sm">Search</label>
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Reference, customer, pickup…" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label form-label-sm">Service</label>
                                    <select name="service_type" class="form-select form-select-sm">
                                        <option value="">All</option>
                                        <option value="airport" {{ request('service_type')==='airport' ? 'selected' : '' }}>Airport Transfer</option>
                                        <option value="hourly"  {{ request('service_type')==='hourly'  ? 'selected' : '' }}>Hourly</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label form-label-sm">Date From</label>
                                    <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label form-label-sm">Date To</label>
                                    <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-2 d-flex gap-2">
                                    <button type="submit" class="btn btn-primary btn-sm flex-grow-1">Filter</button>
                                    <a href="{{ route('admin.rides.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Table --}}
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner p-0">
                            <div class="nk-tb-list nk-tb-ulist">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col"><span>Reference</span></div>
                                    <div class="nk-tb-col"><span>Customer</span></div>
                                    <div class="nk-tb-col tb-col-md"><span>Vehicle</span></div>
                                    <div class="nk-tb-col tb-col-md"><span>Service</span></div>
                                    <div class="nk-tb-col tb-col-lg"><span>Pickup</span></div>
                                    <div class="nk-tb-col tb-col-md"><span>Date & Time</span></div>
                                    <div class="nk-tb-col tb-col-md"><span>Fare</span></div>
                                    <div class="nk-tb-col"><span>Status</span></div>
                                    <div class="nk-tb-col nk-tb-col-tools"></div>
                                </div>

                                @forelse($rides as $ride)
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="fw-bold text-primary">{{ $ride->reference }}</span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <a href="{{ route('admin.customers.show', $ride->customer) }}" class="text-dark fw-medium">
                                            {{ $ride->customer->full_name }}
                                        </a>
                                        <div class="text-soft small">{{ $ride->customer->email }}</div>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <span class="text-soft small">{{ Str::limit($ride->vehicle_name, 30) }}</span>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <span class="badge badge-dot badge-{{ $ride->service_type === 'airport' ? 'primary' : 'info' }}">
                                            {{ $ride->service_type === 'airport' ? 'Airport' : 'Hourly' }}
                                        </span>
                                    </div>
                                    <div class="nk-tb-col tb-col-lg">
                                        <span class="text-soft small">{{ Str::limit($ride->pickup, 35) }}</span>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <span>{{ $ride->date->format('M d, Y') }}</span>
                                        <div class="text-soft small">{{ $ride->time }}</div>
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
                                        <ul class="nk-tb-actions gx-1">
                                            <li>
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                                        <em class="icon ni ni-more-h"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="{{ route('admin.rides.show', $ride) }}"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                            @foreach(['confirmed','completed','cancelled'] as $newStatus)
                                                                @if($ride->status !== $newStatus)
                                                                <li>
                                                                    <form method="POST" action="{{ route('admin.rides.status', $ride) }}" class="d-inline">
                                                                        @csrf @method('PATCH')
                                                                        <input type="hidden" name="status" value="{{ $newStatus }}">
                                                                        <button type="submit" class="dropdown-item">
                                                                            <em class="icon ni ni-edit"></em><span>Mark as {{ ucfirst($newStatus) }}</span>
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                                @endif
                                                            @endforeach
                                                            <li class="divider"></li>
                                                            <li>
                                                                <form method="POST" action="{{ route('admin.rides.destroy', $ride) }}" onsubmit="return confirm('Delete ride {{ $ride->reference }}?')">
                                                                    @csrf @method('DELETE')
                                                                    <button type="submit" class="dropdown-item text-danger">
                                                                        <em class="icon ni ni-trash"></em><span>Delete</span>
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @empty
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col" colspan="9">
                                        <div class="text-center py-5 text-soft">
                                            <em class="icon ni ni-car text-light" style="font-size:3rem"></em>
                                            <p class="mt-2">No ride bookings found.</p>
                                        </div>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- Pagination --}}
                    @if($rides->hasPages())
                    <div class="d-flex justify-content-end mt-3">
                        {{ $rides->links() }}
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
