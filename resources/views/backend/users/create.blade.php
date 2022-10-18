<html> 
    <head> 
        <title> </title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
       
    </head>
    <body> 
        <div class="container"> 
            <div class="row"> 
                <div class="col"> 
                     <h4> User Registration Form </h4>
                    <form action="{{url('/store')}}" method="POST" id="formvalidation"> 
                        @csrf
                        <div class="form-group"> 
                            <label> Name </label>
                            <input type="text" name="name" id="name" class="form-control" value=""> 
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group"> 
                            <label> Email </label>
                            <input type="email" name="email" id="email" class="form-control" value="">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group"> 
                            <label> Password </label>
                            <input type="password" name="password" id="password" class="form-control" value="">
                            @error('password')
                                <div class="alert alert-danger"> {{ $message }} </div>
                            @enderror
                        </div>

                        <div class="form-group"> 
                            <label> Confirm Password</label>
                            <input type="password" name="cpass" id="cpass" class="form-control" value="">
                            @error('cpass')
                                <div class="alert alert-danger"> {{ $message }}</div>
                            @enderror
                        </div><br>

                        <input type="submit" name="submit" id="submit" class="btn btn-primary">
                    </form> 

                     <!-- <h4> User Registration Form </h4>
                  
                    <form action="#" id="formvalidation"> 
                        <div class="form-group"> 
                            <label> Name </label>
                            <input type="text" id="name" name="name" class="form-control" >
                        </div>
                        <div class="form-group"> 
                            <label> Email </label>
                            <input type="email" id="email" name="email" class="form-control" >
                        </div>
                        <div class="form-group"> 
                            <label> Password </label>
                            <input type="password" id="password" name="password" class="form-control" >
                        </div>
                        <div class="form-group"> 
                            <label> Confirm Password</label>
                            <input type="password" id="cpass" name="cpass" class="form-control" >
                        </div><br>

                        <input type="submit" name="submit" id="submit" class="btn btn-primary">
                    </form>  -->
                </div>
            </div>
        </div>

       <!-- <script>
        $(document).ready(function() {
            $("#formvalidation").validate({
                rules: {
                    name: "required",
                    email: "required",
                    password: "required",
                    cpass: "required",
                },
                messages: {
                    name: "name is required",
                    email: "Email is required",
                    password: "Password is required",
                    cpass: "Confirm password is required",
              
                }
            });
        });
    </script>  -->

    <!-- <script>
        $(document).ready(function() {
            $("#formvalidation").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 20,
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 50
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    cpass: {
                        required: true,
                        equalTo: "#password"
                    },
                },
                messages: {
                    name: {
                        required: "First name is required",
                        maxlength: "First name cannot be more than 20 characters"
                    },
                    email: {
                        required: "Email is required",
                        email: "Email must be a valid email address",
                        maxlength: "Email cannot be more than 50 characters",
                    },
                    password: {
                        required: "Password is required",
                        minlength: "Password must be at least 5 characters"
                    },
                    cpass: {
                        required:  "Confirm password is required",
                        equalTo: "Password and confirm password should same"
                    },
                }
            });
        });
    </script> -->
    </body>
</html> 