<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf; // for PDF

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(5);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|digits_between:10,15',
            'address' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/customers'), $filename);
            $data['profile_image'] = $filename;
        }

        Customer::create($data);

        return redirect()->route('customers.index')->with('success', 'Customer added successfully!');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'required|digits_between:10,15',
            'address' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($customer->profile_image && file_exists(public_path('uploads/customers/' . $customer->profile_image))) {
                unlink(public_path('uploads/customers/' . $customer->profile_image));
            }

            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/customers'), $filename);
            $data['profile_image'] = $filename;
        }

        $customer->update($data);

        return redirect()->route('customers.index')->with('success', 'Customer updated!');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        // Delete profile image from folder
        if ($customer->profile_image && file_exists(public_path('uploads/customers/' . $customer->profile_image))) {
            unlink(public_path('uploads/customers/' . $customer->profile_image));
        }

        // Soft delete
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted!');
    }

    // Export CSV
    public function exportCsv()
{
    $customers = Customer::all();

    $filename = "customers_" . date('Ymd_His') . ".csv";

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=$filename",
    ];

    $callback = function() use ($customers) {
        $file = fopen('php://output', 'w');
        fputcsv($file, ['Name', 'Email', 'Phone', 'Address']);

        foreach ($customers as $c) {
            fputcsv($file, [$c->name, $c->email, $c->phone, $c->address]);
        }

        fclose($file);
    };

    return Response::stream($callback, 200, $headers);
}

    // Export PDF
    public function exportPdf()
    {
        $customers = Customer::all();
        $pdf = Pdf::loadView('customers.pdf', compact('customers'));
        return $pdf->download('customers_' . date('Ymd_His') . '.pdf');
    }
}
