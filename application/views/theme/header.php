<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="description" content="">
        <meta name="author" content="">
        <title>Ajanta Backend System</title>

        <!-- Bootstrap Core CSS -->
        <link href="/assets/css/sb-admin.css"
              rel="stylesheet" type="text/css">
        <link
            href="/assets/libraries/bootstrap1/css/bootstrap.min.css"
            rel="stylesheet">

        <!-- Custom Fonts -->
        <link
            href="/assets/libraries/font-awesome/css/font-awesome.min.css"
            rel="stylesheet" type="text/css">

        <!-- Custom CSS -->
        <link href="/assets/css/sb-admin.css"
              rel="stylesheet">


        <!-- JQuery Example -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

        <script>
            $(document).ready(function () {
                $(document).on("click", ".nav-item", function () {
                    console.log($(this));
                    $(this).addClass('nav-item active');
                });


            });
            //document.getElementById("tab_c").childNodes[0].onclick = function() {
            //return false;
            //};
        </script>
        <!-- 
        <style>
        li#tab_c{display:none}
        </style> -->
    </head>

    <body>

        <!-- Navigation -->
        <nav id="mainNav"
             class="navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button"
                    data-toggle="collapse" data-target="#navbarExample"
                    aria-controls="navbarExample" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Revisting Ajanta</a>
            <div class="collapse navbar-collapse" id="navbarExample">
                <ul class="sidebar-nav navbar-nav">
                    <!-- 
                    <li class="nav-item" id="tab_a"><a class="nav-link" href="<php echo site_url('home/index/painting');?>"><i
                                    class="fa fa-fw fa-camera"></i> Paintings</a></li>
                    -->
                    <!--				<li class="nav-item"><a class="nav-link nav-link-collapse collapsed"
                                                            data-toggle="collapse" href="#collapseExample"><i
                                                                    class="fa fa-fw fa-camera"></i>Caves</a>
                                                            <ul class="sidebar-second-level collapse" id="collapseExample">
                                                                <li><a href="<php echo site_url('painting/all_paintings');?>">Show all Painting</a></li>
                                                                    <li><a href="<php echo site_url('home/index/painting');?>">Upload Painting</a></li>					
                                                                    <li><a href="#">Line-Drawing</a></li>
                                                                      
                                                                    <li><a class="nav-link-collapse collapsed" data-toggle="collapse"
                                                                            href="#collapseExample2">Third Level</a>
                                                                            <ul class="sidebar-third-level collapse" id="collapseExample2">
                                                                                    <li><a href="#">Third Level Item</a></li>
                                                                                    <li><a href="#">Third Level Item</a></li>
                                                                            </ul>
                                                                    </li> 
                                                            </ul>
                                                    </li>-->



                    <li class="nav-item" id="tab_b"><a class="nav-link" href="<?php echo site_url('home/index/caves'); ?>"><i
                                class="fa fa-fw fa-commenting-o"></i> Caves </a></li>
                    <!--
                                    <li class="nav-item" id="tab_c"><a class="nav-link" href="<php echo site_url('home/index/animation');?>"><i
                                    class="fa fa-fw fa-fast-forward"></i> Animation</a></li>-->

                    <li class="nav-item"><a class="nav-link" href="<?php echo site_url('home/index/rest'); ?>"><i
                                class="fa fa-fw fa-underline"></i> Check REST</a></li>
                    
                    <li class="nav-item"><a class="nav-link" href="<?php echo site_url('home/index/list'); ?>"><i
                                class="fa fa-fw fa-underline"></i> Create List</a></li>

                    <li class="nav-item"><a class="nav-link nav-link-collapse collapsed"
                                            data-toggle="collapse" href="#collapseExample"><i
                                class="fa fa-fw fa-sitemap"></i>Search</a>
                        <ul class="sidebar-second-level collapse" id="collapseExample">
                            <li><a href="<?php echo site_url('home/index/all_paintings'); ?>">Paintings</a></li>
                            <li><a href="#">Stories</a></li>
                            <!-- <li><a class="nav-link-collapse collapsed" data-toggle="collapse"
                                    href="#collapseExample2">Third Level</a>
                                    <ul class="sidebar-third-level collapse" id="collapseExample2">
                                            <li><a href="#">Third Level Item</a></li>
                                            <li><a href="#">Third Level Item</a></li>
                                    </ul>
                            </li> -->
                        </ul>
                    </li>

                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown"><a
                            class="nav-link dropdown-toggle mr-lg-2" href="#"
                            id="messagesDropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="fa fa-fw fa-envelope"></i> <span
                                class="hidden-lg-up">Messages <span
                                    class="badge badge-pill badge-primary">12 New</span></span> <span
                                class="new-indicator text-primary hidden-md-down"><i
                                    class="fa fa-fw fa-circle"></i><span class="number">12</span></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">New Messages:</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"> <strong>David Miller</strong> <span
                                    class="small float-right text-muted">11:21 AM</span>
                                <div class="dropdown-message small">Hey there! This new version
                                    of SB Admin is pretty awesome! These messages clip off when they
                                    reach the end of the box so they don't overflow over to the
                                    sides!</div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"> <strong>Jane Smith</strong> <span
                                    class="small float-right text-muted">11:21 AM</span>
                                <div class="dropdown-message small">I was wondering if you could
                                    meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"> <strong>John Doe</strong> <span
                                    class="small float-right text-muted">11:21 AM</span>
                                <div class="dropdown-message small">I've sent the final files
                                    over to you for review. When you're able to sign off of them let
                                    me know and we can discuss distribution.</div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"> View All Messages </a>
                        </div></li>
                    <li class="nav-item dropdown"><a
                            class="nav-link dropdown-toggle mr-lg-2" href="#"
                            id="alertsDropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="fa fa-fw fa-bell"></i> <span
                                class="hidden-lg-up">Alerts <span
                                    class="badge badge-pill badge-warning">6 New</span></span> <span
                                class="new-indicator text-warning hidden-md-down"><i
                                    class="fa fa-fw fa-circle"></i><span class="number">6</span></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                            <a class="dropdown-item" href="#">Action</a> <a
                                class="dropdown-item" href="#">Another action</a> <a
                                class="dropdown-item" href="#">Something else here</a>
                        </div></li>
                    <li class="nav-item">
                        <form class="form-inline my-2 my-lg-0 mr-lg-2">
                            <div class="input-group">
                                <input type="text" class="form-control"
                                       placeholder="Search for..."> <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo site_url('home/logout'); ?>"><i
                                class="fa fa-fw fa-sign-out"></i> Logout</a></li>
                </ul>
            </div>
        </nav>