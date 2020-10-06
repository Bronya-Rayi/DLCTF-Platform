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
          <b>DLCTF-Plat--{{$match_name}}</b>
        </a>
        <!--logo end-->
        </header><aside>
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
                  <a href="/challenges/web">
                    <div class="task-info">
                      <div class="desc">Web</div></div>
                  </a>
                </li>
                <li>
                  <a href="/challenges/pwn">
                    <div class="task-info">
                      <div class="desc">Pwn</div></div>
                  </a>
                </li>
                <li>
                  <a href="/challenges/re">
                    <div class="task-info">
                      <div class="desc">Re</div></div>
                  </a>
                </li>
                <li>
                  <a href="/challenges/misc">
                    <div class="task-info">
                      <div class="desc">Misc</div></div>
                  </a>
                </li>
                <li>
                  <a href="/challenges/crypto">
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
          <div class="row mt">
            <div class="col-lg-12">
              <div class="row">@foreach($visible_task as $visible_task_info) @if($visible_task_info->is_hide == 'true')
                <?php continue;?>@else
                  <div class="col-lg-4 col-md-4 col-sm-4 mb">@php if(in_array($visible_task_info->id,$solved)){ echo '
                    <div class="ctf-success pn centered popup-with-zoom-anim" data-toggle="modal" data-target="#myModal'.$visible_task_info->id.'">
                      <i class="fa fa-flag fa-spin"></i>';}else{ if($visible_task_info->type_task === 'web'){ echo '
                      <div class="web-color pn centered popup-with-zoom-anim" data-toggle="modal" data-target="#myModal'.$visible_task_info->id.'">
                        <i class="fa fa fa-pencil"></i>';} elseif($visible_task_info->type_task === 're'){ echo '
                        <div class="re-color pn centered popup-with-zoom-anim" data-toggle="modal" data-target="#myModal'.$visible_task_info->id.'">
                          <i class="fa fa fa-pencil"></i>'; } elseif($visible_task_info->type_task === 'pwn'){ echo '
                          <div class="pwn-color pn centered popup-with-zoom-anim" data-toggle="modal" data-target="#myModal'.$visible_task_info->id.'">
                            <i class="fa fa fa-pencil"></i>'; } elseif($visible_task_info->type_task === 'misc'){ echo '
                            <div class="misc-color pn centered popup-with-zoom-anim" data-toggle="modal" data-target="#myModal'.$visible_task_info->id.'">
                              <i class="fa fa fa-pencil"></i>'; } elseif($visible_task_info->type_task === 'crypto'){ echo '
                              <div class="crypto-color pn centered popup-with-zoom-anim" data-toggle="modal" data-target="#myModal'.$visible_task_info->id.'">
                                <i class="fa fa fa-pencil"></i>'; } }@endphp
                                <h1>{{$visible_task_info->score}}PTS</h1>
                                <div class="info">
                                  <div class="row">
                                    <h3 class="centered">{{$visible_task_info->task_name}}</h3>
                                    <div class="col-sm-6 col-xs-6 pull-left">@php if(in_array($visible_task_info->id,$is_hint_task)) echo '
                                      <p class="goleft">
                                        <font color="#FF0000">
                                          <i class="fa fa-bullhorn"></i>Hint</font></p>';@endphp</div>
                                    <div class="col-sm-6 col-xs-6 pull-right">
                                      <p class="goright">
                                        <i class="fa fa-flag"></i>@php echo $visible_task_info->solved_number; @endphp solved</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>@endif @endforeach
                            @foreach($visible_task ?? '' as $visible_task_info)
                            <div>
                              <div class="modal fade" id="myModal{{$visible_task_info->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                      <h4 class="modal-title" id="myModalLabel">{{$visible_task_info->task_name}}</h4></div>
                                    <div class="modal-body">
                                      <div>
                                        <h4>Task: @php echo base64_decode($visible_task_info->task_data); @endphp</h4></div>
                                      <div>
                                        <hr style="height:5px;border:none;border-top:5px groove skyblue;" />
                                        <h4>@foreach($hint as $hint_info) @if($hint_info->task_id == $visible_task_info->id) Hint:
                                          <code>{{$hint_info->add_time}}:@php echo base64_decode($hint_info->hint_data);@endphp</code>@endif @endforeach</h4></div>
                                    </div>
                                    <div class="modal-footer">
                                      <div class="form-inline">
                                        <div class="form-group">
                                          <input id="flag{{$visible_task_info->id}}" name="flag" type="text" placeholder="flag" class="form-control" />
                                          <input id="id{{$visible_task_info->id}}" type="hidden" name="id" value="{{$visible_task_info->id}}" />
                                          <a id="login_btn{{$visible_task_info->id}}" class="btn btn-primary">Submit</a></div>
                                      </div>
                                    </div>
                                    </div>
                                  </div>
                                </div>
                              </div>@endforeach
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
      <script type="text/javascript">
        function register(i) {
          $("#login_btn" + i).click(function() {
            var flag = $.trim($("#flag" + i).val());
            var id = $.trim($("#id" + i).val());
            var data = {
              _token: "{{csrf_token()}}",
              flag: flag,
              id: id
            };
            $.ajax({
              type: "POST",
              url: "/flag/submit",
              data: data,
              success: function(msg) {
                if (msg == 1) {
                  toastr.success('Right flag:)');
                } else if (msg == 2) {
                  toastr.warning('Already submit!');
                } else {
                  toastr.error('Wrong flag:(');
                }
              }
            });
          });
        }
        $(function() {
          for (var i = 0; i < 50; i++) {
            register(i)
          };
        })
      </script>
  </body>

</html>
