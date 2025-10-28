@extends('layouts.app')

@section('content')
<div class="flex items-start gap-6">
    <div class="w-1/3 bg-white rounded-lg shadow p-4 border">
        <h2 class="text-lg font-semibold mb-3 text-primary">New Deal</h2>
        <form method="POST" action="/deals" class="space-y-3">
            @csrf
            <div>
                <label class="block text-sm mb-1">Customer</label>
                <select name="customer_id" class="w-full border rounded px-3 py-2" required>
                    @foreach($customers as $c)
                        <option value="{{ $c->id }}">{{ $c->first_name }} {{ $c->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm mb-1">Title</label>
                <input name="title" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm mb-1">Amount</label>
                    <input name="amount" type="number" step="0.01" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm mb-1">Status</label>
                    <select name="status" class="w-full border rounded px-3 py-2" required>
                        @foreach(['new','in_progress','won','lost'] as $s)
                            <option value="{{ $s }}">{{ ucfirst(str_replace('_',' ', $s)) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button class="bg-primary text-white px-4 py-2 rounded">Create</button>
        </form>
    </div>

    <div class="flex-1 bg-white rounded-lg shadow p-4 border">
        <h2 class="text-lg font-semibold mb-3 text-primary">Deals</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-slate-100 text-slate-700">
                        <th class="p-2 text-left">ID</th>
                        <th class="p-2 text-left">Customer</th>
                        <th class="p-2 text-left">Title</th>
                        <th class="p-2 text-left">Amount</th>
                        <th class="p-2 text-left">Status</th>
                        <th class="p-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($deals as $deal)
                    <tr class="border-b">
                        <td class="p-2">{{ $deal->id }}</td>
                        <td class="p-2">{{ optional($deal->customer)->first_name }} {{ optional($deal->customer)->last_name }}</td>
                        <td class="p-2">
                            <form method="POST" action="/deals/{{ $deal->id }}" class="flex items-center gap-2">
                                @csrf
                                <select name="customer_id" class="border rounded px-2 py-1">
                                    @foreach($customers as $c)
                                        <option value="{{ $c->id }}" @selected($deal->customer_id===$c->id)>{{ $c->first_name }} {{ $c->last_name }}</option>
                                    @endforeach
                                </select>
                                <input name="title" value="{{ $deal->title }}" class="border rounded px-2 py-1 w-48">
                                <input name="amount" value="{{ $deal->amount }}" class="border rounded px-2 py-1 w-28" type="number" step="0.01">
                                <select name="status" class="border rounded px-2 py-1">
                                    @foreach(['new','in_progress','won','lost'] as $s)
                                        <option value="{{ $s }}" @selected($deal->status===$s)>{{ ucfirst(str_replace('_',' ', $s)) }}</option>
                                    @endforeach
                                </select>
                                <button class="px-3 py-1 bg-secondary text-white rounded">Save</button>
                            </form>
                        </td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2">
                            <form method="POST" action="/deals/{{ $deal->id }}" onsubmit="return confirm('Delete deal?')">
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
        <div class="mt-4">{{ $deals->links() }}</div>
    </div>
</div>
@endsection


