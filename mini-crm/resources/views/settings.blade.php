@extends('layouts.app')

@section('title', 'Settings')
@section('page-title', 'Settings')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Application Settings</h3>
        
        <div class="space-y-8">
            <!-- General Settings -->
            <div class="border-b pb-6">
                <h4 class="text-md font-medium text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-cog mr-2 text-primary"></i>General Settings
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Application Name</label>
                        <input type="text" value="Mini CRM" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Application Version</label>
                        <input type="text" value="1.0.0" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Company Logo</label>
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                            <button id="uploadLogoBtn" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition-colors">
                                <i class="fas fa-upload mr-2"></i>Upload Logo
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Theme Color</label>
                        <div class="flex space-x-2">
                            <div class="w-8 h-8 bg-blue-500 rounded cursor-pointer border-2 border-blue-600"></div>
                            <div class="w-8 h-8 bg-green-500 rounded cursor-pointer"></div>
                            <div class="w-8 h-8 bg-purple-500 rounded cursor-pointer"></div>
                            <div class="w-8 h-8 bg-red-500 rounded cursor-pointer"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User & Authentication Settings -->
            <div class="border-b pb-6">
                <h4 class="text-md font-medium text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-user-shield mr-2 text-primary"></i>User & Authentication Settings
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Default User Role</label>
                        <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="user">User</option>
                            <option value="manager">Manager</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Session Timeout (minutes)</label>
                        <input type="number" value="30" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div class="md:col-span-2">
                        <label class="flex items-center">
                            <input type="checkbox" checked class="mr-3">
                            <span class="text-sm text-gray-700">Enable Two-Factor Authentication (2FA)</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Email Settings -->
            <div class="border-b pb-6">
                <h4 class="text-md font-medium text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-envelope mr-2 text-primary"></i>Email Settings (SMTP)
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Host</label>
                        <input type="text" value="smtp.gmail.com" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Port</label>
                        <input type="number" value="587" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Username</label>
                        <input type="text" value="fidanahmadovva@gmail.com" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Password</label>
                        <input type="password" value="••••••••••••••••" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Encryption</label>
                        <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="tls">TLS</option>
                            <option value="ssl">SSL</option>
                            <option value="none">None</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">From Name</label>
                        <input type="text" value="Mini CRM" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Notification Settings -->
            <div class="border-b pb-6">
                <h4 class="text-md font-medium text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-bell mr-2 text-primary"></i>Notification Settings
                </h4>
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h5 class="text-sm font-medium text-gray-700 mb-3">Email Notifications</h5>
                            <div class="space-y-3">
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="mr-3">
                                    <span class="text-sm text-gray-700">New tasks assigned</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="mr-3">
                                    <span class="text-sm text-gray-700">New deals created</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-3">
                                    <span class="text-sm text-gray-700">Daily summary reports</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-3">
                                    <span class="text-sm text-gray-700">Weekly performance reports</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <h5 class="text-sm font-medium text-gray-700 mb-3">SMS Notifications</h5>
                            <div class="space-y-3">
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-3">
                                    <span class="text-sm text-gray-700">Urgent task alerts</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-3">
                                    <span class="text-sm text-gray-700">Deal closure notifications</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Integrations -->
            <div class="border-b pb-6">
                <h4 class="text-md font-medium text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-plug mr-2 text-primary"></i>Integrations
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Google Calendar API Key</label>
                        <input type="text" placeholder="Enter API key" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Slack Webhook URL</label>
                        <input type="text" placeholder="Enter webhook URL" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Zapier API Key</label>
                        <input type="text" placeholder="Enter API key" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Webhook Endpoint</label>
                        <input type="text" placeholder="Enter webhook endpoint" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Customization -->
            <div class="border-b pb-6">
                <h4 class="text-md font-medium text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-palette mr-2 text-primary"></i>Customization
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Custom Fields</label>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <input type="text" placeholder="Field name" class="flex-1 border border-gray-300 rounded-lg px-3 py-2">
                                <select class="border border-gray-300 rounded-lg px-3 py-2">
                                    <option>Text</option>
                                    <option>Number</option>
                                    <option>Date</option>
                                    <option>Dropdown</option>
                                </select>
                                <button id="addCustomFieldBtn" class="bg-green-500 text-white px-3 py-2 rounded-lg hover:bg-green-600">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Dashboard Widgets</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" checked class="mr-3">
                                <span class="text-sm text-gray-700">Sales Chart</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" checked class="mr-3">
                                <span class="text-sm text-gray-700">Task Progress</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-3">
                                <span class="text-sm text-gray-700">Recent Activities</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Backup & Security -->
            <div class="border-b pb-6">
                <h4 class="text-md font-medium text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-shield-alt mr-2 text-primary"></i>Backup & Security
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Auto Backup Frequency</label>
                        <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="disabled">Disabled</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Data Retention (days)</label>
                        <input type="number" value="365" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div class="md:col-span-2">
                        <div class="flex space-x-4">
                            <button id="downloadBackupBtn" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                                <i class="fas fa-download mr-2"></i>Download Backup
                            </button>
                            <button id="restoreBackupBtn" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
                                <i class="fas fa-upload mr-2"></i>Restore Backup
                            </button>
                            <button id="regenerateKeysBtn" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition-colors">
                                <i class="fas fa-key mr-2"></i>Regenerate API Keys
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Buttons -->
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    <i class="fas fa-info-circle mr-1"></i>
                    Changes will take effect after saving
                </div>
                <div class="flex space-x-4">
                    <button id="resetSettingsBtn" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                        <i class="fas fa-undo mr-2"></i>Reset to Default
                    </button>
                    <button id="saveSettingsBtn" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-secondary transition-colors">
                        <i class="fas fa-save mr-2"></i>Save All Settings
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Upload Logo functionality
    const uploadLogoBtn = document.getElementById('uploadLogoBtn');
    if (uploadLogoBtn) {
        uploadLogoBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const logoPreview = document.querySelector('.w-16.h-16.bg-gray-200');
                        if (logoPreview) {
                            logoPreview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-lg">`;
                        }
                        showNotification('Logo uploaded successfully!', 'success');
                    };
                    reader.readAsDataURL(file);
                }
            };
            input.click();
        });
    } else {
        console.log('Upload Logo button not found');
    }

    // Theme Color functionality
    const colorSwatches = document.querySelectorAll('.w-8.h-8.rounded.cursor-pointer');
    colorSwatches.forEach(swatch => {
        swatch.addEventListener('click', function() {
            // Remove border from all swatches
            colorSwatches.forEach(s => s.classList.remove('border-2', 'border-blue-600'));
            // Add border to clicked swatch
            this.classList.add('border-2', 'border-blue-600');
            
            const color = this.classList.contains('bg-blue-500') ? 'blue' :
                         this.classList.contains('bg-green-500') ? 'green' :
                         this.classList.contains('bg-purple-500') ? 'purple' : 'red';
            
            showNotification(`Theme color changed to ${color}!`, 'success');
        });
    });

    // Add Custom Field functionality
    const addFieldBtn = document.getElementById('addCustomFieldBtn');
    if (addFieldBtn) {
        addFieldBtn.addEventListener('click', function() {
            const fieldName = this.parentElement.querySelector('input[placeholder="Field name"]').value;
            const fieldType = this.parentElement.querySelector('select').value;
            
            if (fieldName.trim()) {
                showNotification(`Custom field "${fieldName}" (${fieldType}) added!`, 'success');
                this.parentElement.querySelector('input[placeholder="Field name"]').value = '';
            } else {
                showNotification('Please enter a field name!', 'error');
            }
        });
    }

    // Backup buttons functionality
    const downloadBackupBtn = document.getElementById('downloadBackupBtn');
    if (downloadBackupBtn) {
        downloadBackupBtn.addEventListener('click', function() {
            showNotification('Backup download started...', 'info');
            // Simulate download
            setTimeout(() => {
                showNotification('Backup downloaded successfully!', 'success');
            }, 2000);
        });
    }

    const restoreBackupBtn = document.getElementById('restoreBackupBtn');
    if (restoreBackupBtn) {
        restoreBackupBtn.addEventListener('click', function() {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = '.json,.sql,.zip';
            input.onchange = function(e) {
                const file = e.target.files[0];
                if (file) {
                    showNotification('Backup restored successfully!', 'success');
                }
            };
            input.click();
        });
    }

    const regenerateKeysBtn = document.getElementById('regenerateKeysBtn');
    if (regenerateKeysBtn) {
        regenerateKeysBtn.addEventListener('click', function() {
            if (confirm('Are you sure you want to regenerate all API keys? This will invalidate existing keys.')) {
                showNotification('API keys regenerated successfully!', 'success');
            }
        });
    }

    // Save Settings functionality
    const saveSettingsBtn = document.getElementById('saveSettingsBtn');
    if (saveSettingsBtn) {
        saveSettingsBtn.addEventListener('click', function() {
            showNotification('Settings saved successfully!', 'success');
        });
    }

    // Reset to Default functionality
    const resetBtn = document.getElementById('resetSettingsBtn');
    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            if (confirm('Are you sure you want to reset all settings to default values?')) {
                showNotification('Settings reset to default values!', 'info');
            }
        });
    }

    // Notification function
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm ${
            type === 'success' ? 'bg-green-500 text-white' :
            type === 'error' ? 'bg-red-500 text-white' :
            type === 'info' ? 'bg-blue-500 text-white' : 'bg-gray-500 text-white'
        }`;
        
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${
                    type === 'success' ? 'fa-check-circle' :
                    type === 'error' ? 'fa-exclamation-circle' :
                    type === 'info' ? 'fa-info-circle' : 'fa-bell'
                } mr-2"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            showNotification('Form submitted successfully!', 'success');
        });
    });

    // Checkbox functionality
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const label = this.parentElement.querySelector('span');
            if (label) {
                const status = this.checked ? 'enabled' : 'disabled';
                showNotification(`${label.textContent.trim()} ${status}!`, 'info');
            }
        });
    });

    // Dropdown functionality
    const dropdowns = document.querySelectorAll('select');
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('change', function() {
            const label = this.previousElementSibling;
            if (label && label.tagName === 'LABEL') {
                showNotification(`${label.textContent.trim()} changed to ${this.value}!`, 'info');
            }
        });
    });

    // Input field changes
    const inputs = document.querySelectorAll('input[type="text"], input[type="number"]');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim()) {
                const label = this.previousElementSibling;
                if (label && label.tagName === 'LABEL') {
                    showNotification(`${label.textContent.trim()} updated!`, 'info');
                }
            }
        });
    });
});
</script>
