@extends('layouts.admin')
@section('title', 'Edit Driver — ' . $driver->name)

@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">

                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edit Driver — {{ $driver->name }}</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{ route('admin.drivers.index') }}" class="btn btn-outline-light btn-sm">
                                <em class="icon ni ni-arrow-left"></em><span>Back</span>
                            </a>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.drivers.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row g-4">

                        <div class="col-lg-8">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="overline-title text-primary mb-3">Personal Information</h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                                <input type="text" name="name" value="{{ old('name', $driver->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Email Address</label>
                                                <input type="email" name="email" value="{{ old('email', $driver->email) }}" class="form-control @error('email') is-invalid @enderror">
                                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Phone Number</label>
                                                <input type="text" name="phone" value="{{ old('phone', $driver->phone) }}" class="form-control @error('phone') is-invalid @enderror">
                                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Assigned Vehicle</label>
                                                <select name="vehicle_id" class="form-select @error('vehicle_id') is-invalid @enderror">
                                                    <option value="">— Unassigned —</option>
                                                    @foreach($vehicles as $v)
                                                        <option value="{{ $v->id }}" @selected(old('vehicle_id', $driver->vehicle_id) == $v->id)>{{ $v->name }} ({{ $v->class }})</option>
                                                    @endforeach
                                                </select>
                                                @error('vehicle_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                                    <option value="Active"    @selected(old('status', $driver->status) === 'Active')>Active</option>
                                                    <option value="Inactive"  @selected(old('status', $driver->status) === 'Inactive')>Inactive</option>
                                                    <option value="Suspended" @selected(old('status', $driver->status) === 'Suspended')>Suspended</option>
                                                </select>
                                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-4">
                                    <h6 class="overline-title text-primary mb-3">License Information</h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">License Number <span class="text-danger">*</span></label>
                                                <input type="text" name="license_number" value="{{ old('license_number', $driver->license_number) }}" class="form-control @error('license_number') is-invalid @enderror" required>
                                                @error('license_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">License Type <span class="text-danger">*</span></label>
                                                <select name="license_type" class="form-select @error('license_type') is-invalid @enderror" required>
                                                    <option value="Class A CDL" @selected(old('license_type', $driver->license_type) === 'Class A CDL')>Class A CDL</option>
                                                    <option value="Class B CDL" @selected(old('license_type', $driver->license_type) === 'Class B CDL')>Class B CDL</option>
                                                    <option value="Class C CDL" @selected(old('license_type', $driver->license_type) === 'Class C CDL')>Class C CDL</option>
                                                    <option value="Non-CDL"     @selected(old('license_type', $driver->license_type) === 'Non-CDL')>Non-CDL</option>
                                                </select>
                                                @error('license_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">License Expiry Date <span class="text-danger">*</span></label>
                                                <input type="date" name="license_expiry" value="{{ old('license_expiry', $driver->license_expiry->format('Y-m-d')) }}" class="form-control @error('license_expiry') is-invalid @enderror" required>
                                                @error('license_expiry')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-4">
                                    <h6 class="overline-title text-primary mb-3">CDL Certifications</h6>
                                    <div class="row g-2">
                                        @php
                                            $allCerts   = ['Hazmat', 'Passenger', 'Tank Vehicle', 'School Bus', 'Doubles/Triples', 'Air Brakes'];
                                            $savedCerts = old('cdl_certifications', $driver->cdl_certifications ?? []);
                                        @endphp
                                        @foreach($allCerts as $cert)
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cert_{{ Str::slug($cert) }}" name="cdl_certifications[]" value="{{ $cert }}" @checked(in_array($cert, $savedCerts))>
                                                <label class="custom-control-label" for="cert_{{ Str::slug($cert) }}">{{ $cert }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    <hr class="my-4">
                                    <h6 class="overline-title text-primary mb-3">Medical Card</h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Medical Card Number</label>
                                                <input type="text" name="medical_card_number" value="{{ old('medical_card_number', $driver->medical_card_number) }}" class="form-control @error('medical_card_number') is-invalid @enderror">
                                                @error('medical_card_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Medical Card Expiry</label>
                                                <input type="date" name="medical_card_expiry" value="{{ old('medical_card_expiry', $driver->medical_card_expiry?->format('Y-m-d')) }}" class="form-control @error('medical_card_expiry') is-invalid @enderror">
                                                @error('medical_card_expiry')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-4">
                                    <div class="form-group">
                                        <label class="form-label">Notes</label>
                                        <textarea name="notes" rows="3" class="form-control">{{ old('notes', $driver->notes) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <h6 class="overline-title text-primary mb-3">Driver Photo</h6>
                                    <div class="upload-zone" id="photoZone" style="border: 2px dashed #dbdfea; border-radius: 8px; padding: 2rem; text-align: center; cursor: pointer;" onclick="document.getElementById('photoInput').click()">
                                        <img id="photoPreview" src="{{ $driver->photo ?? '' }}" alt="" style="display: {{ $driver->photo ? 'block' : 'none' }}; max-width: 100%; max-height: 200px; border-radius: 8px; margin: 0 auto 1rem;">
                                        <div id="photoPlaceholder" style="display: {{ $driver->photo ? 'none' : 'block' }};">
                                            <em class="icon ni ni-user" style="font-size: 3rem; color: #8094ae;"></em>
                                            <p class="text-soft mt-2 mb-0">Click to upload photo</p>
                                            <p class="text-soft small">JPEG, PNG, WEBP — max 2MB</p>
                                        </div>
                                    </div>
                                    <input type="file" id="photoInput" name="photo" accept="image/*" class="d-none">
                                    @error('photo')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                    <p class="text-soft small mt-2">Leave blank to keep current photo.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <em class="icon ni ni-save"></em><span>Update Driver</span>
                                </button>
                                <a href="{{ route('admin.drivers.show', $driver->id) }}" class="btn btn-outline-light">Cancel</a>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('photoInput').addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('photoPreview').src = e.target.result;
        document.getElementById('photoPreview').style.display = 'block';
        document.getElementById('photoPlaceholder').style.display = 'none';
    };
    reader.readAsDataURL(file);
});
</script>
@endpush
