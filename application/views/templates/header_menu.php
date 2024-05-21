<style>
    body,
    html {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    .notification-wrapper {
      position: fixed;
      top: 5px;
      right: 20px;
      display: inline-block;
    }

    .notification-button {
      padding: 5px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    .notification-dropdown {
      display: none;
      position: absolute;
      right: 0;
      top: 40px;
      background-color: white;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      width: 300px;
      max-height: 400px;
      overflow-y: auto;
      z-index: 1000;
    }

    .notification-wrapper:hover .notification-dropdown {
      display: block;
    }

    .notification-item {
      display: flex;
      align-items: center;
      padding: 10px;
      border-bottom: 1px solid #f4f4f4;
    }

    .notification-item:last-child {
      border-bottom: none;
    }

    .notification-item img {
      border-radius: 50%;
      margin-right: 10px;
    }

    .notification-text {
      flex: 1;
    }

    .notification-text p {
      margin: 0;
      font-size: 14px;
    }

    .notification-time {
      font-size: 12px;
      color: #888;
    }

    .view-all {
      display: block;
      text-align: center;
      padding: 10px;
      background-color: #f4f4f4;
      text-decoration: none;
      color: #007bff;
      border-top: 1px solid #e0e0e0;
      border-radius: 0 0 8px 8px;
    }
  </style>

<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!-- <span class="logo-mini"><b>ADN</b></span> -->
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo $user_role ?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <?php if(in_array('viewTest', $user_permission)): ?>
      <div class="notif">
        <div class="notification-wrapper">
        <button class="notification-button">Notifications</button>
        <div class="notification-dropdown">
          <div class="notification-item">
            <div class="notification-text">
              <p><strong>John Doe</strong> commented on your post.</p>
              <span class="notification-time">2 mins ago</span>
            </div>
          </div>
          <div class="notification-item">
            <div class="notification-text">
              <p><strong>Jane Smith</strong> liked your photo.</p>
              <span class="notification-time">5 mins ago</span>
            </div>
          </div>
          <div class="notification-item">
            <div class="notification-text">
              <p><strong>Mike Johnson</strong> shared your post.</p>
              <span class="notification-time">10 mins ago</span>
            </div>
          </div>
          <div class="notification-item">
            <div class="notification-text">
              <p><strong>Sarah Williams</strong> started following you.</p>
              <span class="notification-time">15 mins ago</span>
            </div>
          </div>
          <a href="#" class="view-all">View All Notifications</a>
        </div>
      </div>
      </div>
      <?php endif; ?>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  