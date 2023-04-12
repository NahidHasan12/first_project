<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Bootstrap Cdn-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--JQuery Cdn-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>


  <div class="container border mt-3">

      <div class="row mt-5 mb-5 border">

          <div class="col-8 mx-auto border p-2 text-center">
             <p class="text-success" id="para"> Click button to send me in H2 tag with Ajax </p>
             <button class="btn btn-sm btn-success action">Send</button>
             <h2 class="text-danger"></h2>

               <script type="text/javascript">
                   $(document).ready(function(){
                        const sms = $('p#para').text();
                        $('.action').click(function(){
                            $.ajax({
                                url: "{{ route('ajax.data') }}",
                                type: "get",
                                data: {data:sms},
                                success: function(response){
                                   $('h2').text(response)
                                }
                        });
                        });
                    });
               </script>
            </div>
      </div>
  </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
