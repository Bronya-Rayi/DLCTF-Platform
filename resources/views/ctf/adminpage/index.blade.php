@extends('ctf.adminpage.home')
@section('content')
<div class="tpl-page-container tpl-page-header-fixed">
    <div class="tpl-left-nav tpl-left-nav-hover">
    <div class="tpl-left-nav-title">功能列表</div>
    <div class="tpl-left-nav-list">
        <ul class="tpl-left-nav-menu">
        <li class="tpl-left-nav-item">
            <a href="/ctfadmin/home" class="nav-link active">
            <i class="am-icon-home"></i>
            <span>首页</span></a>
        </li>
        <li class="tpl-left-nav-item">
                <a href="/ctfadmin/task" class="nav-link tpl-left-nav-link-list ">
                    <i class="am-icon-bars"></i>
                    <span>题目列表</span></a>
        </li>

        <li class="tpl-left-nav-item">
                <a href="/ctfadmin/team" class="nav-link tpl-left-nav-link-list ">
                    <i class="am-icon-group"></i>
                    <span>队伍信息</span></a>
        </li>
        <li class="tpl-left-nav-item">
                <a href="/ctfadmin/task/add" class="nav-link tpl-left-nav-link-list">
                    <i class="am-icon-flag"></i>
                    <span>题目添加</span></a>
        </li>


        <li class="tpl-left-nav-item">
            <!-- 打开状态 a 标签添加 active 即可 -->
            <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
            <i class="am-icon-wpforms"></i>
            <span>Notice</span>
            <!-- 列表打开状态的i标签添加 tpl-left-nav-more-ico-rotate 图表即90°旋转 -->
            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
            </a>
            <!-- 打开状态 添加 display:block-->
            <ul class="tpl-left-nav-sub-menu">
            <li>
                <a href="/ctfadmin/task/hint" >
                <i class="am-icon-angle-right"></i>
                <span>题目hint</span>
                </a>
            </li>
            <li>
                <a href="/ctfadmin/notice" >
                <i class="am-icon-angle-right"></i>
                <span>相关公告</span></a>

            </a>
            </li>
            </ul>
        </li>
        <li class="tpl-left-nav-item">
            <a href="/" class="nav-link tpl-left-nav-link-list">
            <i class="am-icon-home"></i>
            <span>CTF主页</span></a>
        </li>
        <li class="tpl-left-nav-item">
            <a href="/logout" class="nav-link tpl-left-nav-link-list">
            <i class="am-icon-key"></i>
            <span>登出</span></a>
        </li>
        </ul>
    </div>
    </div>
<div class="tpl-content-wrapper">
    <div class="tpl-content-page-title">
       Manage CTF
    </div>
    <ol class="am-breadcrumb">
        <li><a href="#" class="am-icon-home">Manage</a></li>
        <li><a href="#">CTF</a></li>

    </ol>


    <div class="row">
        <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
            <div class="dashboard-stat blue">
                <div class="visual">
                    <i class="am-icon-comments-o"></i>
                </div>
                <div class="details">
                    <div class="number"> {{$tasknum}} </div>
                    <div class="desc"> 题目 </div>
                </div>
                <a class="more" href="/ctfadmin/task">
            <i class="m-icon-swapright m-icon-white"></i>
        </a>
            </div>
        </div>
        <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
            <div class="dashboard-stat red">
                <div class="visual">
                    <i class="am-icon-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number"> {{$people}} </div>
                    <div class="desc"> 注册人数 </div>
                </div>
                <a class="more" href="/ctfadmin/team">
            <i class="m-icon-swapright m-icon-white"></i>
        </a>
            </div>
        </div>
        <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
            <div class="dashboard-stat green">
                <div class="visual">
                    <i class="am-icon-apple"></i>
                </div>
                <div class="details">
                    <div class="number"> {{$submit}} </div>
                    <div class="desc"> 提交flag次数 </div>
                </div>
                <a class="more" href="#">
            <i class="m-icon-swapright m-icon-white"></i>
        </a>
            </div>
        </div>
        <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
            <div class="dashboard-stat purple">
                <div class="visual">
                    <i class="am-icon-android"></i>
                </div>
                <div class="details">
                    <div class="number"> {{$scorep}} </div>
                    <div class="desc"> 得分人数 </div>
                </div>
                <a class="more" href="#">
            <i class="m-icon-swapright m-icon-white"></i>
        </a>
            </div>
        </div>



    </div>
    <div class="am-g">
        <div class="am-u-md-6">
            <div class="am-panel am-panel-default">
                <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">比赛时间设置<span class="am-icon-chevron-down am-fr"></span></div>
                <div class="am-panel-bd am-collapse am-in" id="collapse-panel-1" style="">
                    <ul class="am-list admin-content-file">
                        <li>
                            <h3>设定比赛时间<span class="close" data-close="note"></span></h3>
                            <p>现在比赛开始时间为：<?php echo date("Y-m-d H:i:s",$start_time->ctf_start_time); ?></p>
                            <p><span class="label label-danger">提示:</span> 时间格式为 Y-m-d H:i:s</p>
                            <p>设定比赛开始时间</p>
                            <form action="/ctfadmin/settime/">
                                <input type="text" name="start_time" value="2019-1-1 1:1:1">
                                <p>现在比赛结束时间为：<?php echo date("Y-m-d H:i:s",$end_time->ctf_end_time); ?></p>
                                <p><span class="label label-danger">提示:</span> 时间格式为 Y-m-d H:i:s</p>
                                <p>设定比赛结束时间</p>
                                <input type="text" name="end_time" value="2033-1-1 1:1:1">
                                <input type="submit" value="set">
                            </form>
                        </li>

                    </ul>
                </div>
            </div>

        </div>

        <div class="am-u-md-6">
            <div class="am-panel am-panel-default">
                <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">比赛数据管理<span class="am-icon-chevron-down am-fr"></span></div>
                <div class="am-panel-bd am-collapse am-in" id="collapse-panel-1" style="">
                    <ul class="am-list admin-content-file">
                        <li>
                            <p><h3>当前比赛名称为&nbsp;:&nbsp;<code>{{$match_name->match_name}}</code></h3></p>
                        </li>
                        <li>
                        <form action="/ctfadmin/changeMatchName" method="post">
                            @csrf
                            <input type="submit" value="修改当前比赛名称">
                            <input type="text" name="match_name" value="{{$match_name->match_name}}" >
                        </form>
                        </li>
                        <li>
                            <form action="/ctfadmin/resetDatabase" method="post">
                                @csrf
                                <input type="submit" value="一键重置数据库">
                                <input type="text" name="reset_database_password" placeholder="请输入：我确认重置" >
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="tpl-content-scope">
        <div class="note note-info">
            <h3>基于Laravel 6的轻量CTF平台
                <span class="close" data-close="note"></span>
            </h3>
            <p> By sdpc@DL&S</p>
            
            </p>


        </div>

@endsection
