@extends('layouts.app')

@section('title', 'Welcome')
@section('page-title', 'Welcome')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Hero Section -->
        <div class="text-center mb-16">
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">
                Welcome to <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">Mini CRM</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-600 mb-8 max-w-3xl mx-auto">
                Streamline your business operations with our powerful and intuitive Customer Relationship Management system.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/login" class="bg-gradient-to-r from-primary to-secondary text-white px-8 py-4 rounded-lg font-semibold hover:shadow-lg transition-all transform hover:scale-105 flex items-center justify-center">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Login
                </a>
                <a href="/register" class="bg-white border-2 border-primary text-primary px-8 py-4 rounded-lg font-semibold hover:bg-primary hover:text-white transition-all flex items-center justify-center">
                    <i class="fas fa-user-plus mr-2"></i>
                    Register
                </a>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
            <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-building text-blue-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Company Management</h3>
                <p class="text-gray-600">Organize and track all your business clients and partners in one centralized location.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-green-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Customer Relations</h3>
                <p class="text-gray-600">Build stronger relationships with detailed customer profiles and interaction history.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-handshake text-purple-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Deal Tracking</h3>
                <p class="text-gray-600">Monitor your sales pipeline and close more deals with comprehensive deal management.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-tasks text-orange-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Task Management</h3>
                <p class="text-gray-600">Stay organized with tasks, notes, and follow-ups for each customer interaction.</p>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="bg-white rounded-2xl p-8 shadow-xl mb-16">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">System Overview</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2">{{ App\Models\Company::count() }}</div>
                    <div class="text-gray-600">Companies</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-green-600 mb-2">{{ App\Models\Customer::count() }}</div>
                    <div class="text-gray-600">Customers</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-purple-600 mb-2">{{ App\Models\Deal::count() }}</div>
                    <div class="text-gray-600">Active Deals</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-orange-600 mb-2">{{ App\Models\Task::count() }}</div>
                    <div class="text-gray-600">Tasks</div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Ready to get started?</h2>
            <p class="text-gray-600 mb-8">Join thousands of businesses already using Mini CRM to grow their sales and improve customer relationships.</p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/login" class="bg-gradient-to-r from-primary to-secondary text-white px-8 py-4 rounded-lg font-semibold hover:shadow-lg transition-all transform hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Login to Dashboard
                </a>
                <a href="/register" class="bg-white border-2 border-primary text-primary px-8 py-4 rounded-lg font-semibold hover:bg-primary hover:text-white transition-all">
                    <i class="fas fa-user-plus mr-2"></i>
                    Create Account
                </a>
            </div>
        </div>
    </div>
</div>
@endsection