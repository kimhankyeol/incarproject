@foreach($data as $jobSc)
<tr onclick="pageMove.job.detail('jobDetailView','{{$jobSc->Job_Seq}}')" style="text-align: center">
    <td>{{'job_'.$jobSc->Job_WorkLargeCtg.'_'.$jobSc->Job_WorkMediumCtg.'_'.$jobSc->Job_Seq}}</td>
    <td>{{$jobSc->Job_WorkLargeName}}</td>
    <td>{{$jobSc->Job_WorkMediumName}}</td>
    <td>{{$jobSc->Job_Name}}</td>
    <td>{{$jobSc->Job_Sulmyung}}</td>
    <td>{{$jobSc->Job_RegName}}</td>
    <td>{{$jobSc->Job_RegDate}}</td>
</tr>
@endforeach