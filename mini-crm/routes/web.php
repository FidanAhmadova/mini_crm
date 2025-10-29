<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\DashboardController;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Deal;
use App\Models\Task;
use App\Models\Note;
use Illuminate\Support\Facades\Route;

// Public routes (no authentication required)
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes (public)
require __DIR__.'/auth.php';

// Password reset routes
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

// Protected routes (authentication required)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Settings
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRM Pages (authentication required)
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
    Route::put('/companies/{id}', function ($id) {
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
    Route::put('/customers/{id}', function ($id) {
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
    Route::put('/deals/{id}', function ($id) {
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
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // Notes
    Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::put('/notes/{id}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/notes/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');
});
