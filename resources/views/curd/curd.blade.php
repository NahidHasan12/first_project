<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Bootstrap Cdn-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <title>Ajax Curd</title>
</head>
<body>

    <div class="container mt-5">
        <div class="row">
            <div id="alert" class="col-12">

            </div>
        </div>
        <div class="row mb-5">
           <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-items-center justify-content-between">
                    <h4 class="card-title">Data Table</h4>

                    @can('post-create', Auth::user())
                    <button class="btn btn-sm btn-primary" onclick="addNew('Add Student Data','Submit Data')">Add New</button>
                    @endcan

                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Image</th>
                                <th>Student Name</th>
                                <th>Roll</th>
                                <th>Registration</th>
                                <th>Department</th>
                                <th>Number</th>
                                <th>Mail Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableData">

                        </tbody>
                    </table>
                </div>
            </div>
           </div>
        </div>
    </div>
    @include('curd.curdModal')

    <!--JQuery Cdn-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        let _token = "{{ csrf_token() }}"; //catch Token Number
        //show modal
        var curdModal = new bootstrap.Modal(document.getElementById('curdModal'), {
            keyboard: false,
            backdrop: 'static'
        });
        // Add new button effect
        function addNew(modalTitle,modalButton){
            $('form.storeData').find('.errorMsg').remove();
            $('h5#modalTitle').html(modalTitle);
            $('button#submitBtn').html(modalButton);
            $('#dataForm').removeClass('updateData');
            $('#dataForm').addClass('storeData');
            $('form#dataForm')[0].reset();
            $('.img').html('');
            $('#department').html(`
            <label for="department" class="form-label">Department</label>
                             <select name="department" id="department" class="form-select">
                                 <option selected value="">Please Select Department</option>
                                 <option value="textile">Textile</option>
                                 <option value="civil">Civil</option>
                                 <option value="computer">Computer</option>
                                 <option value="gdpm">GDPM</option>
                                 <option value="electrical">Electrical</option>
                             </select>
            `)
            curdModal.show();
        }
        // Store Data
       $(document).on('submit', 'form.storeData', function(e){
          e.preventDefault();
          $.ajax({
            url:"{{ route('curd.store') }}",
            type:"POST",
            data:new FormData(this),
            contentType:false,
            processData:false,
            success: function(response){
                $('form.storeData').find('.errorMsg').remove();
                if(response.status==false){
                   $.each(response.errors, function(key,value){
                    //console.log(key);
                    $('.storeData #'+key).parent().append('<span class="text-danger errorMsg">'+value+'</span>')
                   });
                }else{
                    if(response.status == 'success'){
                        $('#alert').html('<h5 class="alert alert-success">'+ response.message +'</h5>');
                    }else{
                        $('#alert').html('<h5 class="alert alert-danger">'+ response.message +'</h5>');
                    }
                    curdModal.hide();
                }

                readData();

            }
          });
       });

       // Read Data
       function readData(){
        $.ajax({
            url:"{{ route('curd.read') }}",
            type:"POST",
            dataType:"json",
            data:{_token:_token},
            success: function(response){
               $('#tableData').html(response);
            }
        });
       }
       readData();

        // Edit Data
        $(document).on('click','button.editPost', function(){
            let postId = $(this).data('id');
            $('h5#modalTitle').html('Edit Student Data');
            $('button#submitBtn').html('Update Data');
            $('#dataForm').addClass('updateData');
            $('#dataForm').removeClass('storeData');
            $('#dataForm input[name="editId"]').val(postId);
            $.ajax({
                url: "{{ route('curd.edit') }}",
                type:"POST",
                dataType:"json",
                data:{_token:_token, postId:postId},
                success: function(response){
                    if(response){
                        let imgPath = "{{ asset('image/curdImg/') }}/"+response.img;
                        $('#dataForm input[name="name"]').val(response.name);
                        $('#dataForm input[name="roll"]').val(response.roll);
                        $('#dataForm input[name="reg"]').val(response.reg);
                        $('#dataForm input[name="number"]').val(response.number);
                        $('#dataForm input[name="mail"]').val(response.mail);
                        $('.img').html('<img src="'+imgPath+'" alt="img" width="55px" height="50px">');
                        selectDpt(response.id);
                        curdModal.show();
                    }
                }
            });
        });
        // select Department
        function selectDpt(postId){
           $.ajax({
            url:"{{ route('curd.selectDpt') }}",
            type:"POST",
            dataType:"json",
            data:{_token:_token, postId:postId},
            success: function(response){
               if(response){
                $('#department').html(response);
               }
            }
           });
        }

        // Store Data
        $(document).on('submit', 'form.updateData', function(e){
          e.preventDefault();
          $.ajax({
            url:"{{ route('curd.update') }}",
            type:"POST",
            data:new FormData(this),
            contentType: false,
            processData:false,
            success: function(response){
                $('form.storeData').find('.errorMsg').remove();
                if(response.status==false){
                   $.each(response.errors, function(key,value){
                    //console.log(key);
                    $('.storeData #'+key).parent().append('<span class="text-danger errorMsg">'+value+'</span>')
                   });
                }else{
                    if(response.status == 'success'){
                        readData();
                        curdModal.hide();
                        $('form.updateData')[0].reset();
                        $('#alert').html('<h5 class="alert alert-success">'+ response.message +'</h5>');
                    }else{
                        $('#alert').html('<h5 class="alert alert-danger">'+ response.message +'</h5>');
                    }
                }
            }
          });

        });


        //Delete Data
        $(document).on('click','button.deletePost', function(){
          let postId =  $(this).data('id');
          $.ajax({
            url:"{{ route('curd.delete') }}",
            type:"POST",
            dataType:"json",
            data:{_token:_token, postId:postId},
            success: function(response){
               if(response.status == 'success'){
                readData();
                $('#alert').html('<h5 class="alert alert-success">'+ response.message +'</h5>');
               }
            }
          });
       });

    </script>
</body>
</html>
