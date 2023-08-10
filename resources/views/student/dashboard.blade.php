
@extends('layout.student-layout')
@section('space-work')
<h5>Exams</h5>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Exam Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Total attempt</th>
            <th>Available attempt</th>
            <th>Copy Link</th>
        </tr>
    </thead>
    <tbody>
        @if (count($exams) > 0)
            @php
                $count = 1;
            @endphp
            @foreach ($exams as $exam)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $exam->exam_name }}</td>
                    <td>{{ $exam->date }}</td>
                    <td>{{ $exam->time }} Hrs</td>
                    <td>{{ $exam->attempt }} Time</td>
                    <td></td>
                    <td></td>
                    <td><a href="#" data-code="{{ $exam->enterance_id }}" class="copy"><i class="fa fa-copy"></i></a></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">No Exams Available!</td>
            </tr>
        @endif
    </tbody>
</table>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.copy').click(function() {
            $(this).parent().prepend('<span class="copied_text"> Copied</span>');
            var code = $(this).attr('data-code');
            var url = "{{ URL::to('/') }}/exam/" + code;
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            document.execCommand("copy");
            $temp.remove();
            setTimeout(function() {
                $('.copied_text').remove();
            }, 2000);
        });
    });
</script>
@endsection