<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.6
 * @link http://coreui.io
 * Copyright (c) 2017 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,Angular 2,Angular4,Angular 4,jQuery,CSS,HTML,RWD,Dashboard,React,React.js,Vue,Vue.js">
  <link rel="shortcut icon" href="img/favicon.png">
  <title>CoreUI - Open Source Bootstrap Admin Template</title>

  <!-- Icons -->
  <link href="/assets/node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="/assets/node_modules/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

  <!-- Main styles for this application -->
  <link href="/assets/css/style.css" rel="stylesheet">
  <!-- Styles required by this views -->
  
   <script src="/assets/node_modules/jquery/dist/jquery.min.js"></script>

</head>

<!-- BODY options, add following classes to body to change options

// Header options
1. '.header-fixed'					- Fixed Header

// Brand options
1. '.brand-minimized'       - Minimized brand (Only symbol)

// Sidebar options
1. '.sidebar-fixed'					- Fixed Sidebar
2. '.sidebar-hidden'				- Hidden Sidebar
3. '.sidebar-off-canvas'		- Off Canvas Sidebar
4. '.sidebar-minimized'			- Minimized Sidebar (Only icons)
5. '.sidebar-compact'			  - Compact Sidebar

// Aside options
1. '.aside-menu-fixed'			- Fixed Aside Menu
2. '.aside-menu-hidden'			- Hidden Aside Menu
3. '.aside-menu-off-canvas'	- Off Canvas Aside Menu

// Breadcrumb options
1. '.breadcrumb-fixed'			- Fixed Breadcrumb

// Footer options
1. '.footer-fixed'					- Fixed footer

-->

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  <header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>

<!--    <ul class="nav navbar-nav d-md-down-none">
      <li class="nav-item px-3">
        <a class="nav-link" href="#">Dashboard</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" href="#">Users</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" href="#">Settings</a>
      </li>
    </ul>-->
    <ul class="nav navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#"><i class="fa fa-globe"></i><span class="badge badge-pill badge-danger">4</span></a>
        <div class="dropdown-menu dropdown-menu-right">
          
            <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> New Notification 1</a>
          <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> New Notification 2</a>
          <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> New Notification 3</a>
          <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> New Notification 4</a>
          
          
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#"><i class="fa fa-envelope"></i><span class="badge badge-pill badge-danger">3</span></a>
        <div class="dropdown-menu dropdown-menu-right">
          
            <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> New Message 1</a>
          <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> New Message 2</a>
          <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> New Message 3</a>
          
          
        </div>
      </li>
      
      <li class="nav-item d-md-down-none">
        <a class="nav-link" href="#">
          <img src="/assets/img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
        </a>
        
      </li>
    </ul>
    <button class="navbar-toggler aside-menu-toggler" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>

  </header>

<div class="app-body">
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" id="caves-li" href="<?php echo site_url('home/index/caves'); ?>"><i class="fa fa-plus"></i> Caves </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" id="rest-li" href="<?php echo site_url('home/index/rest'); ?>"><i class="fa fa-code"></i> Check REST</a>

                </li>
                <li class="nav-item ">
                  <a class="nav-link" id="default-li" href="<?php echo site_url('form/default_add'); ?>"><i class="fa fa-list"></i> Default Forms</a>

                </li>

                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url('/auth/logout'); ?>"><i class="fa fa-sign-out"></i> Logout</a>

                </li>

            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>