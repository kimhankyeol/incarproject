const monitor = {
  test: function () {
    console.log("test");
  },
  //조회
  search: function (page) {
    var jobStatus = $('.jobStatus');
    var searchWord = $('#searchWord').val();
    var WorkLarge = $('#workLargeVal option:selected').val();
    var WorkMedium = $('#workMediumVal option:selected').val();
    var startDate = $('#startDate').val();
    var endDate = $('#endDate').val();
    var jobStatusStr = '';
    for (var i = 0; i < jobStatus.length; i++) {
      if (jobStatus[i].checked) {
        jobStatusStr += jobStatus[i].value + ',';
      } else {
        jobStatusStr += '0,';
      }
    }
    if (searchWord == '' || searchWord == undefined) {
      searchWord = "searchWordNot";
    }
    $.ajax({
      url: "/monitoring/scheduleList",
      method: "get",
      data: {
        'jobStatus': jobStatusStr.substr(0, jobStatusStr.length - 1),
        'searchWord': searchWord,
        'WorkLarge': WorkLarge,
        'WorkMedium': WorkMedium,
        'startDate': startDate,
        'endDate': endDate,
        'page': page
      },
      success: function (resp) {
        $('#scheduleList').html(resp.returnHTML)
      }
    })
  },
  detailList: function (Job_Seq, page) {
    var noneTable = document.getElementById("scheduleProcessList");
    // noneTable.style.display = "none"
    $.ajax({
      url: "/monitoring/monitorJobDetailList",
      method: "get",
      data: {
        "Job_Seq": Job_Seq,
        "page": page
      },
      success: function (resp) {
        $('#jobDetailList').html(resp.returnHTML)
      }
    })
  },
  // 스케줄링 프로세스 정보
  scheduleProcessList(Job_Seq, Sc_Seq) {
    var scheduleProcessList = document.getElementById("scheduleProcessListTable");
    var reloadBtn = document.getElementById("reloadBtn");
    if (scheduleProcessList != null) {
      scheduleProcessList.style.display = "";
    }
    if (reloadBtn != null) {
      reloadBtn.style.display = "";
    }
    document.getElementById("jobSeq").value = Job_Seq;
    document.getElementById("scSeq").value = Sc_Seq;
    $.ajax({
      url: "/monitoring/scheduleProcessList",
      method: "get",
      data: {
        "Job_Seq": Job_Seq,
        "Sc_Seq": Sc_Seq
      },
      success: function (resp) {
        $('#scheduleProcessListTable').html(resp.returnHTML);
      }
    })
    colResiz();
  },
  // 잡 상세
  jobPopup: function (Job_Seq) {
    window.open('/popup/jobDetailPopup?Job_Seq=' + Job_Seq, '잡 정보 상세', 'top=10, left=10, width=1400, height=875, status=no, location=no, directories=no, status=no, menubar=no, toolbar=no, scrollbars=yes, resizable=no');
  },
  // 잡 스케줄의 상세 정보
  scheduleDetailPopup(Job_Seq, Sc_Seq) {
    window.open('/popup/scheduleDetailPopup?Job_Seq=' + Job_Seq + '&Sc_Seq=' + Sc_Seq, '구성 디테일', 'top=10, left=10, width=1400, height=720, status=no, location=no, directories=no, status=no, menubar=no, toolbar=no, scrollbars=yes, resizable=no');
  },
  // 프로그램 상세
  processDetail: function (Sc_Seq, P_Seq) {
    window.open('/popup/processDetailPopup?Sc_Seq=' + Sc_Seq + '&P_Seq=' + P_Seq, '프로그램 정보 상세', 'top=10, left=10, width=1400, height=875, status=no, location=no, directories=no, status=no, menubar=no, toolbar=no, scrollbars=yes, resizable=no');
  },
  // 스케줄 재작업 확인
  reWorkScheduleChk: function (Sc_Seq) {
    const Job_Seq = event.target.parentElement.parentElement.getAttribute("data-job_seq");
    const RegDate = event.target.parentElement.parentElement.getAttribute("data-regdate");
    document.getElementById("Sc_Note").value = "";
    $.ajax({
      url: "/monitoring/reWorkScheduleChk",
      method: "get",
      data: {
        "Sc_Seq": Sc_Seq
      },
      success: function (resp) {
        if (resp.succesCount == 0) {
          const result = confirm("이미 완료된 스케줄 입니다. 재작업 하시겠습니까?");
          if (result) {
            if (resp.reWorkCount > 0) {
              alert("재작업 불가능한 스케줄 입니다.");
              return false;
            }
            $('#reworkModal').modal('show');
            document.getElementById("jobSeq").value = Job_Seq;
            document.getElementById("scSeq").value = Sc_Seq;
            document.getElementById("regDate").value = RegDate;
          }
        }
        if (resp.succesCount != 0) {
          const result = confirm("재작업 하시겠습니까?");
          if (result) {
            if (resp.reWorkCount > 0) {
              alert("재작업 불가능한 스케줄 입니다.");
              return false;
            }
            $('#reworkModal').modal('show');
            document.getElementById("jobSeq").value = Job_Seq;
            document.getElementById("scSeq").value = Sc_Seq;
            document.getElementById("regDate").value = RegDate;
          }
        }
      }
    })
  },
  // 스케줄 재작업
  reWorkSchedule: function () {
    const jobSeq = document.getElementById("jobSeq").value;
    const scSeq = document.getElementById("scSeq").value;
    const regDate = document.getElementById("regDate").value;
    const Sc_Note = document.getElementById("Sc_Note").value;
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      url: "/monitoring/reWorkSchedule",
      method: "post",
      data: {
        "Job_Seq": jobSeq,
        "Sc_Seq": scSeq,
        "RegDate": regDate,
        "Sc_Note": Sc_Note
      },
      success: function (resp) {
        location.href = "/monitoring/monitoringView";
      }
    })
  },
   //모니터링 로그 팝업
   processLog:function(scSeq,jobSeq,pSeq){
    window.open('/popup/monitoringLogPopup?Sc_Seq='+scSeq+'&Job_Seq='+jobSeq+'&P_Seq='+pSeq, '모니터링 로그 출력', 'top=10, left=10, width=1400, height=720, status=no, location=no, directories=no, status=no, menubar=no, toolbar=no, scrollbars=yes, resizable=no');
  }
}

