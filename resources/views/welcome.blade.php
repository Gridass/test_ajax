<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

    </head>
    <body>


    <div class="container">
        <h2>Laravel Ajax</h2>


        <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
        </div>


        <form method="post" id="ajax_form" >

            {{ csrf_field() }}
            <div class="form-group">
                <label>First Name:</label>
                <input type="text" name="first_name" class="form-control" placeholder="First Name">
            </div>


            <div class="form-group">
                <label>Last Name:</label>
                <input type="text" name="last_name" class="form-control" placeholder="Last Name">
            </div>


            <div class="form-group">
                <strong>Email:</strong>
                <input type="text" name="email" class="form-control" placeholder="Email">
            </div>

            <div class="form-group">
                <strong>Password:</strong>
                <input type="text" name="password" class="form-control" placeholder="password">
            </div>


            <div class="form-group">
                <strong>Address:</strong>
                <textarea class="form-control" name="address" placeholder="Address"></textarea>
            </div>


            <div class="form-group">
                <button class="btn btn-success btn-submit">Submit</button>
            </div>
        </form>
    </div>


    <script type="text/javascript">


        $(document).ready(function() {
            $(".btn-submit").click(function(e){
                e.preventDefault();


                var _token = $("input[name='_token']").val();
                var first_name = $("input[name='first_name']").val();
                var last_name = $("input[name='last_name']").val();
                var email = $("input[name='email']").val();
                var password = $("input[name='password']").val();
                var address = $("textarea[name='address']").val();


                $.ajax({
                    url: "/my-form",
                    type:'POST',
                    data: {_token:_token, first_name:first_name, last_name:last_name, email:email, password:password, address:address},
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            alert(data.success);
                        }else{
                            printErrorMsg(data.error);
                        }
                    }
                });
                $("button").click(function(e){

                    e.preventDefault();

                    var formData = $("form").serialize();

                    $.ajax({
                        type: "POST",
                        url: "insertClientNew.php",
                        data: formData,
                        success: function(data) {
                            $("#insclient").html(data);
                        }
                    });

                });


            });


            function printErrorMsg (msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }
        });


    </script>

    </body>
</html>
