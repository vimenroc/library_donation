<?php

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?= base_url('assets/images/fcfm.ico')?>" type="image/ico" />

    <title><?= $title ?>  </title>

    <!-- Bootstrap -->
    <link href =" <?= base_url() ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href=" <?= base_url()?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
    <!-- NProgress -->
    <link href=" <?= base_url()?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href=" <?= base_url()?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href=" <?= base_url()?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href=" <?= base_url()?>assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href=" <?= base_url()?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href=" <?= base_url()?>assets/build/css/custom.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src=" <?= base_url()?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src=" <?= base_url()?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
    </head>

    <body class="nav-md">
        <div class="container body">
        <div class="main_container">
        <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?= base_url() ?>" class="site_title"><i class="fa fa-book"></i> <span>Biblioteca FCFM</span></a>
                </div>  
                <div class="clearfix"></div>
                <!-- menu profile quick info -->
                <div class="profile clearfix">
                <div class="profile_pic">
                    <img src="<?= base_url()?>assets/images/img.jpg" alt="..." class="img-circle profile_img">
                </div>
                <div class="profile_info">
                    <span>Welcome,</span>
                    <h2>Usuario</h2>
                </div>
                </div>
                <!--     /menu profile quick info -->
                <br />

                <!-- sidebar menu -->
                <div     id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                    <h3>General</h3>
                    <ul class="nav side-menu">
                    <!-- <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                        <li><a href="index.html">Dashboard</a></li>
                        <li><a href="index2.html">Dashboard2</a></li>
                        <li><a href="index3.html">Dashboard3</a></li>
                        </ul>
                    </li> -->
                    <li><a><i class="fa fa-edit"></i> Donaciones <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= base_url('donations/register/') ?>">Registrar Donación</a></li>
                            <li><a href="<?= base_url('donations/registry/') ?>">Registro de Donaciones</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fas fa-receipt"></i> Recibos <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <!-- <li><a href="<?= base_url('receipts/single_search/') ?>">Individual</a></li> -->
                            <li><a href="<?= base_url('receipts/massive_search/') ?>">Decarga Masiva</a></li>
                        </ul>
                    </li> 
                </div>
                

            </div>
            <!-- /sidebar menu -->

                
        </div>
    </div>

    <!-- top navigation -->
    <div class="top_nav">
        <div class="nav_menu">
                <nav>
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>

                <ul class="nav navbar-nav navbar-right">
                    <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?= base_url() ?>assets/images/img.jpg" alt="">John Doe
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="javascript:;"> Opción 1</a></li>
                        <li>
                        <a href="javascript:;">
                            <span class="badge bg-red pull-right">50%</span>
                            <span>Opción 2</span>
                        </a>
                        </li>
                        <li><a href="javascript:;">Opción 3</a></li>
                        
                        <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Opción 4</a></li>
                    </ul>
                    </li>

                   
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        <div class="right_col" role="main">
