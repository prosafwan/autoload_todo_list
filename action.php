<?php 
require 'vendor/autoload.php';
 $obj=new Todo();

 if(isset($_POST["action"]))  
 {  
      if($_POST["action"] == "Load")  
      {  
         
               $sql="SELECT sum(active) as active_count FROM users where active=1";
               $count_data=$obj->execute_query_count($sql); 
               //print_r($count_data);

                if(!empty($_POST["complate"])=="Complate"){
                     
                     if(!empty($_POST['clear'])=='Clear'){
                     	 $query = "DELETE FROM users WHERE active =1";
      	                 $obj->execute_query($query);
                     }

                     $style='style="text-decoration: line-through;"';
                     echo $obj->get_data_in_table("SELECT * FROM users where active=1 ORDER BY id DESC",$count_data,$style);

                }else{

                echo $obj->get_data_in_table("SELECT * FROM users where active=0 ORDER BY id DESC",$count_data);
                }
 

      }  
      if($_POST["action"] == "Insert")  
      {  
           $data = mysqli_real_escape_string($obj->connect, $_POST["task_name"]);
           $query ="INSERT INTO users(name)VALUES ('".$data."')";  
           $obj->execute_query($query);  
           echo 'Data Inserted';  
      }
      if($_POST["action"] == "Edit"){
      	 $text=$_POST["text"];
      	 $id=$_POST["id"];
      	 $query = "UPDATE users SET name='".$text."' WHERE id='".$id."'";
      	 $obj->execute_query($query);
      	 echo 'Data Updated';
      }       

      if($_POST["action"] == "Delete"){
      	 $id=$_POST["id"];
      	 $query = "DELETE FROM users WHERE id = '".$id."'";
      	 $obj->execute_query($query);
      	 echo 'Data Delete';
      }       

      if($_POST["action"] == "Active"){
      	 $id=$_POST["id"];
      	 $query = "UPDATE users SET active=1 WHERE id='".$id."'";
      	 $obj->execute_query($query);
      	 echo 'Update Active';
      }  
 } 

?>