<?php
//분기 처리 해주는 php 위치 
$ifViewRender = new App\Http\Controllers\Render\IfViewRender;
$ifViewRender->setRenderInfo($_SERVER['REQUEST_URI']);
//include 될 blade.php 의 경로 + 파일명을 가져옴
//title 변경 스크립트  common/head.blade 쓰이는 변수 
$titleInfo  = $ifViewRender->getHtmlTitle();
//url 에따른 resource 변경 추가 할떄   common/head.blade 쓰이는 변수 
$resourceInfo = $ifViewRender->getResource();
//사이드바 정보   common/sidebar.blade
$sidebarInfo = $ifViewRender->getSidebarArray();
?>
<!DOCTYPE html>
<html lang="en">
@include('common.head')
<body id="page-top">
  <div id="wrapper">
    {{-- 블레이드 주석 쓰는 법--}}
    {{--사이드바 시작--}}
    @include('common.sidebar')
    {{--사이드바 끝--}}
    {{--content 시작--}}
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">스케줄 등록</h5>
                        <input id="P_RegIp" type="hidden" value="{{$_SERVER["REMOTE_ADDR"]}}"/>
                        <input id="P_RegId" type="hidden" value="이수연"/>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 text-center align-self-center font-weight-bold text-primary">잡 Id</div>
                            <input id="jobSc_id" type="text" class="col-md-2 form-control form-control-sm align-self-center" readonly>
                            <div class="input-group-append">
                                <div class="btn btn-primary" onclick="pageMove.jobpopup.list('jobSearchView')">
                                <i class="fas fa-search fa-sm"></i>
                                </div>
                            </div>
                            <div class="col-md-2 text-center align-self-center font-weight-bold text-primary mt-2">잡 명</div>
                            <input id = "jobSc_name" type="text" class="col-md-5 form-control form-control-sm mt-2" readonly>
                        </div>
                        <hr>
                        <div class="row">
                            {{-- <div class="col-md-2 text-center align-self-center font-weight-bold text-primary">스케줄 번호</div>
                            <input type="text" class="col-md-3 form-control form-control-sm align-self-center" placeholder="프로그램 명" readonly> --}}
                            <div class="col-md-2 text-center align-self-center font-weight-bold text-primary mt-2">스케줄 설명</div>
                            <input id="Sc_Sulmyung" type="text" class="col-md-3 form-control form-control-sm mt-2" placeholder="스케줄 설명">
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <fieldset class="cistp-fieldset">
                                <legend>실행주기</legend>
                                <div class="d-inline-table  col-md-2 right-line">
                                    <label class="w-100 text-center">
                                        <input id="Oneday" type="radio" class="mr-3" name="runCycle" value="1" checked="checked" onchange="handler()"> 한번
                                    </label>
                                    <hr>
                                    <label class="w-100 text-center">
                                        <input id="Everyday" type="radio" class="mr-3" name="runCycle" value="2" onchange="handler()"> 매일
                                    </label>
                                    <hr>
                                    <label class="w-100 text-center">
                                        <input id="Everyweek" type="radio" class="mr-3" name="runCycle" value="3" onchange="handler()"> 매주
                                    </label>
                                    <hr>
                                    <label class="w-100 text-center">
                                        <input id="Everymonth" type="radio" class="mr-3" name="runCycle" value="4" onchange="handler()"> 매월
                                    </label>
                                    <hr>
                                    <label class="w-100 text-center">
                                        <input id="Everyyear" type="radio" class="mr-3" name="runCycle" value="5" onchange="handler()"> 매년
                                    </label>
                                </div>
                                <div class="d-inline-table col-md-8">
                                    <div class="d-inline-flex w-100  align-items-center form-control-sm" id="StartTime">
                                        시작 시간 : 
                                        
                                        <input id="startdate" type="date" class="form-control col-md-3" value="{{date("Y-m-d")}}">
                                        <input id="starttime" type="time" class="form-control col-md-3" value="{{date("H:i")}}">
            
                                    </div>
                                    <div class="d-inline-flex w-100  align-items-center"></div>
                                    {{-- 분기 처리 --}}
                                    {{-- 밑의 주석 부분 지우는 코드 아님, 분기처리 할 코드임 --}}
                                        {{-- 매일 --}}
                                        <div class="d-inline-flex w-100  align-items-center">
                                            <label class="Day">
                                                매
                                            </label>
                                            <label class="Day">   
                                                <input id="Day" type="text" class="col-md-10 form-control form-control-sm Day">
                                            </label>
                                            <label class="Day">
                                                일 마다
                                            </label>
                                            {{-- 매주 --}}
                                            <label class="week">
                                                <div class="col-md-5 ml-auto Action">주마다 다음 요일에 :</div>
                                            </label>
                                        </div>
                                        
                                        {{-- 매주 --}}
                                        <div class="d-inline-flex w-100  align-items-center">
                                            <label class="mr-3 week">
                                                <input name="yoil" type="checkbox" class="mr-1 week" value="0"> 일요일
                                            </label>
                                            <label class="mr-3 week">
                                                <input name="yoil" type="checkbox" class="mr- week" value="1"> 월요일
                                            </label>
                                            <label class="mr-3 week">
                                                <input name="yoil"  type="checkbox" class="mr- week" value="2"> 화요일
                                            </label>
                                            <label class="mr-3 week">
                                                <input name="yoil"  type="checkbox" class="mr- week" value="3"> 수요일
                                            </label>
                                            <label class="mr-3 week">
                                                <input name="yoil"  type="checkbox" class="mr- week" value="4"> 목요일
                                            </label>
                                            <label class="mr-3 week">
                                                <input name="yoil"  type="checkbox" class="mr- week" value="5"> 금요일
                                            </label>
                                            <label class="mr-3 week">
                                                <input name="yoil"  type="checkbox" class="mr-1 week" value="6"> 토요일
                                            </label>
                                        </div>
                                        {{-- 매월 --}}
                                        <div class="d-inline-flex w-100  align-items-center">
                                            <label class="month">
                                                매월
                                            </label>
                                            <label class="month"> 
                                                <select class="col-md-10 form-control form-control-sm ml-3">
                                                    <option>1</option><option>2</option><option>3</option>
                                                    <option>4</option><option>5</option><option>6</option>
                                                    <option>7</option><option>8</option><option>9</option>
                                                    <option>10</option><option>11</option><option>12</option>
                                                    <option>13</option><option>14</option><option>15</option>
                                                    <option>16</option><option>17</option><option>18</option>
                                                    <option>19</option><option>20</option><option>21</option>
                                                    <option>22</option><option>23</option><option>24</option>
                                                    <option>25</option><option>26</option><option>27</option>
                                                    <option>28</option><option>29</option><option>30</option><option>31</option>
                                                </select>
                                            </label>
                                            <label class="month"> 
                                                일
                                            </label>
                                        </div>
                                        {{-- 매년 --}}
                                        <div class="d-inline-flex w-100  align-items-center">
                                            <label class="year">
                                                매년
                                            </label>
                                            <label class="year">
                                                <select class="col-md-10 form-control form-control-sm ml-3">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                    <option>6</option>
                                                    <option>7</option>
                                                    <option>8</option>
                                                    <option>9</option>
                                                    <option>10</option>
                                                    <option>11</option>
                                                    <option>12</option>
                                                </select>
                                            </label>
                                            <label class="year">
                                                월
                                            </label>
                                            <label class="year">
                                                <select class="col-md-10 form-control form-control-sm ml-3">
                                                    <option>1</option><option>2</option><option>3</option>
                                                    <option>4</option><option>5</option><option>6</option>
                                                    <option>7</option><option>8</option><option>9</option>
                                                    <option>10</option><option>11</option><option>12</option>
                                                    <option>13</option><option>14</option><option>15</option>
                                                    <option>16</option><option>17</option><option>18</option>
                                                    <option>19</option><option>20</option><option>21</option>
                                                    <option>22</option><option>23</option><option>24</option>
                                                    <option>25</option><option>26</option><option>27</option>
                                                    <option>28</option><option>29</option><option>30</option><option>31</option>
                                                </select>
                                            </label>
                                            <label class="year">
                                                일
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-inline-flex col-md-6  align-items-center form-control-sm end">
                                        <span class="font-weight-bold text-primary mx-auto end">종료시간 : </span>
                                        <input id="enddate" type="date" class="form-control col-md-4 end" value="2037-12-31">
                                        <input id="endtime" type="time" class="form-control col-md-4 end" value="00:00">
                                </div>
                                <hr>
                                <div class="card-body" id="jobparams1">
                                    @include('schedule.scheduleExecParam')
                                </div>
                                <hr>
                                <div class="row justify-content-end">
                                    <input type="button" class="mt-3 mr-2 btn btn-primary" value="등록" onclick="job.scRegister()" />
                                    <input type="button" class="mt-3 mr-2 btn btn-danger" value="취소" onclick="history.back()"/>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                @include('common.footer')
                {{--content 끝--}}
            </div>
        </div>
        <script type="text/javascript">
        function handler(){
        if(event.target.value==1){
            $('#StartTime').show();
            $('.Day').hide();
            $('.week').hide();
            $('.month').hide();
            $('.year').hide();
            $('.end').hide();
        }else if(event.target.value==2){
            $('#StartTime').show();
            $('.Day').show();
            $('.week').hide();
            $('.month').hide();
            $('.year').hide();
            $('.end').show();
        }else if(event.target.value==3){
            $('#StartTime').show();
            $('.Day').hide();
            $('.week').show();
            $('.month').hide();
            $('.year').hide();
            $('.end').show();
        }else if(event.target.value==4){
            $('#StartTime').show();
            $('.Day').hide();
            $('.week').hide();
            $('.month').show();
            $('.year').hide();
            $('.end').show();
        }else if(event.target.value==5){
            $('#StartTime').show();
            $('.Day').hide();
            $('.week').hide();
            $('.month').hide();
            $('.year').show();
            $('.end').show();
        }
    }

    $(document).ready( function() {
    
    //숫자만
    $("#Day").keyup(function(event){
        var str;
                        
        if(event.keyCode != 8){
            if (!(event.keyCode >=37 && event.keyCode<=40)) {
                var inputVal = $(this).val();
                
                str = inputVal.replace(/[^-0-9]/gi,'');
                
                if(str.lastIndexOf("-")>0){ //중간에 -가 있다면 replace
                    if(str.indexOf("-")==0){ //음수라면 replace 후 - 붙여준다.
                        str = "-"+str.replace(/[-]/gi,'');
                    }else{
                        str = str.replace(/[-]/gi,'');
                    }
                
                }
                                        
                $(this).val(str);
                
            }                    
        }

    });
    
});
    </script>
    </body>
    </html>

