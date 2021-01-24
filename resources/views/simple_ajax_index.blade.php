<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel 5.8 - DataTables Server Side Processing using Ajax</title>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="container">    
     <br />
     <h3 align="center">Laravel Simple Ajax Crud Operations</h3>
     <br />
     <div align="right">
      <button type="button" name="create_record" id="create_record" data-target="#formModal" class="btn btn-success btn-sm">Create Record</button>
     </div>
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="user_table">
           <thead>
            <tr>
                <th width="10%">S. No</th>
                <th width="35%">First Name</th>
                <th width="35%">Last Name</th>
                <th width="30%">Action</th>
            </tr>
           </thead>
           <tbody>
               <?php
               $x = 1;
               ?>
                @foreach ($data as $student)
                    <tr id="sid_{{$student->id}}">
                        <td>
                            {{$x}}
                        </td>
                        <td>
                            {{$student->first_name}}
                        </td>
                        <td>
                            {{$student->last_name}}
                        </td>
                        <td>
                            <button type="button" id="{{$student->id}}" class="edit btn btn-info">Edit</button>
                            <button type="button" id="{{$student->id}}" class="delete btn btn-danger">Delete</button>
                        </td>
                    </tr>
                  <?php
                  $x++;
                  ?>
                @endforeach
           </tbody>
       </table>
   </div>
   <br />
   <br />
  </div>
 </body>
</html>

<div id="formModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Record</h4>
        </div>
        <div class="modal-body">
         <span id="form_result"></span>
         <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label class="control-label col-md-4" >First Name : </label>
            <div class="col-md-8">
             <input type="text" name="first_name" id="first_name" class="form-control" />
            </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-4">Last Name : </label>
            <div class="col-md-8">
             <input type="text" name="last_name" id="last_name" class="form-control" />
            </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-4">Select Profile Image : </label>
            <div class="col-md-8">
             <input type="file" name="image" id="image" />
             <span id="store_image"></span>
            </div>
           </div>
           <br />
           <div class="form-group" align="center">
            <input type="hidden" name="action" id="action" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
           </div>
         </form>
        </div>
     </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    function loop_through_tr(){
        jQuery('table > tbody  > tr').each(function(index, tr) {
            jQuery(this).find('td:first-child').text(index+1);
        });
    }
    jQuery(document).ready(function(){
        $('#create_record').click(function(){
            $('.modal-title').text("Add New Record");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#formModal').modal('show');
        });
        $("#sample_form").on('submit', function(){
            event.preventDefault();
            if($('#action').val() == 'Add')
            {
            $.ajax({
                type: 'POST',
                url: '/simple-ajax-crud/add',
                data: $(this).serialize(),
                success: function(response){
                    console.log(response);
                    if(response){
                        $("#user_table tbody").append('<tr id="sid_'+response.id+'"><td></td><td>'+response.first_name+'</td><td>'+response.last_name+'</td><td> <button type="button" id="'+response.id+'" class="edit btn btn-info">Edit</button><button type="button" id="'+response.id+'" class="delete btn btn-danger">Delete</button></td></tr>');
                        loop_through_tr();
                        $("#sample_form")[0].reset();               
                        $('#formModal').modal('hide');
                    }

                },
                error: function(error){
                    console.log(error);
                }
            });
            }

            if($('#action').val() == "Edit")
            {
                var first_name = $("#first_name").val();
                var last_name = $("#last_name").val();
                var id = $("#hidden_id").val();
            $.ajax({
                url:"{{ route('simple-ajax-crud.update') }}",
                method:"POST",
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType:"json",
                success:function(data)
                {
                    var html = '';
                    if(data.errors)
                    {
                        html = '<div class="alert alert-danger">';
                        for(var count = 0; count < data.errors.length; count++)
                        {
                        html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if(data.success)
                    {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#sample_form')[0].reset();
                        $('#store_image').html('');
                        $("#sid_"+id+" td:nth-child(2)").text(first_name);
                        $("#sid_"+id+" td:nth-child(3)").text(last_name);
                    }
                console.log(html);
                $('#form_result').html(html);
                }
            });
            }
        });

        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
            url:"/simple-ajax-crud/"+id+"/edit",
            dataType:"json",
            success:function(html){
                $('#first_name').val(html.first_name);
                $('#last_name').val(html.last_name);
                $('.modal-title').text("Edit Record");
                $('#hidden_id').val(html.id);
                $('#action_button').val("Edit");
                $('#action').val("Edit");
                $('#formModal').modal('show');
            }
            })
        });
        var row_id;
        $(document).on('click', '.delete', function(){
            row_id = $(this).attr('id');
            console.log(row_id);
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function(){
            $.ajax({
                method:"POST",
                url:"/simple-ajax-crud/"+row_id+"/delete",
                dataType:"json",
                data:{
                    _token:$("input[name=_token]").val()
                },
                beforeSend:function(){  
                    $('#ok_button').text('Deleting...');
                },
                success:function(data)
                {
                    console.log(row_id);
                    setTimeout(function(){
                    $('#sid_'+row_id).remove();
                    loop_through_tr();
                    $('#confirmModal').modal('hide');
                    $('#ok_button').text('Ok');
                    }, 2000);
                }
            });
        });
    });
</script>