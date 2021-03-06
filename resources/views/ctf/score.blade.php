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
    <script src="/ctf/assets/js/chart-master/Chart.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--></head>

<body onload="getTime()">
<section id="container">
    <!-- ********************************************************************************************************************************************************** TOP BAR CONTENT & NOTIFICATIONS *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <a href="/home" class="logo">
            <b>DLCTF-Platform</b>
        </a>
        <!--logo end--></header>
    <!--header end-->
    <!-- ********************************************************************************************************************************************************** MAIN SIDEBAR MENU *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
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
                    <a  href="/home">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="sub-menu">
                    <a href="/challenges">
                        <i class="fa fa-flag"></i>
                        <span>Challenges</span></a>
                </li>
                <li class="sub-menu">
                    <a href="/notice">
                        <i class="fa fa-gift"></i>
                        <span>Notice</span></a>
                </li>
                <li class="sub-menu">
                    <a class="active" href="/scoreboard">
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
              <li class="sub-menu"> <a href="/logout"> <i class=" fa fa-sign-out"></i> <span>Logout</span> </a> </li>'; }?>
            </ul>
            <!-- sidebar menu end--></div>
    </aside>

    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Scoreboard--<code>{{$match_name}}</code></h3>
            <div class="row">

                <div class="col-lg-12">
                    <div class="content-panel">
                        <div class="card-header">
                            <h4>Rank Page </h4>
                            <div class="card-header-right-icon">
                                <ul>
                                    <li class="card-close" data-dismiss="alert"><i class="ti-close"></i></li>
                                    <li class="card-option drop-menu"><i class="ti-settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                        <ul class="card-option-dropdown dropdown-menu">
                                            <li><a href="#"><i class="ti-loop"></i> Update data</a></li>
                                            <li><a href="#"><i class="ti-menu-alt"></i> Detail log</a></li>
                                            <li><a href="#"><i class="ti-pulse"></i> Statistics</a></li>
                                            <li><a href="#"><i class="ti-power-off"></i> Clear ist</a></li>
                                        </ul>
                                    </li>
                                    <li class="doc-link"><a href="#"><i class="ti-link"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center" width='70'>rank</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th class="text-center" >Score</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ranklist as $rank)
                                    <tr>
                                        <td class="text-center" width="70">{{$loop->index+1}}</td>
                                        <td width="150">{{$rank->name}}</td>
                                        <td>
                                        @php $taskli=json_decode($rank->task_id,true);@endphp
                                        @foreach($task as $taskid)
                                            @php if(in_array($taskid->id,$taskli)){
                                             if($rank->student_id == $taskid->fb_student_id){
                                             echo '<font color="#68dff0"><i title="'.$taskid->task_name.'" class="fa fa-circle"></i></font>';}else{
                                               echo '<i title="'.$taskid->task_name.'" class="fa fa-circle"></i> ';}}else{
                                               echo '<i title="'.$taskid->task_name.'"class="fa fa-circle-o"></i> ';}
                                            @endphp
                                        @endforeach

                                        <td class="text-center" width="100">{{$rank->score}}</td>

                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- /# column -->

            </div><!-- /# row -->     </div>



        </section><! --/wrapper -->
    </section>
    <!-- /container -->
    <!--main content end-->
    <!--footer start-->
    <!--footer end-->
    <!--main content end-->
    <!--footer start-->
    <!--footer end--></section>
</section>
<!-- js placed at the end of the document so the pages load faster -->
<script class="include" type="text/javascript" src="/ctf/assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="/ctf/assets/js/jquery.scrollTo.min.js"></script>
<script src="/ctf/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
<!--common script for all pages-->
<script src="/ctf/assets/js/common-scripts.js"></script>
<script src="/ctf/assets/js/jquery.js"></script>
<script src="/ctf/assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="/ctf/assets/js/jquery.backstretch.min.js"></script>
</body>

</html>
