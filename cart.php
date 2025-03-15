<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - HomeServe</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        /* Header */
        header {
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 20px;
            font-weight: bold;
            color: #0066ff;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-size: 14px;
        }

        .cart-link {
            display: flex;
            align-items: center;
            color: #0066ff;
            font-weight: 500;
        }

        /* Main Content */
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .cart-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .cart-items {
            flex: 1;
            min-width: 300px;
        }

        .cart-item {
            display: flex;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .item-image {
            width: 60px;
            height: 60px;
            background-color: #f0f0f0;
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 20px;
        }

        .item-icon {
            color: #999;
            font-size: 24px;
        }

        .item-details {
            flex: 1;
        }

        .item-title {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .item-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .item-quantity {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-btn {
            background: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
            color: #666;
        }

        .item-price {
            font-weight: 600;
            font-size: 18px;
            text-align: right;
            min-width: 80px;
        }

        .remove-button {
            color: #ff3b30;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            display: block;
            margin-left: auto;
            margin-top: 5px;
        }

        /* Order Summary */
        .order-summary {
            width: 350px;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            align-self: flex-start;
        }

        .summary-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .summary-row.total {
            font-weight: 600;
            font-size: 18px;
            border-top: 1px solid #eee;
            padding-top: 15px;
            margin-top: 15px;
        }

        .promo-code {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .promo-input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .apply-btn {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 0 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .checkout-btn {
            width: 100%;
            background-color: #0066ff;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            font-size: 16px;
        }

        /* Footer */
        footer {
            background-color: #1d2433;
            color: white;
            padding: 40px 20px 20px;
            margin-top: 40px;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
        }

        .footer-section h3 {
            font-size: 18px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .footer-section p {
            color: #b0b0b0;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .footer-section ul {
            list-style-type: none;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section ul li a {
            color: #b0b0b0;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .footer-section ul li a:hover {
            color: #ffffff;
        }

        .social-links {
            display: flex;
            gap: 15px;
        }

        .social-links a {
            color: #fff;
            text-decoration: none;
        }

        .copyright {
            text-align: center;
            padding-top: 30px;
            color: #b0b0b0;
            font-size: 14px;
            border-top: 1px solid #2a2f3a;
            margin-top: 30px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .cart-container {
                flex-direction: column;
            }
            
            .order-summary {
                width: 100%;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <a href="#" class="logo">HomeServe</a>
        <nav class="nav-links">
            <a href="#">Services</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#" class="cart-link">
                <i class="fas fa-shopping-cart"></i>
                Cart (3)
            </a>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="container">
        <h1>Your Cart</h1>
        
        <div class="cart-container">
            <!-- Cart Items -->
            <div class="cart-items">
                <div class="cart-item">
                    <div class="item-image">
                        <i class="fas fa-broom item-icon"></i>
                    </div>
                    <div class="item-details">
                        <h3 class="item-title">House Cleaning Service</h3>
                        <p class="item-description">3 hours cleaning session</p>
                        <div class="item-quantity">
                            <button class="quantity-btn">−</button>
                            <span>1</span>
                            <button class="quantity-btn">+</button>
                        </div>
                    </div>
                    <div class="item-price">$89.99</div>
                    <button class="remove-button">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>

                <div class="cart-item">
                    <div class="item-image">
                        <i class="fas fa-wrench item-icon"></i>
                    </div>
                    <div class="item-details">
                        <h3 class="item-title">Plumbing Service</h3>
                        <p class="item-description">Basic plumbing maintenance</p>
                        <div class="item-quantity">
                            <button class="quantity-btn">−</button>
                            <span>1</span>
                            <button class="quantity-btn">+</button>
                        </div>
                    </div>
                    <div class="item-price">$129.99</div>
                    <button class="remove-button">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>

                <div class="cart-item">
                    <div class="item-image">
                        <i class="fas fa-bolt item-icon"></i>
                    </div>
                    <div class="item-details">
                        <h3 class="item-title">Electrical Service</h3>
                        <p class="item-description">Electrical inspection and repair</p>
                        <div class="item-quantity">
                            <button class="quantity-btn">−</button>
                            <span>1</span>
                            <button class="quantity-btn">+</button>
                        </div>
                    </div>
                    <div class="item-price">$149.99</div>
                    <button class="remove-button">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <h2 class="summary-title">Order Summary</h2>
                
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>$369.97</span>
                </div>
                
                <div class="summary-row">
                    <span>Service Fee</span>
                    <span>$10.00</span>
                </div>
                
                <div class="summary-row">
                    <span>Tax</span>
                    <span>$29.60</span>
                </div>
                
                <div class="summary-row total">
                    <span>Total</span>
                    <span>$409.57</span>
                </div>
                
                <div class="promo-code">
                    <input type="text" class="promo-input" placeholder="Promo code">
                    <button class="apply-btn">Apply</button>
                </div>
                
                <button class="checkout-btn">Proceed to Checkout</button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>HomeServe</h3>
                <p>Your trusted partner for home services</p>
            </div>
            
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Services</h3>
                <ul>
                    <li><a href="#">Cleaning</a></li>
                    <li><a href="#">Plumbing</a></li>
                    <li><a href="#">Electrical</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        
        <div class="copyright">
            © 2025 HomeServe. All rights reserved.
        </div>
    </footer>
</body>
</html>