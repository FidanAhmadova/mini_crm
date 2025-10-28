@extends('layouts.app')

@section('content')
<div class="flex items-start gap-6">
    <div class="w-1/3 bg-white rounded-lg shadow p-4 border">
        <h2 class="text-lg font-semibold mb-3 text-primary">New Customer</h2>
        <form method="POST" action="/customers" class="space-y-3">
            @csrf
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm mb-1">First name</label>
                    <input name="first_name" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm mb-1">Last name</label>
                    <input name="last_name" class="w-full border rounded px-3 py-2" required>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm mb-1">Email</label>
                    <input name="email" class="w-full border rounded px-3 py-2" type="email">
                </div>
                <div>
                    <label class="block text-sm mb-1">Phone</label>
                    <input name="phone" class="w-full border rounded px-3 py-2">
                </div>
            </div>
            <div>
                <label class="block text-sm mb-1">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2" required>
                    <option value="lead">Lead</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div>
                <label class="block text-sm mb-1">Company</label>
                <select name="company_id" class="w-full border rounded px-3 py-2">
                    <option value="">—</option>
                    @foreach($companies as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <button class="bg-primary text-white px-4 py-2 rounded">Create</button>
        </form>
    </div>

    <div class="flex-1 bg-white rounded-lg shadow p-4 border">
        <h2 class="text-lg font-semibold mb-3 text-primary">Customers</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-slate-100 text-slate-700">
                        <th class="p-2 text-left">ID</th>
                        <th class="p-2 text-left">Name</th>
                        <th class="p-2 text-left">Email</th>
                        <th class="p-2 text-left">Phone</th>
                        <th class="p-2 text-left">Status</th>
                        <th class="p-2 text-left">Company</th>
                        <th class="p-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($customers as $customer)
                    <tr class="border-b">
                        <td class="p-2">{{ $customer->id }}</td>
                        <td class="p-2">
                            <form method="POST" action="/customers/{{ $customer->id }}" class="flex items-center gap-2">
                                @csrf
                                <input name="first_name" value="{{ $customer->first_name }}" class="border rounded px-2 py-1 w-36">
                                <input name="last_name" value="{{ $customer->last_name }}" class="border rounded px-2 py-1 w-36">
                                <input name="email" value="{{ $customer->email }}" class="border rounded px-2 py-1 w-48">
                                <input name="phone" value="{{ $customer->phone }}" class="border rounded px-2 py-1 w-36">
                                <select name="status" class="border rounded px-2 py-1">
                                    @foreach(['lead','active','inactive'] as $s)
                                        <option value="{{ $s }}" @selected($customer->status===$s)>{{ ucfirst($s) }}</option>
                                    @endforeach
                                </select>
                                <select name="company_id" class="border rounded px-2 py-1">
                                    <option value="">—</option>
                                    @foreach($companies as $c)
                                        <option value="{{ $c->id }}" @selected($customer->company_id===$c->id)>{{ $c->name }}</option>
                                    @endforeach
                                </select>
                                <button class="px-3 py-1 bg-secondary text-white rounded">Save</button>
                            </form>
                        </td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2">
                            <form method="POST" action="/customers/{{ $customer->id }}" onsubmit="return confirm('Delete customer?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $customers->links() }}</div>
    </div>
</div>
@endsection


