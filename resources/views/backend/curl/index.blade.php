    <?php
        //From URL to get webpage contents.
        $url = "https://reqres.in/api/users?page=2";
        //Initialize a CURL session.
        $ch = curl_init();

        // Daniel Stenberg.

        //Return Page contents.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //grab URL and pass it to the variable.
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);

        $response = json_decode($result, true);
        // echo "<pre>";
        // print_r($result);
        curl_close($ch);
    

    /* ----------------Post data with cURL---------------*/
    // $arr = array(
                    
    //                 "name"=> "ashish",
    //                 "job"=> "developer",
    //             );
    //         $url = "https://reqres.in/api/users";
    //         $ch = curl_init();
        
    //         curl_setopt($ch, CURLOPT_URL, $url);
    //         curl_setopt($ch, CURLOPT_POST, 1);
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
    //         //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //         curl_exec($ch);
    //         curl_close($ch);
            ?>
<html> 
    <head>
    <title> Curl Table </title>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </head>
    <body> 
        <div class="container"> 
            <div class="row"> 
                <div class="col"> 
                    <!-- <table class="table"> 
                        <thead> 
                            <tr> 
                                <th> ID </th>
                                <th> first_name</th>
                                <th> last_name</th>
                                <th> Email</th>
                            </tr>
                        </thead>
                        <tbody> 
                        @foreach($response['data'] as $res)
                        <tr> 
                            <td> {{ $res['id'] }} </td>
                            <td> {{ $res['first_name'] }}</td>
                            <td> {{ $res['last_name'] }}</td>
                            <td> {{ $res['email'] }} </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table> -->

                    <table class="table"> 
                        <thead> 
                            <tr> 
                                <th> ID </th>
                                <th> first_name</th>
                                <th> last_name</th>
                                <th> Email</th>
                                <th> Image</th>
                            </tr>
                        </thead>
                        <tbody> 
                      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script> 
            $(document).ready(function(){
                curlApi();
            });
            function curlApi(){
                        $.ajax({
                        type: 'get',
                        url: "{{url('/curl-api')}}",
                        success: function(response) {
                           var data = response.data;
                          //console.log(response);
                            $.each(data, function(key, value){
                                // console.log(value);
                                var id    = value.id;
                                var name  = value.first_name;
                                var last_name = value.last_name;
                                var email = value.email;
                                var img = value.avatar;
                            
                            // console.log(name);
                                $('tbody').append(['<tr>', 
                                                    '<td>' + id + '</td>',
                                                    '<td>' + name + '</td>',
                                                    '<td>' + last_name + '</td>',
                                                    '<td>' + email + '</td>',
                                                    '<img src="'+ img +'">',
                                                   '</tr>']);
                            });
                         }
                    })
                 }
        </script>
    </body>
</html>