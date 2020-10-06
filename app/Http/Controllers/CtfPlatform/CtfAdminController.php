<?php

namespace App\Http\Controllers\CtfPlatform;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CtfAdminController extends Controller
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
            http_response_code(404);
            die('404 not found');
        }
    }

    /*
     * 显示主页面的相关信息
     */

    public function index(Request $request) {
        $this->isAdmin();
        $match_name = DB::table('matchs')->select('match_name')->where([['type','=','ctf'],['status','=','on']])->first();
        $tasknum = DB::table('ctf_task')->select('id')->count();
        $people = DB::table('users')->select('id')->count();
        $submit = DB::table('ctf_submit_flag')->select('id')->count();
        $scorep = DB::table('ctf_solved_task')->select('id')->count();
        $start_time = DB::table('ctf_time')->select('ctf_start_time')->first();
        $end_time = DB::table('ctf_time')->select('ctf_end_time')->first();
        return view('ctf.adminpage.index')->with(['match_name' => $match_name,'tasknum' => $tasknum, 'people' => $people, 'submit' => $submit, 'scorep' => $scorep, 'start_time' => $start_time,
            'end_time' => $end_time]);
    }

    public function seetask(Request $request) {
        $this->isAdmin();
        $task = DB::table('ctf_task')->get();
        return view('ctf.adminpage.task')->with('task', $task);
    }

    /*
     * 添加和修改题目，为了防止事故，题目默认隐藏
     */

    public function addtask(Request $request) {
        $this->isAdmin();
        if ($request->isMethod('get')) {
            return view('ctf.adminpage.addtask');
        } elseif ($request->isMethod('post')) {
            $taskname = htmlspecialchars($request->input('task_name'));
            $type = htmlspecialchars($request->input('type'));
            $score = htmlspecialchars($request->input('score'));
            $flag = htmlspecialchars($request->input('flag'));
            $taskdata = base64_encode(str_replace("\n",'</br>',htmlspecialchars($request->input('task_data'))));
            $success = DB::table('ctf_task')->insert(['task_name' => $taskname, 'type_task' => $type, 'task_data' => $taskdata, 'is_hide' => 'true', 'fb_student_id' => '', 'flag' => $flag, 'score' => $score, 'add_time' => date("Y-m-d H:i:s") ]);
            if ($success) {
                $mess = "添加成功";
            } else {
                $mess = "因为某些原因失败";
            }
            return view('ctf.jump')->with(['message' => $mess, 'url' => '/ctfadmin/task/add', 'jumpTime' => 2, ]);
        }
    }

    public function edittask(Request $request, $id) {
        $this->isAdmin();
        $task = DB::table('ctf_task')->where('id', $id)->get();
        if ($task) {
            if ($request->isMethod('get')) {
                return view('ctf.adminpage.edittask')->with('task', $task);
            } elseif ($request->isMethod('post')) {
                $taskname = htmlspecialchars($request->input('task_name'));
                $type = htmlspecialchars($request->input('type'));
                $score = htmlspecialchars($request->input('score'));
                $flag = htmlspecialchars($request->input('flag'));
                $taskdata = base64_encode(str_replace("\n",'</br>',htmlspecialchars($request->input('taskdata'))));
                $update_task_db = DB::table('ctf_task')->where('id', $id)->update(['task_name' => $taskname, 'type_task' => $type, 'task_data' => $taskdata, 'is_hide' => 'true', 'fb_student_id' => '', 'flag' => $flag, 'score' => $score, 'add_time' => date("Y-m-d H:i:s") ]);
                if ($update_task_db) {
                    $mess = "更新成功";
                } else {
                    $mess = "因为某些原因失败";
                }
                return view('ctf.jump')->with(['message' => $mess, 'url' => '/ctfadmin/task', 'jumpTime' => 0.5, ]);
            }
        } else {
            $mess = "不存在当前题目";
        }
        return view('ctf.jump')->with(['message' => $mess, 'url' => '/ctfadmin/task', 'jumpTime' => 1, ]);
    }

    public function hide(Request $request, $id) {
        $this->isAdmin();
        $success = DB::table('ctf_task')->where('id', $id)->update(['is_hide' => 'true']);
        if ($success) {
            $mess = "隐藏题目成功";
        } else {
            $mess = "因为某些原因失败";
        }
        $task = DB::table('ctf_task')->get();
        return view('ctf.adminpage.task')->with('task', $task);
    }

    public function open(Request $request, $id) {
        $this->isAdmin();
        $success = DB::table('ctf_task')->where('id', $id)->update(['is_hide' => 'false']);
        if ($success) {
            $mess = "开放题目成功";
        } else {
            $mess = "因为某些原因失败";
        }
        $task = DB::table('ctf_task')->get();
        return view('ctf.adminpage.task')->with('task', $task);
    }

    /*
     * 删除题目时要注意是否连同分数一并删除
     */

    public function delete(Request $request, $id) {
        $this->isAdmin();
        //删除题目的同时扣除用户的相应分数,但是保存题目的记录
        //查询所有用户的id和已解出的题目
        $user_solve = DB::table('ctf_solved_task')->select('student_id', 'task_id')->get()->toArray();
        //转化为一维数组
        $user_solve = array_column($user_solve, 'task_id', 'student_id');
        $task_now = DB::table('ctf_task')->where('id', $id)->first();
        //取出需要减去的分数
        $del_score = $task_now -> score;
        //检测删除的题目是否为用户已解题目
        foreach ($user_solve as $key => $value) {
            $solvd = json_decode($value, true);
            //若题目已解，则删除题目的同时扣除相应分数
            if (in_array($id, $solvd)) {
                $solvd = array_flip($solvd);
                unset($solvd[$id]);
                $solvd = array_flip($solvd);
                $solvd = json_encode($solvd);
                $del_score_DB = DB::table('ctf_solved_task')->where('student_id', $key)->decrement('score',$del_score,['task_id' => $solvd]);
            }
        }
        $del_task = DB::table('ctf_task')->where('id', $id)->delete();
        if ($del_score_DB && $del_task) {
            $mess = "删除题目成功";
        } else {
            $mess = "因为某些原因失败";
        }
        return view('ctf.jump')->with(['message' => $mess, 'url' => '/ctfadmin/task', 'jumpTime' => 1, ]);
    }

    public function notice(Request $request) {
        $this->isAdmin();
        if ($request->isMethod('get')) {
            $notice = DB::table('ctf_notice')->get();
            return view('ctf.adminpage.notice')->with('notice', $notice);
        } elseif ($request->isMethod('post')) {
            $noticedata = base64_encode(htmlspecialchars("  ".$request->input('noticedata')));
            $success = DB::table('ctf_notice')->insert(['notice_data' => $noticedata, 'add_time' => date("Y-m-d H:i:s") ]);
            if ($success) {
                $mess = "添加notice成功";
            } else {
                $mess = "因为某些原因失败";
            }
            return view('ctf.jump')->with(['message' => $mess, 'url' => '/ctfadmin/notice', 'jumpTime' => 2, ]);
        }
    }

    public function noticedelete(Request $request, $id) {
        $this->isAdmin();
        $success = DB::table('ctf_notice')->where('id', $id)->delete();
        if ($success) {
            $mess = "删除notice成功";
        } else {
            $mess = "因为某些原因失败";
        }
        return view('ctf.jump')->with(['message' => $mess, 'url' => '/ctfadmin/notice', 'jumpTime' => 1, ]);
    }

    public function noticeedit(Request $request, $id) {
        $this->isAdmin();
        $notice = DB::table('ctf_notice')->where('id', $id)->get();
        $success1 = DB::table('ctf_notice')->where('id', $id)->first();
        if ($success1) {
            if ($request->isMethod('get')) {
                return view('ctf.adminpage.editnotice')->with('notice', $notice);
            } elseif ($request->isMethod('post')) {
                $noticedata = htmlspecialchars($request->input('noticedata'));
                $success2 = DB::table('ctf_notice')->where('id', $id)->update(['notice_data' => base64_encode($noticedata) ]);
                if ($success2) {
                    $mess = "更新成功";
                } else {
                    $mess = "因为某些原因失败";
                }
                return view('ctf.jump')->with(['message' => $mess, 'url' => '/ctfadmin/notice', 'jumpTime' => 2, ]);
            }
        } else {
            $mess = "不存在当前公告";
        }
        return view('ctf.jump')->with(['message' => $mess, 'url' => '/ctfadmin/task', 'jumpTime' => 1, ]);
    }


    public function settime(Request $request) {
        $this->isAdmin();
        $start_time = $request->input('start_time');
        $patten = "/^\d{4}[\-](0?[1-9]|1[012])[\-](0?[1-9]|[12][0-9]|3[01])(\s+(0?[0-9]|1[0-9]|2[0-3])\:(0?[0-9]|[1-5][0-9])\:(0?[0-9]|[1-5][0-9]))?$/";
        if (preg_match ( $patten, $start_time)) {
            $start_time = (int)strtotime($start_time);
        } else {
            $mess = '开始时间不正确！';
            return view('ctf.jump')->with(['message' => $mess, 'url' => '/ctfadmin/home', 'jumpTime' => 1, ]);
        }
        $success_start = DB::table('ctf_time')->where('id', 1)->update(['ctf_start_time' => $start_time]);

        $end_time = $request->input('end_time');
        $patten = "/^\d{4}[\-](0?[1-9]|1[012])[\-](0?[1-9]|[12][0-9]|3[01])(\s+(0?[0-9]|1[0-9]|2[0-3])\:(0?[0-9]|[1-5][0-9])\:(0?[0-9]|[1-5][0-9]))?$/";
        if (preg_match ( $patten, $end_time)) {
            $end_time = (int)strtotime($end_time);
        } else {
            $mess = '结束时间不正确！';
            return view('ctf.jump')->with(['message' => $mess, 'url' => '/ctfadmin/home', 'jumpTime' => 1, ]);
        }
        $success_end = DB::table('ctf_time')->where('id', 1)->update(['ctf_end_time' => $end_time]);
        if ($success_start && $success_end) {
            $mess = "更改开始结束时间成功";
        } else {
            $mess = "更改开始结束时间成功！";
        }
        return view('ctf.jump')->with(['message' => $mess, 'url' => '/ctfadmin/home', 'jumpTime' => 1, ]);
    }


    public function hintadd(Request $request) {
        $this->isAdmin();
        if ($request->isMethod('get')) {
            $task = DB::table('ctf_task')->get();
            return view('ctf.adminpage.hint')->with('task', $task);
        } elseif ($request->isMethod('post')) {
            $taskname = $request->input('taskid');
            $taskdata = base64_encode(htmlspecialchars($request->input('hintdata')));
            $success = DB::table('ctf_hint')->insert(['task_id' => $taskname, 'hint_data' => $taskdata, 'add_time' => date("Y-m-d H:i:s") ]);
            if ($success) {
                $mess = "添加hint成功";
            } else {
                $mess = "因为某些原因失败";
            }
            return view('ctf.jump')->with(['message' => $mess, 'url' => '/ctfadmin/task/hint', 'jumpTime' => 2, ]);
        }
    }

    public function seeteam(Request $request) {
        $this->isAdmin();
        $team = DB::table('ctf_solved_task')->get();
        return view('ctf.adminpage.team')->with('team', $team);
    }

    public function editteam(Request $request, $student_id) {
        $this->isAdmin();
        $email = $student_id;
        $team = DB::table('ctf_solved_task')->where('student_id', $student_id)->get();
        $success1 = DB::table('ctf_solved_task')->where('student_id', $student_id)->first();
        if ($success1) {
            if ($request->isMethod('get')) {
                return view('ctf.adminpage.editteam')->with('team', $team);
            } elseif ($request->isMethod('post')) {
                $taskid = $request->input('taskid');
                $score = $request->input('score');
                $success2 = DB::table('ctf_solved_task')->where('student_id', $student_id)->update(['task_id' => $taskid, 'score' => $score]);
                if ($success2) {
                    $mess = "更新成功";
                } else {
                    $mess = "因为某些原因失败";
                }
                return view('ctf.jump')->with(['message' => $mess, 'url' => '/ctfadmin/team', 'jumpTime' => 2, ]);
            }
        } else {
            $mess = "不存在当前队伍";
        }
        return view('ctf.jump')->with(['message' => $mess, 'url' => '/ctfadmin/team', 'jumpTime' => 1, ]);
    }

    public function resetDatabase(Request $request) {
        $this->isAdmin();
        $reset_database_password = $request->input('reset_database_password');
        if($reset_database_password === '我确认重置'){
            
            DB::unprepared(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/../sql/ctf_Platform.sql'));
            $mess = "重置数据库成功";
            return view('ctf.jump')->with(['message' => $mess, 'url' => '/ctfadmin/home', 'jumpTime' => 1, ]);
        }else{
            $mess = "重置密码错误";
            return view('ctf.jump')->with(['message' => $mess, 'url' => '/ctfadmin/home', 'jumpTime' => 1, ]);
        }
    }

    

    public function changeMatchName(Request $request){
        $this->isAdmin();
        $match_name = htmlspecialchars($request->input('match_name'));
        $date = date("Y-m-d");
        $flag = DB::table('matchs')->where([['type','=','ctf']])->update(['match_name' => $match_name,'start_time'=> $date]);
        if($flag){
            $mess = "比赛名称更新成功";
            return view('ctf.jump')->with(['message' => $mess, 'url' => '/ctfadmin/home', 'jumpTime' => 1, ]);
        }else{
            $mess = "比赛名称更新失败";
            return view('ctf.jump')->with(['message' => $mess, 'url' => '/ctfadmin/home', 'jumpTime' => 1, ]);
        }
    }
}
