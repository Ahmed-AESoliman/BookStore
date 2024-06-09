<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Password</title>
    <style>
        /* Basic reset to remove default browser styles */
        body, h2, label, input, button {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
        }

        /* Center the login form on the page */
        body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f0f2f5;
        }

        /* Container for the form */
        .login-container {
        background-color: #ffffff;
        padding: 20px 25px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Style the form */
        .login-form {
        width: 300px;
        text-align: center;
        }

        /* Form title */
        .login-form h2 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
        }

        /* Form group for labels and inputs */
        .form-group {
        margin-bottom: 15px;
        text-align: left;
        }

        /* Style the labels */
        .form-group label {
        display: block;
        margin-bottom: 5px;
        color: #333;
        }

        /* Style the inputs */
        .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        }

        /* Style the error messages */
        .error-message {
        color: red;
        font-size: 12px;
        margin-top: 5px;
        }

        /* Style the status message */
        .status-message {
        color: green;
        font-size: 14px;
        margin-bottom: 15px;
        }

        /* Style the submit button */
        button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        }

        /* Add a hover effect to the button */
        button:hover {
        background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="login-container">
        @if (session('status'))
        <div class="status-message">
            {{ session('status') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form class="login-form" method="POST" action="{{ route('password.update') }}">
            @csrf
            <h2>Create New Password</h2>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
                @error('password_confirmation')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="hidden" name="token" value="{{ $token }}">
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>

</html>
