@extends('layouts.app')

@section('title', 'Notes')
@section('page-title', 'Notes Management')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Notes</h1>
            <p class="text-gray-600 mt-1">Manage your notes and comments</p>
        </div>
        <a href="/notes?action=create" class="mt-4 sm:mt-0 bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition-colors flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Add Note
        </a>
    </div>

    <!-- Create Form -->
    @if(request('action') == 'create')
    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Add New Note</h3>
        <form method="POST" action="/notes" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Author *</label>
                <select name="user_id" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="">Select Author</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role }})</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Customer</label>
                    <select name="customer_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deal</label>
                    <select name="deal_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Select Deal</option>
                        @foreach($deals as $deal)
                            <option value="{{ $deal->id }}">#{{ $deal->id }} - {{ $deal->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Note Content *</label>
                <textarea name="content" rows="4" required
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent"
                          placeholder="Write your note here..."></textarea>
            </div>
            <div class="flex space-x-3">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-secondary transition-colors">
                    Add Note
                </button>
                <a href="/notes" class="border border-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100">
                    <i class="fas fa-sticky-note text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Notes</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $notes->total() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100">
                    <i class="fas fa-users text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Customer Notes</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ App\Models\Note::whereNotNull('customer_id')->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100">
                    <i class="fas fa-handshake text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Deal Notes</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ App\Models\Note::whereNotNull('deal_id')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Notes List -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">All Notes ({{ $notes->total() }})</h3>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" id="notesSearch" placeholder="Search notes..." 
                               class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <a href="?action=create" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition-colors">
                        <i class="fas fa-plus mr-2"></i>Add Note
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6 space-y-4">
            @forelse ($notes as $note)
                <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                            <span class="font-medium">#{{ $note->id }}</span>
                            <span>•</span>
                            <span>By {{ $note->user->name ?? 'Unknown' }}</span>
                            @if($note->customer)
                                <span>•</span>
                                <span>Customer: {{ $note->customer->first_name }} {{ $note->customer->last_name }}</span>
                            @endif
                            @if($note->deal)
                                <span>•</span>
                                <span>Deal: #{{ $note->deal->id }}</span>
                            @endif
                        </div>
                        <div class="flex items-center space-x-2">
                            <button onclick="editNote({{ $note->id }}, '{{ $note->content }}', {{ $note->user_id }}, {{ $note->customer_id ?? 'null' }}, {{ $note->deal_id ?? 'null' }})" class="text-primary hover:text-secondary text-sm">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form method="POST" action="/notes/{{ $note->id }}" class="inline" onsubmit="return confirm('Delete this note?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="text-gray-800 whitespace-pre-wrap">{{ $note->content }}</div>
                    <div class="mt-2 text-xs text-gray-400">
                        {{ $note->created_at->format('M d, Y \a\t g:i A') }}
                    </div>
                </div>
            @empty
                <div class="text-center py-12 text-gray-500">
                    <i class="fas fa-sticky-note text-4xl mb-4"></i>
                    <p>No notes found. Create your first note!</p>
                </div>
            @endforelse
        </div>

        @if($notes->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $notes->links() }}
            </div>
        @endif
    </div>

    <!-- Edit Form -->
    @if(request('edit') && App\Models\Note::find(request('edit')))
        @php $note = App\Models\Note::find(request('edit')); @endphp
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Edit Note</h3>
            <form method="POST" action="/notes/{{ $note->id }}" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Author *</label>
                    <select name="user_id" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Select Author</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $note->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->role }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Customer</label>
                        <select name="customer_id"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $note->customer_id == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->first_name }} {{ $customer->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deal</label>
                        <select name="deal_id"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">Select Deal</option>
                            @foreach($deals as $deal)
                                <option value="{{ $deal->id }}" {{ $note->deal_id == $deal->id ? 'selected' : '' }}>
                                    #{{ $deal->id }} - {{ $deal->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Note Content *</label>
                    <textarea name="content" rows="4" required
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">{{ $note->content }}</textarea>
                </div>
                <div class="flex space-x-3">
                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-secondary transition-colors">
                        Update Note
                    </button>
                    <a href="/notes" class="border border-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('notesSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.border.rounded-lg.p-4');
            
            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    }
});

// Edit note function
function editNote(id, content, userId, customerId, dealId) {
    // Create modal
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
    modal.innerHTML = `
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Edit Note</h3>
            <form method="POST" action="/notes/${id}" class="space-y-4">
                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                <input type="hidden" name="_method" value="PUT">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">User *</label>
                    <select name="user_id" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                        ${getUserOptions(userId)}
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Customer</label>
                        <select name="customer_id"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">Select Customer</option>
                            ${getCustomerOptions(customerId)}
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deal</label>
                        <select name="deal_id"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">Select Deal</option>
                            ${getDealOptions(dealId)}
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Note Content *</label>
                    <textarea name="content" rows="4" required
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">${content}</textarea>
                </div>
                <div class="flex space-x-3">
                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-secondary transition-colors">
                        Update Note
                    </button>
                    <button type="button" onclick="closeModal()" class="border border-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    `;
    
    document.body.appendChild(modal);
}

// Get user options for select
function getUserOptions(selectedId) {
    const users = @json($users);
    let options = '';
    users.forEach(user => {
        const selected = user.id == selectedId ? 'selected' : '';
        options += `<option value="${user.id}" ${selected}>${user.name}</option>`;
    });
    return options;
}

// Get customer options for select
function getCustomerOptions(selectedId) {
    const customers = @json($customers);
    let options = '';
    customers.forEach(customer => {
        const selected = customer.id == selectedId ? 'selected' : '';
        options += `<option value="${customer.id}" ${selected}>${customer.first_name} ${customer.last_name}</option>`;
    });
    return options;
}

// Get deal options for select
function getDealOptions(selectedId) {
    const deals = @json($deals);
    let options = '';
    deals.forEach(deal => {
        const selected = deal.id == selectedId ? 'selected' : '';
        options += `<option value="${deal.id}" ${selected}>#${deal.id} - ${deal.title}</option>`;
    });
    return options;
}

// Close modal function
function closeModal() {
    const modal = document.querySelector('.fixed.inset-0');
    if (modal) {
        modal.remove();
    }
}

// Close modal on outside click
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('fixed') && e.target.classList.contains('inset-0')) {
        closeModal();
    }
});
</script>
@endpush
@endsection
