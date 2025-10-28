@extends('layouts.app')

@section('content')
<div class="flex items-start gap-6">
    <div class="w-1/3 bg-white rounded-lg shadow p-4 border">
        <h2 class="text-lg font-semibold mb-3 text-primary">New Company</h2>
        <form method="POST" action="/companies" class="space-y-3">
            @csrf
            <div>
                <label class="block text-sm mb-1">Name</label>
                <input name="name" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm mb-1">Number</label>
                <input name="number" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm mb-1">Website</label>
                <input name="website" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm mb-1">Address</label>
                <textarea name="address" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <button class="bg-primary text-white px-4 py-2 rounded">Create</button>
        </form>
    </div>

    <div class="flex-1 bg-white rounded-lg shadow p-4 border">
        <h2 class="text-lg font-semibold mb-3 text-primary">Companies</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-slate-100 text-slate-700">
                        <th class="p-2 text-left">ID</th>
                        <th class="p-2 text-left">Name</th>
                        <th class="p-2 text-left">Number</th>
                        <th class="p-2 text-left">Website</th>
                        <th class="p-2 text-left">Address</th>
                        <th class="p-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($companies as $company)
                    <tr class="border-b">
                        <td class="p-2">{{ $company->id }}</td>
                        <td class="p-2">
                            <form method="POST" action="/companies/{{ $company->id }}" class="flex items-center gap-2">
                                @csrf
                                <input name="name" value="{{ $company->name }}" class="border rounded px-2 py-1 w-40">
                                <input name="number" value="{{ $company->number }}" class="border rounded px-2 py-1 w-32">
                                <input name="website" value="{{ $company->website }}" class="border rounded px-2 py-1 w-40">
                                <input name="address" value="{{ $company->address }}" class="border rounded px-2 py-1 w-56">
                                <button class="px-3 py-1 bg-secondary text-white rounded">Save</button>
                            </form>
                        </td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2">
                            <form method="POST" action="/companies/{{ $company->id }}" onsubmit="return confirm('Delete company?')">
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
        <div class="mt-4">{{ $companies->links() }}</div>
    </div>
</div>
@endsection


