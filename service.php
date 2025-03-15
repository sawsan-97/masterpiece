<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Cleaning Service - HomeServ</title>
   <link rel="stylesheet" href="service.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <a href="#" class="logo">HomeServ</a>
        <nav class="nav-links">
            <a href="#">Home</a>
            <a href="#">Services</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#" class="book-now-btn">Book Now</a>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="service-page">
            <!-- Service Information -->
            <div class="service-info">
                <h1>House Cleaning Service</h1>
                <div class="rating">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="review-count">4.9 (2.5k+ reviews)</span>
                </div>

                <div class="service-section">
                    <h2>Service Description</h2>
                    <ul class="feature-list">
                        <li class="feature-item">
                            <i class="fas fa-check feature-icon"></i>
                            <span>Professional cleaning equipment</span>
                        </li>
                        <li class="feature-item">
                            <i class="fas fa-check feature-icon"></i>
                            <span>Eco-friendly cleaning products</span>
                        </li>
                        <li class="feature-item">
                            <i class="fas fa-check feature-icon"></i>
                            <span>Trained & verified staff</span>
                        </li>
                        <li class="feature-item">
                            <i class="fas fa-check feature-icon"></i>
                            <span>100% satisfaction guarantee</span>
                        </li>
                    </ul>
                </div>

                <div class="service-section">
                    <h2>Pricing</h2>
                    <table class="pricing-table">
                        <tr>
                            <td>Basic Clean (2 hours)</td>
                            <td>$80</td>
                        </tr>
                        <tr>
                            <td>Deep Clean (4 hours)</td>
                            <td>$110</td>
                        </tr>
                        <tr>
                            <td>Move-in/Move-out Clean</td>
                            <td>$180</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Booking Form -->
            <div class="booking-form">
                <h2 class="form-title">Book Your Service</h2>
                <form>
                    <div class="form-group">
                        <label for="service-type">Select Service Type</label>
                        <select id="service-type" class="form-control">
                            <option>Basic Clean (2 hours)</option>
                            <option>Deep Clean (4 hours)</option>
                            <option>Move-in/Move-out Clean</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">Select Date</label>
                        <input type="date" id="date" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="time">Preferred Time</label>
                        <select id="time" class="form-control">
                            <option>9:00 AM</option>
                            <option>10:00 AM</option>
                            <option>11:00 AM</option>
                            <option>12:00 PM</option>
                            <option>1:00 PM</option>
                            <option>2:00 PM</option>
                            <option>3:00 PM</option>
                            <option>4:00 PM</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="address">Your Address</label>
                        <textarea id="address" class="form-control" placeholder="Enter your full address"></textarea>
                    </div>

                    <button type="submit" class="submit-btn">Book Now - $80</button>
                </form>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <div class="features-section">
            <h2 class="features-title">Why Choose Our Services</h2>
            <div class="features-grid">
                <div class="feature-box">
                    <div class="feature-box-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Insured & Bonded</h3>
                    <p>All our services are fully insured for your peace of mind</p>
                </div>

                <div class="feature-box">
                    <div class="feature-box-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Flexible Scheduling</h3>
                    <p>Book your service at your convenient time</p>
                </div>

                <div class="feature-box">
                    <div class="feature-box-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h3>Verified Professionals</h3>
                    <p>Background-checked and trained staff</p>
                </div>

                <div class="feature-box">
                    <div class="feature-box-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Satisfaction Guaranteed</h3>
                    <p>100% satisfaction or we'll make it right</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>HomeServ</h3>
                <p>Professional home services at your doorstep</p>
            </div>
            
            <div class="footer-section">
                <h3>Services</h3>
                <ul>
                    <li><a href="#">House Cleaning</a></li>
                    <li><a href="#">Deep Cleaning</a></li>
                    <li><a href="#">Move-in/Move-out</a></li>
                    <li><a href="#">Commercial Cleaning</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Company</h3>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Contact Us</h3>
                <div class="contact-info">
                    <i class="fas fa-phone"></i>
                    <span>1-800-HOME-SERV</span