<?php 
$url = "http://localhost:8000/api"; //Laravel API URL
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
$json = curl_exec($ch);
if(!$json) {
    echo curl_error($ch);
}
curl_close($ch);
$tasks = json_decode($json, true);
?>
<html>

<head>
    <title>App Name - </title>

    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>

    <style>
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #9C27B0;
            color: white;
            text-align: center;
        }

    </style>

</head>

<body>

    <div class="container">
            <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Task List for MendVIP </h2>
            </div>
            
        </div>
    </div>
		
           
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" style="width: 80%; display: inline">
                <div class="pull-right">
                	<a class="btn btn-success" href="javascript:create_task()" title="Create a task"> <i class="fas fa-plus-circle"></i>
                    </a>
            	</div>
                </div>
                
            </div>
  
    
    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        <?php
        foreach($tasks as $task) { ?>
	 <tr>
                <td><?php echo $task['id']?></td>
                <td><label id="labelName<?php echo $task['id']?>"><?php echo $task['name']?></label>
                	<input type="text" name="nameEdit<?php echo $task['id']?>" id="nameEdit<?php echo $task['id']?>" class="form-control" placeholder="Name" value="<?php echo $task['name']?>" style="display:none">
                </td>
                <td>
                  <a href="javascript:edit_task(<?php echo $task['id']?>)" class="btn btn-sm btn-outline-danger py-0 edit" id="edit_label<?php echo $task['id']?>">Edit</a>
                  <a href="javascript:edit_cancel(<?php echo $task['id']?>)" class="btn btn-sm btn-outline-danger py-0 edit" id="edit_cancel<?php echo $task['id']?>" style="display:none">cancel</a>
                  <a href="" onclick="if(confirm('Do you want to delete this task?'))event.preventDefault(); delete_task(<?php echo $task['id']?>)" class="btn btn-sm btn-outline-danger py-0">Delete</a>
                </td>
            </tr>
	<?php }
        ?>
                   
                   
            </table>

    

    </div>
</body>

<script type="text/javascript">

function edit_task(id) {
	$('#labelName'+id).hide();
	$('#nameEdit'+id).show();
	$('#nameEdit'+id).select();
	$('#edit_label'+id).hide();
	$('#edit_cancel'+id).show();
	
	$('#nameEdit'+id).keypress(function(event) {
	
		  if (event.keyCode == '13') {
		  	var task = new Object();
			task.name = $('#nameEdit'+id).val();
			$.ajax({  
			     url: 'http://localhost:8000/api/'+id,  
			     type: 'PUT',  
			     dataType: 'json', 
			     data: task,
			     success: function (data, textStatus, xhr) {  
				   console.log('task edited');
				   location.reload();  
			     },  
			     error: function (xhr, textStatus, errorThrown) {  
				 console.log('Error in Operation: '+errorThrown);
				 location.reload(); 
			     }  
			 });		 
			
		  }
	  });
};
function edit_cancel(id) {
	$('#labelName'+id).show();
	$('#nameEdit'+id).hide();
	$('#edit_cancel'+id).hide();
	$('#edit_label'+id).show();
	$('#nameEdit'+id).val($('#labelName'+id).html());
};
function create_task() {
 var task = new Object();
task.name = $('#name').val();
$.ajax({  
     url: 'http://localhost:8000/api/',  
     type: 'POST',  
     dataType: 'json', 
     data: task,
     success: function (data, textStatus, xhr) {  
           console.log('task created');
           location.reload();  
     },  
     error: function (xhr, textStatus, errorThrown) {  
         console.log('Error in Operation: '+errorThrown);
         location.reload(); 
     }  
 });

}



function delete_task(id) {
$.ajax({  
     url: 'http://localhost:8000/api/'+id,  
     type: 'DELETE',  
     dataType: 'json', 
     success: function (data, textStatus, xhr) {  
           console.log('deleted');
           location.reload();  
     },  
     error: function (xhr, textStatus, errorThrown) {  
         console.log('Error in Operation');  
     }  
 });

}
</script>
</html>
