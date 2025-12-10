<x-app-layout>

<x-slot name="header">
    <h2 class="text-xl font-bold">Edit Customer</h2>
</x-slot>

<div class="p-6">

<div style="max-width:500px;margin:auto;background:white;padding:20px;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,0.08);">

    <!-- Validation Errors -->
    @if ($errors->any())
        <div style="background:#fee2e2;color:#b91c1c;padding:10px;border-radius:6px;margin-bottom:10px;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('customers.update', $customer->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name -->
        <label class="label">Name</label>
        <input name="name" value="{{ old('name', $customer->name) }}" class="input" required>

        <!-- Email -->
        <label class="label">Email</label>
        <input type="email" name="email" value="{{ old('email', $customer->email) }}" class="input" required>

        <!-- Phone -->
        <label class="label">Phone</label>
        <input name="phone" value="{{ old('phone', $customer->phone) }}" class="input">

        <!-- Address -->
        <label class="label">Address</label>
        <textarea name="address" class="input" rows="3">{{ old('address', $customer->address) }}</textarea>

        <!-- Profile Image -->
        <label class="label">Profile Image</label>

        @if($customer->profile_image)
            <div style="margin-bottom:8px;text-align:center;">
                <img src="{{ asset('uploads/customers/' . $customer->profile_image) }}" 
                     width="90" height="90" style="border-radius:50%;object-fit:cover;border:1px solid #ddd;">
                <p style="font-size:12px;color:gray;">Current Image</p>
            </div>
        @endif

        <input type="file" name="profile_image" class="input-file">

        <button type="submit" class="btn-update">
            Update Customer
        </button>
    </form>

</div>

</div>

<style>
.label{
    display:block;
    font-weight:600;
    margin-top:10px;
    margin-bottom:4px;
}

.input{
    width:100%;
    padding:8px;
    border-radius:6px;
    border:1px solid #d1d5db;
}

.input:focus{
    outline:none;
    border-color:#2563eb;
}

.input-file{
    width:100%;
    margin-top:6px;
}

.btn-update{
    margin-top:15px;
    width:100%;
    background:#10b981;
    color:white;
    padding:10px;
    border-radius:8px;
    border:none;
    cursor:pointer;
    font-size:15px;
}

.btn-update:hover{
    opacity:0.9;
}
</style>

</x-app-layout>
