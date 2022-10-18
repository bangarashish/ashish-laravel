<html> 
<head> 
    <title> Employee Table</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body> 
<div class="container">
    <div class="row"> 
        <div class="col-md-6"> 
            <!-- <form action="{{ url('/employee') }}" method="GET">
                    <input type="text" name="search" required/>
                    <button type="submit">Search</button>
                </form> -->
                <div class="form-group">
                    <input type="text"  id="search_input" class="form-control" required/>
                </div>
                <button type="submit" id="search" class="btn btn-primary">Search</button>
        </div>
        <div class="row"> 
            <div class="col-sm-6"> 
            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"> Add New Employee</a>
            </div>
        </div>
        <!--  -----------show table data by ajax -------------------- -->
        <div class="row table"> 
                <table class="table"> 
                    <thead id="sorting"> 
                        <!-- <tr> 
                            <th> <a href="#" class="sorting" data-column_name="id" data-sorting_type="desc">ID</a></th>
                            <th> </th>
                            <th> Name</th>
                            <th> Email</th>
                            <th> phone</th>
                        </tr>  -->
                    </thead>
                      <tbody id="employee_data"> 
                      
                    </tbody>
                </table>
                <div class="pagination">
                     
                 </div>
                <p class="loading">Loading Data</p>
        </div>

        <!-- -----------show table data by ajax -------------------- -->
        <div class="row"> 
            <!-- ------------Add Employee Model-------------------------- -->
            <div id="addEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Employee</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body add_employee">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" id="name_input" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" id="email_input" class="form-control">
                                <!-- @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror -->
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" id="phone_input" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-success add-employee" value="add">
                        </div>
                    </div>
                </div>
            </div>
             <!-- ------------Add Employee Model-------------------------- -->

            <!-- ---------------View Modal HTML---------------------------- -->
            <div id="viewEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">View Employee</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body edit_employee">
                            <div class="form-group">
                                <input type="hidden" id="gtm-id" name="id" value="">
                                <label>Name</label>
                                <input type="text" id="name_input" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" id="email_input" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" id="phone_input" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-success update-employee" value="Update">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
      /* --------------------Start Sorting --------------------------- */
    $(document).ready(function(){
        $(document).on('click', '.sorting', function(event){
            event.preventDefault();
            var column_name = $(this).data('column_name');
            var order_type = $(this).data('sorting_type');
            //alert(order_type);
            var reverse_order = '';
            if(order_type == 'asc')
            {
            $(this).data('sorting_type', 'desc');
            reverse_order = 'desc';
            }
            if(order_type == 'desc')
            {
            $(this).data('sorting_type', 'asc');
            reverse_order = 'asc';
            }
            sortEmployee(column_name, order_type);
        });
    });

    function sortEmployee(column_name, order_type){
        $.ajax({
           type: 'GET',
           data: {
            column_name: column_name,
            order_type : order_type,
           },
           url:"/sorting",
          // url:"/sorting?column_name="+column_name+"&order_type="+order_type,
            success: function(response){
                var emp = response.employee;
                var page = response.pagination;
                //console.log(emp.data);
                var tr = '';
                $.each(emp.data, function(key, value){
                   // console.log(value);
                var id = value.id;
                var name = value.name;
                var email = value.email;
                var phone = value.phone;
               // console.log(phone);

                tr += '<tr>';
                tr += '<td>'+ id +'</td>';
                tr += '<td>'+ name +'</td>';
                tr += '<td>'+ email +'</td>';
                tr += '<td>'+ phone +'</td>';
                tr += '<td><div class="d-flex">';
                tr += '<td> <a href="#viewEmployeeModal" data-toggle="modal" onclick=viewEmployeeModal("'+id+'")><button class="btn btn-success">Edit</button></a></td>';
                tr += '<td><a href="#deleteEmployeeModel" id="delete_id" onclick=deleteEmployeeModel("'+id+'")><button class="btn btn-danger">Delete</button> </a></td>';  
                tr += '</div></td>';        
                tr += '<tr>';
                });
                $('.pagination').html(page);
                $('.loading').hide();
                $('#employee_data').html(tr);
           
            }
        });
    }

    /* --------------------End Sorting --------------------------- */

        /* --------------------Start function Sorting --------------------------- */

    //  $(document).ready(function(){
    //     $(document).on('click', '#sorting a', function(event){
    //         event.preventDefault();
        
    //         var column_name = $(this).attr('href').split('sort=')[1];
    //         alert(column_name);
    //        var order_type = $(this).attr('href').split('sort=')[1];
    //        var order_type = $(this).attr('href').split('direction=')[1];
    //        alert(order_type);
    //         var reverse_order = 'desc';
    //         if(order_type == 'asc')
    //             {
    //             reverse_order = 'desc';
    //             $(this).attr('direction', 'desc');
    //             reverse_order = 'desc';
    //             }
    //             if(order_type == 'desc')
    //             {
    //              $(this).attr('direction', 'asc');
    //             reverse_order = 'asc';
    //             }
    //         sortEmployee(order_type);
    //        //alert(order_type);
    //     });
    // });

    // function sortEmployee(order_type){
    //     $.ajax({
    //        type: 'GET',
    //        data: {
    //         // column_name: column_name,
    //         order_type : order_type,
    //        },
    //        url:"/sorting",
    //       // url:"/sorting?column_name="+column_name+"&order_type="+order_type,
    //         success: function(response){
    //           console.log(response);
    //         }
    //     });
    // }

      /* --------------------Start Sorting --------------------------- */

      

     /* --------------------Start Pagination --------------------------- */
    // $(document).ready(function() {
    //     moreEmployee();

    // });

    $(document).ready(function(){
        $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            // var page = $(this).attr('href');
            // alert(page);
            var page = $(this).attr('href').split('page=')[1];
             moreEmployee(page);
          // console.log(page);
        });
    });

    function moreEmployee(page){
        $.ajax({
           type: 'GET',
           url:"/pagination?page="+page,
            success: function(response){
                var emp = response.employee;
                var page = response.pagination;
                //console.log(emp);
                var tr = '';
                $.each(emp.data, function(key, value){
                // console.log(key);
                var id = value.id;
                var name = value.name;
                var email = value.email;
                var phone = value.phone;
               // console.log(phone);

                tr += '<tr>';
                tr += '<td>'+ id +'</td>';
                tr += '<td>'+ name +'</td>';
                tr += '<td>'+ email +'</td>';
                tr += '<td>'+ phone +'</td>';
                tr += '<td><div class="d-flex">';
                tr += '<td> <a href="#viewEmployeeModal" data-toggle="modal" onclick=viewEmployeeModal("'+id+'")><button class="btn btn-success">Edit</button></a></td>';
                tr += '<td><a href="#deleteEmployeeModel" id="delete_id" onclick=deleteEmployeeModel("'+id+'")><button class="btn btn-danger">Delete</button> </a></td>';  
                tr += '</div></td>';        
                tr += '<tr>';
                });
                $('.pagination').html(page);
                $('.loading').hide();
                $('#employee_data').html(tr);
            }
        });
    }
     /* --------------------End Pagination --------------------------- */
     
     /* --------------------start search table data--------------------------- */
        $(document).ready(function(){
            $('#search').click(function(){
                var search = $('#search_input').val();
                //console.log(search);
                $.ajax({
                    type: "GET",
                    data: {
                        search: search,
                    },
                    url: "{{url('search')}}",
                    success: function(response){
                    var emp = response.employee;
                    var page = response.pagination;
                    // var sort = response.sort();
                    // console.log(sort);
                    var tr = '';
                    $.each(emp.data, function(key, value){
                    // console.log(value);
                    var id = value.id;
                    var name = value.name;
                    var email = value.email;
                    var phone = value.phone;
                // console.log(phone);

                    tr += '<tr>';
                    tr += '<td>'+ id +'</td>';
                    tr += '<td>'+ name +'</td>';
                    tr += '<td>'+ email +'</td>';
                    tr += '<td>'+ phone +'</td>';
                    tr += '<td><div class="d-flex">';
                    tr += '<td> <a href="#viewEmployeeModal" data-toggle="modal" onclick=viewEmployeeModal("'+id+'")><button class="btn btn-success">Edit</button></a></td>';
                    tr += '<td><a href="#deleteEmployeeModel" id="delete_id" onclick=deleteEmployeeModel("'+id+'")><button class="btn btn-danger">Delete</button> </a></td>';  
                    tr += '</div></td>';        
                    tr += '<tr>';

                    });
                    $('.pagination').html(page);
                    $('.loading').hide();
                    $('#employee_data').html(tr);
                    }
                })
            });
        });
        /* --------------------end search table data--------------------------- */

     /* --------------------start show table data--------------------------- */
    $(document).ready(function() {
            employeeList();

    });

    function employeeList(){
        $.ajax({
            type: "GET",
            url:  "{{url('employee-table')}}",
            success: function(response){
                var emp = response.employee;
                var page = response.pagination;
                // var sort = response.sort();
                // console.log(emp);
                var tr = '';
                $.each(emp.data, function(key, value){
                   // console.log(value);
                var id = value.id;
                var name = value.name;
                var email = value.email;
                var phone = value.phone;
               // console.log(phone);

                tr += '<tr>';
                tr += '<td>'+ id +'</td>';
                tr += '<td>'+ name +'</td>';
                tr += '<td>'+ email +'</td>';
                tr += '<td>'+ phone +'</td>';
                tr += '<td><div class="d-flex">';
                tr += '<td> <a href="#viewEmployeeModal" data-toggle="modal" onclick=viewEmployeeModal("'+id+'")><button class="btn btn-success">Edit</button></a></td>';
                tr += '<td><a href="#deleteEmployeeModel" id="delete_id" onclick=deleteEmployeeModel("'+id+'")><button class="btn btn-danger">Delete</button> </a></td>';  
                tr += '</div></td>';        
                tr += '<tr>';

                });
                $('.pagination').html(page);
                $('.loading').hide();
                $('#employee_data').html(tr);
                //$('#sorting').append('<tr><th><a href="#" class="sorting" data-column_name="id" data-sorting_type="desc">ID</a></th></tr>');
                $('#sorting').html([
                '<tr>',
                    '<th><a href="#" class="sorting" data-column_name="id" data-sorting_type="desc">ID</a></th>',
                    '<th><a href="#" class="sorting" data-column_name="name" data-sorting_type="desc">Name</a></th>',
                    '<th><a href="#" class="sorting" data-column_name="email" data-sorting_type="desc">Email</a></th>',
                    '<th><a href="#" class="sorting" data-column_name="phone" data-sorting_type="desc">Phone</a></th>',
                '</tr>'
                ]);

                // $('#employee_data').html([
                // '<tr>',
                //     '<td>'+ id +'</th>',
                //     '<td>'+ name +'</th>',
                //     '<td>'+ email +'</th>',
                //     '<td>'+ phone +'</th>',
                // '</tr>'
                // ]);

             // $('#sorting').append('<th>' + '@sortablelink('id')' + '</th>');
             // $('#sorting').append('@sortablelink('id')');
              
            }
            //         var tr = '';
            //         for(var i = 0; i < emp.data; i++){
            //            // console.log(emp.data);
            //             var id = emp.data[i][0].id;
            //             //console.log(id);
            //             var name = emp.data[i].name;
            //             var email = emp.data[i].email;
            //             var phone = emp.data[i].phone;
            //             tr += '<tr>';
            //             tr += '<td>'+ id +'</td>';
            //             tr += '<td>'+ name +'</td>';
            //             tr += '<td>'+ email +'</td>';
            //             tr += '<td>'+ phone +'</td>';
            //             tr += '<td><div class="d-flex">';
            //             tr += '<td> <a href="#viewEmployeeModal" data-toggle="modal" onclick=viewEmployeeModal("'+id+'")><button class="btn btn-success">Edit</button></a></td>';
            //             tr += '<td><a href="#deleteEmployeeModel" id="delete_id" onclick=deleteEmployeeModel("'+id+'")><button class="btn btn-danger">Delete</button> </a></td>';  
            //             tr += '</div></td>';        
            //             tr += '<tr>';
            //         }
            //         $('.pagination').html(page);
            //         $('.loading').hide();
            //         $('#employee_data').html(tr);
            //         //console.log(tr);
            //    }

        });
    }
    /* --------------------end show table data--------------------------- */
 /* --------------------add form data--------------------------- */
    $(document).ready(function(){
        $('.add-employee').click(function(){
            var name  = $('.add_employee #name_input').val();
            var email = $('.add_employee #email_input').val();
            var phone = $('.add_employee #phone_input').val();
            //console.log(name, email, phone);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                data: {
                    name: name,
                    email: email,
                    phone: phone,
                    //_token: "{{ csrf_token() }}"
                },
                url: "{{url('employee-add')}}",
                success: function(response) {
                    $('#addEmployeeModal').modal('hide');
                  // employeeList();
                     moreEmployee();
                    //alert(response.message);
                }
            })
        });
    });
  /* --------------------add form data--------------------------- */

    /* -----------------show Form data -------------------------- */
    $(document).ready(function(){
        $('.modal-employee').click(function(){
         var id = $(this).attr('data-id');
        //$('#viewEmployeeModal').model('show');
         $.ajax({
                url: "/view-employee/"+id,
                type: 'GET',
               success: function(response) {
                 //console.log(response);
                    $('.edit_employee #name_input').val(response.employee.name);
                    $('.edit_employee #email_input').val(response.employee.email);
                    $('.edit_employee #phone_input').val(response.employee.phone);
                    $('.edit_employee #gtm-id').val(id);
                }
           });
        });
    });
    /* -----------------show Form data -------------------------- */

     /* --------------ajax id show form data-------------------------- */
     function viewEmployeeModal(id){
            var id = id;
            //console.log(id);
            $.ajax({
                type: 'get',
                data: {
                    id: id,
                },
                url: "{{url('view-data')}}",
                success: function(response){
                   // console.log(response);
                   $('.edit_employee #name_input').val(response.name);
                   $('.edit_employee #email_input').val(response.email);
                   $('.edit_employee #phone_input').val(response.phone);
                   $('.edit_employee #gtm-id').val(response.id);
                }
            })
       }

      /* --------------ajax id show form data-------------------------- */


    /* --------------Update form data-------------------------- */
    $(document).ready(function(){
        $('.update-employee').click(function(){
            var name  = $('.edit_employee #name_input').val();
            var email = $('.edit_employee #email_input').val();
            var phone = $('.edit_employee #phone_input').val();
            var id    = $('.edit_employee #gtm-id').val();

            //console.log(id, name, email, phone);
            $.ajax({
                type: "POST",
                data: {
                    name: name,
                    email: email,
                    phone: phone,
                    _token: "{{ csrf_token() }}"
                },
                url: "/update-employee/"+id,
                success: function(response) {
                 //  employeeList();
                   moreEmployee();
                    $('#viewEmployeeModal').modal('hide');
                    //alert(response.message);
                }
            });
        });
    });
     /* --------------Update form data-------------------------- */

    /* --------------Delete table data-------------------------- */
        function deleteEmployeeModel(id){
            var id = id;  
            //console.log(id);
            $.ajax({
                type: "GET",
                data: {
                    id: id,
                },
                url: "{{url('delete-employee')}}",
                success: function(response){
                    //console.log(response);
                  //  employeeList();
                    moreEmployee();
                    //alert(response.message);
                }
            });
        }

    /* --------------Delete table data-------------------------- */

   
    
    /*      show model popup */
    
    //    function editEmployee(id){
    //          $('#viewEmployeeModal').css('display','block');
    //          $('#viewEmployeeModal').addClass('show');
    //    }
    </script>
</body>
</html>