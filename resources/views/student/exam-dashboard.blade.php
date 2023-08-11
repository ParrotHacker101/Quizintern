@extends('layout/layout-common')
@section('space-work')
@php
    $time = explode(':',$exam[0]['time']);
@endphp
<div style="color: black" class="container">
    <p>Welcome, {{ Auth::user()->name }}</p>
    <h1 class="text-center">{{ $exam[0]['exam_name'] }}</h1>
    @php  $qcount = 1;  @endphp
    @if ($success == true)
    @if (count($qna) > 0)
     <h4 class="text-right time">{{ $exam[0]['time'] }}</h4>
    <form action="{{ route('examSubmit') }}" method="POST" id="exam_form" class="mb-5">
     @csrf
      <input type="hidden" name="exam_id" value="{{ $exam[0]['id'] }}">

          @foreach ($qna as $data)
          <div>
          <h5>Q{{$qcount++}}. {{ $data['question'][0]['question'] }}</h5>
          <input type="hidden" name="q[]" value="{{ $data['question'][0]['id'] }}">
          <input type="hidden" name="ans_{{$qcount-1}}" id="ans_{{$qcount-1}}">
          @php $acount = 1; @endphp
          
          @foreach ($data['question'][0]['answers'] as $answer)
          <label>
              <span><b>{{ $acount++ }}).</b> {{ $answer['answer'] }}</span>
              <input type="radio" name="radio_{{$qcount-1}}" class="select_ans" data-id="{{$qcount-1}}" value="{{ $answer['id'] }}">
          </label>
      @endforeach
        </div>
        

          @endforeach
          <div class="text-center">
            <input type="submit" class="btn btn-info">
          </div>
  </form>

    @else
      <h3 class="text-center" style="color: red;">Questions & Answers not available</h3>
    @endif
    @else
    <h3 class="text-center" style="color: red;">{{ $msg }}</h3>

    @endif
</div>
<script>
  $(document).ready(function(){
     $('.select_ans').click(function(){
      var no = $(this).attr('data-id');
      $('#ans_'+no).val($(this).val());
     });

     var time = @json($time);
$('.time').text(time[0] + ':' + time[1] + ':00 Left time');

var seconds = 0; // Changed from 59 to 0
var hours = parseInt(time[0]);
var minutes = parseInt(time[1]);

var timer = setInterval(() => {
    if (hours === 0 && minutes === 0 && seconds === 0) {
        clearInterval(timer);
        $('#exam_form').submit();
    }

    console.log(hours + ' -:- ' + minutes + ' -:- ' + seconds);
    
    if (seconds >= 59) { // Changed from seconds <= 0
        minutes--;
        seconds = 0; // Changed from 59 to 0
    }
    
    if (minutes <= 0 && hours !== 0) {
        hours--;
        minutes = 59;
    }

    let tempHours = hours.toString().padStart(2, '0');
    let tempMinutes = minutes.toString().padStart(2, '0');
    let tempSeconds = seconds.toString().padStart(2, '0');
    
    $('.time').text(tempHours + ':' + tempMinutes + ':' + tempSeconds + ' Left time');
    
    seconds++; // Changed from seconds--

}, 1000);
  });
  function isValid(){
      var result=true;
      return result;
      $qlength = parseInt("{{$qcount}}-1");
      $('.error_msg').remove();
      for(let i=1; i <=$qlength; i++){
        if($('#ans_'+i).val() == ""){
          return = false;
          $('#ans_'+i').parent().append(<span style="color:red;" class="error_msg">please select answer.</span>)
          setTimeout(() => {
            $('.error_msg').remove();

          }, 5000);

        }
      }
     }
</script>
@endsection
