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
                        <h5 class="m-0 font-weight-bold text-primary">프로그램 정보 수정</h5>
                        <input id="P_UpdIP" type="hidden" value="{{$_SERVER["REMOTE_ADDR"]}}"/>
                        <input id="P_UpDate" type="hidden" value="{{date("Y-m-d H:i:s")}}"/>
                        <input id="P_Seq" type="hidden" value="{{$processDetail[0]->P_Seq}}"/>
                    </div>
                    <div class="card-body">
                        <div class="row">
<<<<<<< HEAD
=======
<<<<<<< HEAD
                            <div id="codeLargeView" class="outher-code">
                              <div class="col-md-3 text-center align-self-center font-weight-bold text-primary">업무구분</div>
                              <div class="col-md-2 text-center align-self-center font-weight-bold text-primary" >대분류</div>
                              <input type="text" class="col-md-2 form-control form-control-sm" readonly value="{{$processDetail[0]->P_WorkLargeName}}"/>
                              <div class="col-md-2 text-center align-self-center font-weight-bold text-primary">중분류</div>
                              <input type="text" class="col-md-2 form-control form-control-sm" readonly value="{{$processDetail[0]->P_WorkMediumName}}"/>
=======
>>>>>>> kim
                            <div class="outher-code">
                              <input id="P_Seq" type="hidden" value="{{$processDetail[0]->P_Seq}}"/>
                              <div class="text-center align-self-center font-weight-bold text-primary mx-2">대분류</div>
                              <input type="text" class="form-control form-control-sm mx-2" value="{{$processDetail[0]->P_WorkLargeName}}"  readonly>
                               <input id="P_WorkLargeCtg" type="hidden" class="form-control form-control-sm mx-2" value="{{$processDetail[0]->P_WorkLargeCtg}}"  readonly> 
                              <div class="text-center align-self-center font-weight-bold text-primary mx-2">중분류</div>
                              <input  type="text" class="form-control form-control-sm mx-2" value="{{$processDetail[0]->P_WorkMediumName}}" readonly>
                              <input id="P_WorkMediumCtg" type="hidden" class="form-control form-control-sm mx-2" value="{{$processDetail[0]->P_WorkMediumCtg}}"  readonly> 
<<<<<<< HEAD
=======
>>>>>>> 545bfcc710c9ea5a142747f5e516874ae83b6acd
>>>>>>> kim
                            </div>
                            <div class="col-md-1 text-center align-self-center font-weight-bold text-primary">프로그램 ID</div>
                            <input id ="processPath" type="text" class="col-md-1 form-control form-control-sm align-self-center"  value="{{$processDetail[0]->P_FileName}}" readonly>
                            <input id ="processFile" type="text" class="col-md-1 form-control form-control-sm align-self-center" value="{{$processDetail[0]->P_File}}" >
                            <div class="col-md-1 text-center align-self-center font-weight-bold text-primary">사용 DB</div>
                            <select id="UseDb" class="col-md-1 form-control form-control-sm">
<<<<<<< HEAD
=======
<<<<<<< HEAD
                              
                              @foreach ($db_list as $list)
                                  <option value = {{$list->WorkLarge}}>{{$list->ShortName}}</option>
                              @endforeach
                            </select>   
=======
>>>>>>> kim
                                    @foreach ($db_list as $list)
                                        <option value="{{$list->WorkMedium}}">{{ $list -> LongName}}</option>
                                    @endforeach  
                            </select>
<<<<<<< HEAD
=======
>>>>>>> 545bfcc710c9ea5a142747f5e516874ae83b6acd
>>>>>>> kim
                            @if(($processDetail[0]->P_ReworkYN)==1)
                            <div class="col-md-1 mx-2 custom-control custom-checkbox small">
                                <input id="retry" type="checkbox" class="custom-control-input" checked="checked" value="{{ $processDetail[0]->P_ReworkYN }}">
                                <label class="custom-control-label font-weight-bold text-primary" for="retry">재작업</label>
                            </div>
                            @else
                            <div class="col-md-1 mx-2 custom-control custom-checkbox small">
                              <input id="retry" type="checkbox" class="custom-control-input" value="{{ $processDetail[0]->P_ReworkYN }}">
                              <label class="custom-control-label font-weight-bold text-primary" for="retry">재작업</label>
                            </div>
                            @endif
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-1 text-center align-self-center font-weight-bold text-primary">프로그램 명</div>
                            <input id="programName" type="text" class="col-md-2 form-control form-control-sm align-self-center" value="{{$processDetail[0]->P_Name}}">
                            <div class="col-md-1 text-center align-self-center font-weight-bold text-primary mt-2">설명</div>
                            <input id = "programExplain" type="text" class="col-md-5 form-control form-control-sm mt-2" value="{{$processDetail[0]->P_Sulmyung}}">
                            <div class="col-md-1 text-center align-self-center font-weight-bold text-primary mt-2">프로그램 상태</div>
                            <input type="text" class="col-md-1 form-control form-control-sm align-self-center mt-2" placeholder="-" readonly>
                        </div>
                        <hr>
                        <div class="row">
                              <div class="col-md-6 text-center">
                              <div class="col-md-12 text-center align-self-center font-weight-bold text-primary">예상시간</div>
                              <div class="d-inline-block col-md-1 text-center align-self-center font-weight-bold text-primary">일</div>
                              <input type="text" class="d-inline-block col-md-2 form-control form-control-sm align-self-center" id="Pro_YesangTime1" value="{{intval($processDetail[0]->P_YesangTime/1440)}}" numberOnly>
                              <div class="d-inline-block col-md-1 text-center align-self-center font-weight-bold text-primary">시</div>
                              <input type="text" class="d-inline-block col-md-2 form-control form-control-sm align-self-center" id="Pro_YesangTime2" value="{{intval($processDetail[0]->P_YesangTime%1440/60)}}" numberOnly>
                              <div class="d-inline-block col-md-1 text-center align-self-center font-weight-bold text-primary">분</div>
                              <input type="text" class="d-inline-block col-md-2 form-control form-control-sm align-self-center" id="Pro_YesangTime3" value="{{intval($processDetail[0]->P_YesangTime%60)}}">
                          </div>
                          <div class="col-md-6 text-center">
                              <div class="col-md-12 text-center align-self-center font-weight-bold text-primary">최대 예상시간</div>
                              <div class="d-inline-block col-md-1 text-center align-self-center font-weight-bold text-primary">일</div>
                              <input type="text" class="d-inline-block col-md-2 form-control form-control-sm align-self-center" id="Pro_YesangMaxTime1" value="{{intval($processDetail[0]->P_YesangMaxTime/1440)}}"numberOnly>
                              <div class="d-inline-block col-md-1 text-center align-self-center font-weight-bold text-primary">시</div>
                              <input type="text" class="d-inline-block col-md-2 form-control form-control-sm align-self-center" id="Pro_YesangMaxTime2" value="{{intval($processDetail[0]->P_YesangMaxTime%1440/60)}}" numberOnly>
                              <div class="d-inline-block col-md-1 text-center align-self-center font-weight-bold text-primary">분</div>
                              <input type="text" class="d-inline-block col-md-2 form-control form-control-sm align-self-center" id="Pro_YesangMaxTime3" value="{{intval($processDetail[0]->P_YesangMaxTime%60)}}" numberOnly>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="limit-time-text">등록자</div>
                                <input id="P_RegId" type="text" class="form-control form-control-sm limit-time-input" value="{{$processDetail[0]->P_RegId}}" readonly>
                                <div class="limit-time-text">등록자IP</div>
                                <input id="P_RegIp" type="text" class="form-control form-control-sm limit-time-input" value="{{long2ip($processDetail[0]->P_RegIP)}}" readonly>
                                <div class="limit-time-text">등록일</div>
                                <input id="P_RegDate" type="text" class="form-control form-control-sm limit-time-input" value="{{$processDetail[0]->P_RegDate}}" readonly>              
                            </div>
                            <div class="col-md-6">
                               <div class="limit-time-text">수정자</div>
                                <input type="text" class="form-control form-control-sm limit-time-input" value="{{$processDetail[0]->P_UpdId}}" readonly>
                                <div class="limit-time-text">수정자IP</div>
                                <input type="text" class="form-control form-control-sm limit-time-input" value="{{$processDetail[0]->P_UpdIP}}" readonly>
                                <div class="limit-time-text">수정일</div>
                                <input type="text" class="form-control form-control-sm limit-time-input" value="{{$processDetail[0]->P_UpdDate}}" readonly> 
                            </div>
                        </div>
                        <hr>
                        <div class="row align-items-center">
                             {{-- 업무 구분 대분류 중분류 선택 --}}
                            <div class="col-md-2 text-center align-self-center font-weight-bold text-primary">파일 입력</div>
                            <input id="P_FileInput" type="text" class="col-md-2 form-control form-control-sm align-self-center mt-2" value="{{$processDetail[0]->P_FileInput}}" readonly>
                               @if(($processDetail[0]->P_FileInputCheck)==1)
                                  <div class="col-md-1 mx-2 custom-control custom-checkbox small">
                                      <input id="P_FileInputCheck" type="checkbox" class="custom-control-input" checked="checked" value="{{ $processDetail[0]->P_FileInputCheck }}">
                                      <label class="custom-control-label font-weight-bold text-primary" for="P_FileInputCheck">파일입력여부</label>
                                  </div>
                                  @else
                                  <div class="col-md-1 mx-2 custom-control custom-checkbox small">
                                    <input id="P_FileInputCheck" type="checkbox" class="custom-control-input" value="{{ $processDetail[0]->P_FileInputCheck }}">
                                    <label class="custom-control-label font-weight-bold text-primary" for="P_FileInputCheck">파일입력여부</label>
                                  </div>
                                @endif
                        </div>
                        <hr>
                        <div class="row">
                        <h6 class="col-md-12 font-weight-bold text-primary">
                          프로그램 파라미터 타입
                        </div>
                        <hr>
                        {{-- 프로그램변수가 추가되는 부분 --}}
                        <div class="w-75 m-auto">
                          <div class="row" id="proParams">
<<<<<<< HEAD
=======
                            @if(isset($processDetail[0]->P_Params))
<<<<<<< HEAD
>>>>>>> origin/lsy
=======
>>>>>>> 545bfcc710c9ea5a142747f5e516874ae83b6acd
>>>>>>> kim
                              @php
                                $proParamArr=explode("||",$processDetail[0]->P_Params);
                                $proParamSulArr=explode("||",$processDetail[0]->P_ParamSulmyungs);
                                for ($i = 0; $i < count($proParamArr); $i++) {
                                  echo '<div class="d-inline-flex w-50 delYN mb-2">';
                                  echo '<div class="col-md-3 small align-self-center text-center">프로그램 파라미터</div>';
                                  echo '<select name="proParamType" class="col-md-2 form-control form-control-sm">';
                                if($proParamArr[$i]=="paramDate"){
                                  echo '<option value="'.$proParamArr[$i].'" selected>날짜</option> <option value="paramStr">문자</option> <option value="paramNum">숫자</option> </select>';
                                }else if($proParamArr[$i]=="paramNum"){
                                  echo '<option value="paramDate">날짜</option> <option value="paramStr">문자</option> <option value="'.$proParamArr[$i].'" selected>숫자</option> </select>';
                                }else if($proParamArr[$i]=="paramStr"){
                                  echo '<option value="paramDate">날짜</option> <option value="'.$proParamArr[$i].'" selected>문자</option> <option value="paramNum">숫자</option> </select>';
                                }
                                echo '<input type="text" name="proParamSulmyungInput" class="col-md-6 form-control form-control-sm" value="'.$proParamSulArr[$i].'">';
                                echo '<div class="delParam btn-danger  form-control form-control-sm col-md-1 text-center" onclick="process.deleteDivParam()">삭제</div>';
                                echo '</div>';
                                }
                              @endphp
                            @endif  
                          </div>
                        </div>
                          
                          <div class="row">
                            <div class="col-md-12" id="proParams"></div>
                            {{-- 프로그램변수가 추가되는 함수  process.addDivParam()   삭제되는 함수는 process.delDivParam() //jobF unc.js 에 있음 --}}
                            <div class="col-md-12 text-center">
                                <input type="button" class="mt-3 btn btn-info" value="프로그램 변수 추가 +"  onclick="process.addDivParam()"/>
                            </div>
                          </div>
                          <hr>
                        
                          <div class="row justify-content-end">
                              <input type="button" class="mt-3 mr-2 btn btn-primary" value="저장" onclick="process.update()" />
                              <input type="button" class="mt-3 mr-2 btn btn-danger" value="취소" onclick="history.back()"/>
                          </div>
                        </div>
                </div>
            </div>
        </div>
        @include('common.footer')
        {{--content 끝--}}
      </div>
    </div>
  </body>
  </html>
 <script>
    $(function(){
        $('#P_FileInputCheck').click(function(){
            var workLargeVal=$('#workLargeVal');
            var workMediumVal=$('#workMediumVal');
            var processFile=$('#processFile');
            if(workLargeVal.val()!="all"&&workMediumVal.val()!="all"&&processFile.val()!=""){
                var chk = $(this).is(":checked");
                if(chk){
                    var FileName = $('#processFile').val();
                    var FileNameText = FileName.replace('php','txt');
                    $('#P_FileInput').val($('#processPath').val()+"/"+FileNameText);
                    processFile.prop('readonly', true);
                    workLargeVal.attr("disabled","disabled");
                    workMediumVal.attr("disabled","disabled");
                }else{
                    $('#P_FileInput').val("");
                    processFile.prop('readonly', false);
                    workLargeVal.removeAttr("disabled", "disabled");
                    workMediumVal.removeAttr("disabled", "disabled");
                }
            }else{
                return false;
            }
        })
    })
</script>
