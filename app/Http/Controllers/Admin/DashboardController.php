<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JoinRequest;
use App\Models\Member;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $membersCount = Member::count();
        $approvedMembersCount = Member::where('status', 'approved')->count();
        $projectCount = Project::count();
        $postCount = Post::count();
        $joinRequestCount = JoinRequest::count();
        $pendingJoinRequests = JoinRequest::where('status', 'pending')->count();
        $rejectedJoinRequests = JoinRequest::where('status', 'rejected')->count();

        $memberStatusDistribution = Member::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $joinRequestStatusDistribution = JoinRequest::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $recentProjects = Project::with('translation')
            ->latest()
            ->take(8)
            ->get();

        $recentMembers = Member::with('translation')
            ->latest()
            ->take(6)
            ->get();

        $recentJoinRequests = JoinRequest::with('translation')
            ->latest()
            ->take(6)
            ->get();

        $days = collect();
        $today = Carbon::today();
        for ($i = 6; $i >= 0; $i--) {
            $days->push($today->copy()->subDays($i));
        }

        $recentMemberDates = Member::where('created_at', '>=', $today->copy()->subDays(6))
            ->get(['created_at'])
            ->groupBy(fn($member) => $member->created_at->toDateString())
            ->map->count()
            ->toArray();

        $dailyCounts = $days->map(fn($date) => $recentMemberDates[$date->toDateString()] ?? 0)->toArray();

        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $months->push($today->copy()->startOfMonth()->subMonths($i));
        }

        $recentMemberMonths = Member::where('created_at', '>=', $today->copy()->startOfMonth()->subMonths(5))
            ->get(['created_at'])
            ->groupBy(fn($member) => $member->created_at->format('Y-m'))
            ->map->count()
            ->toArray();

        $monthlyMemberCounts = $months
            ->map(fn($date) => $recentMemberMonths[$date->format('Y-m')] ?? 0)
            ->toArray();

        return view('dashboard.index', compact(
            'membersCount',
            'approvedMembersCount',
            'projectCount',
            'postCount',
            'joinRequestCount',
            'pendingJoinRequests',
            'rejectedJoinRequests',
            'memberStatusDistribution',
            'joinRequestStatusDistribution',
            'recentProjects',
            'recentMembers',
            'recentJoinRequests',
            'days',
            'dailyCounts',
            'months',
            'monthlyMemberCounts'
        ));
    }
}
