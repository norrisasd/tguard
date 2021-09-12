<div class="sidebar">
  <div class="sidebar-title">
    <a href="./" class="brand-link text-left">
      <img src="../dist/img/logo.png" alt="Logo" style="height: 60px;">
      <span class="brand-text font-weight-bold text-light">TaskGuard</span>
    </a>
  </div>
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/profpic/<?php echo $image?>" class="img-circle elevation-2" id="navPic" alt="User Image">
        </div>
        <div class="info">
          <a href="settings" class="d-block side">Admin</a>
        </div>
      </div>
      <li class="nav-item">
        <a href="./" onclick="resetDisplay()" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="pages/client" class="nav-link">
          <i class="nav-icon fas fa-chart-bar"></i>
          <p>
            Reports
          </p>
          <i class="right fas fa-angle-left"></i>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item has-treeview">
            <a href="progresslog" class="nav-link">
              <i class="fas fa-briefcase nav-icon"></i>
              <p>User Progress Log</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="activitylog" class="nav-link">
              <i class="fas fa-clipboard nav-icon"></i>
              <p>User Activity Log</p>
            </a>
          </li>
          <!-- <li class="nav-item has-treeview">
            <a href="activitycharts" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>User Activity Charts</p>
            </a>
          </li> -->
        </ul>
      </li>
      <li class="nav-item">
        <a href="pages/client" class="nav-link">
          <i class="nav-icon fas fa-tasks"></i>
          <p>
            Tasks
          </p>
          <i class="right fas fa-angle-left"></i>
        </a>
        <ul class="nav nav-treeview" id="tasktypes">
          <li class="nav-item has-treeview">
            <a href="addtask" class="nav-link" onclick="resetDisplay()">
              <i class="fas fa-plus-square nav-icon"></i>
              <p>Add Task</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="tasklist" class="nav-link">
              <i class="fas fa-list-alt nav-icon"></i>
              <p>Task List</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="tasktype" class="nav-link">
              <i class="nav-icon far fas fa-gavel"></i>
              <p>Agrisoft</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="pages/client" class="nav-link">
          <i class="nav-icon fas fa-scroll"></i>
          <p>
            Forms
          </p>
          <i class="right fas fa-angle-left"></i>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item has-treeview">
            <a href="clients" class="nav-link">
              <i class="fas fa-user nav-icon"></i>
              <p>Clients</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="employee" class="nav-link">
              <i class="fas fa-user-shield nav-icon"></i>
              <p>Employees</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="formflag" class="nav-link">
              <i class="fas fa-flag nav-icon"></i>
              <p>Flag Types</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="formtasktype" class="nav-link">
              <i class="fas fa-list-alt nav-icon"></i>
              <p>Task Types</p>

            </a>
          </li>

        </ul>
      </li>
      <li class="nav-item">
        <a href="../php/logout" class="nav-link">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>
            Logout
          </p>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>