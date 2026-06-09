@extends('layouts.admin')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Pricing Engine Settings</h3>
                            <div class="nk-block-des text-soft">
                                <p>Configure distance thresholds, hourly parameters, extra passenger/luggage surcharges, and peak-hour rate rules.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success alert-icon mb-4">
                        <em class="icon ni ni-check-circle"></em> {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-icon mb-4">
                        <em class="icon ni ni-cross-circle"></em>
                        <strong>Update failed:</strong> Please check the errors below.
                        <ul class="list-disc pl-4 mt-2 mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="nk-block">
                    <form action="{{ route('admin.settings.pricing.update') }}" method="POST">
                        @csrf
                        <div class="row g-gs">
                            @foreach($rates as $category => $items)
                            <div class="col-md-6">
                                <div class="card card-bordered h-100 shadow-sm">
                                    <div class="card-inner">
                                        <div class="card-title-group mb-4 border-bottom pb-2">
                                            <div class="card-title">
                                                <h6 class="title text-uppercase text-primary font-bold">
                                                    @if($category === 'airport')
                                                        <em class="icon ni ni-location-fill mr-1"></em> Airport Transfer Rates
                                                    @elseif($category === 'hourly')
                                                        <em class="icon ni ni-clock-fill mr-1"></em> Hourly Charter Rates
                                                    @elseif($category === 'surcharges')
                                                        <em class="icon ni ni-plus-circle-fill mr-1"></em> Extra Capacity Surcharges
                                                    @elseif($category === 'peak_hour')
                                                        <em class="icon ni ni-alarm-alt-fill mr-1"></em> Peak-Hour Rules
                                                    @else
                                                        {{ str_replace('_', ' ', $category) }} Rules
                                                    @endif
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="row g-3">
                                            @foreach($items as $rate)
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label font-weight-bold text-soft">{{ $rate->label }}</label>
                                                    <div class="form-control-wrap">
                                                        @php
                                                            $unit = 'USD';
                                                            if (strpos($rate->key, 'discount') !== false) {
                                                                $unit = '%';
                                                            } elseif (strpos($rate->key, 'distance') !== false || strpos($rate->key, 'mile') !== false) {
                                                                $unit = 'Miles';
                                                            } elseif (strpos($rate->key, 'hours') !== false) {
                                                                $unit = 'Hours';
                                                            } elseif (strpos($rate->key, 'limit') !== false) {
                                                                $unit = 'Qty';
                                                            } elseif ($rate->key === 'peak_surcharge_enabled' || $rate->key === 'peak_surcharge_is_percent') {
                                                                $unit = 'Toggle';
                                                            } elseif ($rate->key === 'peak_start_time' || $rate->key === 'peak_end_time') {
                                                                $unit = 'Time';
                                                            }
                                                        @endphp

                                                        @if($unit !== 'Toggle' && $unit !== 'Time')
                                                            <div class="form-text-hint">
                                                                <span class="overline-title">{{ $unit }}</span>
                                                            </div>
                                                        @endif

                                                        @if($rate->key === 'peak_surcharge_enabled' || $rate->key === 'peak_surcharge_is_percent')
                                                            <select name="rates[{{ $rate->id }}]" class="form-select form-control" required>
                                                                <option value="1.00" {{ old('rates.'.$rate->id, $rate->value) == 1 ? 'selected' : '' }}>Yes / Enable</option>
                                                                <option value="0.00" {{ old('rates.'.$rate->id, $rate->value) == 0 ? 'selected' : '' }}>No / Disable</option>
                                                            </select>
                                                        @elseif($rate->key === 'peak_start_time' || $rate->key === 'peak_end_time')
                                                            <select name="rates[{{ $rate->id }}]" class="form-select form-control" required>
                                                                @for($h = 0; $h < 24; $h++)
                                                                    <option value="{{ $h }}.00" {{ (int)old('rates.'.$rate->id, $rate->value) === $h ? 'selected' : '' }}>
                                                                        {{ date("g A", strtotime("$h:00")) }} ({{ sprintf("%02d:00", $h) }})
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        @else
                                                            <input type="number" step="0.01" min="0" name="rates[{{ $rate->id }}]" class="form-control" value="{{ old('rates.'.$rate->id, $rate->value) }}" required>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-4 pb-5">
                            <button type="submit" class="btn btn-lg btn-primary shadow-sm"><em class="icon ni ni-save mr-1"></em> Save Pricing Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
