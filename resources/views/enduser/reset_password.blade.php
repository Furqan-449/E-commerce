<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .reset-password-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        p {
            color: #666;
            margin-bottom: 25px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .password-strength {
            height: 5px;
            background-color: #eee;
            margin-top: 5px;
            border-radius: 3px;
            overflow: hidden;
        }

        .strength-meter {
            height: 100%;
            width: 0%;
            background-color: red;
            transition: width 0.3s, background-color 0.3s;
        }

        .error-message {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
            display: none;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }

        button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        .back-to-login {
            margin-top: 20px;
            font-size: 14px;
        }

        .back-to-login a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="reset-password-container">
        <h2>Reset Your Password</h2>
        <p>Please enter your new password below.</p>

        <form id="resetPasswordForm" action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="input-group">
                <label for="newPassword">New Password</label>
                <input type="password" id="newPassword" name="password" placeholder="Enter new password" minlength="8">
            </div>

            <div class="input-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="password_confirmation"
                    placeholder="Confirm new password">
            </div>

            <button type="submit" id="submitBtn">Reset Password</button>
        </form>


        <div class="back-to-login">
            <a href="">Back to Login</a>
        </div>
    </div>

    {{-- <script>
        const newPassword = document.getElementById('newPassword');
        const confirmPassword = document.getElementById('confirmPassword');
        const passwordError = document.getElementById('passwordError');
        const confirmError = document.getElementById('confirmError');
        const strengthMeter = document.getElementById('strengthMeter');
        const submitBtn = document.getElementById('submitBtn');
        const form = document.getElementById('resetPasswordForm');

        // Check password strength
        newPassword.addEventListener('input', function() {
            const password = newPassword.value;
            let strength = 0;

            // Length check
            if (password.length >= 8) strength += 1;
            if (password.length >= 12) strength += 1;

            // Character variety checks
            if (/[A-Z]/.test(password)) strength += 1;
            if (/[0-9]/.test(password)) strength += 1;
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;

            // Update strength meter
            let width = 0;
            let color = 'red';

            if (strength <= 2) {
                width = 33;
                color = 'red';
                passwordError.textContent = 'Weak password';
                passwordError.style.display = 'block';
            } else if (strength <= 4) {
                width = 66;
                color = 'orange';
                passwordError.textContent = 'Medium strength';
                passwordError.style.display = 'block';
            } else {
                width = 100;
                color = 'green';
                passwordError.style.display = 'none';
            }

            strengthMeter.style.width = `${width}%`;
            strengthMeter.style.backgroundColor = color;

            validateForm();
        });

        // Confirm password match
        confirmPassword.addEventListener('input', function() {
            if (confirmPassword.value !== newPassword.value) {
                confirmError.textContent = 'Passwords do not match';
                confirmError.style.display = 'block';
            } else {
                confirmError.style.display = 'none';
            }

            validateForm();
        });

        // Form validation
        function validateForm() {
            const isPasswordValid = newPassword.value.length >= 8;
            const doPasswordsMatch = confirmPassword.value === newPassword.value;

            submitBtn.disabled = !(isPasswordValid && doPasswordsMatch);
        }

        // Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Get token from URL (in a real app, you'd extract this from the URL)
            const urlParams = new URLSearchParams(window.location.search);
            const token = urlParams.get('token');
            document.getElementById('token').value = token;

            // In a real application, you would send this to your server
            const formData = {
                token: token,
                newPassword: newPassword.value,
                confirmPassword: confirmPassword.value
            };

            console.log('Form data:', formData);
            alert('Password reset successful! You can now login with your new password.');

            // In a real application:
            // fetch('/api/reset-password', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //     },
            //     body: JSON.stringify(formData),
            // })
            // .then(response => response.json())
            // .then(data => {
            //     if (data.success) {
            //         window.location.href = '/login?reset=success';
            //     } else {
            //         alert(data.message || 'Password reset failed');
            //     }
            // })
            // .catch(error => {
            //     console.error('Error:', error);
            //     alert('An error occurred. Please try again.');
            // });
        });
    </script> --}}
</body>

</html>
