@if (isset($processList))
  <h5 class="font-weight-bold text-primary mt-0 mb-4">스케줄 프로그램</h5>
  <table id="scheduleProcessList" class="table table-bordered" cellspacing="0">
      <colgroup>
        <col width="60px" />
        <col width="180px" />
        <col width="200px" />
        <col width="120px" />
        <col width="120px" />
        <col width="180px" />
        <col width="180px" />
        <col width="100px" />
        <col width="350px" />
        <col width="130px" />
        <col width="130px" />
        <col width="130px" />
        <col width="130px" />
      </colgroup>
        <thead>
          <tr>
            <th>순서</th>
            <th>프로그램 명</th>
            <th>설명</th>
            <th>상태</th>
            <th>재작업</th>
            <th>시작시간</th>
            <th>종료시간</th>
            <th>진행률</th>
            <th>파라미터</th>
            <th>텍스트유무</th>
            <th>예상시간</th>
            <th>최대예상시간</th>
            <th>로그 확인</th>
          </tr>
        </thead>
        <tbody>
        {{--  조회된 값이 보여주는 위치 --}}
        {{-- onclick="popup.processLog('{{$gusungSc->Sc_Seq}}','{{$gusungSc->Job_Seq}}','{{$gusungSc->P_Seq}}')" --}}
        @foreach($processList as $index => $gusungSc )
          <tr class="OneDbClickCss2" data-Job_Seq="{{$gusungSc->Job_Seq}}" data-Sc_Seq="{{$gusungSc->Sc_Seq}}" data-P_Seq="{{$gusungSc->P_Seq}}"  ondblclick="monitor.processDetail({{$gusungSc->Sc_Seq}},{{$gusungSc->P_Seq}})">
            <td class="text-center">{{$index+1}}</td>
            <td>{{$gusungSc->P_File}}</td>
            <td>{{$gusungSc->P_Name}}</td>
            <td class="text-center">{{$gusungSc->JobSM_P_Status}}</td>
            <td class="text-center">
              @if(($gusungSc->Sc_ReworkYN)=='Y')
                <label class="m-0 font-weight-bold text-primary">가능</label>
              @else
                <label class="m-0  font-weight-bold text-danger">불가능</label>
              @endif
            </td>
            <td class="text-center">{{isset($gusungSc->JobSM_P_StartTime)?$gusungSc->JobSM_P_StartTime:""}}</td>
            <td class="text-center">{{isset($gusungSc->JobSM_P_EndTime)?$gusungSc->JobSM_P_EndTime:""}}</td>
            <td>
              @php
                if(!empty($gusungSc->JobSM_P_StartTime)) {
                  $maxRunningTime = date("Y-m-d H:i:s", strtotime($gusungSc->JobSM_P_StartTime)+ intval($gusungSc->P_YesangMaxTime*60));
                  $nowDateTime = date("Y-m-d H:i:s", time());

                  $r1 = (strtotime($maxRunningTime)-strtotime($gusungSc->JobSM_P_StartTime))/60;
                  $r2 = (strtotime($nowDateTime)-strtotime($gusungSc->JobSM_P_StartTime))/60;
                  if($gusungSc->JobSM_P_Status=='오류') {
                    echo '<div class="progress">';
                    echo '<div class="progress-bar bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">ERROR</div>';
                    echo '</div>';
                    echo '<p class="p-0 progress-percent text-danger">오류</p>';
                  } else if (round( $r2 /$r1 *100) > 100 || isset($gusungSc->JobSM_P_EndTime)) {
                    echo '<div class="progress">';
                    echo '<div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>';
                    echo '</div>';
                    echo '<p class="p-0 progress-percent text-primary">100%</p>';
                  } else if (($maxRunningTime < $nowDateTime && !isset($gusungSc->JobSM_P_EndTime))) {
                    echo '<div class="progress">';
                    echo '<div class="progress-bar bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>';
                    echo '</div>';
                    echo '<p class="p-0 progress-percent text-danger">지연</p>';
                  } else {
                    echo '<div class="progress">';
                    echo '<div class="progress-bar bg-success" role="progressbar" style="width: '.round( $r2 /$r1 *100).'%;" aria-valuenow="'.round( $r2 /$r1 *100).'" aria-valuemin="0" aria-valuemax="'.round( $r2 /$r1 *100).'"></div>';
                    echo '</div>';
                    echo '<p class="p-0 progress-percent text-success">'.round( $r2 /$r1 *100).'%</p>';
                  }
                } else {
                  echo '<div class="progress">';
                  echo '</div>';
                  echo '<p class="p-0 progress-percent text-success">0%</p>';
                }
              @endphp
            </td>
            <td class="overflow-auto">
              @php
                $paramLength = count(explode('||',$gusungSc->JobGusung_ParamPos));
                echo '<label class="mx-0 mb-1 row justify-content-center">';
                for ($i=0; $i < $paramLength; $i++) { 
                  # code...
                  #echo '<p class="form-control form-control-sm d-inline-block col-md-6 overflow-auto border-0 my-0" type="text">파라미터 '.intVal($i+1).' '.explode('||',$gusungSc->Job_ParamSulmyungs)[explode('||',$gusungSc->JobGusung_ParamPos)[$i]].'</p>';
                  echo '<p type="text" class="form-control form-control-sm d-inline-block col-md-8 overflow-auto readonly my-0 readonly">'.explode('||',$gusungSc->Sc_Param)[explode('||',$gusungSc->JobGusung_ParamPos)[$i]].'</p>';
                }
                echo '</label>';
              @endphp
            </td>
            <td class="text-center">{{empty($gusungSc->P_TextInput)==1?"N":"Y"}}</td>
            <td class="text-center">{{intval($gusungSc->P_YesangTime/1440)==0?"":intval($gusungSc->P_YesangTime/1440)."일"}}{{intval($gusungSc->P_YesangTime%1440/60)==0?"":intval($gusungSc->P_YesangTime%1440/60)."시간"}}{{intval($gusungSc->P_YesangTime%60)==0?"":intval($gusungSc->P_YesangTime%60)."분"}}</td>
            <td class="text-center">{{intval($gusungSc->P_YesangMaxTime/1440)==0?"":intval($gusungSc->P_YesangMaxTime/1440)."일"}}{{intval($gusungSc->P_YesangMaxTime%1440/60)==0?"":intval($gusungSc->P_YesangMaxTime%1440/60)."시간"}}{{intval($gusungSc->P_YesangMaxTime%60)==0?"":intval($gusungSc->P_YesangMaxTime%60)."분"}}</td>
            <td class="text-center"><button class="btn btn-sm btn-info"  onclick="monitor.processLog('{{$gusungSc->Sc_Seq}}','{{$gusungSc->Job_Seq}}','{{$gusungSc->P_Seq}}')">로그 보기</button></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endIf
