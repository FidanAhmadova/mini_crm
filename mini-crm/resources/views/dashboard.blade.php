@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
        <div class="bg-white rounded-lg shadow-sm p-4 lg:p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-2 lg:p-3 rounded-full bg-blue-100">
                    <i class="fas fa-building text-blue-600 text-lg lg:text-xl"></i>
                </div>
                <div class="ml-3 lg:ml-4">
                    <p class="text-xs lg:text-sm font-medium text-gray-500">Companies</p>
                    <p class="text-xl lg:text-2xl font-semibold text-gray-900">{{ App\Models\Company::count() }}</p>
                </div>
            </div>
            <div class="mt-3 lg:mt-4">
                <span class="text-xs lg:text-sm text-green-600">
                    <i class="fas fa-arrow-up mr-1"></i>12%
                </span>
                <span class="text-xs lg:text-sm text-gray-500 ml-2">vs last month</span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-4 lg:p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-2 lg:p-3 rounded-full bg-green-100">
                    <i class="fas fa-users text-green-600 text-lg lg:text-xl"></i>
                </div>
                <div class="ml-3 lg:ml-4">
                    <p class="text-xs lg:text-sm font-medium text-gray-500">Customers</p>
                    <p class="text-xl lg:text-2xl font-semibold text-gray-900">{{ App\Models\Customer::count() }}</p>
                </div>
            </div>
            <div class="mt-3 lg:mt-4">
                <span class="text-xs lg:text-sm text-green-600">
                    <i class="fas fa-arrow-up mr-1"></i>8%
                </span>
                <span class="text-xs lg:text-sm text-gray-500 ml-2">vs last month</span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-4 lg:p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-2 lg:p-3 rounded-full bg-purple-100">
                    <i class="fas fa-handshake text-purple-600 text-lg lg:text-xl"></i>
                </div>
                <div class="ml-3 lg:ml-4">
                    <p class="text-xs lg:text-sm font-medium text-gray-500">Active Deals</p>
                    <p class="text-xl lg:text-2xl font-semibold text-gray-900">{{ App\Models\Deal::whereIn('status', ['new', 'in_progress'])->count() }}</p>
                </div>
            </div>
            <div class="mt-3 lg:mt-4">
                <span class="text-xs lg:text-sm text-green-600">
                    <i class="fas fa-arrow-up mr-1"></i>15%
                </span>
                <span class="text-xs lg:text-sm text-gray-500 ml-2">vs last month</span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-4 lg:p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-2 lg:p-3 rounded-full bg-orange-100">
                    <i class="fas fa-tasks text-orange-600 text-lg lg:text-xl"></i>
                </div>
                <div class="ml-3 lg:ml-4">
                    <p class="text-xs lg:text-sm font-medium text-gray-500">Pending Tasks</p>
                    <p class="text-xl lg:text-2xl font-semibold text-gray-900">{{ App\Models\Task::where('status', 'pending')->count() }}</p>
                </div>
            </div>
            <div class="mt-3 lg:mt-4">
                <span class="text-xs lg:text-sm text-red-600">
                    <i class="fas fa-arrow-down mr-1"></i>3%
                </span>
                <span class="text-xs lg:text-sm text-gray-500 ml-2">vs last month</span>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Revenue Chart -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Revenue Overview</h3>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-sm bg-primary text-white rounded-md">Monthly</button>
                    <button class="px-3 py-1 text-sm text-gray-500 hover:bg-gray-100 rounded-md">Yearly</button>
                </div>
            </div>
            <div class="relative h-80">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Deal Status Chart -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Deal Status</h3>
                <button class="text-sm text-primary hover:text-secondary">View All</button>
            </div>
            <div class="relative h-80">
                <canvas id="dealStatusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Deals -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Recent Deals</h3>
                <a href="/deals" class="text-sm text-primary hover:text-secondary">View All</a>
            </div>
            <div class="space-y-4">
                @forelse(App\Models\Deal::with('customer')->latest()->take(5)->get() as $deal)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                                <i class="fas fa-handshake text-white"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-medium text-gray-900">{{ $deal->title }}</p>
                                <p class="text-sm text-gray-500">{{ $deal->customer->first_name ?? 'N/A' }} {{ $deal->customer->last_name ?? '' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-900">${{ number_format($deal->amount, 2) }}</p>
                            <span class="px-2 py-1 text-xs rounded-full
                                @if($deal->status === 'won') bg-green-100 text-green-800
                                @elseif($deal->status === 'in_progress') bg-blue-100 text-blue-800
                                @elseif($deal->status === 'new') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $deal->status)) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-handshake text-4xl mb-4"></i>
                        <p>No deals found</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="/companies" class="flex items-center p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                    <i class="fas fa-plus text-blue-600 mr-3"></i>
                    <span class="text-blue-800 font-medium">Add Company</span>
                </a>
                <a href="/customers" class="flex items-center p-3 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                    <i class="fas fa-user-plus text-green-600 mr-3"></i>
                    <span class="text-green-800 font-medium">Add Customer</span>
                </a>
                <a href="/deals" class="flex items-center p-3 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                    <i class="fas fa-handshake text-purple-600 mr-3"></i>
                    <span class="text-purple-800 font-medium">Create Deal</span>
                </a>
                <a href="/tasks" class="flex items-center p-3 bg-orange-50 rounded-lg hover:bg-orange-100 transition-colors">
                    <i class="fas fa-tasks text-orange-600 mr-3"></i>
                    <span class="text-orange-800 font-medium">Add Task</span>
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: @json($revenueLabels ?? []),
            datasets: [{
                label: 'Revenue',
                data: @json($revenueData ?? []),
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#3b82f6',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    borderColor: '#3b82f6',
                    borderWidth: 1
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6b7280'
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    },
                    ticks: {
                        color: '#6b7280',
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });

    // Deal Status Chart
    const dealStatusCtx = document.getElementById('dealStatusChart').getContext('2d');
    new Chart(dealStatusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Won', 'In Progress', 'New', 'Lost'],
            datasets: [{
                data: [
                    {{ ($dealStatusCounts['won'] ?? 0) }},
                    {{ ($dealStatusCounts['in_progress'] ?? 0) }},
                    {{ ($dealStatusCounts['new'] ?? 0) }},
                    {{ ($dealStatusCounts['lost'] ?? 0) }}
                ],
                backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#ef4444'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '60%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((context.parsed / total) * 100).toFixed(1);
                            return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection