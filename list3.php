<html>
   
   <head>
      <title>RECORDS</title>
   </head>
   
   <body>
   <a align='left' href="erp.php"> HOME </a>
      <?php
         $dbhost = 'localhost';
         $dbuser = 'root';
         $dbpass = 'root';

         

         $rec_limit = 6;
      $conn = mysql_connect('localhost','root','root','erp');   
         if(! $conn ) {
            die('Could not connect: ' . mysql_error());
         }
         mysql_select_db('erp');
         
         /* Get total number of records */
         $sql = "SELECT count(id) FROM slogin ";
         $retval = mysql_query( $sql, $conn );
         
         if(! $retval ) {
            die('Could not get data: ' . mysql_error());
         }
         $row = mysql_fetch_array($retval, MYSQL_NUM );
         $rec_count = $row[0];
         
       if( isset($_GET{'page'} ) ) {
            $page = $_GET{'page'} + 1;
            $offset = $rec_limit * $page ;
         }else {
            $page = 0;
            $offset = 0;
         } 
         
         $left_rec = $rec_count - ($page * $rec_limit);
         $sql1= "SELECT pname, email, mobile ". 
            "FROM slogin ".
            "LIMIT $offset, $rec_limit";
            
         $retval = mysql_query( $sql1, $conn );
         
         if(! $retval ) {
            die('Could not get data: ' . mysql_error());
         }

  



          echo 
         "<h2>Registered Student </h2>";

          

         echo 
  
        "<table border='3'>
        <tr>
       <th>Name</th>
       <th>Email</th>
        <th>Mobile</th>
        </tr>";
        
        
      while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
     
echo 
      
      "<tr>
      <td>{$row['name']}</td>
      <td>{$row['email']}</td>
      <td>{$row['mobile']}</td>
      </tr>\n";


 
   }

 if( $page > 0 ) 
         {
         $last = $page - 2;
         echo '<a href="?page=' .$last .'">   <b>Previous <b/> </a> | ';
         echo '<a href="?page=' .$page .'">   <b>Next</b>     </a> <br></br>';

         }
         else if( $page == 0 )
         {
         echo '<a href="?page=' .$page .'">  <b>Next</b> </a> <br></br>';
         }
         else if( $left_rec < $rec_limit ) {
         $last = $page - 2;
         echo '<a href="?page=' .$last .'"> <b>Previous</b> </a> |"';
         }

        mysql_close($conn);
        ?>
      
          </body>
</html>



