<!DOCTYPE html>
<html>
 <head>
  <title>To Do List</title>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  <style>
		   body
		   {
		    font-family: 'Comic Sans MS';
		   }

		   .list-group-item
		   {
		    font-size: 26px;
		   }

		    .myclass2{
		     text-decoration: line-through;
		    }

		    .myclass1{
		    	text-decoration: none;
		    }

		    .container {
		      width: 584px;
		    }

		  table tr button { opacity:0; float:right }
		  table tr:hover button { opacity:1 }

	  </style>
 </head>

 <body>
  <div class="container">
   <h1 align="center">To-Do List</h1>
   <br />
   <div class="panel panel-default">
	    <div class="panel-heading">
		     <div class="row">
			      <div class="col-md-9">
			       <h3 class="panel-title">My To-Do List</h3>
			      </div>
		     </div>
	    </div>

	      <div class="panel-body">
		       <form method="post" id="to_do_form">
			        <span id="message"></span>
			        <div class="input-group" style="width: 100%;">
			             <input type="text" name="task_name" id="task_name" class="form-control input-lg" autocomplete="off" placeholder="Title..." />
			        </div>
		       </form>
	       </div>
	       <div id="user_table" class="table-responsive">  </div>
      </div>
     </div>
  </div>
 </body>
</html>


<script>
 $(document).ready(function(){

      load_data();
      function load_data()  
       {  
            var action = "Load";
            //alert(action);  
            $.ajax({  
                 url:"action.php",  
                 method:"POST",  
                 data:{action:action},  
                 success:function(data)  
                 {  
                      $('#user_table').html(data);  
                 }  
            });  
       }


		$('input').change(function(){
	        if($('#task_name').val() !== ''){
	            // var task_name = $('#task_name').serialize();
	             var task_name = $('#task_name').val();
		        // alert(task_name);
		         var action='Insert';
                 $.ajax({
				    type:'post',
				    data:{action:action,task_name:task_name},
				    url:'action.php',
				    success:function(response){
				       //console.log(response);
				        $("#task_name").val("");
				        load_data();
				       }
				  });
	        }
		});


		function edit_data(id, text, column_name)  
	    {  
	    	var action = "Edit";
	        $.ajax({  
	            url:"action.php",  
	            method:"POST",  
	            data:{id:id, text:text, column_name:column_name,action:action},  
	            dataType:"text",  
	            success:function(data){ 
	                load_data(); 
	            }  
	        });  
	    }  
	    $(document).on('blur', '.name', function(){ 
	        var id = $(this).data("id1");  
	        var name = $(this).text();  
	        edit_data(id, name, "name");  
	    });



         $(document).on('click', '.radio_check', function(){
    	   var id = $(this).data("id2");
		    document.getElementById(id).style.color = "grey";
		    var gender = document.querySelector('input[name = radio_check]:checked').value;
            result.innerHTML ="<a class='btn_active' data-id5='"+gender+"'>Active<a/>";
        })




	   $(document).on('click', '.btn_active', function(){
	   	   var id=$(this).data("id5");
	   	   var action ="Active";
            $.ajax({  
                url:"action.php",  
                method:"POST",  
                data:{id:id,action:action},  
                dataType:"text",  
                success:function(data){  
                    load_data(); 
                }  
            });  
	   })	   


	   $(document).on('click', '.btn_all', function(){
           load_data();
	   })	   

	  $(document).on('click', '.btn_clear_complate', function(){
       	   var clear = "Clear";
       	   var action ="Load";
	   	   var complate ="Complate";
            $.ajax({  
                url:"action.php",  
                method:"POST",  
                data:{action:action,complate:complate,clear:clear},  
                dataType:"text",  
                success:function(data){  
                    $('#user_table').html(data);
                }  
            }); 
	   })


	   $(document).on('click', '.btn_complate', function(){
	   	   var action ="Load";
	   	   var complate ="Complate";
            $.ajax({  
                url:"action.php",  
                method:"POST",  
                data:{action:action,complate:complate},  
                dataType:"text",  
                success:function(data){ 
                    $('#user_table').html(data);

                }  
            });  
	   })


	    $(document).on('click', '.btn_delete', function(){  
	        var id=$(this).data("id3");  
	       // if(confirm("Are you sure you want to delete this?"))  
	       // {  
	        	var action = "Delete";
	            $.ajax({  
	                url:"action.php",  
	                method:"POST",  
	                data:{id:id,action:action},  
	                dataType:"text",  
	                success:function(data){  
	                    load_data(); 
	                }  
	            });  
	        //}  
	    });


 });

 </script>