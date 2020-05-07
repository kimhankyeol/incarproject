<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App;
use DateTime;
class ExecuteController extends Controller
{
    //잡 로그  tail add
    public function jobTailAdd(Request $request){
        $line = $request->input('line');
        $Job_Seq = $request->input('Job_Seq');
        $setNum = $request->input('setNum');
        $headTail = $request->input('headTail');
        $logSearchWord = $request->input('logSearchWord');

        //검색어가 없으면
        if($logSearchWord==""){
            //잡시퀀스를 통해 잡구성 정보 로그파일 이름 가져와야함 잡 테이블 ,잡구성 ,잡상태 모니터링 테이블에서 정보를 가져와야함 
            //로그파일은 job_업무대분류_업무중분류_잡시퀀스_잡실행날짜  job_1000_100_75_20200504.log
            $getJobInfo = DB::select('CALL JobExecute_getJobInfo(?)',[$Job_Seq]);
            //잡의 첫번쨰 프로그램이 실행될떄가 잡이 실행되는 시점
            if(!empty($getJobInfo)){
                
                //만약 상태모니터링 테이블에서 시작시간이 업데이트 된다하면 실행시간 다시 구해야됨
                $JobExecuteDate =  $getJobInfo[0]->JobSM_P_StartTime;
                //2020-05-05 02:20:20 - > 20200505 로 변환해야됨
                $JobExecuteDate = new DateTime($JobExecuteDate);
                $JobExecuteDate = $JobExecuteDate->format('Ymd');

                $WorkLarge =  $getJobInfo[0]->WorkLarge;
                $WorkMedium =  $getJobInfo[0]->WorkMedium;
                
                $logfilename = "job_".$WorkLarge."_".$WorkMedium."_".$Job_Seq."_".$JobExecuteDate.".log";
                $logfile = "/home/script/log/".$JobExecuteDate."/job_".$WorkLarge."_".$WorkMedium."_".$Job_Seq."_".$JobExecuteDate.".log";
                $lineTotal = shell_exec("wc -l ".$logfile); 
                $lineTotal = explode(" ",$lineTotal)[0];
                $fileSize = filesize($logfile);
                $lastmod = date("Y.m.d H:i:s", filemtime($logfile));

                // 로그 더보기 라인 갯수가 로그 라인 토탈을 초과하면 안되기 떄문에 분기처리 해줘야함
                if($lineTotal<=$line){
                    $msg = "lineExcess";
                    $returnHTML = view('job.execute.jobTailAddView',compact('line','Job_Seq','JobExecuteDate','WorkLarge','WorkMedium','logfile','lineTotal','msg','setNum','fileSize','headTail','lastmod','logfilename'))->render();
                    return response()->json(array('returnHTML'=>$returnHTML,'lineTotal'=>$lineTotal ),200);
                }else if($lineTotal>$line){
                    $msg = "success";
                    $returnHTML = view('job.execute.jobTailAddView',compact('line','Job_Seq','JobExecuteDate','WorkLarge','WorkMedium','logfile','lineTotal','msg','setNum','fileSize','headTail','lastmod','logfilename'))->render();
                    return response()->json(array('returnHTML'=>$returnHTML,'lineTotal'=>$lineTotal ),200);
                }
            }else{
                // 잡실행을 누른뒤에 상태모니터링 테이블에 정보가 저장되니 프로시저 조회한 값이 없으면 잡실행에 등록이 안된것임
                $msg = "notExec";
                $returnHTML = view('job.execute.jobTailAddView',compact('msg'))->render();
                return response()->json(array('returnHTML'=>$returnHTML ),200);
            }
        }else{
            //검색어가 있으면

            //잡시퀀스를 통해 잡구성 정보 로그파일 이름 가져와야함 잡 테이블 ,잡구성 ,잡상태 모니터링 테이블에서 정보를 가져와야함 
            //로그파일은 job_업무대분류_업무중분류_잡시퀀스_잡실행날짜  job_1000_100_75_20200504.log
            $getJobInfo = DB::select('CALL JobExecute_getJobInfo(?)',[$Job_Seq]);
            //잡의 첫번쨰 프로그램이 실행될떄가 잡이 실행되는 시점
            if(!empty($getJobInfo)){
                
                //만약 상태모니터링 테이블에서 시작시간이 업데이트 된다하면 실행시간 다시 구해야됨
                $JobExecuteDate =  $getJobInfo[0]->JobSM_P_StartTime;
                //2020-05-05 02:20:20 - > 20200505 로 변환해야됨
                $JobExecuteDate = new DateTime($JobExecuteDate);
                $JobExecuteDate = $JobExecuteDate->format('Ymd');

                $WorkLarge =  $getJobInfo[0]->WorkLarge;
                $WorkMedium =  $getJobInfo[0]->WorkMedium;
                
                $logfilename = "job_".$WorkLarge."_".$WorkMedium."_".$Job_Seq."_".$JobExecuteDate.".log";
                $logfile = "/home/script/log/".$JobExecuteDate."/job_".$WorkLarge."_".$WorkMedium."_".$Job_Seq."_".$JobExecuteDate.".log";
                $lineTotal = shell_exec("grep -o ".$logSearchWord." ".$logfile."| wc -w");
                $lineTotal = explode(" ",$lineTotal)[0];
                $fileSize = filesize($logfile);      
            
                $lastmod = date("Y.m.d H:i:s", filemtime($logfile));

                // 로그 더보기 라인 갯수가 로그 라인 토탈을 초과하면 안되기 떄문에 분기처리 해줘야함
                if($lineTotal<=$line){
                    $msg = "lineExcess";
                    $returnHTML = view('job.execute.jobTailAddView',compact('line','Job_Seq','JobExecuteDate','WorkLarge','WorkMedium','logfile','lineTotal','msg','setNum','fileSize','headTail','lastmod','logfilename','logSearchWord'))->render();
                    return response()->json(array('returnHTML'=>$returnHTML,'lineTotal'=>$lineTotal ),200);
                }else if($lineTotal>$line){
                    $msg = "success";
                    $returnHTML = view('job.execute.jobTailAddView',compact('line','Job_Seq','JobExecuteDate','WorkLarge','WorkMedium','logfile','lineTotal','msg','setNum','fileSize','headTail','lastmod','logfilename','logSearchWord'))->render();
                    return response()->json(array('returnHTML'=>$returnHTML,'lineTotal'=>$lineTotal ),200);
                }
            }else{
                // 잡실행을 누른뒤에 상태모니터링 테이블에 정보가 저장되니 프로시저 조회한 값이 없으면 잡실행에 등록이 안된것임
                $msg = "notExec";
                $returnHTML = view('job.execute.jobTailAddView',compact('msg'))->render();
                return response()->json(array('returnHTML'=>$returnHTML ),200);
            }
        }
        
    }
}