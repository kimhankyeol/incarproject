
@if($WorkMedium=="all")
    <option value="all" selected>전체</option>
    @foreach($workMediumCtgData as $workMData)
        <option value="{{$workMData->WorkMedium}}">{{$workMData->LongName}}</option>
    @endforeach
@elseif($WorkMedium!="all")
    <option value="all" selected>전체</option>
    @foreach($workMediumCtgData as $workMData)
    @if($WorkMedium==$workMData->WorkMedium)
        <option value="{{$workMData->WorkMedium}}" selected>{{$workMData->LongName}}</option>
    @else
        <option value="{{$workMData->WorkMedium}}">{{$workMData->LongName}}</option>
    @endif
    @endforeach
@endif