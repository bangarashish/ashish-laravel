<html> 
<head> 
    <title> Employee Table</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
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
       
        <!-- <div class="row"> 
            <div class="col"> 
                <table class="table"> 
                    <thead> 
                        <tr> 
                            <th> @sortablelink('id') </th>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Phone </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($employee as $employees)
                        <tr> 
                            <td>{{$employees->id}}</td>
                            <td>{{$employees->name}} </td>
                            <td>{{$employees->email}} </td>
                            <td>{{$employees->phone}} </td>
                            <td> 
                             <a href="{{url('/edit')}}/{{$employees->id}}"> 
                              <button id="form-edit" class="btn btn-primary"> Edit </button>
                            </a>   -->
                            <!-- <a href="#viewEmployeeModal" 
                            class="btn btn-success modal-employee" data-id="{{$employees->id}}" data-toggle="modal">
                            <span>Edit</span> </a> -->

                            <!-- <a href="javascript:void(0)" id="edit-post" data-id="" class="btn btn-info"> -->
                            <!-- </td>
                        </tr> -->
                        <!-- @endforeach -->
                    <!-- </tbody>
                </table> -->
                    <!-- {{$employee->links()}} -->
            <!-- </div> -->
        <!-- </div> --> 
        <!--  -----------show table data by ajax -------------------- -->
        <div class="row table"> 
                <table class="table"> 
                    <thead> 
                        <tr> 
                            <th> Name</th>
                            <th> Email</th>
                            <th> phone</th>
                        </tr> 
                    </thead>
                    <tbody id="employee_data"> 
                    </tbody>
                </table>
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
        $(document).ready(function(){
            $('#search').click(function(){
                var search = $('#search_input').val();
                console.log(search);
                // $.ajax({
                //     type: "get",
                //     data: {
                //         search: search,
                //     },
                //     url: "{{url('search')}}",
                //     success: function(response){
                //         console.log(response);
                       
                //     }
                // })
            });
        });

     /* --------------------show table data--------------------------- */
    $(document).ready(function() {
            employeeList();

    });

    function employeeList(){
        $.ajax({
            type: "GET",
            url: "{{url('employee-table')}}",
            success: function(response){
                //console.log(response);
                var tr = '';
                for(var i = 0; i < response.length; i++){
                    //console.log(i);
                    var id = response[i].id;
                    var name = response[i].name;
                    var email = response[i].email;
                    var phone = response[i].phone;
                   // console.log(name);
                    tr += '<tr>';
                    tr += '<td>'+ id +'</td>';
                    tr += '<td>'+ name +'</td>';
                    tr += '<td>' + email+ '</td>';
                    tr += '<td>'+ phone + '</td>';
                    tr += '<td><div class="d-flex">';
                    tr += '<td> <a href="#viewEmployeeModal" data-toggle="modal" onclick=viewEmployeeModal("'+id+'")><button class="btn btn-success">Edit</button></a></td>';
                    tr += '<td><a href="#deleteEmployeeModel" id="delete_id" onclick=deleteEmployeeModel("'+id+'")><button class="btn btn-danger">Delete</button> </a></td>';  
                    tr += '</div></td>';        
                    tr += '<tr>';
                }
                $('.loading').hide();
                $('#employee_data').html(tr);
            }
        });
    }
    /* --------------------show table data--------------------------- */
 /* --------------------add form data--------------------------- */
    $(document).ready(function(){
        $('.add-employee').click(function(){
            var name = $('.add_employee  #name_input').val();
            var email = $('.add_employee #email_input').val();
            var phone = $('.add_employee #phone_input').val();
            //console.log(name, email, phone);
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            $.ajax({
                type: 'post',
                data: {
                    name: name,
                    email: email,
                    phone: phone,
                    _token: "{{ csrf_token() }}"
                },
                url: "{{url('employee-add')}}",
                success: function(response) {
                    $('#addEmployeeModal').modal('hide');
                    employeeList();
                    //alert(response.message);
                }
            })
        });
    });
  /* --------------------add form data--------------------------- */

    /* -----------------show From data -------------------------- */
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
    /* -----------------show From data -------------------------- */

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
                    employeeList();
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
                    employeeList();
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