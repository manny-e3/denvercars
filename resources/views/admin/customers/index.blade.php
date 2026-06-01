@extends('layouts.admin')

@section('title', 'Customers')

@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">

                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Customers</h3>
                            <p class="text-soft">All customers who have submitted ride bookings.</p>
                        </div>
                        <div class="nk-block-head-content">
                            <span class="badge badge-lg bg-primary">{{ $customers->total() }} Total</span>
                        </div>
                    </div>
                </div>

                <div class="nk-block mb-3">
                    <form method="GET" action="{{ route('admin.customers.index') }}" class="d-flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Search by name, email or phone…"
                               class="form-control form-control-sm" style="max-width:360px">
                        <button type="submit" class="btn btn-primary btn-sm">Search</button>
                        @if(request('search'))
                        <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
                        @endif
                    </form>
                </div>

                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner p-0">
                            <div class="nk-tb-list nk-tb-ulist">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col"><span>Customer</span></div>
                                    <div class="nk-tb-col tb-col-md"><span>Email</span></div>
                                    <div class="nk-tb-col tb-col-md"><span>Phone</span></div>
                                    <div class="nk-tb-col tb-col-md"><span>Total Rides</span></div>
                                    <div class="nk-tb-col tb-col-lg"><span>Joined</span></div>
                                    <div class="nk-tb-col nk-tb-col-tools"></div>
                                </div>

                                @forelse($customers as $customer)
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <div class="user-card">
                                            <div class="user-avatar sm bg-primary">
                                                <span>{{ strtoupper(substr($customer->first_name,0,1) . substr($customer->last_name,0,1)) }}</span>
                                            </div>
                                            <div class="user-info">
                                                <span class="tb-lead">{{ $customer->full_name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <span class="text-soft">{{ $customer->email }}</span>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <span class="text-soft">{{ $customer->phone ?? '—' }}</span>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <span class="badge badge-dim bg-info">{{ $customer->ride_bookings_count }} ride(s)</span>
                                    </div>
                                    <div class="nk-tb-col tb-col-lg">
                                        <span class="text-soft small">{{ $customer->created_at->format('M d, Y') }}</span>
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
                                                            <li>
                                                                <a href="{{ route('admin.customers.show', $customer) }}">
                                                                    <em class="icon ni ni-eye"></em><span>View Profile</span>
                                                                </a>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li>
                                                                <form method="POST" action="{{ route('admin.customers.destroy', $customer) }}"
                                                                      onsubmit="return confirm('Delete {{ $customer->full_name }} and all their bookings?')">
                                                                    @csrf @method('DELETE')
                                                                    <button type="submit" class="dropdown-item text-danger">
                                                                        <em class="icon ni ni-trash"></em><span>Delete Customer</span>
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
                                    <div class="nk-tb-col">
                                        <div class="text-center py-5 text-soft">
                                            <em class="icon ni ni-users text-light" style="font-size:3rem"></em>
                                            <p class="mt-2">No customers found.</p>
                                        </div>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    @if($customers->hasPages())
                    <div class="d-flex justify-content-end mt-3">
                        {{ $customers->links() }}
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
