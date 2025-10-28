<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Mini CRM') }} - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#1e40af',
                        accent: '#06b6d4',
                        success: '#10b981',
                        warning: '#f59e0b',
                        danger: '#ef4444',
                    }
                }
            }
        }
    </script>
    @stack('head')
</head>
<body class="bg-gray-50">
    <!-- Mobile menu button -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button @click="sidebarOpen = !sidebarOpen" class="bg-white p-2 rounded-md shadow-md">
            <i class="fas fa-bars text-gray-600"></i>
        </button>
    </div>

    <!-- Sidebar -->
    <div x-data="{ sidebarOpen: false }" class="flex">
        <!-- Sidebar Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" 
             class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden"></div>
        
        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
             class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
            
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 bg-gradient-to-r from-primary to-secondary">
                <h1 class="text-xl font-bold text-white">
                    <i class="fas fa-chart-line mr-2"></i>Mini CRM
                </h1>
            </div>

            <!-- Navigation -->
            <nav class="mt-8">
                <div class="px-4 space-y-2">
                    <a href="/dashboard" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->is('dashboard') ? 'bg-primary text-white' : '' }}">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    
                    <a href="/companies" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->is('companies*') ? 'bg-primary text-white' : '' }}">
                        <i class="fas fa-building mr-3"></i>
                        Companies
                    </a>
                    
                    <a href="/customers" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->is('customers*') ? 'bg-primary text-white' : '' }}">
                        <i class="fas fa-users mr-3"></i>
                        Customers
                    </a>
                    
                    <a href="/deals" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->is('deals*') ? 'bg-primary text-white' : '' }}">
                        <i class="fas fa-handshake mr-3"></i>
                        Deals
                    </a>
                    
                    <a href="/tasks" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->is('tasks*') ? 'bg-primary text-white' : '' }}">
                        <i class="fas fa-tasks mr-3"></i>
                        Tasks
                    </a>
                    
                    <a href="/notes" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->is('notes*') ? 'bg-primary text-white' : '' }}">
                        <i class="fas fa-sticky-note mr-3"></i>
                        Notes
                    </a>
                </div>

                <!-- User Section -->
                <div class="absolute bottom-0 w-full p-4 border-t">
                    @auth
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            <p class="text-xs text-primary font-medium capitalize">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                    @else
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-gray-400 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-700">Guest</p>
                            <p class="text-xs text-gray-500">Not logged in</p>
                        </div>
                    </div>
                    @endauth
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen lg:ml-0">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <div class="flex items-center">
                            <h2 class="text-xl font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h2>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <!-- User Menu -->
                            <div class="relative" x-data="{ open: false }">
                                @auth
                                <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                                    <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white text-sm"></i>
                                    </div>
                                    <div class="hidden md:block text-left">
                                        <div class="text-sm font-medium">{{ Auth::user()->name }}</div>
                                        <div class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</div>
                                    </div>
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </button>
                                @else
                                <a href="/login" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                                    <div class="w-8 h-8 bg-gray-400 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white text-sm"></i>
                                    </div>
                                    <span class="hidden md:block">Login</span>
                                </a>
                                @endauth
                                
                                @auth
                                <div x-show="open" @click.away="open = false" 
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                    <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-user mr-2"></i>Profile
                                    </a>
                                    <a href="/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-cog mr-2"></i>Settings
                                    </a>
                                    <hr class="my-1">
                                    <button @click="logout()" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                <!-- Status Messages -->
                @if (session('status'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex">
                            <i class="fas fa-check-circle text-green-400 mt-0.5 mr-3"></i>
                            <p class="text-green-800">{{ session('status') }}</p>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex">
                            <i class="fas fa-exclamation-circle text-red-400 mt-0.5 mr-3"></i>
                            <p class="text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="text-sm text-gray-500">
                            © {{ date('Y') }} Mini CRM. All rights reserved.
                        </div>
                        <div class="flex space-x-4 mt-2 md:mt-0">
                            <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Privacy</a>
                            <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Terms</a>
                            <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Support</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center h-full">
            <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-primary"></div>
                <span class="text-gray-700">Loading...</span>
            </div>
        </div>
    </div>

    <script>
        // Global AJAX helper
        function showLoading() {
            document.getElementById('loading-overlay').classList.remove('hidden');
        }
        
        function hideLoading() {
            document.getElementById('loading-overlay').classList.add('hidden');
        }
        
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-${type === 'success' ? 'check' : 'exclamation'} mr-2"></i>
                    ${message}
                </div>
            `;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // AJAX Form Helper
        function submitFormAjax(form, successCallback = null) {
            const formData = new FormData(form);
            const url = form.action;
            const method = form.method || 'POST';
            
            showLoading();
            
            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                if (data.success) {
                    showNotification(data.message || 'Operation completed successfully');
                    if (successCallback) successCallback(data);
                } else {
                    showNotification(data.message || 'Operation failed', 'error');
                }
            })
            .catch(error => {
                hideLoading();
                showNotification('An error occurred', 'error');
                console.error('Error:', error);
            });
        }

        // AJAX Delete Helper
        function deleteItemAjax(url, itemName = 'item') {
            if (confirm(`Are you sure you want to delete this ${itemName}?`)) {
                showLoading();
                
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    hideLoading();
                    if (data.success) {
                        showNotification(data.message || `${itemName} deleted successfully`);
                        // Reload page or update table
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        showNotification(data.message || 'Delete failed', 'error');
                    }
                })
                .catch(error => {
                    hideLoading();
                    showNotification('An error occurred', 'error');
                    console.error('Error:', error);
                });
            }
        }

        // Real-time search
        function setupSearch(inputSelector, tableSelector) {
            const searchInput = document.querySelector(inputSelector);
            const table = document.querySelector(tableSelector);
            
            if (searchInput && table) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const rows = table.querySelectorAll('tbody tr');
                    
                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        }

        // Logout Function
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                // Create a form and submit it to logout
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/logout';
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                form.appendChild(csrfToken);
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Page loaded, search should work with Alpine.js');
        });
    </script>
    
    @stack('scripts')
</body>
</html>