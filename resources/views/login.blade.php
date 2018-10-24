<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        <title>Elections</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <style>
            .voting {
                background: yellow;
            }

            .logo {
                width: 150px;
            }
           
        </style>
    </head>
    <body >
        <div class="container mt-5">
        <div class="col-12 text-center" >
        <img class="logo" src="{{ asset('images/profile.png') }}" />
        </div>
            <div class="row" >
            <div class="col-4 offset-4" >
            <div style="direction: rtl; text-align: right;">
                <form action="/login" method="post">
                {{csrf_field()}}                                            
					    @csrf
                    <div class="form-group" >
                        <input type="text" name="user" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="משתמש">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="סיסמה">
                    </div>
                    <div class="text-center" >
                    <button type="submit" class="btn btn-primary">כניסה</button>
                    </div>
                    </form>
                    
                </div> 
                </div>
	        </div>
    </div>
	<script>

	</script>
    </body>

</html>
