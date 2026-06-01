@extends('layouts.admin')

@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Fleet Management</h3>
                            <div class="nk-block-des text-soft">
                                <p>Manage available vehicles, rates, and specifications.</p>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary">
                                <em class="icon ni ni-plus-circle"></em><span>Add New Vehicle</span>
                            </a>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-icon">
                        <em class="icon ni ni-check-circle"></em> {{ session('success') }}
                    </div>
                @endif

                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner">
                            <table class="datatable-init nk-tb-list nk-tb-ulist table" data-auto-responsive="false">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        <th class="nk-tb-col"><span class="sub-text">Vehicle</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Class</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Capacity</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Rates</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                                        <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($vehicles as $vehicle)
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col">
                                            <div class="user-card align-items-center">
                                                @if($vehicle->image)
                                                <div class="user-avatar bg-light" style="width: 60px; height: 45px; border-radius: 4px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                                    <img src="{{ $vehicle->image }}" alt="{{ $vehicle->name }}" style="width:100%; height:100%; object-fit: cover;">
                                                </div>
                                                @else
                                                <div class="user-avatar bg-light" style="width: 60px; height: 45px; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                                    <em class="icon ni ni-truck" style="font-size: 1.5rem;"></em>
                                                </div>
                                                @endif
                                                <div class="user-info" style="margin-left: 15px;">
                                                    <span class="tb-lead">{{ $vehicle->name }}</span>
                                                    <span class="sub-text">Key: {{ $vehicle->key }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="badge badge-dim bg-outline-primary text-uppercase">{{ $vehicle->class }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="sub-text">{{ $vehicle->passengers }} Passengers / {{ $vehicle->luggage }} Bags</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="tb-amount">${{ number_format($vehicle->hourly_rate, 2) }}/hr</span>
                                            <span class="sub-text">Airport: ${{ number_format($vehicle->airport_rate, 2) }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            @if(($vehicle->status ?? 'Active') === 'Active')
                                                <span class="badge badge-dim bg-success text-success">Active</span>
                                            @elseif($vehicle->status === 'Maintenance')
                                                <span class="badge badge-dim bg-warning text-warning">Maintenance</span>
                                            @else
                                                <span class="badge badge-dim bg-danger text-danger">Retired</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li>
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="{{ route('admin.vehicles.edit', $vehicle->id) }}"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                                                <li>
                                                                    <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" id="delete-vehicle-{{ $vehicle->id }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this vehicle?')) document.getElementById('delete-vehicle-{{ $vehicle->id }}').submit();" class="text-danger">
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
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="card-inner-sm border-t border-light mt-3">
                                {{ $vehicles->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
