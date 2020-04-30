<?php
session_start();
$connect = mysqli_connect("localhost", "root", "");  
mysqli_select_db($connect, 'users');
$results_per_page = 10;
$sql='SELECT * FROM pagination';
$result = mysqli_query($connect, $sql);
$number_of_results = mysqli_num_rows($result);
// determine number of total pages available
$number_of_pages = ceil($number_of_results/$results_per_page);
// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}
// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;
if($_SESSION['is_login'])
{
     $email=$_SESSION['email'];
}
else{
    header("location:login-form.php");
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
 <link rel="stylesheet" type="text/css" href="Css/style.css">
     <?php
          include "header.php";
      ?>
<div class="container-fluid ">
     <div class="row">
       <div class="col-md-2 px-0">
          <?php
          include "nav.php";
          ?>
       </div>
<div class="col-md-10 pl-0">
<div class="container" style="width:100%;">  
     <div class="table-responsive ">
          <table class="table border border-top-0">
               <tr>
                    <td align="right"><button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-success">Add</button> </td>
               </tr>
          </table>
                    <div id="employee_table">  
                         <table   class="table table-striped table-bordered table-hover">  
                         <thead>
                         <tr>
                           <th>Id</th>
                           <th>Product_Name</th>
                           <th>Product_Image</th>
                           <th>Product_Price</th>
                           <th>View</th>
                           <th>Edit</th>
                           <th>Delete</th>
                           </tr>
                        </thead>              
                              <?php  
                              
                              $query = "SELECT * FROM product_record LIMIT " . $this_page_first_result . ',' .  $results_per_page;  
                              $result = mysqli_query($connect, $query);  
                              while($row = mysqli_fetch_array($result))  
                              {  
                              ?>  
                              <tr>
                              <td><?php echo $row["id"]; ?></td>
                               <td><?php echo $row["name"]; ?></td>
                               <td><img src="images/<?php echo $row["image"]; ?>" class="img-responsive imgdiv" /><br /></td>
                               <td>$<?php echo $row["price"]; ?></td>
                               <td><input type="button" name="view" value="view" id="<?php echo $row["id"]; ?>" class="btn btn-Primary btn-xs view_data" /></td>  
                               <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-xs edit_data" /></td>
                                  <!-- delete button -->
                                  <td><a href="delete.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-xs ">Delete</a></td>
  			               </tr>

                                   
                             
                              <?php  
                              }  
                             
                              ?>  
                         </table>  
                              <?php
                              for ($page=1;$page<=$number_of_pages;$page++) {
                                   echo '<a href="welcome1.php?page=' . $page . '">' . $page . '</a> ';
                              }
                              
                              ?>
                    </div>  
               </div>  
          </div>  
</div>
    

</div>

</div>

</div>

<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                
                     <h4 class="modal-title" id="title">Employee Details</h4>  
                 
                <div class="modal-body" id="employee_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 <div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
              <h4 class="modal-title text-center heading">Insert Record</h4>
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                         <label>Product Name:</label>
                        <input type="text" name="name" id="name" class="form-control"><br>
                        <label>Product Image:</label>
                        <input type="text" name="image" id="image" class="form-control"><br>
                        <label >Poduct Price</label>
                        <input type="text" name="price" id="price" class="form-control"><br>
                        
                          <input type="hidden" name="id" id="id" />  
                          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  

 

 <script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var id = $(this).attr("id");  
           $.ajax({  
                url:"fetch.php",  
                method:"POST",  
                data:{id:id},  
                dataType:"json",  
                success:function(data){  
                     $('#name').val(data.name);  
                     $('#image').val(data.image);  
                     $('#price').val(data.price);  
                    
                     $('#id').val(data.id);  
                     $('#insert').val("Update");

                     $('#add_data_Modal').modal('show');  
                     $('.modal-title').html('Edit Record');


                }  
           });  
      });  
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#name').val() == "")  
           {  
                alert("Name is required");  
           }  
           else if($('#image').val() == '')  
           {  
                alert("Image is required");  
           }  
           else if($('#price').val() == '')  
           {  
                alert("price  is required");  
           }  
           else  
           {  
                $.ajax({  
                     url:"insert1.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('#employee_table').html(data);  
                          window.location.reload();

                     }  
                });  
           }  
      });  
      $(document).on('click', '.view_data', function(){  
           var id = $(this).attr("id");  
           if(id != '')  
           {  
                $.ajax({  
                     url:"select.php",  
                     method:"POST",  
                     data:{id:id},  
                     success:function(data){  
                          $('#employee_detail').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });  
           }            
      });  
 });  
 </script>
 



  
