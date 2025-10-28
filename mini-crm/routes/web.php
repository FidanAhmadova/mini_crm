<?php

use App\Http\Controllers\ProfileController;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Deal;
use App\Models\Task;
use App\Models\Note;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Companies
    Route::get('/companies', function () {
        $companies = Company::orderByDesc('id')->paginate(10);
        return view('companies.index', compact('companies'));
    });
    Route::post('/companies', function () {
        request()->validate([
            'name' => 'required',
            'number' => 'nullable',
            'website' => 'nullable',
            'address' => 'nullable',
        ]);
        Company::create(request(['name','number','website','address']));
        return back()->with('status','Company created');
    });
    Route::post('/companies/{id}', function ($id) {
        $company = Company::findOrFail($id);
        request()->validate([
            'name' => 'required',
            'number' => 'nullable',
            'website' => 'nullable',
            'address' => 'nullable',
        ]);
        $company->update(request(['name','number','website','address']));
        return back()->with('status','Company updated');
    });
    Route::delete('/companies/{id}', function ($id) {
        Company::whereKey($id)->delete();
        return back()->with('status','Company deleted');
    });

    // Customers
    Route::get('/customers', function () {
        $customers = Customer::with('company')->orderByDesc('id')->paginate(10);
        $companies = Company::orderBy('name')->get();
        return view('customers.index', compact('customers','companies'));
    });
    Route::post('/customers', function () {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'status' => 'required|in:lead,active,inactive',
            'company_id' => 'nullable|exists:companies,id',
        ]);
        Customer::create(request(['first_name','last_name','email','phone','status','company_id']));
        return back()->with('status','Customer created');
    });
    Route::post('/customers/{id}', function ($id) {
        $customer = Customer::findOrFail($id);
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'status' => 'required|in:lead,active,inactive',
            'company_id' => 'nullable|exists:companies,id',
        ]);
        $customer->update(request(['first_name','last_name','email','phone','status','company_id']));
        return back()->with('status','Customer updated');
    });
    Route::delete('/customers/{id}', function ($id) {
        Customer::whereKey($id)->delete();
        return back()->with('status','Customer deleted');
    });

    // Deals
    Route::get('/deals', function () {
        $deals = Deal::with('customer')->orderByDesc('id')->paginate(10);
        $customers = Customer::orderBy('first_name')->get();
        return view('deals.index', compact('deals','customers'));
    });
    Route::post('/deals', function () {
        request()->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required',
            'amount' => 'required|numeric',
            'status' => 'required|in:new,in_progress,won,lost',
        ]);
        Deal::create(request(['customer_id','title','amount','status']));
        return back()->with('status','Deal created');
    });
    Route::post('/deals/{id}', function ($id) {
        $deal = Deal::findOrFail($id);
        request()->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required',
            'amount' => 'required|numeric',
            'status' => 'required|in:new,in_progress,won,lost',
        ]);
        $deal->update(request(['customer_id','title','amount','status']));
        return back()->with('status','Deal updated');
    });
    Route::delete('/deals/{id}', function ($id) {
        Deal::whereKey($id)->delete();
        return back()->with('status','Deal deleted');
    });

    // Tasks
    Route::get('/tasks', function () {
        $tasks = Task::orderByDesc('id')->paginate(10);
        return view('tasks.index', compact('tasks'));
    });
    Route::post('/tasks', function () {
        request()->validate([
            'title' => 'required',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,done',
        ]);
        Task::create(request(['title','description','due_date','status']));
        return back()->with('status','Task created');
    });
    Route::post('/tasks/{id}', function ($id) {
        $task = Task::findOrFail($id);
        request()->validate([
            'title' => 'required',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,done',
        ]);
        $task->update(request(['title','description','due_date','status']));
        return back()->with('status','Task updated');
    });
    Route::delete('/tasks/{id}', function ($id) {
        Task::whereKey($id)->delete();
        return back()->with('status','Task deleted');
    });

    // Notes
    Route::get('/notes', function () {
        $notes = Note::with(['user','customer','deal'])->orderByDesc('id')->paginate(10);
        $customers = Customer::orderBy('first_name')->get();
        $deals = Deal::orderByDesc('id')->get();
        return view('notes.index', compact('notes','customers','deals'));
    });
    Route::post('/notes', function () {
        request()->validate([
            'content' => 'required',
            'customer_id' => 'nullable|exists:customers,id',
            'deal_id' => 'nullable|exists:deals,id',
        ]);
        Note::create([
            'user_id' => auth()->id(),
            'customer_id' => request('customer_id'),
            'deal_id' => request('deal_id'),
            'content' => request('content'),
        ]);
        return back()->with('status','Note added');
    });
    Route::delete('/notes/{id}', function ($id) {
        Note::whereKey($id)->delete();
        return back()->with('status','Note deleted');
    });
});

require __DIR__.'/auth.php';
