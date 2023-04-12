<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Bootstrap Cdn-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <title>Document</title>
</head>
<body>


  <div class="container border mt-3">
        <div class="row mt-5 mb-5">
            <h4 class="text-danger text-center delete"></h4>
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3 class="card-title mb-0">Student List</h3>
                        <button type="button" class="btn btn-sm btn-primary" onclick="addNew('Add New Student','Save Change')">Add New</button>
                    </div>
                    <div class="card-body">
                       <div class="table-responsive mx-auto">
                            <table class="table table-sm table-hovered table-borderd">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Mail</th>
                                        <th>Phone</th>
                                        <th>Roll</th>
                                        <th>Registration</th>
                                        <th>Board</th>
                                        <th>Session</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="stuData">

                                </tbody>
                           </table>
                        </div>
                   </div>
                </div>
            </div>
       </div>
  </div>

    @include('ajax_curd.modal');

    <!--JQuery Cdn-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   <script type="text/javascript">
        var _token ="{{ csrf_token() }}";

          //Input Modal Ready to Show
        var studentModal = new bootstrap.Modal(document.getElementById('studentModal'), {
            keyboard: false,
            backdrop: 'static'
        })


        function addNew(modalTitle,saveModal){
            $('form#admit-form').find('.errorMsg').remove(); // Form validation message
            $('form#admit-form').removeClass('update-form');
            $('form#admit-form').addClass('admit-form');
            $('form#admit-form input[name="updateId"]').val(''); // Edit & Update korar jonno post id dhorte hoy
            $('form#admit-form')[0].reset(); // click add new button to reset form data
            $('form#admit-form #proImg').html(''); // remove post img in the modal
            $('form#admit-form #selectBoard').html(`
                   <label for="board" class="form-label">Board</label>
                    <select class="form-select" id="board" name="board" aria-label="Default select example">
                        <option selected>Open this select Board</option>
                        <option value="rajshahi">Rajshahi</option>
                        <option value="dhaka">Dhaka</option>
                        <option value="madrasha">Madrasha</option>
                    </select>`);
            $('form#admit-form #selectSession').html(`
                <label for="session" class="form-label">Session</label>
                <select class="form-select" id="session" name="session" aria-label="Default select example">
                    <option selected>Open this select Session</option>
                    <option value="2017-18">2017-18</option>
                    <option value="2018-19">2018-19</option>
                    <option value="2019-20">2019-20</option>
                </select>`);
           $('h5#modalTitle').text(modalTitle);
           $('button.sub_btn').text(saveModal);

           studentModal.show(); //Show Modal
        }

        // Store Student Data
        $(document).on('submit','.admit-form', function(e){
           e.preventDefault();
           $.ajax({
            url: "{{ route('admit.store') }}",
            type:"POST",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success: function(response){
                $('form.admit-form').find('.errorMsg').remove();
                if(response.status==false){
                   $.each(response.errors, function(key,value){
                    //console.log(value);
                    $('.admit-form #'+key).parent().append('<span class="text-danger errorMsg">'+value+'</span>')
                   });
                }else{
                    if(response.status == 'success'){
                       studentDataFatch();
                       $('.admit-form')[0].reset();
                       $('#success').html(response.message);
                    }else{
                       $('#error').html(response.message)
                    }
                }

            }
           });
        });

        // Read Data
        function studentDataFatch(){

            $.ajax({
                url: "{{ route('admit.read') }}",
                type: "post",
                dataType: "json",
                data: {_token:_token},
                success: function(response){
                   $('tbody.stuData').html(response);
                }
            });
        }
        studentDataFatch(); // Calling Function

        // Student Data Edit
        $(document).on('click','button.editData', function(){
            // alert($(this).data('id')); ====> kono element a id dhorar jonno use kora hoy
           let studentId = $(this).data('id');   // Post er id ready kora hoise
           $('h5#modalTitle').text('Edit Student Data'); // Modal Title Name
           $('button.sub_btn').text('Update');  // Modal Submit Button Name
           $('form#admit-form input[name="updateId"]').val(studentId);   // post id dhore updateId input a send kora hoise
           $('form#admit-form').addClass('update-form');
           $('form#admit-form').removeClass('admit-form');
           $.ajax({
                url: "{{ route('admit.edit') }}",
                type: "post",
                dataType: "json",
                data: {_token:_token, studentId:studentId},
                success: function(response){
                    if(response){
                        let avatarPath = "{{ asset('image/profile/') }}/"+response.avatar;
                        $('form#admit-form input[name="name"]').val(response.name);
                        $('form#admit-form input[name="mail"]').val(response.mail);
                        $('form#admit-form input[name="phone"]').val(response.phone);
                        $('form#admit-form input[name="roll"]').val(response.roll);
                        $('form#admit-form input[name="reg"]').val(response.reg);
                        $('form#admit-form #proImg').html('<img class="proImg" src="'+avatarPath+'" width="50px" height="50px" alt="profile image">');
                        studentBoard(response.id);
                        studentSession(response.id);
                        studentModal.show()
                    }
                }
            });

        });
        function studentBoard(studentId){
            $.ajax({
                url: "{{ route('admit.boardSelect') }}",
                type: "post",
                dataType: "json",
                data: {_token:_token, studentId:studentId},
                success: function(response){
                   if(response){
                    $('#selectBoard').html(response);
                   }
                }
            });
        }
        function studentSession(studentId){
            $.ajax({
                url: "{{ route('admit.studentSession') }}",
                type: "post",
                dataType: "json",
                data: {_token:_token, studentId:studentId},
                success: function(response){
                   if(response){
                    $('#selectSession').html(response);
                   }
                }
            });
        }
        // Student Data Edit End
        //======================


        // Update Student Data
         $(document).on('submit','form.update-form', function(e){
           e.preventDefault();
           $.ajax({
            url: "{{ route('admit.update') }}",
            type:"POST",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success: function(response){
                $('form.update-form').find('.errorMsg').remove();
                if(response.status==false){
                   $.each(response.errors, function(key,value){
                    //console.log(value);
                    $('form.update-form #'+key).parent().append('<span class="text-danger errorMsg">'+value+'</span>')
                   });
                }else{
                    if(response.status == 'success'){
                       studentDataFatch();
                       $('form.update-form')[0].reset();
                       $('#success').html(response.message);
                    }else{
                       $('#error').html(response.message)
                    }
                }

            }
           });
        });


        // Student Data Delete
        $(document).on('click','button.deleteData', function(){
            // alert($(this).data('id')); ====> kono element a id dhorar jonno use kora hoy
            let studentId = $(this).data('id');
            $.ajax({
                url: "{{ route('admit.delete') }}",
                type: "post",
                dataType: "json",
                data: {_token:_token, studentId:studentId},
                success: function(response){
                   if(response.status == 'success'){
                     studentDataFatch();
                     $('h4.delete').append(response.message);

                    }
                }
            });
        });



    </script>

</body>
</html>
