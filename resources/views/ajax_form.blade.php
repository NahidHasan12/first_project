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
        <div class="row mt-5 mb-5 border">
           <div class="col-6 mx-auto border p-2">
              <div class="card">

                    <div class="card-header">
                        <h2 class="card-title">Ajax Form </h2>
                    </div>
                    <div class="card-body">

                        <form id="form" action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" class="form-control" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="mail" class="form-label">Mail</label>
                                <input type="email" id="mail" class="form-control" name="mail">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" id="phone" class="form-control" name="phone">
                            </div>
                            <button type="button" class="btn btn-sm btn-primary sub_btn">Submit</button>
                       </form>
                    </div>
              </div>
            </div>
       </div>
  </div>

    <!--JQuery Cdn-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   <script type="text/javascript">
        var _token ="{{ csrf_token() }}";
        $(document).ready(function(){
            $('button.sub_btn').click(function(){
                let name= $('input[name="name"]').val();
                let mail= $('input[name="mail"]').val();
                let phone= $('input[name="phone"]').val();

                $.ajax({
                    url:"{{ route('form.store') }}",
                    type:"post",
                    data: {
                        name:name,
                        mail:mail,
                        phone:phone,
                        _token:_token
                    },
                    success: function(response){
                        $('#form')[0].reset();
                       $('.card-header').append('<span class="alert bg-success text-light p-0 w-100">' + response + '</span>');
                    }
                });
            });
        });
   </script>

</body>
</html>
