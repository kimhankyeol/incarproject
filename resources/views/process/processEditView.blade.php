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
                      <div class="custom-row">
                        <input id="P_Seq" type="hidden" value="{{$processDetail[0]->P_Seq}}"/>
                        <div class="text-center align-self-center font-weight-bold text-primary mx-2">대분류</div>
                        <input id="workLargeVal" type="text" class="form-control form-control-sm mx-2" value="{{$processDetail[0]->P_WorkLargeName}}" style="cursor:not-allowed" readonly>
                        <div class="text-center align-self-center font-weight-bold text-primary mx-2">중분류</div>
                        <input id="workMediumVal" type="text" class="form-control form-control-sm mx-2" value="{{$processDetail[0]->P_WorkMediumName}}" readonly>
                        <div class="text-center align-self-center font-weight-bold text-primary">프로그램 경로</div>
                        <input id ="processPath" type="text" class="form-control form-control-sm align-self-center"  value="{{$processDetail[0]->FilePath}}" readonly>
                        <input id ="processFile" type="text" class="form-control form-control-sm align-self-center" value="{{$processDetail[0]->P_File}}" readonly>
                          <div class="mx-2 custom-control custom-checkbox small align-middle">
                            <input id="retry" type="checkbox" class="custom-control-input" {{$processDetail[0]->P_ReworkYN==1?"checked":""}} value="{{ $processDetail[0]->P_ReworkYN }}" onclick = "return false">
                            <label class="custom-control-label font-weight-bold text-primary" for="retry">재작업</label>
                          </div>
                      </div>
                      <hr>
                      <div class="row w-100 mx-auto">
                          <div class="col-md-auto text-center align-self-center font-weight-bold text-primary">프로그램 명</div>
                          <input id="programName" type="text" class="col-md-2 form-control form-control-sm align-self-center" value="{{$processDetail[0]->P_Name}}" readonly>
                          <div class="col-md-auto text-center align-self-center font-weight-bold text-primary">설명</div>
                          <textarea id = "programExplain" type="text" class="col-md-5 form-control form-control-sm">{{$processDetail[0]->P_Sulmyung}}</textarea>
                          <div class="col-md-auto text-center align-self-center font-weight-bold text-primary">프로그램 상태</div>
                          <input type="text" class="col-md-1 form-control form-control-sm align-self-center text-center font-weight-bold" value="{{$processDetail[0]->status}}" readonly>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-md-6 text-center">
                          <div class="col-md-12 text-center align-self-center font-weight-bold text-primary">배치 작업 평균 소요시간</div>
                          <div class="d-inline-block col-md-3 text-center align-self-center font-weight-bold text-primary">일 / 시 / 분</div>
                          <input type="text" class="d-inline-block col-md-2 form-control form-control-sm align-self-center" id="Pro_YesangTime1" value="{{intval($processDetail[0]->P_YesangTime/1440)}}" numberOnly>
                          <input type="text" class="d-inline-block col-md-2 form-control form-control-sm align-self-center" id="Pro_YesangTime2" value="{{intval($processDetail[0]->P_YesangTime%1440/60)}}" numberOnly>
                          <input type="text" class="d-inline-block col-md-2 form-control form-control-sm align-self-center" id="Pro_YesangTime3" value="{{intval($processDetail[0]->P_YesangTime%60)}}">
                        </div>
                        <div class="col-md-6 text-center">
                          <div class="col-md-12 text-center align-self-center font-weight-bold text-primary">배치 작업 최대 소요시간</div>
                          <div class="d-inline-block col-md-3 text-center align-self-center font-weight-bold text-primary">일 / 시 / 분</div>
                            <input type="text" class="d-inline-block col-md-2 form-control form-control-sm align-self-center" id="Pro_YesangMaxTime1" value="{{intval($processDetail[0]->P_YesangMaxTime/1440)}}"numberOnly>
                            <input type="text" class="d-inline-block col-md-2 form-control form-control-sm align-self-center" id="Pro_YesangMaxTime2" value="{{intval($processDetail[0]->P_YesangMaxTime%1440/60)}}" numberOnly>
                            <input type="text" class="d-inline-block col-md-2 form-control form-control-sm align-self-center" id="Pro_YesangMaxTime3" value="{{intval($processDetail[0]->P_YesangMaxTime%60)}}" numberOnly>
                        </div>
                      </div>
                      <hr>
                      <div class="row justify-content-center w-100 mx-auto">
                        <div class="limit-time-text col-md-auto">등록자</div>
                        <input id="P_RegId" type="text" class="form-control form-control-sm limit-time-input col-md-1 w-auto" value="{{$processDetail[0]->P_RegId}}" readonly>
                        <div class="limit-time-text col-md-auto">등록자IP</div>
                        <input id="P_RegIp" type="text" class="form-control form-control-sm limit-time-input col-md-1 w-auto" value="{{$processDetail[0]->P_RegIP}}" readonly>
                        <div class="limit-time-text col-md-auto">등록일</div>
                        <input id="P_RegDate" type="text" class="form-control form-control-sm limit-time-input col-md-auto w-auto" value="{{$processDetail[0]->P_RegDate}}" readonly>    
                        <div class="limit-time-text col-md-auto">수정자</div>
                        <input type="text" class="form-control form-control-sm limit-time-input col-md-1 w-auto" value="{{empty($processDetail[0]->P_UpdId) ? $processDetail[0]->P_RegId:$processDetail[0]->P_UpdId}}" readonly>   
                        <div class="limit-time-text col-md-auto">수정자IP</div>
                        <input type="text" class="form-control form-control-sm limit-time-input col-md-1 w-auto"  value="{{empty($processDetail[0]->P_UpdIP) ? $processDetail[0]->P_RegIP:$processDetail[0]->P_UpdIP}}" readonly>       
                        <div class="limit-time-text col-md-auto">수정일</div>
                        <input type="text" class="form-control form-control-sm limit-time-input col-md-auto w-auto" value="{{empty($processDetail[0]->P_UpdDate) ? $processDetail[0]->P_RegDate:$processDetail[0]->P_UpdDate}}" readonly> 
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-md-2 text-center align-self-center font-weight-bold text-primary">텍스트 입력</div>
                        @if(($processDetail[0]->P_TextInputCheck)==1)
                          <div class="col-md-3 mx-2 custom-control custom-checkbox small">
                              <input id="P_TextInputCheck" type="checkbox" class="custom-control-input" checked="checked" value="{{ $processDetail[0]->P_TextInputCheck }}">
                              <label class="custom-control-label font-weight-bold text-primary" for="P_TextInputCheck">텍스트 입력여부</label>
                          </div>
                        @else
                          <div class="col-md-3 mx-2 custom-control custom-checkbox small">
                            <input id="P_TextInputCheck" type="checkbox" class="custom-control-input" value="{{ $processDetail[0]->P_TextInputCheck }}" readonly>
                            <label class="custom-control-label font-weight-bold text-primary" for="P_TextInputCheck">텍스트 입력여부</label>
                          </div>
                        @endif
                        @if(($processDetail[0]->P_TextInputCheck)==1)
                          <textarea id="P_TextInput" type="text" class="col-md-12 form-control form-control-sm align-self-center mt-2" style="height: 300px" >{{$processDetail[0]->P_TextInput}}</textarea>
                        @else
                          <textarea id="P_TextInput" type="text" class="col-md-12 form-control form-control-sm align-self-center mt-2" style="height: 300px"  readonly>{{$processDetail[0]->P_TextInput}}</textarea>
                        @endif
                      </div>
                      <hr>
                      {{-- 프로그램변수가 추가되는 부분 --}}
                      <div class="row w-100 mx-auto">
                        <h6 class="col-md-12 font-weight-bold text-primary">프로그램 파라미터 타입</h6>
                        @if(isset($processDetail[0]->P_Params))
                          @php
                            $proParamArr=explode("||",$processDetail[0]->P_Params);
                            $proParamSulArr=explode("||",$processDetail[0]->P_ParamSulmyungs);
                            echo '<div class="col-md-12" id="proParams">';
                            for ($i = 0; $i < count($proParamArr); $i++) {
                              echo '<div class="d-inline-flex w-50 delYN mb-2">';
                              echo '<div class="col-md-3 small align-self-center text-center">파라미터</div>';
                              echo '<select name="proParamType" class="col-md-2 form-control form-control-sm">';
                              if($proParamArr[$i]=="paramNum"){
                                echo '<option value="paramStr">문자</option> <option value="'.$proParamArr[$i].'" selected>숫자</option> </select>';
                              }else if($proParamArr[$i]=="paramStr"){
                                echo '<option value="'.$proParamArr[$i].'" selected>문자</option> <option value="paramNum">숫자</option> </select>';
                              }
                              echo '<input type="text" name="proParamSulmyungInput" class="col-md-6 form-control form-control-sm" value="'.$proParamSulArr[$i].'">';
                              echo '<button type="button" class="btn btn-sm col-md-auto delParam btn-danger form-control-sm text-center" onclick="process.deleteDivParam()">삭제</button>';
                              echo '</div>';
                            }
                            echo '</div>';
                          @endphp
                        @endif  
                        {{-- 프로그램변수가 추가되는 함수  process.addDivParam()   삭제되는 함수는 process.delDivParam() //jobF unc.js 에 있음 --}}
                        <div class="col-md-12 text-center">
                            <input type="button" class="mt-3 btn btn-info" value="프로그램 변수 추가 +"  onclick="process.addDivParam()"/>
                        </div>
                      </div>
                      <hr>
                    
                      <div class="row justify-content-end">
                          <input type="button" class="mt-3 mr-2 btn btn-primary" value="저장" onclick="process.update('upd')" />
                          {{--  <input type="button" class="mt-3 mr-2 btn btn-danger" value="삭제" onclick="process.update('del')" />  --}}
                          <input type="button" class="mt-3 mr-2 btn btn-info" value="취소" onclick="location.href = '/process/processListView'"/>
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
      $('#P_TextInputCheck').click(function(){
         var chk = $(this).is(":checked");
         if(chk){
          $('#P_TextInput').removeAttr("readonly", "");
          $('#P_TextInput').removeAttr("readonly", "");
         }else{
          $('#P_TextInput').attr("readonly","readonly");
          $('#P_TextInput').attr("readonly","readonly");
             
         }
      });
   </script>