<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home Services Platform</title>
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  </head>
  <body>
    <!-- Header -->
    <header class="header">
      <nav class="navbar">
        <div class="navbar-left">
          <a href="#" class="logo">
            <span class="logo-underline">HomeServe</span>
          </a>
          <div class="nav-links">
            <div class="dropdown">
              <a href="#">All Services ▾</a>
              <div class="dropdown-content">
                <a href="#">Cleaning</a>
                <a href="#">Plumbing</a>
                <a href="#">Furniture Assembly</a>
                <a href="#">Painting</a>
                <a href="#">moving</a>
              </div>
            </div>
            <a href="#">Blog</a>
          </div>
        </div>
        <div class="navbar-right">
          <a href="#">Contact Us</a>
          <a href="#">About Us</a>
          <a href="#">Log In</a>
        </div>
      </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero"
     style="
                  background-image: url('services_landing_hero_web-2de19ef2a4f19cbe92a86522efe2745d4ea7f7d2f43e2b317ab0533792b92495.jpg');
                ">
      <div class="hero-overlay">
        <div class="hero-content">
          <h1>Choose a service to get started.</h1>
          <div class="search-container">
            <input
              type="text"
              class="search-input"
              placeholder='Search for a service (e.g. "cleaning")'
            />
            <button class="search-btn">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Categories Section -->
    <section class="categories">
      <h2>All Categories</h2>
      <div class="categories-layout">
        <div class="categories-sidebar">
          <ul>
            <li><a href="#">Popular</a></li>
            <li><a href="#">Cleaning</a></li>
            <li><a href="#">TV and Electronics</a></li>
            <li><a href="#">Assembly</a></li>
         
            <li><a href="#">Plumbing</a></li>
            
            <li><a href="#">Painting</a></li>
            <li><a href="#">Moving</a></li>
          </ul>
        </div>
        <div class="categories-content">
          <h3 class="categories-title">Popular</h3>
          <div class="categories-grid">
            <div class="category-card">
              <div
                class="category-img"
                style="
                  background-image: url('when-bg-home-2-ca9f98fd61e7398b76c194d1b5405b06e61ff1053d46ec1f98abee5c90ca8ec0.jpg');
                "
              ></div>
              <div class="category-label">Home Cleaning</div>
            </div>
            <div class="category-card">
              <div
                class="category-img"
                style="
                  background-image: url('./image/furniture-63d29abb78e0854d32370670ebc60e785191b459a238ea30cffa450b115939ba.jpg');
                "
              ></div>
              <div class="category-label">Furniture Assembly</div>
            </div>
            <div class="category-card">
              <div
                class="category-img"
                style="
                  background-image: url('./image/large_painting-a03eb0d4ce992e5d1af0912f25a6b95cf87dc7d1ec7865c0dba26380023d7bcb.jpg');
                "
              ></div>
              <div class="category-label">Interior Painting</div>
            </div>
            <div class="category-card">
              <div
                class="category-img"
                style="
                  background-image: url('./image/large_hanging_pictures_shelves_3-7e794fb88a766d9392e6751ef923143259c20998e3896dce637c5ec7c03abc4c.jpg');
                "
              ></div>
              <div class="category-label">Hanging Pictures and Installing</div>
            </div>
            <div class="category-card">
              <div
                class="category-img"
                style="
                  background-image: url('./image/large_office_cleaning_2-22534475362c99e63886855ec7cec8e16260d226cf913424936841a112ac7c97.jpg');
                "
              ></div>
              <div class="category-label">Office Cleaning</div>
            </div>
            <div class="category-card">
              <div
                class="category-img"
                style="
                  background-image: url('./image/practice-54b01b5638651869cd0034a572da4bb9e328bc000794c25bf43ac4afc48c76bc.jpg');
                "
              ></div>
              <div class="category-label">TV Mounting</div>
            </div>
            
          </div>
        </div>
      </div>

      
    </section>
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>HomeServe</h3>
                <p>Your trusted partner for all home services needs</p>
            </div>
            
            <div class="footer-section">
                <h3>Services</h3>
                <ul>
                    <li><a href="#">Painting</a></li>
                    <li><a href="#">Cleaning</a></li>
                    <li><a href="#">Repair</a></li>
                    <li><a href="#">Plumbing</a></li>
                    <li><a href="#">Shifting</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Contact</h3>
                <div class="contact-info">
                    <i class="fas fa-phone"></i>
                    <p>0798654543>
                </div>
                <div class="contact-info">
                    <i class="fas fa-envelope"></i>
                    <p>info@HomeServe.com</p>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>© 2025 HomeServe. All rights reserved.</p>
        </div>
    </footer>



    <script>
      // Replace placeholder images with actual background image
      document.addEventListener("DOMContentLoaded", function () {
        // You would replace this with your actual hero image URL
        const heroSection = document.querySelector(".hero");
        heroSection.style.backgroundImage =
          "url('https://via.placeholder.com/1600x600/333333/FFFFFF?text=House+Image')";

        // Add functionality for search button if needed
        const searchBtn = document.querySelector(".search-btn");
        const searchInput = document.querySelector(".search-input");

        searchBtn.addEventListener("click", function () {
          // Add search functionality here
          console.log("Search for:", searchInput.value);
        });
      });
    </script>
  </body>
</html>
