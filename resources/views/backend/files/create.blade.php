<html> 
    <head> 
        <title>Upload Files</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body> 
        <div class="container"> 
            <div class="row"> 
                <div class="col-md-6">
                    <!-- <form  id="upload_form">
                    {{ csrf_field() }}
                        <div class="form-group">
                        <label> Image </label><br>
                           <input type="file" name="file" id="file" class="form-control">
                           <input type="file" name="images "id="image" class="form-control">
                        </div>
                        <input type="submit" name="submit" id="submit" class="btn btn-primary">
                     </form>       -->
                   
                    <div class="form-group">
                        <label> Image </label><br>
                            <input type="file" id="file" class="form-control">
                            <!-- <input type="file" name="images "id="image" class="form-control"> -->
                        </div>
                        <input type="submit" name="submit" id="submit" class="btn btn-primary">
                    </div>
            </div>

            <div class="col-md-6">  
                    <table class="table"> 
                        <thead id="editImage"> 
                            <tr> 
                                <th> Image <th>
                                <th> Edit </th> 
                            </tr>
                        </thead>
                        <tbody id="uploadImage"> 
                            <tr> 
                                 <img src="">
                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="col-md-6"> 
            <div class="form-group">
                <label> Update Image </label><br>
                    <input type="hidden" id="fileId" class="form-control">
                    <input type="file" id="newfile" class="form-control">
                    <img src='' id="edit_image" width="180px;" height="120">
                </div>
                <input type="submit" name="submit" id="update_file" class="btn btn-primary">
            </div>
            </div>
        </div>
       
        <script>

             /*---------- ------------Add image---------------- -----------*/
                $(document).ready(function(){
                    $('#submit').click(function(){

                        var file_data = $('#file').prop('files')[0];
                      //var file_data = $('#file')[0].files[0]; 
                        //console.log(file_data);
                       
                        var form_data = new FormData();                  
                        form_data.append('file', file_data);

                        //console.log(form_data);
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url:"{{ url('filesUpload') }}",
                            method:"POST",
                            data: form_data,
                            dataType:'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success:function(data)
                            {
                                var id = data.id;
                              // console.log(id);
                              // $('#uploadImage img').attr('src',"images/"+ data +"");
                               $('#uploadImage').append('<img src="images/' + data.files + '" height="100px" width="100px">');
                               //$('tbody').append('<td><a href="'+ data.id +'"> Edit </a></td>');
                               $('tbody').append('<td> <a href="#" onclick=viewUploadfile("'+id+'")>Edit</a></td>');
                               $('tbody').append('<td> <a href="#" onclick=deleteUploadfile("'+id+'")>Delete</a></td>');
                               
                              
                            }
                        })
                    });
                });
                /*----------- ------------Add image---------------- -----------*/
                /*---------- ------------View image in input field---------------- -----------*/

                function viewUploadfile(id) {
                            $.ajax({
                                url: "{{ url('viewfile') }}/" + id,
                                type: "GET",
                                // contentType: false,
                                // cache: false,
                                // processData: false,
                                // dataType: "json",

                                success: function(response) {
                                    var id = response.id;
                                  //console.log(id);
                                // $('#uploadImage').append('<img src="images/' + data.files + '" height="100px" width="100px">');
                                 $("#edit_image").attr('src','images/'+response.files);
                                 $('#fileId').val(id);
                                }
                            });
                         }

                /*---------- ------------view image in input field---------------- -----------*/
                /*---------- ------------Edit image---------------- -----------*/

                $(document).ready(function(){
                    $('#update_file').click(function(){

                        var id  = $('#fileId').val();
                       // console.log(id);
                        var file_data = $('#newfile').prop('files')[0];
                        //console.log(file_data);
                       // var form_data = new FormData($('#file')[0]);  
                        var form_data = new FormData();                  
                        form_data.append('file', file_data);
                       // form_data.append('id', id);

                       // console.log(form_data);
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ url('updatefile') }}/"+id,
                            type:"POST",
                            data: form_data,
                            dataType:'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success:function(data)
                            {
                               console.log(data);
                           
                            //    $('#uploadImage').append('<img src="images/' + data.files + '" height="100px" width="100px">');
                            //    $('tbody').append('<td> <a href="'+ data.id +'"> Edit </a></td>');
                              
                            }
                        })
                    });
                });

                  /*---------- ------------Edit image---------------- -----------*/

                   /*---------- ------------Delete image---------------- -----------*/

                   function deleteUploadfile(id) {
                            $.ajax({
                                url: "{{ url('deletefile') }}/" + id,
                                type: "GET",
                                // contentType: false,
                                // cache: false,
                                // processData: false,
                                // dataType: "json",

                                success: function(response) {
                                   // var id = response.id;
                                  console.log(response);
                                // $('#uploadImage').append('<img src="images/' + data.files + '" height="100px" width="100px">');
                                //  $("#edit_image").attr('src','images/'+response.files);
                                //  $('#fileId').val(id);
                                }
                            });
                         }
                  /*---------- ------------Delete image---------------- -----------*/


        </script>

        <!-- <script>
            $(document).ready(function(){
                $('#upload_form').on('submit', function(event){
                    event.preventDefault();
                    $.ajax({
                    url:"{{ url('filesUpload') }}",
                    method:"POST",
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {
                        console.log(data);
                    }
                    })
                });

            });
        </script> -->
    </body>
</html>