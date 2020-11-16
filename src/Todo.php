 <?php
   Class Todo{

      public  $connect;  
      private $host = "localhost";  
      private $username = 'root';  
      private $password = '';  
      private $database = 'todo';  

      function __construct()  
      {  
           $this->database_connect();  
      }  

      public function database_connect()  
      {  
           $this->connect =$con= mysqli_connect($this->host, $this->username, $this->password, $this->database);
      }

      public function execute_query($query)  
      {  
           return mysqli_query($this->connect, $query);  
      }     

       public function execute_query_count($query)  
      {  
      	    $result = mysqli_query($this->connect, $query);
            $data=mysqli_fetch_assoc($result);
            return $data['active_count'];
      }


     public function get_data_in_table($query,$count_data,$style=false)  
      {  
      	   if($count_data > 0) {
             $count_data='<a class="btn_clear_complate">Clear Complate<a/>';
           }

           $output = '';  
           $result = $this->execute_query($query); 
           $output .= '  
           <table id="testTable" class="table table-bordered table-striped">';  
           $n=0;
           while($row = mysqli_fetch_object($result))  
           {  
           	    $n++;

           	    if($style){
                    $stylecss=$style;
                    $editable='';
           	    }else{
           	    	$stylecss='data-id1="'.$row->id.'"';
           	    	$editable='contenteditable';
           	    }
           	    
                $output .= '  
                <tr>       
                     <td style="width:6%"><input class="radio_check" name="radio_check" id="radio_check"  type="radio" value="'.$row->id.'" data-id2="'.$row->id.'" /></td>  
                     <td id="'.$row->id.'" class="name" '.$stylecss.' '.$editable.'>'.$row->name.'</td>         
                     <td class="button_hide"  style="width:4%"><button type="button" name="delete_btn" data-id3="'.$row->id.'" class="btn btn-danger btn-xs btn_delete">X</button></td>  
                </tr>  
                ';  
           }  

            $output .= '  
            <tr>       
                 <td colspan="3">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   '.$n.' items left
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <a class="btn_all">All</a>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <span id="result">Active</span>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <a class="btn_complate">Complate</a>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   '.$count_data.'
                   </td>  
            </tr>  
            ';  

           $output .= '</table>';  
           return $output;  
      } 


   }
 ?>