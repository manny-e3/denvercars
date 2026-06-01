@extends('layouts.admin')
@section('title', 'Revenue Reports')

@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">

                {{-- Header --}}
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Revenue Reports</h3>
                            <div class="nk-block-des text-soft">
                                <p>Total earnings breakdown by period and vehicle class — based on completed bookings.</p>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <span class="badge bg-primary text-white px-3 py-2" style="font-size: 0.85rem;">
                                <em class="icon ni ni-calendar me-1"></em>
                                As of {{ now()->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- KPI Cards --}}
                <div class="nk-block">
                    <div class="row g-3 mb-2">
                        {{-- Today --}}
                        <div class="col-6 col-xl-3">
                            <div class="card card-bordered h-100" style="border-radius: 12px; border-left: 4px solid #6576ff;">
                                <div class="card-inner">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div class="card-title-group">
                                            <p class="text-soft small mb-0 text-uppercase fw-semibold" style="letter-spacing: .08em;">Today</p>
                                            <h4 class="amount mb-0" style="font-size: 1.65rem; font-weight: 700; color: #364a63;">
                                                ${{ number_format($today, 2) }}
                                            </h4>
                                        </div>
                                        <div class="nk-stats-icon" style="background: #eff1ff; border-radius: 50%; width: 44px; height: 44px; display:flex; align-items:center; justify-content:center;">
                                            <em class="icon ni ni-sun" style="font-size: 1.25rem; color: #6576ff;"></em>
                                        </div>
                                    </div>
                                    <p class="text-soft small mb-0">{{ $todayBookings }} completed ride{{ $todayBookings != 1 ? 's' : '' }} today</p>
                                </div>
                            </div>
                        </div>

                        {{-- This Week --}}
                        <div class="col-6 col-xl-3">
                            <div class="card card-bordered h-100" style="border-radius: 12px; border-left: 4px solid #09c2de;">
                                <div class="card-inner">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <p class="text-soft small mb-0 text-uppercase fw-semibold" style="letter-spacing: .08em;">This Week</p>
                                            <h4 class="amount mb-0" style="font-size: 1.65rem; font-weight: 700; color: #364a63;">
                                                ${{ number_format($thisWeek, 2) }}
                                            </h4>
                                        </div>
                                        <div style="background: #e3f9fc; border-radius: 50%; width: 44px; height: 44px; display:flex; align-items:center; justify-content:center;">
                                            <em class="icon ni ni-calendar-week" style="font-size: 1.25rem; color: #09c2de;"></em>
                                        </div>
                                    </div>
                                    <p class="text-soft small mb-0">{{ now()->startOfWeek()->format('M d') }} – {{ now()->endOfWeek()->format('M d') }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- This Month --}}
                        <div class="col-6 col-xl-3">
                            <div class="card card-bordered h-100" style="border-radius: 12px; border-left: 4px solid #1ee0ac;">
                                <div class="card-inner">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <p class="text-soft small mb-0 text-uppercase fw-semibold" style="letter-spacing: .08em;">This Month</p>
                                            <h4 class="amount mb-0" style="font-size: 1.65rem; font-weight: 700; color: #364a63;">
                                                ${{ number_format($thisMonth, 2) }}
                                            </h4>
                                        </div>
                                        <div style="background: #e3faf4; border-radius: 50%; width: 44px; height: 44px; display:flex; align-items:center; justify-content:center;">
                                            <em class="icon ni ni-bar-chart" style="font-size: 1.25rem; color: #1ee0ac;"></em>
                                        </div>
                                    </div>
                                    <p class="text-soft small mb-0">{{ now()->format('F Y') }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- This Year --}}
                        <div class="col-6 col-xl-3">
                            <div class="card card-bordered h-100" style="border-radius: 12px; border-left: 4px solid #f4bd0e;">
                                <div class="card-inner">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <p class="text-soft small mb-0 text-uppercase fw-semibold" style="letter-spacing: .08em;">This Year</p>
                                            <h4 class="amount mb-0" style="font-size: 1.65rem; font-weight: 700; color: #364a63;">
                                                ${{ number_format($thisYear, 2) }}
                                            </h4>
                                        </div>
                                        <div style="background: #fef9e3; border-radius: 50%; width: 44px; height: 44px; display:flex; align-items:center; justify-content:center;">
                                            <em class="icon ni ni-trend-up" style="font-size: 1.25rem; color: #f4bd0e;"></em>
                                        </div>
                                    </div>
                                    <p class="text-soft small mb-0">Jan – Dec {{ now()->year }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Custom Date Range Filter --}}
                <div class="nk-block">
                    <div class="card card-bordered mb-3" style="border-radius: 10px;">
                        <div class="card-inner py-3">
                            <form method="GET" class="d-flex flex-wrap align-items-end gap-3">
                                <div>
                                    <label class="form-label mb-1 small fw-semibold">From Date</label>
                                    <input type="date" name="date_from" value="{{ $dateFrom?->format('Y-m-d') }}" class="form-control form-control-sm">
                                </div>
                                <div>
                                    <label class="form-label mb-1 small fw-semibold">To Date</label>
                                    <input type="date" name="date_to" value="{{ $dateTo?->format('Y-m-d') }}" class="form-control form-control-sm">
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <em class="icon ni ni-search"></em><span>Calculate</span>
                                </button>
                                @if($dateFrom && $dateTo)
                                <a href="{{ route('admin.reports.revenue') }}" class="btn btn-sm btn-outline-light">Clear</a>
                                @endif
                            </form>

                            @if($customTotal !== null)
                            <div class="mt-3 pt-3 border-top">
                                <div class="row g-3">
                                    <div class="col-auto">
                                        <span class="sub-text">Custom Period Revenue</span>
                                        <h4 class="mb-0 text-primary">${{ number_format($customTotal, 2) }}</h4>
                                    </div>
                                    <div class="col-auto">
                                        <span class="sub-text">Completed Bookings</span>
                                        <h4 class="mb-0">{{ $customBookings }}</h4>
                                    </div>
                                    @if($customBookings > 0)
                                    <div class="col-auto">
                                        <span class="sub-text">Avg. Per Booking</span>
                                        <h4 class="mb-0">${{ number_format($customTotal / $customBookings, 2) }}</h4>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Chart + Booking Status --}}
                <div class="nk-block">
                    <div class="row g-4 mb-4">

                        {{-- 12-Month Trend Chart --}}
                        <div class="col-lg-8">
                            <div class="card card-bordered h-100" style="border-radius: 12px;">
                                <div class="card-inner pb-0">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="overline-title text-primary">12-Month Revenue Trend</h6>
                                        <span class="text-soft small">Completed bookings only</span>
                                    </div>
                                    <div id="revenueChart" style="height: 280px;"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Booking Summary --}}
                        <div class="col-lg-4">
                            <div class="card card-bordered h-100" style="border-radius: 12px;">
                                <div class="card-inner">
                                    <h6 class="overline-title text-primary mb-3">Booking Summary</h6>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="text-center p-3" style="background: #f8faff; border-radius: 8px;">
                                                <div class="fs-2 fw-bold text-primary">{{ $totalBookings }}</div>
                                                <div class="text-soft small">Completed</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center p-3" style="background: #fff8e6; border-radius: 8px;">
                                                <div class="fs-2 fw-bold text-warning">{{ $pendingBookings }}</div>
                                                <div class="text-soft small">Pending</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center p-3" style="background: #fff1f3; border-radius: 8px;">
                                                <div class="fs-2 fw-bold text-danger">{{ $cancelledBookings }}</div>
                                                <div class="text-soft small">Cancelled</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center p-3" style="background: #f0fff8; border-radius: 8px;">
                                                <div class="fs-2 fw-bold text-success">{{ $todayBookings }}</div>
                                                <div class="text-soft small">Today</div>
                                            </div>
                                        </div>
                                    </div>

                                    @if($byService->count() > 0)
                                    <hr class="my-3">
                                    <h6 class="overline-title text-soft mb-2">By Service Type</h6>
                                    @foreach($byService as $svc)
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <div>
                                            <span class="badge badge-dim bg-outline-primary text-uppercase">{{ $svc->service_type }}</span>
                                            <span class="text-soft small ms-1">{{ $svc->bookings }} rides</span>
                                        </div>
                                        <span class="fw-medium">${{ number_format($svc->total, 2) }}</span>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Revenue by Vehicle Class + Top Vehicles --}}
                <div class="nk-block">
                    <div class="row g-4">

                        {{-- By Vehicle Class --}}
                        <div class="col-lg-6">
                            <div class="card card-bordered" style="border-radius: 12px;">
                                <div class="card-inner">
                                    <h6 class="overline-title text-primary mb-3">Revenue by Vehicle Class <span class="text-soft">(This Month)</span></h6>
                                    @if($byClass->count() > 0)
                                        @php $maxClass = $byClass->max('total'); @endphp
                                        @foreach($byClass as $item)
                                        @php
                                            $pct = $maxClass > 0 ? round(($item->total / $maxClass) * 100) : 0;
                                            $colorMap = ['Sedan' => '#6576ff', 'SUV' => '#09c2de', 'Van' => '#1ee0ac', 'Limousine' => '#f4bd0e'];
                                            $color = $colorMap[$item->class] ?? '#6576ff';
                                        @endphp
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-1">
                                                <span class="fw-medium">{{ $item->class }}</span>
                                                <span class="text-soft small">{{ $item->bookings }} rides · ${{ number_format($item->total, 2) }}</span>
                                            </div>
                                            <div class="progress" style="height: 8px; border-radius: 4px; background: #e5e9f2;">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $pct }}%; background: {{ $color }}; border-radius: 4px;" aria-valuenow="{{ $pct }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="text-center py-4">
                                            <em class="icon ni ni-bar-chart-alt" style="font-size: 2.5rem; color: #dbdfea;"></em>
                                            <p class="text-soft mt-2">No completed bookings this month yet.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Top Vehicles --}}
                        <div class="col-lg-6">
                            <div class="card card-bordered" style="border-radius: 12px;">
                                <div class="card-inner">
                                    <h6 class="overline-title text-primary mb-3">Top Performing Vehicles <span class="text-soft">(This Year)</span></h6>
                                    @if($topVehicles->count() > 0)
                                    <table class="table table-sm table-hover">
                                        <thead>
                                            <tr>
                                                <th class="sub-text" style="font-size: 0.7rem;">Rank</th>
                                                <th class="sub-text" style="font-size: 0.7rem;">Vehicle</th>
                                                <th class="sub-text" style="font-size: 0.7rem;">Class</th>
                                                <th class="sub-text" style="font-size: 0.7rem;">Rides</th>
                                                <th class="sub-text text-end" style="font-size: 0.7rem;">Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($topVehicles as $i => $veh)
                                            <tr>
                                                <td>
                                                    @if($i === 0)
                                                        <span style="color: #f4bd0e; font-size: 1.1rem;">🥇</span>
                                                    @elseif($i === 1)
                                                        <span style="font-size: 1.1rem;">🥈</span>
                                                    @elseif($i === 2)
                                                        <span style="font-size: 1.1rem;">🥉</span>
                                                    @else
                                                        <span class="text-soft">#{{ $i + 1 }}</span>
                                                    @endif
                                                </td>
                                                <td class="fw-medium">{{ $veh->name }}</td>
                                                <td><span class="badge badge-dim bg-outline-primary">{{ $veh->class }}</span></td>
                                                <td>{{ $veh->bookings }}</td>
                                                <td class="text-end fw-bold text-primary">${{ number_format($veh->total, 2) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                        <div class="text-center py-4">
                                            <em class="icon ni ni-truck" style="font-size: 2.5rem; color: #dbdfea;"></em>
                                            <p class="text-soft mt-2">No completed bookings recorded yet.</p>
                                        </div>
                                    @endif
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

@push('scripts')
<script>
// Trend Chart using ApexCharts (bundled with NioBoard)
(function() {
    const labels  = @json($trendLabels);
    const revenue = @json($trendData);
    const counts  = @json($trendCounts);

    var options = {
        series: [{
            name: 'Revenue ($)',
            type: 'area',
            data: revenue,
        }, {
            name: 'Bookings',
            type: 'bar',
            data: counts,
        }],
        chart: {
            height: 280,
            type: 'line',
            toolbar: { show: false },
            fontFamily: "'Nunito Sans', sans-serif",
        },
        colors: ['#6576ff', '#1ee0ac'],
        dataLabels: { enabled: false },
        stroke: { width: [2, 0], curve: 'smooth' },
        fill: {
            type: ['gradient', 'solid'],
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.4,
                opacityTo: 0.05,
                stops: [0, 90, 100]
            }
        },
        xaxis: {
            categories: labels,
            labels: { style: { colors: '#8094ae', fontSize: '11px' } }
        },
        yaxis: [
            {
                title: { text: 'Revenue ($)', style: { color: '#6576ff' } },
                labels: {
                    formatter: v => '$' + v.toLocaleString(),
                    style: { colors: '#8094ae' }
                }
            },
            {
                opposite: true,
                title: { text: 'Bookings', style: { color: '#1ee0ac' } },
                labels: {
                    formatter: v => v,
                    style: { colors: '#8094ae' }
                }
            }
        ],
        tooltip: {
            y: [
                { formatter: v => '$' + v.toFixed(2) },
                { formatter: v => v + ' rides' }
            ]
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left',
            labels: { colors: '#8094ae' }
        },
        grid: {
            borderColor: '#e5e9f2',
            strokeDashArray: 4,
        }
    };

    // Try ApexCharts if available, else fall back to a simple table
    if (typeof ApexCharts !== 'undefined') {
        var chart = new ApexCharts(document.querySelector('#revenueChart'), options);
        chart.render();
    } else {
        // Fallback: simple table
        var html = '<table class="table table-sm"><thead><tr><th>Month</th><th>Revenue</th><th>Rides</th></tr></thead><tbody>';
        labels.forEach((l, i) => {
            html += `<tr><td>${l}</td><td>$${revenue[i].toFixed(2)}</td><td>${counts[i]}</td></tr>`;
        });
        html += '</tbody></table>';
        document.getElementById('revenueChart').innerHTML = html;
    }
})();
</script>
@endpush
