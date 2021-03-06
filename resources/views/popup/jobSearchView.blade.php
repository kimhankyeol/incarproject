<!DOCTYPE html>
<html lang="en">
@include('popup.popupCommon.head')
{{-- js 라이브러리  --}}
@include('popup.popupCommon.popupJs')
<script type="text/javascript" src="/js/colResizable-1.6.js"></script>
<body class="bg-gradient-primary">
  <div class="mx-2">
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow my-3">
      <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100" style="width: 100%;">
        <div class="input-group">
          <div class="text-center align-self-center font-weight-bold text-primary mx-2">업무 구분</div>
            @include("code.codeSelect")
            {{-- 검색 조건 --}}
            <select class="form-control bg-light border-primary small">
              <option>
                잡명
              </option>
            </select>
            {{-- 검색 단어가 있을떄 없을때 구분  --}}
            {{-- 검색 단어가 있을떄 없을때 구분  --}}
            @if(!isset($searchWord))
            <input id="searchWord" type="text" class="form-control bg-light border-primary small" placeholder="조회" aria-label="Search" value="{{$searchWord}}">
            @elseif(isset($searchWord))
              @if($searchWord=="searchWordNot")
                <input id="searchWord" type="text" value="" class="form-control bg-light border-primary small" placeholder="조회" aria-label="Search" >
              @else
                <input id="searchWord" type="text" value="{{$searchWord}}" class="form-control bg-light border-primary small" aria-label="Search">
              @endif
            @endif
          <div class="input-group-append">
            <div class="btn btn-primary" onclick="popup.schedulesearch('1')">
              <i class="fas fa-search fa-sm"></i>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <div class="card shadow mb-4">
      <div class="card-body">
        <input type = "hidden" id="tr_job_id"/>
        <input type = "hidden" id="tr_job_name"/>
        <input type = "hidden" id="tr_job_seq"/>
        {{-- <input type="button" class="mt-3 mr-2 btn btn-primary" value="선택" onclick="job.jobselect()" /> --}}
        <div class="table-responsive">
          <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12 text-center">
                <table class="table table-bordered dataTable hoverTable" id="dataTable1" width="100%" cellspacing="0" role="grid"
                  aria-describedby="dataTable_info" style="width: 100%;">
                  <thead>
                      <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" style="width: 14%">ID</th>
                      <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 14%;">대분류</th>
                      <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 14%;">중분류</th>
                      <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 14%;">잡 명</th>
                      <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 14%;">설명</th>
                      <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 15%">등록자</th>
                      <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 15%">등록일</th>
                  </thead>
                  <tbody>
                    @foreach($data as $jobSc)
                    <tr class="jobList">
                        <td id="job_id">{{'job_'.$jobSc->Job_WorkLargeCtg.'_'.$jobSc->Job_WorkMediumCtg.'_'.$jobSc->Job_Seq}}</td>
                        <td>{{$jobSc->Job_WorkLargeName}}</td>
                        <td>{{$jobSc->Job_WorkMediumName}}</td>
                        <td id="job_name">{{$jobSc->Job_Name}}</td>
                        <td>{{$jobSc->Job_Sulmyung}}</td>
                        <td>{{$jobSc->Job_RegId}}</td>
                        <td>{{$jobSc->Job_RegDate}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{-- 페이징 이동 경로 --}}
                    @if(isset($paginator))
                    {{$paginator->setPath('/popup/jobSearchView')->appends(request()->except($searchParams))->links()}}
                    @endIf
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
  function workLargeChgSel(){
        var WorkLarge =  $('#workLargeVal').val();
            $.ajax({
              url:"/code/workMediumCtg",
              method:"get",
              data:{
                "WorkLarge":WorkLarge
              },
              success:function(resp){
                $("#workMediumVal").html(resp.returnHTML);
              },
              error:function(error){
              }
            })
  }
  
  $(".hoverTable tbody tr").dblclick(function(){
    var arr = new Array();

    var tr = $(this);
    var td = tr.children();
    
    var job_id = td.eq(0).text();//잡 아이디
    var job_name = td.eq(3).text();// 잡명
    var job_seq = job_id.split('_')[3];//잡 시퀀스

    job.jobselect(job_id,job_name,job_seq);

})
</script>
</html>

