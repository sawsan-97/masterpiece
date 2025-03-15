<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Home Service Platform</title>
<link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="register-container">
        <!-- Logo -->
        <div class="logo">
            <div class="logo-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
            </div>
        </div>

        <!-- Header -->
        <div class="header">
            <h1>Create Account</h1>
            <p>Join our home service platform</p>
        </div>

        <!-- Registration Form -->
        <form>
            <div class="form-row">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName">
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName">
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword">
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="termsAgree" name="termsAgree">
                <label for="termsAgree">I agree to the <a href="#">Terms and Conditions</a></label>
            </div>

            <button type="submit" class="register-button">Create Account</button>
            
            <div class="login-link">
                Already have an account? <a href="#">Sign in</a>
            </div>

           
        </form>
    </div>
</body>
</html>