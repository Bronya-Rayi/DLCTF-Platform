<?php

namespace App\Http\Controllers\CtfPlatform;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CtfController extends Controller
{
    public $is_admin = false;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function isAdmin()
    {
        if(Auth::user()->student_id === '00000001'){
            $this->is_admin = true;
        }
        else
        {
            $this->is_admin = false;
        }
    }

    /*
     * 跳转仪表盘
     */

    public function index(Request $request) {
        //登记用户的情况到solvedtask表，防止出现0分用户不在排行榜上的情况
        if (Auth::check()) {
            $user_solve = DB::table('ctf_solved_task')->where('student_id', Auth::user()->student_id)->first();
            if ($user_solve == NULL) {
                DB::table('ctf_solved_task')->insert(['student_id' => Auth::user()->student_id, 'score' => '0', 'task_id' => '[""]', 'add_time' => date("Y-m-d H:i:s"),'name' => Auth::user()->name ]);
            }
        }
        return view('ctf.index');
    }

    /*
     * 用于判断比赛是否已经到达开始时间，显示用户已做完和未做完的题目，题目hint
     */

    public function challenges(Request $request) {

        $match_name = DB::table('matchs')->select('match_name')->where([['type','=','ctf'],['status','=','on']])->first()->match_name;
        //首先判断是否为比赛开始时间
        $ctf_start_time = DB::table('ctf_time')->select('ctf_start_time')->first();
        $ctf_end_time = DB::table('ctf_time')->select('ctf_end_time')->first();
        //这里没设置时区，所以加了8*60*60
        if(time()+8*60*60 >= $ctf_start_time->ctf_start_time && time()+8*60*60 <= $ctf_end_time->ctf_end_time){
            //将查询到的非隐藏的题目对象导入变量
            $visible_task = DB::table('ctf_task')->where('is_hide', '=', 'false')->get();
            //获取当前用户已经解答的题目
            $user_solved = DB::table('ctf_solved_task')->where('student_id', '=',Auth::user()->student_id)->first();
            if ($user_solved != NULL)
            {
                //$user_solved_array存储用户解出题目序号的数组
                $user_solved_array = json_decode($user_solved->task_id, true);
            } else
                {
                $user_solved_array = array();
                }
            //降序排列获取详细的hint信息，供题目中显示用
            $hint = DB::table('ctf_hint')->join('ctf_task', 'ctf_hint.task_id', '=', 'ctf_task.id')->select('ctf_hint.*', 'ctf_task.task_name')->orderBy('add_time', 'desc')->get();
            //获取所有有提示的题目id，生成数组，供视图中hint标志显示用
            $is_hint_task = DB::table('ctf_hint')->pluck('task_id')->toArray();
            return view('ctf.challenge')->with(['visible_task' => $visible_task, 'solved' => $user_solved_array, 'hint' => $hint, 'is_hint_task' => $is_hint_task,'match_name' => $match_name]);
        }
        elseif(time()+8*60*60 <= $ctf_end_time->ctf_end_time) {
            //若不到比赛开始时间，则跳转到比赛倒计时页面
            return view('ctf.un_challenge')->with(['ctf_start_time' => $ctf_start_time->ctf_start_time , 'ctf_end_time' => $ctf_end_time->ctf_end_time]);}

        else{
            //比赛结束，跳转到比赛结束页面
            return view('ctf.end_challenge');}
    }

    public function score(Request $request) {
        $match_name = DB::table('matchs')->select('match_name')->where([['type','=','ctf'],['status','=','on']])->first()->match_name;
        //用户已解出的题目，按照分数降序排列，分数相同的按照提交时间升序排列
        $user_solve = DB::table('ctf_solved_task')->orderBy('score', 'desc')->orderBy('add_time','asc')->get();
        //所有题目列表
        $task_list = DB::table('ctf_task')->where('is_hide','false')->get();
        return view('ctf.score')->with(['ranklist' => $user_solve, 'task' => $task_list,'match_name' => $match_name]);
    }

    public function about(Request $request) {
        return view('ctf.about');
    }

    public function notice(Request $request) {
        $notice = DB::table('ctf_notice')->get();
        return view('ctf.notice')->with(['notice' => $notice]);
    }

    public function submitflag(Request $request) {
        $submitflag = $request->input('flag');
        $id = $request->input('id');
        //获取数据库中存储的flag
        $flag = DB::table('ctf_task')->where('id', $id)->first();
        if ($flag->flag === $submitflag) {
            if ($flag->fb_student_id == '') {
                DB::table('ctf_task')->where('id', $id)->update(['fb_student_id' => Auth::user()->student_id]);
            }
            //添加用户解出题目的记录，并计算分数
            $user_solve = DB::table('ctf_solved_task')->where('student_id',Auth::user()->student_id)->first();
            if ($user_solve != NULL) {
                //返回数组，内容为用户已解的题目id
                $solved = json_decode($user_solve->task_id, true);
                if (!in_array($id, $solved)) {
                    //将当前解出题目的id添加进记录
                    $newarr = array_merge($solved, array($id));
                    $new_json = json_encode($newarr);

                    //记录提交的flag
                    DB::table('ctf_submit_flag')->insert(['student_id' => Auth::user()->student_id, 'task_id' => $id, 'check_status' => 1, 'add_time' => date("Y-m-d H:i:s")]);
                    DB::table('ctf_solved_task')->where('student_id', Auth::user()->student_id)->increment('score', $flag->score, ['task_id' => $new_json, 'add_time' => date("Y-m-d H:i:s")]);
                    echo '1';
                } //以下是重复提交的情况
                else {
                    DB::table('ctf_submit_flag')->insert(['student_id' => Auth::user()->student_id, 'task_id' => $id, 'check_status' => 2, 'add_time' => date("Y-m-d H:i:s")]);
                    echo '2';
                }
            } else {

                $flagarray = array(
                    $id
                );
                $flagjson = json_encode($flagarray);
                DB::table('ctf_submit_flag')->insert(['student_id' => Auth::user()->student_id, 'task_id' => $id, 'check_status' => 1, 'add_time' => date("Y-m-d H:i:s")]);
                DB::table('ctf_solved_task')->where('student_id', Auth::user()->student_id)->increment('score', $flag->score, ['task_id' => $flagjson, 'add_time' => date("Y-m-d H:i:s")]);
                echo '1';
            }
        }
        //如果flag不对的话
        else {
            DB::table('ctf_submit_flag')->insert(['student_id' => Auth::user()->student_id, 'task_id' => $id, 'check_status' => 0, 'add_time' => date("Y-m-d H:i:s")]);
            echo '0';
        }
    }

    public function resetPassword(Request $request)
    {
          $rules = [
            'old_password'=>'required',
            'new_password'=>'required|between:8,20|confirmed',
          ];
          $msg = [
            'required'=>'密码不能为空！',
            'new_password.between'=>'密码必须在8~20位之间！',
            'new_password.confirmed'=>'新密码与确认密码不一致！',
          ];
          $validator = Validator::make($request->all(),$rules,$msg);
          if ($validator->passes()) {
              if(!Hash::check($request->input('old_password'),Auth::user()->password)){
                return view('ctf.jump')->with(['message' => "旧密码不正确！", 'url' => '/team', 'jumpTime' => 2, ]);
              }
              $user=Auth::user();
              $user->password=Hash::make($request->input('new_password'));
              $user->save();
              return view('ctf.jump')->with(['message' => "修改密码成功！", 'url' => '/team', 'jumpTime' => 2, ]);
          }else{
            return view('ctf.team')->withErrors($validator);
          }
  
    }

}
