<!DOCTYPE html>
<html lang="en">
<head>
    <!-- SITE META -->
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title> // TCOB Base Application // Trulaske College of Business, University of Missouri</title>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <?php
        $this->load->helper('html');
        //CSS
        echo link_tag('assets/css/usptostrap.css');
    ?>
</head>

<body>
<div class="skipLinks alert-info">
   <a class="sr-only focusable" href="#mainContent">Skip to main content</a>
   <a class="sr-only focusable" href="#contentNav">Skip to content navigation</a>   
</div>
<header class="app-header clearfix">
        
    <div id="logoRow" class="container-fluid">
        <div class="row">
            <div class="container-fluid">
                <img id="mainLogo" src="<?php echo base_url();?>assets/images/web-logo.png" alt="TCOB Logo" height="60px" />
            </div>
        </div>
    </div>
    <nav id="contentNav" class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="./">
                    <strong>TCOB</strong>
                    <span class="light">Base App</span>
                </a>
                <?php if($this->session->userdata('logged_in')){ ?>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php } ?>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php if($this->session->userdata('logged_in')){ ?>
                    <!--<li><a href="#">Link1</a></li>
                    <li><a href="#">Link2</a></li>-->
                    
                    <li class="dropdown">
                        <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon icon-user margin-right-1 icon-inverse"></i><?php echo $this->session->userdata('cn')?> <span class="caret"></span><span class="sr-only">Toggle Dropdown</span></a>
                        <ul class="dropdown-menu" role="menu">
                            <!--<li><a href="profile">User Profile</a></li>
                            <li><a href="#modal-appSettings" data-toggle="modal">Settings</a></li>
                            <li class="divider" role="separator"></li>-->
                            <li><a href="logout">Logout</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    </header>
    
    <div id="mainContent" class="container-fluid top-buffer">