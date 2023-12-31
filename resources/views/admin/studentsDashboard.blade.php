@extends('layout/student-layout')
@section('space-work')
<h2 class="mb-4">Students</h2><!-- Button trigger modal -->

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">
    Add Student
</button>

  <table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>
    </thead>
    <tbody>
        <tr>    
            @if (count($students)>0) 
            @foreach ($students as $student) 
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>
                    <button type="button" data-id="{{ $student->id }}" data-name="{{ $student->name }}" data-email="{{ $student->email }}" class="btn btn-info editButton" data-toggle="modal" data-target="#editStudentModal">
                        Edit
                    </button>
                </td>
                <td>
                    <button type="button" data-id="{{ $student->id }}" class="btn btn-danger deleteButton" data-toggle="modal" data-target="#deleteStudentModal">
                        Delete
                    </button>
                </td>
            </tr>
                
            @endforeach
            @else
                <tr>
                    <td colspan="5">Student is not Found!</td>
                </tr>

                
            @endif
        </tr>
    </tbody>

</table>
  

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addStudent">
            @csrf
             <div class="modal-body">
                <div class="row">
                    <input type="text" class="w-100" name="name" placeholder="Enter Student name" required>
                </div>
                <div class="row mt-3">
                    <input type="text" class="w-100" name="email" placeholder="Enter Student email" required>
                </div>
             </div>    

             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Add Student</button>
            </div>
        </form>

         </div>
    </div>
  </div>


<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="editStudent">
            @csrf
             <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="id" id="id">
                    <input type="text" class="w-100" id="name" name="name" placeholder="Enter Student name" required>
                </div>
                <div class="row mt-3">
                    <input type="text" class="w-100" id="email" name="email" placeholder="Enter Student email" required>
                </div>
             </div>    

             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">update Student</button>
            </div>
        </form>

         </div>
    </div>
  </div>


<!-- Delete Student Modal -->
<div class="modal fade" id="deleteStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Delete Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="deleteStudent">
            @csrf
             <div class="modal-body">
                <p>are you sure you want to delete student</p>
                <input type="hidden" name="id" id="student_id">
             </div>    

             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>

         </div>
    </div>
  </div>

  <script>
   $(document).ready(function() {
  $("#addStudent").submit(function(e) {
    e.preventDefault();

    var formData = $(this).serialize();
    $.ajax({
      url: "{{ route('addStudent') }}",
      type: "POST",
      data: formData,
      success: function(data) {
        if (data.success == true) {
          location.reload();
        } else {
          alert(data.msg);
        }
      },
      error: function() {
        alert("An error occurred while adding the student.");
      }
    });
  });

  // Edit button click and show values
  $(document).on("click", ".editButton", function() {
    $("#id").val($(this).attr("data-id"));
    $("#name").val($(this).attr("data-name"));
    $("#email").val($(this).attr("data-email"));
  });

  $("#editStudent").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      url: "{{ route('editStudent') }}",
      type: "POST",
      data: formData,
      success: function(data) {
        if (data.success == true) {
          location.reload();
        } else {
          alert(data.msg);
        }
      },
      error: function() {
        alert("An error occurred while editing the student.");
      }
    });
  });

  $(document).on("click", ".deleteButton", function() {
    var id = $(this).attr("data-id");
    $("#student_id").val(id);
  });

  $("#deleteStudent").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      url: "{{ route('deleteStudent') }}",
      type: "POST",
      data: formData,
      success: function(data) {
        if (data.success == true) {
          location.reload();
        } else {
          alert(data.msg);
        }
      },
      error: function() {
        alert("An error occurred while deleting the student.");
      }
    });
  });
});

    </script>

@endsection