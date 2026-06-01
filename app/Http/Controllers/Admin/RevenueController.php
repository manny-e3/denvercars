<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RideBooking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RevenueController extends Controller
{
    public function index(Request $request)
    {
        // ── Date range filter ────────────────────────────────────────────────────
        $dateFrom = $request->filled('date_from')
            ? Carbon::parse($request->date_from)->startOfDay()
            : null;
        $dateTo = $request->filled('date_to')
            ? Carbon::parse($request->date_to)->endOfDay()
            : null;

        // ── KPI Totals ───────────────────────────────────────────────────────────
        $today = DB::table('ride_bookings')
            ->where('status', 'completed')
            ->whereDate('date', today())
            ->sum('total_fare');

        $thisWeek = DB::table('ride_bookings')
            ->where('status', 'completed')
            ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('total_fare');

        $thisMonth = DB::table('ride_bookings')
            ->where('status', 'completed')
            ->whereYear('date', now()->year)
            ->whereMonth('date', now()->month)
            ->sum('total_fare');

        $thisYear = DB::table('ride_bookings')
            ->where('status', 'completed')
            ->whereYear('date', now()->year)
            ->sum('total_fare');

        // ── Booking counts ───────────────────────────────────────────────────────
        $totalBookings     = DB::table('ride_bookings')->where('status', 'completed')->count();
        $todayBookings     = DB::table('ride_bookings')->where('status', 'completed')->whereDate('date', today())->count();
        $pendingBookings   = DB::table('ride_bookings')->where('status', 'pending')->count();
        $cancelledBookings = DB::table('ride_bookings')->where('status', 'cancelled')->count();

        // ── Revenue by vehicle class (this month) ────────────────────────────────
        $byClass = DB::table('ride_bookings')
            ->join('vehicles', 'ride_bookings.vehicle_id', '=', 'vehicles.id')
            ->where('ride_bookings.status', 'completed')
            ->whereYear('ride_bookings.date', now()->year)
            ->whereMonth('ride_bookings.date', now()->month)
            ->groupBy('vehicles.class')
            ->select(
                'vehicles.class',
                DB::raw('SUM(ride_bookings.total_fare) as total'),
                DB::raw('COUNT(ride_bookings.id) as bookings')
            )
            ->orderByDesc('total')
            ->get();

        // ── Revenue by service type (this month) ─────────────────────────────────
        $byService = DB::table('ride_bookings')
            ->where('status', 'completed')
            ->whereYear('date', now()->year)
            ->whereMonth('date', now()->month)
            ->groupBy('service_type')
            ->select(
                'service_type',
                DB::raw('SUM(total_fare) as total'),
                DB::raw('COUNT(id) as bookings')
            )
            ->get();

        // ── 12-month trend ───────────────────────────────────────────────────────
        $monthlyTrend = DB::table('ride_bookings')
            ->where('status', 'completed')
            ->where('date', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('year', 'month')
            ->select(
                DB::raw('YEAR(date) as year'),
                DB::raw('MONTH(date) as month'),
                DB::raw('SUM(total_fare) as total'),
                DB::raw('COUNT(id) as bookings')
            )
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Build full 12-month array (fill gaps with 0)
        $trendLabels = [];
        $trendData   = [];
        $trendCounts = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $label = $month->format('M Y');
            $trendLabels[] = $label;

            $found = $monthlyTrend->first(function ($row) use ($month) {
                return (int)$row->year === (int)$month->format('Y')
                    && (int)$row->month === (int)$month->format('n');
            });

            $trendData[]   = $found ? round((float)$found->total, 2) : 0;
            $trendCounts[] = $found ? (int)$found->bookings : 0;
        }

        // ── Top 5 vehicles by revenue ─────────────────────────────────────────────
        $topVehicles = DB::table('ride_bookings')
            ->join('vehicles', 'ride_bookings.vehicle_id', '=', 'vehicles.id')
            ->where('ride_bookings.status', 'completed')
            ->whereYear('ride_bookings.date', now()->year)
            ->groupBy('vehicles.id', 'vehicles.name', 'vehicles.class')
            ->select(
                'vehicles.id',
                'vehicles.name',
                'vehicles.class',
                DB::raw('SUM(ride_bookings.total_fare) as total'),
                DB::raw('COUNT(ride_bookings.id) as bookings')
            )
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // ── Custom date range totals ──────────────────────────────────────────────
        $customTotal    = null;
        $customBookings = null;

        if ($dateFrom && $dateTo) {
            $customTotal = DB::table('ride_bookings')
                ->where('status', 'completed')
                ->whereBetween('date', [$dateFrom->toDateString(), $dateTo->toDateString()])
                ->sum('total_fare');

            $customBookings = DB::table('ride_bookings')
                ->where('status', 'completed')
                ->whereBetween('date', [$dateFrom->toDateString(), $dateTo->toDateString()])
                ->count();
        }

        return view('admin.reports.revenue', compact(
            'today', 'thisWeek', 'thisMonth', 'thisYear',
            'totalBookings', 'todayBookings', 'pendingBookings', 'cancelledBookings',
            'byClass', 'byService',
            'trendLabels', 'trendData', 'trendCounts',
            'topVehicles',
            'customTotal', 'customBookings', 'dateFrom', 'dateTo'
        ));
    }
}
