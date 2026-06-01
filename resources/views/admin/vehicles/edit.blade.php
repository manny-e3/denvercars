@extends('layouts.admin')

@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edit Vehicle</h3>
                            <div class="nk-block-des text-soft">
                                <p>Modify vehicle details, rates, or specs for "{{ $vehicle->name }}".</p>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex">
                                <em class="icon ni ni-arrow-left"></em><span>Back to Fleet</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row g-gs">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Vehicle Name</label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $vehicle->name) }}" placeholder="e.g., Cadillac Escalade ESV" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Vehicle Class</label>
                                            <select name="class" class="form-control @error('class') is-invalid @enderror" required>
                                                <option value="" disabled>Select Class</option>
                                                <option value="Sedan" {{ old('class', $vehicle->class) === 'Sedan' ? 'selected' : '' }}>Sedan</option>
                                                <option value="SUV" {{ old('class', $vehicle->class) === 'SUV' ? 'selected' : '' }}>SUV</option>
                                                <option value="Van" {{ old('class', $vehicle->class) === 'Van' ? 'selected' : '' }}>Van</option>
                                                <option value="Limousine" {{ old('class', $vehicle->class) === 'Limousine' ? 'selected' : '' }}>Limousine</option>
                                            </select>
                                            @error('class')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Hourly Rate ($)</label>
                                            <input type="number" step="0.01" name="hourly_rate" class="form-control @error('hourly_rate') is-invalid @enderror" value="{{ old('hourly_rate', $vehicle->hourly_rate) }}" placeholder="e.g., 150" required>
                                            @error('hourly_rate')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Airport Transfer Rate ($)</label>
                                            <input type="number" step="0.01" name="airport_rate" class="form-control @error('airport_rate') is-invalid @enderror" value="{{ old('airport_rate', $vehicle->airport_rate) }}" placeholder="e.g., 180" required>
                                            @error('airport_rate')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Max Passengers</label>
                                            <input type="number" name="passengers" class="form-control @error('passengers') is-invalid @enderror" value="{{ old('passengers', $vehicle->passengers) }}" placeholder="e.g., 6" required>
                                            @error('passengers')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Max Luggage Bags</label>
                                            <input type="number" name="luggage" class="form-control @error('luggage') is-invalid @enderror" value="{{ old('luggage', $vehicle->luggage) }}" placeholder="e.g., 6" required>
                                            @error('luggage')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                                <option value="Active" {{ old('status', $vehicle->status) === 'Active' ? 'selected' : '' }}>Active</option>
                                                <option value="Maintenance" {{ old('status', $vehicle->status) === 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                                <option value="Retired" {{ old('status', $vehicle->status) === 'Retired' ? 'selected' : '' }}>Retired</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Vehicle Image</label>
                                            @if($vehicle->image)
                                                <div class="mb-2">
                                                    <img src="{{ $vehicle->image }}" alt="{{ $vehicle->name }}" style="max-height: 150px; border-radius: 4px; border: 1px solid #e5e9f2; object-fit: cover;">
                                                </div>
                                            @endif
                                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                            <small class="text-soft">Leave blank to keep the current image</small>
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Enter vehicle description and premium amenities details..." required>{{ old('description', $vehicle->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-lg btn-primary">Update Vehicle Details</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
