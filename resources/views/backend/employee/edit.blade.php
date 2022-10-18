<html> 
    <head> 
        <title> Edit Employee </title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>
    <body> 
        <div class="container"> 
            <div class="row"> 
                <div class="col"> 
                    <form action="{{url('/update')}}/{{$employee->id}}" method="POST"> 
                        @csrf
                        <div class="form-group"> 
                            <label> Name </label>
                            <input type="text" name="name" class="form-control" value="{{$employee->name}}">
                        </div>
                        <div class="form-group"> 
                            <label> Email </label>
                            <input type="email" name="email" class="form-control" value="{{$employee->email}}">
                        </div>
                        <div class="form-group"> 
                            <label> Phone </label>
                            <input type="text" name="phone" class="form-control" value="{{$employee->phone}}">
                        </div><br>
                            <input type="submit" name="submit" class="btn btn-warning">
                    </form>
                </div>
            </div>
        </div> 
    </body>
</html>