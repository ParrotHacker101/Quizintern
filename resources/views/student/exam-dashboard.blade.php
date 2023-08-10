@extends('layout.layout-common')

@section('space-work')
<div style="color: black" class="container">
    <p>Welcome, {{ Auth::user()->name }}</p>
    <h1 class="text-center">{{ $exam->exam_name }}</h1>
    @php $qcount = 1; @endphp
    @if ($success)
        @if (count($qna) > 0)
            <form action="{{ route('exam.submit') }}" method="POST" class="mb-5" onsubmit="return isValid()">
                @csrf
                <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                @foreach ($qna as $data)
                    <div>
                        <h5>Q{{ $qcount }}. {{ $data->question->question }}</h5>
                        <input type="hidden" name="q[]" value="{{ $data->question->id }}">
                        <input type="hidden" name="ans_{{ $qcount }}" id="ans_{{ $qcount }}">
                        @php $acount = 1; @endphp
                        @foreach ($data->question->answers as $answer)
                            <p><b>{{ $acount }}).</b> {{ $answer->answer }}</p>
                            <input type="radio" name="radio_{{ $qcount }}" class="select_ans" data-id="{{ $qcount }}" value="{{ $answer->id }}">
                            @php $acount++; @endphp
                        @endforeach
                    </div>
                    <br>
                    @php $qcount++; @endphp
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
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('.select_ans').click(function(){
            var no = $(this).attr('data-id');
            $('#ans_'+no).val($(this).val());
        });
    });

    function isValid(){
        var result = true;
        var qLength = parseInt("{{ $qcount }}") - 1;
        $('.error_msg').remove();

        for (let i = 1; i <= qLength; i++) {
            if ($('#ans_'+i).val() === "") {
                result = false;
                $('#ans_'+i).parent().append('<span style="color:red;" class="error_msg">Please select an answer.</span>');
                setTimeout(() => {
                    $('.error_msg').remove();
                }, 5000);
            }
        }

        return result;
    }
</script>
@endsection