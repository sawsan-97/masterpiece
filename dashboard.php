<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HomeServices Dashboard</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
  <div class="sidebar">
    <div class="logo">
      <div class="logo-icon">↗</div>
      <div class="logo-text">HomeServices</div>
    </div>
    <a href="#" class="menu-item active">
      <span class="menu-icon">□</span>
      Dashboard
    </a>
    <a href="#" class="menu-item">
      <span class="menu-icon">□</span>
      Bookings
    </a>
    <a href="#" class="menu-item">
      <span class="menu-icon">♟</span>
      Providers
    </a>
    <a href="#" class="menu-item">
      <span class="menu-icon">☺</span>
      Customers
    </a>
    <a href="#" class="menu-item">
      <span class="menu-icon">⚙</span>
      Settings
    </a>
  </div>

  <div class="main-content">
    <div class="header">
      <div class="welcome-text">
        <h1>Dashboard Overview</h1>
        <p>Welcome back, Admin</p>
      </div>
      <div class="profile">
        <div class="profile-avatar">JA</div>
        <div class="profile-name">John Admin</div>
      </div>
    </div>

    <div class="stats-container">
      <div class="stat-card">
        <div class="stat-header">
          <span>Total Bookings</span>
          <div class="stat-icon blue-bg">□</div>
        </div>
        <div class="stat-value">2,451</div>
        <div class="stat-change">▲ 10.5%</div>
      </div>
      <div class="stat-card">
        <div class="stat-header">
          <span>Active Providers</span>
          <div class="stat-icon purple-bg">☺</div>
        </div>
        <div class="stat-value">156</div>
        <div class="stat-change">▲ 8.2%</div>
      </div>
      <div class="stat-card">
        <div class="stat-header">
          <span>Total Revenue</span>
          <div class="stat-icon green-bg">$</div>
        </div>
        <div class="stat-value">$84,245</div>
        <div class="stat-change">▲ 15.8%</div>
      </div>
      <div class="stat-card">
        <div class="stat-header">
          <span>Customer Rating</span>
          <div class="stat-icon orange-bg">★</div>
        </div>
        <div class="stat-value">4.8</div>
        <div class="stat-change">▲ 2.1%</div>
      </div>
    </div>

    <div class="charts-container">
      <div class="chart-card">
        <div class="chart-title">Booking Analytics</div>
        <div class="booking-chart">
          <div class="chart-bar" style="height: 50%;"></div>
          <div class="chart-bar" style="height: 70%;"></div>
          <div class="chart-bar" style="height: 45%;"></div>
          <div class="chart-bar" style="height: 85%;"></div>
          <div class="chart-bar" style="height: 65%;"></div>
          <div class="chart-bar" style="height: 95%;"></div>
          <div class="chart-bar" style="height: 75%;"></div>
        </div>
      </div>
      <div class="chart-card">
        <div class="chart-title">Service Categories</div>
        <div class="categories">
          <div class="category-item">
            <div class="category-label">
              <span>Cleaning</span>
              <span>40%</span>
            </div>
            <div class="category-bar" style="width: 80%; background-color: #8c7ae6;"></div>
          </div>
          <div class="category-item">
            <div class="category-label">
              <span>Plumbing</span>
              <span>30%</span>
            </div>
            <div class="category-bar" style="width: 60%; background-color: #9c88ff;"></div>
          </div>
          <div class="category-item">
            <div class="category-label">
              <span>Electrical</span>
              <span>20%</span>
            </div>
            <div class="category-bar" style="width: 40%; background-color: #c8d6e5;"></div>
          </div>
          <div class="category-item">
            <div class="category-label">
              <span>Others</span>
              <span>10%</span>
            </div>
            <div class="category-bar" style="width: 20%; background-color: #dfe6e9;"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="chart-card">
      <div class="chart-title">Recent Bookings</div>
      <table class="bookings-table">
        <thead>
          <tr>
            <th>CUSTOMER</th>
            <th>SERVICE</th>
            <th>PROVIDER</th>
            <th>DATE</th>
            <th>STATUS</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <div class="customer-info">
                <div class="avatar">SJ</div>
                <span>Sarah Johnson</span>
              </div>
            </td>
            <td>House Cleaning</td>
            <td>
              <div class="provider-info">
                <div class="avatar">MS</div>
                <span>Mike Smith</span>
              </div>
            </td>
            <td>Jan 16, 2025</td>
            <td><span class="status completed">Completed</span></td>
          </tr>
          <tr>
            <td>
              <div class="customer-info">
                <div class="avatar">ED</div>
                <span>Emma Davis</span>
              </div>
            </td>
            <td>Plumbing Repair</td>
            <td>
              <div class="provider-info">
                <div class="avatar">JW</div>
                <span>John Wilson</span>
              </div>
            </td>
            <td>Jan 14, 2025</td>
            <td><span class="status in-progress">In Progress</span></td>
          </tr>
          <tr>
            <td>
              <div class="customer-info">
                <div class="avatar">LB</div>
                <span>Lisa Brown</span>
              </div>
            </td>
            <td>Electrical Work</td>
            <td>
              <div class="provider-info">
                <div class="avatar">DC</div>
                <span>David Clark</span>
              </div>
            </td>
            <td>Jan 14, 2025</td>
            <td><span class="status pending">Pending</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>