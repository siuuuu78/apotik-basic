<!DOCTYPE html>

<?php
session_start();
require_once("../config/koneksi.php")
?>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin - Apotik</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/datepicker3.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />

    <!--Custom Font-->
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="css/admin.css">
  </head>
  <body>
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button
            type="button"
            class="navbar-toggle collapsed"
            data-toggle="collapse"
            data-target="#sidebar-collapse"
          >
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><span></span>Admin</a>
          <ul class="nav navbar-top-links navbar-right">
          </ul>
        </div>
      </div>
      <!-- /.container-fluid -->
    </nav>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
      <div class="profile-sidebar">
        <div class="profile-userpic">
          <img
            src="../images/user-icon.png"
            class="img-responsive"
            alt=""
          />
        </div>
        <div class="profile-usertitle">
          <div class="profile-usertitle-name">Apotik</div>
          <div class="profile-usertitle-status">
            <span class="indicator label-success"></span>Online
          </div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="divider"></div>
      <form role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search" />
        </div>
      </form>
      <ul class="nav menu">
        <li class="active">
          <a href="main.php"
            ><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a>
        <li class="parent">
          <a data-toggle="collapse" href="#sub-item-1">
            <em class="fa fa-navicon">&nbsp;</em> Menu
            <span
              data-toggle="collapse"
              href="#sub-item-1"
              class="icon pull-right"
              ><em class="fa fa-plus"></em
            ></span>
          </a>
          <ul class="children collapse" id="sub-item-1">
            <li>
              <a class="" href="main.php?page=produk">
                <span class="fa fa-arrow-right">&nbsp;</span> Produk
              </a>
            </li>
            <li>
              <a class="" href="main.php?page=user">
                <span class="fa fa-arrow-right">&nbsp;</span> User
              </a>
            </li>
            <li>
              <a class="" href="main.php?page=checkout">
                <span class="fa fa-arrow-right">&nbsp;</span> Checkout
              </a>
            </li>
            <li>
              <a class="" href="main.php?page=kontak">
                <span class="fa fa-arrow-right">&nbsp;</span> Kontak
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="index.php"
            ><em class="fa fa-power-off">&nbsp;</em> Logout</a
          >
        </li>
      </ul>
    </div>
    <!--/.sidebar-->

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
      <div class="row">
        <ol class="breadcrumb">
          <li>
            <a href="#">
              <em class="fa fa-home"></em>
            </a>
          </li>
          <li class="active">Data Apotik</li>
        </ol>
      </div>
      <!--/.row-->

      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Data Apotik</h1>
        </div>
      </div>
      <!--/.row-->
      <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <?php
                if(isset($_GET['page'])){
                  $halaman = $_GET['page'];
                }else{
                  $halaman = "";
                }
                if($halaman == ""){
                  include "page/home.php";
                } else if(!file_exists("page/$halaman.php")){
                  echo "halaman yang dicari tidak ada";
                } else{
                  include "page/$halaman.php";
                }
              ?>
              </div>
          </div>
      </div>
      

     
        <!--/.col-->
        <div class="col-sm-12">
          <p class="back-link">
          </p>
        </div>
      </div>
      <!--/.row-->
    </div>
    <!--/.main-->

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>
    <script>
      window.onload = function () {
        var chart1 = document.getElementById("line-chart").getContext("2d");
        window.myLine = new Chart(chart1).Line(lineChartData, {
          responsive: true,
          scaleLineColor: "rgba(0,0,0,.2)",
          scaleGridLineColor: "rgba(0,0,0,.05)",
          scaleFontColor: "#c5c7cc",
        });
      };
    </script>
  </body>
</html>
