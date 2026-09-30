<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VisitController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'path' => ['required', 'string', 'max:255'],
            'referrer' => ['nullable', 'string', 'max:255'],
        ]);

        Visit::query()->create([
            'path' => $validated['path'],
            'referrer' => $validated['referrer'] ?? null,
            'ip' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 255),
        ]);

        return response()->json(null, 201);
    }

    public function stats(): JsonResponse
    {
        $now = Carbon::now();

        $daily = Visit::query()
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total, COUNT(DISTINCT ip) as unique_visitors')
            ->where('created_at', '>=', $now->copy()->subDays(13)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(fn ($row) => [
                'date' => $row->date,
                'total' => (int) $row->total,
                'uniqueVisitors' => (int) $row->unique_visitors,
            ]);

        return response()->json([
            'total' => Visit::query()->count(),
            'today' => Visit::query()->whereDate('created_at', $now->toDateString())->count(),
            'last7Days' => Visit::query()->where('created_at', '>=', $now->copy()->subDays(7))->count(),
            'last30Days' => Visit::query()->where('created_at', '>=', $now->copy()->subDays(30))->count(),
            'uniqueVisitorsTotal' => Visit::query()->distinct('ip')->count('ip'),
            'daily' => $daily,
        ]);
    }
}
