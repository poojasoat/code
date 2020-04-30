<?php  
 $connect = mysqli_connect("localhost", "root", "", "users");  
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $name=$_POST['name']; 
      $price=$_POST['price'];
     $image=$_POST['image'] ;
      if($_POST["id"] != '')  
      {  
           $query = "  
           UPDATE product_record   
           SET name='$name',   
           price='$price',   
           image = '$image'
          WHERE id='".$_POST["id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {  
           $query = "  
           INSERT INTO product_record(name, image,price)  
           VALUES('$name',  '$image','$price' );  
           ";  
           $message = 'Data Inserted';  
      }  
      if(mysqli_query($connect, $query))  
      {  
           $output .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM product_record ORDER BY id DESC";  
           $result = mysqli_query($connect, $select_query);  
           $output .= '  
                <table class="table table-bordered">  
                     <tr> <th>Id</th>
                     <th>Product Name</th>
                     <th>Product Image</th>
                     <th>Product Price</th>
                     <th>Action</th> 
                     </tr>  
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                     <td>' . $row["id"] . '</td>  
                     <td>' . $row["name"] . '</td>  
                          <td>'.$row["image"].'</td>
                          <td>'.$row["price"].'</td>
                          <td>'.$row["image"].'</td>


                          <td><input type="button" name="edit" value="Edit" id="'.$row["id"] .'" class="btn btn-info btn-xs edit_data" />
                          <input type="button" name="view" value="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data" /></td>  
                           
                     </tr>  
                ';  
           }  
           $output .= '</table>';  
      }  
      echo $output;  
 }  
 ?>
 