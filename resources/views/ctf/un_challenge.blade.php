<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>DLCTF</title>
    <!-- Bootstrap core CSS -->
    <link href="/ctf/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="/ctf/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="/ctf/assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="/ctf/assets/js/gritter/css/jquery.gritter.css" />
    <!-- Custom styles for this template -->
    <link href="/ctf/assets/css/style.css" rel="stylesheet">
    <link href="/ctf/assets/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="/ctf/assets/css/to-do.css">
    <link href="/ctf/build/toastr.css" rel="stylesheet" />
    <style type="text/css">@import url(http://fonts.googleapis.com/css?family=Open+Sans:300,400); body { background: #F1F2F2; color: black; font: normal 12px 'Open Sans', sans-serif; margin-top: 20px; } ul.countdown { list-style: none; margin: 75px 0; padding: 0; display: block; text-align: center; } ul.countdown li { display: inline-block; } ul.countdown li span { font-size: 80px; font-weight: 300; line-height: 80px; } ul.countdown li.seperator { font-size: 80px; line-height: 70px; vertical-align: top; } ul.countdown li p { color: #a7abb1; font-size: 14px; } a { color: #76949F; text-decoration: none; } a:hover { text-decoration: underline; } .source { width: 405px; margin: 0 auto; background: #4f5861; color: #a7abb1; font-weight: bold; display: block; white-space: pre; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; } .btn { background: #f56c4c; margin: 40px auto; padding: 12px; display: block; width: 100px; color: white; text-align: center; text-transform: uppercase; font-weight: bold; text-decoration: none; -webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px; } .btn:hover { text-decoration: none; opacity: .7; }</style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--></head>

  <body>
    <section id="container">
      <!-- ********************************************************************************************************************************************************** TOP BAR CONTENT & NOTIFICATIONS *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
        <div class="sidebar-toggle-box">
          <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <a href="/home" class="logo">
          <b>DLCTF-Plat</b>
        </a>
        <!--logo end--></header>
      <aside>
        <div id="sidebar" class="nav-collapse ">
          <!-- sidebar menu start-->
          <ul class="sidebar-menu" id="nav-accordion">
            <p class="centered">
              <a href="#">
                <img src="/ctf/assets/img/ui-sam.jpg" class="img-circle" width="60"></a>
            </p>
            <h5 class="centered">
              <?php if(Auth::check()){echo htmlspecialchars(Auth::user()->name);}else{echo "DLCTF";} ?></h5>
              <li class="mt">
                  <a href="/home">
                      <i class="fa fa-dashboard"></i>
                      <span>Dashboard</span></a>
              </li>
              <li class="sub-menu">
                  <a class="active" href="/challenges">
                      <i class="fa fa-flag"></i>
                      <span>Challenges</span></a>
              </li>
              <li class="sub-menu">
                  <a href="/notice">
                      <i class="fa fa-gift"></i>
                      <span>Notice</span></a>
              </li>
              <li class="sub-menu">
                  <a href="/scoreboard">
                      <i class="fa fa-book"></i>
                      <span>scoreboard</span></a>
              </li>
              <li class="sub-menu">
              <a href="/team">
                <i class=" fa fa-code"></i>
                <span>Team</span></a>
            </li>
              <li class="sub-menu">
                  <a href="/about">
                      <i class=" fa fa-bar-chart-o"></i>
                      <span>About</span></a>
              </li>
              <?php if(Auth::user()->student_id === '00000001'){echo '
           <li class="sub-menu">
             <a href="/ctfadmin/home">
             <i class="fa fa-cog" aria-hidden="true"></i>
             <span>Admin</span></a>
           </li>'; }?>
            <?php if(Auth::check()){echo '
            <li class="sub-menu"> <a href="/logout"> <i class=" fa fa-sign-out"></i> <span>Logout</span> </a> </li>'; }?></ul>
          <!-- sidebar menu end--></div>
      </aside>
      <section id="main-content">
        <section class="wrapper site-min-height">
          <div style="width:150px; height:auto; float:left; display:inline">
            <h3>
              <i class="fa fa-angle-right"></i>Task Page</h3>
          </div>
          <!-- settings start -->
          <h3>
            <dl class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                <i class="fa fa-tasks"></i>
              </a>
              <ul class="dropdown-menu extended tasks-bar">
                <div class="notify-arrow notify-arrow-green"></div>
                <li>
                  <p class="green">Types</p></li>
                <li>
                  <a href="/challenges/">
                    <div class="task-info">
                      <div class="desc">Web</div></div>
                  </a>
                </li>
                <li>
                  <a href="/challenges/">
                    <div class="task-info">
                      <div class="desc">Pwn</div></div>
                  </a>
                </li>
                <li>
                  <a href="/challenges">
                    <div class="task-info">
                      <div class="desc">Re</div></div>
                  </a>
                </li>
                <li>
                  <a href="/challenges">
                    <div class="task-info">
                      <div class="desc">Misc</div></div>
                  </a>
                </li>
                <li>
                  <a href="/challenges">
                    <div class="task-info">
                      <div class="desc">Crypto</div></div>
                  </a>
                </li>
                <li class="external">
                  <a href="/challenges">See All Tasks</a></li>
              </ul>
            </dl>
          </h3>
          <!-- settings end -->
          <div>
            <h1 align="center" style="margin-top:150px;">距离比赛开始还有</h1>
            <ul class="countdown">
              <li>
                <span class="days">00</span>
                <p class="days_ref">days</p></li>
              <li class="seperator">.</li>
              <li>
                <span class="hours">00</span>
                <p class="hours_ref">hours</p></li>
              <li class="seperator">:</li>
              <li>
                <span class="minutes">00</span>
                <p class="minutes_ref">minutes</p></li>
              <li class="seperator">:</li>
              <li>
                <span class="seconds">00</span>
                <p class="seconds_ref">seconds</p></li>
            </ul>
          </div>
          <!-- /row -->
          <!-- SORTABLE TO DO LIST --></section>
        <!-- --/wrapper ----></section>
      <!-- /MAIN CONTENT -->
      <!--main content end-->
      <!--footer start-->
      <!-- js placed at the end of the document so the pages load faster -->
      <script src="/ctf/assets/js/jquery.js"></script>
      <script src="/ctf/assets/js/bootstrap.min.js"></script>
      <script class="include" type="text/javascript" src="/ctf/assets/js/jquery.dcjqaccordion.2.7.js"></script>
      <script src="/ctf/assets/js/jquery.scrollTo.min.js"></script>
      <script src="/ctf/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
      <script src="/ctf/assets/jquery.magnific-popup.js" type="text/javascript"></script>
      <script type="text/javascript" src="/js/jquery.min.js"></script>
      <script type="text/javascript" src="/js/jquery.downCount.js"></script>
      <script type="text/javascript">$('.countdown').downCount({
          date: '<?php echo date('m/d/Y H:i:s',$ctf_start_time); ?>',
          offset: +8
        },
        function() {
          alert('倒计时结束!');
        });</script>
      <script>$(document).ready(function() {
          $('.popup-with-zoom-anim').magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
          });
        });</script>
      <!--common script for all pages-->
      <script class="include" type="text/javascript" src="/ctf/assets/js/jquery.backstretch.min.js"></script>
      <script src="/ctf/assets/js/common-scripts.js"></script>
      <!--script for this page-->
      <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
      <script src="/ctf/assets/js/tasks.js" type="text/javascript"></script>
      <script>jQuery(document).ready(function() {
          TaskList.initTaskWidget();
        });
        $(function() {
          $("#sortable").sortable();
          $("#sortable").disableSelection();
        });</script>
      <script>//custom select box
        $(function() {
          $('select.styled').customSelect();
        });</script>
      <script typet="text/javascript" src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>
      <script src="/ctf/build/toastr.min.js"></script>
      <script type="text/javascript">toastr.options.positionClass = 'toast-top-right';</script>
  </body>

</html>
