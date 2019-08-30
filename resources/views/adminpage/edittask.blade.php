@extends('adminpage.home')
@section('content')
@foreach($task as $taskdata)
<div class="tpl-page-container tpl-page-header-fixed">
    <div class="tpl-left-nav tpl-left-nav-hover">
    <div class="tpl-left-nav-title">Amaze UI 列表</div>
    <div class="tpl-left-nav-list">
        <ul class="tpl-left-nav-menu">
        <li class="tpl-left-nav-item">
            <a href="/ctfadmin/home" class="nav-link">
            <i class="am-icon-home"></i>
            <span>首页</span></a>
        </li>
        <li class="tpl-left-nav-item">
                <a href="/ctfadmin/task" class="nav-link tpl-left-nav-link-list">
                    <i class="am-icon-bars"></i>
                    <span>题目列表</span></a>
        </li>
        <li class="tpl-left-nav-item">
                <a href="/ctfadmin/task/edit" class="nav-link tpl-left-nav-link-list active">
                    <i class="am-icon-flag"></i>
                    <span>题目更新</span></a>
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
                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                </a>
            </li>
                <li>
                    <a href="/ctfadmin/notice" >
                        <i class="am-icon-angle-right"></i>
                        <span>相关公告</span></a>
                    <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li class="tpl-left-nav-item">
            <a href="login.html" class="nav-link tpl-left-nav-link-list">
            <i class="am-icon-key"></i>
            <span>登出</span></a>
        </li>
        </ul>
    </div>
    </div>
      <div class="tpl-content-wrapper">
        <div class="tpl-content-page-title">Edit Task</div>
        <ol class="am-breadcrumb">
          <li>
            <a href="#" class="am-icon-home">首页</a></li>
          
        <div class="tpl-portlet-components">
          <div class="portlet-title">
            <div class="caption font-green bold">
              <span class="am-icon-code"></span>题目更新</div>
          </div>
          <div class="tpl-block">
            <div class="am-g">
              <div class="tpl-form-body tpl-form-line">
                <form action="" class="am-form tpl-form-line-form" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-3 am-form-label">题目名称
                      <span class="tpl-form-line-small-title">taskname</span></label>
                    <div class="am-u-sm-9">
                      <input type="text" class="tpl-form-input" name="taskname" value="{{$taskdata -> taskname}}"></div>
                  </div>
                  <div class="am-form-group">
                    <label for="user-phone" class="am-u-sm-3 am-form-label">题目分类
                      <span class="tpl-form-line-small-title">tasktype</span></label>
                    <div class="am-u-sm-9">
                      <select name="type" data-am-selected="{searchBox: 1}">
                        <option value="web">WEB</option>
                        <option value="pwn">PWN</option>
                        <option value="misc">MISC</option>
                        <option value="re">RE</option>
                        <option value="crypto">CRYPTO</option></select>
                    </div>
                  </div>
                  <div class="am-form-group">
                    <label class="am-u-sm-3 am-form-label">题目分值
                      <span class="tpl-form-line-small-title">taskscore</span></label>
                    <div class="am-u-sm-9">
                      <input type="text" name="score" value="{{$taskdata -> score}}"></div>
                  </div>
                  <div class="am-form-group">
                    <label class="am-u-sm-3 am-form-label">题目flag
                      <span class="tpl-form-line-small-title">taskflag</span></label>
                    <div class="am-u-sm-9">
                      <input type="text" name="flag" value="{{$taskdata -> flag}}"></div>
                  </div>
                  <div class="am-form-group">
                    <label for="user-intro" class="am-u-sm-3 am-form-label">隐藏题目</label>
                    <div class="am-u-sm-9">
                      <div class="tpl-switch">
                        <input type="checkbox" name="check" class="ios-switch bigswitch tpl-switch-btn" checked />
                        <div class="tpl-switch-btn-view">
                          <div></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="am-form-group">
                    <label for="user-intro" class="am-u-sm-3 am-form-label">题目描述</label>
                    <div class="am-u-sm-9">
                      <textarea class="" rows="10" name="taskdata"><?php echo base64_decode($taskdata -> taskdata);?></textarea>
                    </div>
                  </div>
                  <div class="am-form-group">
                    <div class="am-u-sm-9 am-u-sm-push-3">
                      <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button></div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    @endsection
