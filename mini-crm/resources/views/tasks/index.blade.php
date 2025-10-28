@extends('layouts.app')

@section('content')
<div class="flex items-start gap-6">
    <div class="w-1/3 bg-white rounded-lg shadow p-4 border">
        <h2 class="text-lg font-semibold mb-3 text-primary">New Task</h2>
        <form method="POST" action="/tasks" class="space-y-3">
            @csrf
            <div>
                <label class="block text-sm mb-1">Title</label>
                <input name="title" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm mb-1">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm mb-1">Due date</label>
                    <input name="due_date" type="date" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm mb-1">Status</label>
                    <select name="status" class="w-full border rounded px-3 py-2" required>
                        <option value="pending">Pending</option>
                        <option value="done">Done</option>
                    </select>
                </div>
            </div>
            <button class="bg-primary text-white px-4 py-2 rounded">Create</button>
        </form>
    </div>

    <div class="flex-1 bg-white rounded-lg shadow p-4 border">
        <h2 class="text-lg font-semibold mb-3 text-primary">Tasks</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-slate-100 text-slate-700">
                        <th class="p-2 text-left">ID</th>
                        <th class="p-2 text-left">Title</th>
                        <th class="p-2 text-left">Due</th>
                        <th class="p-2 text-left">Status</th>
                        <th class="p-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($tasks as $task)
                    <tr class="border-b">
                        <td class="p-2">{{ $task->id }}</td>
                        <td class="p-2">
                            <form method="POST" action="/tasks/{{ $task->id }}" class="flex items-center gap-2">
                                @csrf
                                <input name="title" value="{{ $task->title }}" class="border rounded px-2 py-1 w-64">
                                <input name="description" value="{{ $task->description }}" class="border rounded px-2 py-1 w-64">
                                <input name="due_date" type="date" value="{{ $task->due_date }}" class="border rounded px-2 py-1">
                                <select name="status" class="border rounded px-2 py-1">
                                    <option value="pending" @selected($task->status==='pending')>Pending</option>
                                    <option value="done" @selected($task->status==='done')>Done</option>
                                </select>
                                <button class="px-3 py-1 bg-secondary text-white rounded">Save</button>
                            </form>
                        </td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2">
                            <form method="POST" action="/tasks/{{ $task->id }}" onsubmit="return confirm('Delete task?')">
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
        <div class="mt-4">{{ $tasks->links() }}</div>
    </div>
</div>
@endsection


