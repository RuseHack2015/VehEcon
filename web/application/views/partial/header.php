<?php
/**
 * Created by PhpStorm.
 * User: Pavel Zlatarov
 * Date: 29.5.2015 г.
 * Time: 22:26
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="<?=base_url('/static/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('/static/css/main.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('/static/bootstrap/css/bootstrap-responsive.min.css')?>" rel="stylesheet" type="text/css">
    <!--<link href="<?/*=base_url('/static/jquery-ui/jquery-ui.min.css')*/?>" rel="stylesheet" type="text/css">-->
    <script type="text/javascript" src="<?=base_url('/static/js/jquery-1.11.3.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('/static/bootstrap/js/bootstrap.min.js')?>"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="padding-top:0" href="#">
                <img src="<?=base_url('/static/img/logo4.png')?>" alt="logo">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!--<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>-->
                <li><a href="<?=site_url('/index')?>">Home</a></li>
                <li><a href="<?=site_url('/cars')?>">My cars</a></li>
                <li><a href="<?=site_url('/stations')?>">Nearest gas station(s)</a></li>


            </ul>

            <ul class="nav navbar-nav navbar-right">
                <!--<li><a href="#">Reserved for future development</a></li>-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?=$username?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?=site_url('/index/logout')?>">Log out</a></li>
                        <!--<li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>-->
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div id="content">