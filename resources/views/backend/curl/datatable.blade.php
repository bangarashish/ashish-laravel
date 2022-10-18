<html> 
    <head> 
    <title> Jquery datatable plugin  </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    
 
    </head>
    <body> 
        <div class="container"> 
            <div class="row"> 
                <div class="col"> 
                <table class="table table-bordered user_datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>email</th>
                        <th>First Name</th>
                        <th>lastName</th>
                        <th>Image</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
                </div>
            </div>
        </div>
      
    <script type="text/javascript">
    /* ----------Jquery datatable with laravel route url------------- */

    // $(function () {
    //     var table = $('.user_datatable').DataTable({
    //         processing: true,
    //         serverSide: true,
    //         ajax: "{{ url('/datatable') }}",
    //         columns: [
    //             {data: 'id', name: 'id'},
    //             {data: 'name', name: 'name'},
    //             {data: 'email', name: 'email'},
    //             {data: 'phone', name: 'phone'},
    //             {data: 'action', name: 'action', orderable: false, searchable: false},
    //         ]
    //     });
    // });

    /* ----------Jquery datatable with laravel route url------------- */

    /* ----------Jquery datatable with api url------------- */


    //     $(function () {
    //     var table = $('.user_datatable').DataTable({
    //         processing: true,
    //         serverSide: true,
    //         ajax: "https://reqres.in/api/users?page=2",
    //         columnDefs: [{
    //             defaultContent: "-",
    //             targets: "_all"
    //         }],
    //         columns: [
    //             {data: 'id', name: 'id'},
    //             {data: 'email', name: 'email'},
    //             {data: 'first_name', name: 'first_name'},
    //             {data: 'last_name', name: 'last_name'},
    //             {
    //                 data: 'avatar',
    //                 render: function (data, type, row, meta) {
    //                 return '<img src="' + data + '" alt="' + data + '"height="50" width="50"/>';
                
    //                 },
    //             },
    //             {data: 'action', name: 'action', orderable: false, searchable: false},
    //         ]
    //     });
    // });

    /* ----------Jquery datatable with api url------------- */

    /* ----------Jquery datatable with laravel route url api url------------- */

        $(function () {
        var table = $('.user_datatable').DataTable({
            processing: true,
            serverSide: true,
            order: [],
            ajax: "{{ url('/datatable') }}",
            columnDefs: [{
                defaultContent: "-",
                targets: "_all"
            }],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'email', name: 'email'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {
                    data: 'avatar',
                    render: function (data, type, row, meta) {
                    return '<img src="' + data + '" alt="' + data + '"height="100" width="100"/>';
                    },
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });
    });

    /* ----------Jquery datatable with laravel route url api url------------- */







        // $(document).ready( function () {
        //     $.ajax({
        //         url : '/datatable',
        //         type : 'GET',
        //         dataType : 'json',
        //         success : function(data) {
        //            // var result = data.data;
        //            // var res = result[4][0];
        //             console.log(data);
        //             // $.each(res, function(key, value){

        //             //     var id = value.id;
        //             //     console.log(id);
        //             // });
        //             // var res = result[4][0].email;
        //             // var res = result[4][0].first_name;
        //             // var res = result[4][0].last_name;
        //             // var res = result[4][0].avatar;
        //             // console.log(result);
        //             // console.log(res);
        //             datatable(res);
        //         }
        //     });
        // });
        // function datatable(res) {
        //     var table = $('.user_datatable').dataTable({
        //         bAutoWidth : false,
        //         aaData : res,
        //         columns: [
        //             {res: 'id', name: 'id'},
        //             {res: 'email', name: 'email'},
        //             {res: 'first_name', name: 'first_name'},
        //             {res: 'last_name', name: 'last_name'},
        //             {res: 'avatar', name: 'avatar'},
        //             {res: 'action', name: 'action', orderable: false, searchable: false},
        //         ]
        //     })
        // }


    </script>
    </body>
</html>