<?php

namespace App\Http\Controllers;

use App\Models\SurveyLink;
use App\Models\SurveyResponse;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $stats = [
            'total_links' => SurveyLink::count(),
            'total_responses' => SurveyResponse::count(),
            'active_links' => SurveyLink::where('is_active', true)->count(),
        ];

        $recentLinks = SurveyLink::with('room')
            ->withCount('responses')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'recentLinks' => $recentLinks,
        ]);
    }
}
