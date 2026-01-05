<!DOCTYPE html>
<html>
<head>
    <!-- Page Title -->
    <title>Laravel 12 Client-Side Form Validation</title>

    <!-- Bootstrap CSS for basic styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- jQuery Validation Plugin for client-side form validation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <!-- Custom style for validation error messages -->
    <style>
        label.error {
            color: #dc3545;      /* Red color for error text */
            font-size: 14px;     /* Slightly smaller font */
        }
    </style>
</head>
<body>

<!-- Main container -->
<div class="container mt-5">

    <!-- Success message displayed after user creation -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- User Registration Form -->
    <form id="regForm" method="POST" action="{{ route('users.store') }}">
        @csrf <!-- CSRF protection token -->

        <!-- Name Field -->
        <div class="mb-3">
            <label for="inputName" class="form-label">Name:</label>
            <input type="text" name="name" id="inputName" class="form-control">
        </div>

        <!-- Email Field -->
        <div class="mb-3">
            <label for="inputEmail" class="form-label">Email:</label>
            <input type="text" name="email" id="inputEmail" class="form-control">
        </div>

        <!-- Password Field -->
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <!-- Confirm Password Field -->
        <div class="mb-3">
            <label for="inputPassword" class="form-label">Confirm Password:</label>
            <input type="password" name="confirm_password" id="inputPassword" class="form-control">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- jQuery Client-Side Validation Script -->
<script>
$(document).ready(function(){

    // Apply validation on form submit
    $("#regForm").validate({

        // Validation rules
        rules: {
            name: { 
                required: true            // Name must be filled
            },
            email: { 
                required: true,           // Email is required
                email: true               // Must be valid email format
            },
            password: { 
                required: true,           // Password is required
                minlength: 5              // Minimum 5 characters
            },
            confirm_password: {
                required: true,           // Confirm password required
                equalTo: "#password"      // Must match password field
            }
        },

        // Custom error messages
        messages: {
            name: "Name is required",
            email: {
                required: "Email is required",
                email: "Enter a valid email"
            },
            password: {
                required: "Password is required",
                minlength: "Minimum 5 characters"
            },
            confirm_password: {
                required: "Confirm password is required",
                equalTo: "Passwords do not match"
            }
        }
    });
});
</script>

</body>
</html>
