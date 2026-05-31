@extends('adminLayouts.app')

@section('content')
@php
    $statusLabels = ['approved' => 'Approved', 'pending' => 'Pending', 'rejected' => 'Rejected'];
    $statusClasses = ['approved' => 'badge--honorary', 'pending' => 'badge--current', 'rejected' => 'badge--former'];
    $memberPieValues = [
        $memberStatusDistribution['approved'] ?? 0,
        $memberStatusDistribution['pending'] ?? 0,
        $memberStatusDistribution['rejected'] ?? 0,
    ];
@endphp

<div class="mgmt-wrap dashboard-overview">


    <div class="mgmt-header dashboard-header">
        <div>
            <h1 class="mgmt-title">Website Statistics</h1>
            <p class="dashboard-subtitle">Live overview of members, requests, projects, and published posts.</p>
        </div>
        <a href="{{ route('joinRequests.index') }}" class="btn-add">
            <span class="btn-add__icon">+</span> Review Requests
        </a>
    </div>


    <div class="row g-3">
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-card__top">
                        <span class="stat-card__label">Total Members</span>
                        <span class="stat text-primary"><i data-feather="users"></i></span>
                    </div>
                    <h2>{{ number_format($membersCount) }}</h2>
                    <p><span class="text-success">{{ number_format($approvedMembersCount) }}</span> approved members</p>
                </div>
            </div>
        </div>


        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-card__top">
                        <span class="stat-card__label">Join Requests</span>
                        <span class="stat text-primary"><i data-feather="inbox"></i></span>
                    </div>
                    <h2>{{ number_format($joinRequestCount) }}</h2>
                    <p><span class="text-warning">{{ number_format($pendingJoinRequests) }}</span> waiting, <span class="text-danger">{{ number_format($rejectedJoinRequests) }}</span> rejected</p>
                </div>
            </div>
        </div>


        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-card__top">
                        <span class="stat-card__label">Projects</span>
                        <span class="stat text-primary"><i data-feather="briefcase"></i></span>
                    </div>
                    <h2>{{ number_format($projectCount) }}</h2>
                    <p>Projects shown on the website</p>
                </div>
            </div>
        </div>


        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-card__top">
                        <span class="stat-card__label">Posts</span>
                        <span class="stat text-primary"><i data-feather="file-text"></i></span>
                    </div>
                    <h2>{{ number_format($postCount) }}</h2>
                    <p>News and memories published</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-xl-8 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header dashboard-card-header">
                    <div>
                        <h5 class="card-title mb-0">Members Joined This Week</h5>
                        <small class="text-muted">Daily new member registrations</small>
                    </div>
                </div>
                <div class="card-body py-3">
                    <div class="chart chart-sm">
                        <canvas id="chartjs-dashboard-line"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header dashboard-card-header">
                    <div>
                        <h5 class="card-title mb-0">Member Status</h5>
                        <small class="text-muted">Approved, pending, and rejected</small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart chart-xs mb-3">
                        <canvas id="chartjs-dashboard-pie"></canvas>
                    </div>
                    <table class="table mb-0 dashboard-status-table">
                        <tbody>
                            @foreach($statusLabels as $key => $label)
                                <tr>
                                    <td><span class="badge {{ $statusClasses[$key] }}">{{ $label }}</span></td>
                                    <td class="text-end">{{ number_format($memberStatusDistribution[$key] ?? 0) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h6 class="dashboard-mini-title">Join Requests</h6>
                    <table class="table mb-0 dashboard-status-table">
                        <tbody>
                            @foreach($statusLabels as $key => $label)
                                <tr>
                                    <td><span class="badge {{ $statusClasses[$key] }}">{{ $label }}</span></td>
                                    <td class="text-end">{{ number_format($joinRequestStatusDistribution[$key] ?? 0) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="row g-3 mt-1">
        <div class="col-xl-4 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header dashboard-card-header">
                    <div>
                        <h5 class="card-title mb-0">Six-Month Growth</h5>
                        <small class="text-muted">New members per month</small>
                    </div>
                </div>
                <div class="card-body d-flex w-100">
                    <div class="align-self-center chart chart-lg">
                        <canvas id="chartjs-dashboard-bar"></canvas>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-8 d-flex">
            <div class="card flex-fill">
                <div class="card-header dashboard-card-header">
                    <div>
                        <h5 class="card-title mb-0">Latest Members</h5>
                        <small class="text-muted">Recently added to the website</small>
                    </div>
                    <a href="{{ route('members.index') }}" class="btn-row btn-row--edit">View all</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover my-0 dashboard-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th class="text-end">Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentMembers as $member)
                                <tr>
                                    <td>{{ $member->translation?->name ?? 'Unnamed member' }}</td>
                                    <td class="text-muted">{{ $member->email ?? '-' }}</td>
                                    <td><span class="badge {{ $statusClasses[$member->status] ?? 'badge--former' }}">{{ ucfirst($member->status) }}</span></td>
                                    <td class="text-end text-muted">{{ $member->created_at?->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="mgmt-empty">No members yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="row g-3 mt-1">
        <div class="col-xl-7 d-flex">
            <div class="card flex-fill">
                <div class="card-header dashboard-card-header">
                    <div>
                        <h5 class="card-title mb-0">Latest Join Requests</h5>
                        <small class="text-muted">Newest applications from the public form</small>
                    </div>
                    <a href="{{ route('joinRequests.index') }}" class="btn-row btn-row--edit">Manage</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover my-0 dashboard-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Nationality</th>
                                <th>Status</th>
                                <th class="text-end">Submitted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentJoinRequests as $request)
                                <tr>
                                    <td>{{ $request->translation?->name ?? 'Unnamed applicant' }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $request->nationality)) }}</td>
                                    <td><span class="badge {{ $statusClasses[$request->status] ?? 'badge--former' }}">{{ ucfirst($request->status) }}</span></td>
                                    <td class="text-end text-muted">{{ $request->created_at?->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="mgmt-empty">No join requests yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="col-xl-5 d-flex">
            <div class="card flex-fill">
                <div class="card-header dashboard-card-header">
                    <div>
                        <h5 class="card-title mb-0">Latest Projects</h5>
                        <small class="text-muted">Most recently created project pages</small>
                    </div>
                    <a href="{{ route('projects.index') }}" class="btn-row btn-row--edit">View all</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover my-0 dashboard-table">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Status</th>
                                <th class="text-end">Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentProjects as $project)
                                @php
                                    $projectStatusClass = match($project->status) {
                                        'active' => 'badge--current',
                                        'completed' => 'badge--honorary',
                                        default => 'badge--former',
                                    };
                                @endphp
                                <tr>
                                    <td>{{ $project->translation?->title ?? 'Untitled project' }}</td>
                                    <td><span class="badge {{ $projectStatusClass }}">{{ ucfirst(str_replace('_', ' ', $project->status)) }}</span></td>
                                    <td class="text-end text-muted">{{ $project->created_at?->format('M d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="mgmt-empty">No projects yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.dashboardLineData = {
        labels: @json($days->map(fn ($date) => $date->format('D'))->toArray()),
        values: @json($dailyCounts),
        label: 'New members'
    };


    window.dashboardPieData = {
        labels: ['Approved', 'Pending', 'Rejected'],
        values: @json($memberPieValues)
    };


    window.dashboardBarData = {
        labels: @json($months->map(fn ($date) => $date->format('M'))->toArray()),
        values: @json($monthlyMemberCounts)
    };
</script>

<style>
.dashboard-overview .card {
    border: 0;
    box-shadow: 0 10px 30px rgba(var(--color-primary-rgb), 0.06);
}

.dashboard-header {
    align-items: flex-start;
    gap: 16px;
}

.dashboard-subtitle {
    margin: 6px 0 0;
    color: var(--color-muted);
    font-size: 14px;
}

.stat-card {
    height: 100%;
}

.stat-card__top,
.dashboard-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}

.stat-card__label {
    color: var(--color-muted);
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .04em;
}

.stat-card h2 {
    margin: 14px 0 6px;
    color: var(--color-primary);
    font-size: 34px;
    font-weight: 800;
}

.stat-card p {
    margin: 0;
    color: var(--color-muted);
    font-size: 13px;
}

.dashboard-card-header {
    min-height: 72px;
}

.dashboard-mini-title {
    margin: 18px 0 8px;
    color: var(--color-muted);
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: .04em;
}

.dashboard-status-table td,
.dashboard-table td,
.dashboard-table th {
    vertical-align: middle;
}

.dashboard-table th {
    color: var(--color-muted);
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .04em;
}

@media (max-width: 575.98px) {
    .dashboard-header {
        flex-direction: column;
    }


    .dashboard-card-header {
        align-items: flex-start;
        flex-direction: column;
    }
}
</style>
@endsection
