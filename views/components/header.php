<nav class="navbar header">
  <div style="align-self: flex-end; display: flex; flex-direction: row; justify-content: center; align-items: center;">
    <div class="dropdown show">
      <a href="#" class="notifications text-white" style="margin-right: 2rem !important;" id="notifications" data-toggle="dropdown">
          <i class="fas fa-bell">
          <span class="badge badge-pill bg-white count" style="color: black; margin-left: -9px; margin-bottom: -5px; font-size: 9px;">0</span>
          </i>
      </a>
      <div class="dropdown-menu dropdown-menu-right scrollable-menu" aria-labelledby="notifications">
        <div class="notif-area">
          <h6 class="dropdown-header" style="font-weight: 600;">Notifications</h6>
          <div class="dropdown-divider"></div>
          <div class="notif text-center">
            <i class="far fa-envelope fa-5x"></i>
            <h5>No notifications</h5>
          </div>
        </div>
      </div>
    </div>
    <button type="button" onclick="location.href='../controller/employeeLogout.php'" class="btn-logout"><i class="fas fa-sign-out-alt" style="align-self: center;"></i> Logout</button>
  </div>
</nav>