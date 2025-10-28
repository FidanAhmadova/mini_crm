@extends('layouts.app')

@section('content')
<div class="flex items-start gap-6">
    <div class="w-1/3 bg-white rounded-lg shadow p-4 border">
        <h2 class="text-lg font-semibold mb-3 text-primary">New Note</h2>
        <form method="POST" action="/notes" class="space-y-3">
            @csrf
            <div>
                <label class="block text-sm mb-1">Customer</label>
                <select name="customer_id" class="w-full border rounded px-3 py-2">
                    <option value="">—</option>
                    @foreach($customers as $c)
                        <option value="{{ $c->id }}">{{ $c->first_name }} {{ $c->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm mb-1">Deal</label>
                <select name="deal_id" class="w-full border rounded px-3 py-2">
                    <option value="">—</option>
                    @foreach($deals as $d)
                        <option value="{{ $d->id }}">#{{ $d->id }} - {{ $d->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm mb-1">Content</label>
                <textarea name="content" class="w-full border rounded px-3 py-2" required></textarea>
            </div>
            <button class="bg-primary text-white px-4 py-2 rounded">Add</button>
        </form>
    </div>

    <div class="flex-1 bg-white rounded-lg shadow p-4 border">
        <h2 class="text-lg font-semibold mb-3 text-primary">Notes</h2>
        <div class="space-y-3">
            @foreach($notes as $note)
                <div class="border rounded p-3">
                    <div class="text-sm text-slate-500 flex items-center justify-between">
                        <div>
                            #{{ $note->id }} by {{ optional($note->user)->name }}
                            @if($note->customer_id) • Customer: {{ optional($note->customer)->first_name }} {{ optional($note->customer)->last_name }} @endif
                            @if($note->deal_id) • Deal: #{{ $note->deal_id }} @endif
                        </div>
                        <form method="POST" action="/notes/{{ $note->id }}" onsubmit="return confirm('Delete note?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded text-xs">Delete</button>
                        </form>
                    </div>
                    <div class="mt-2">{{ $note->content }}</div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $notes->links() }}</div>
    </div>
</div>
@endsection


