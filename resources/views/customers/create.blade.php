<x-app-layout>

<x-slot name="header">
    <h2 class="text-xl font-bold">Add Customer</h2>
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

    <form method="POST" action="{{ route('customers.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <label class="label">Name</label>
        <input name="name" class="input" placeholder="Enter Full Name" required>

        <!-- Email -->
        <label class="label">Email</label>
        <input name="email" type="email" class="input" placeholder="Enter Email" required>

        <!-- Phone -->
        <label class="label">Phone</label>
        <input name="phone" class="input" placeholder="Enter Phone Number" required>

        <!-- Address -->
        <label class="label">Address</label>
        <textarea name="address" class="input" rows="3" placeholder="Enter Address" required></textarea>

        <!-- Profile Image -->
        <label class="label">Profile Image</label>
        <input type="file" name="profile_image" class="input-file">

        <button type="submit" class="btn-save">
            Save Customer
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
    margin-top:5px;
}

.btn-save{
    margin-top:15px;
    width:100%;
    background:#16a34a;
    color:white;
    padding:10px;
    border-radius:8px;
    border:none;
    cursor:pointer;
    font-size:15px;
}
.btn-save:hover{
    opacity:0.9;
}
</style>

</x-app-layout>
