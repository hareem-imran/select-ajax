<?php
            $msg = '';
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $image = $_FILES['image']['tmp_name'];
                $img = file_get_contents($image);
                $con = mysqli_connect('localhost','root','','pos_db') or die('Unable To connect');
                $sql = "insert into product (image) values(?)";

                $stmt = mysqli_prepare($con,$sql);

                mysqli_stmt_bind_param($stmt, "s",$img);
                mysqli_stmt_execute($stmt);

                $check = mysqli_stmt_affected_rows($stmt);
                if($check==1){
                    $msg = 'Image Successfullly Uploaded';
                }else{
                    $msg = 'Error uploading image';
                }
                mysqli_close($con);
            }
            ?>



<!DOCTYPE html>
<html>
<head>
    <title>Add New</title>
    <link href="<?php echo base_url().'assets/css/bootstrap.css'?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
<script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
</head>
<body>
    <div class="container">
 
      <div class="row justify-content-md-center">
        <div class="col col-lg-6">
            <h3>Add New Recipe:</h3>
            <?php echo $this->session->flashdata('msg');?>
            <a href="<?php echo site_url('product');?>" class="btn btn-success btn-sm"><i class="fa fa-chevron-left"></i> Back</a><hr/>
            <form action="<?php echo site_url('product/save_product');?>" method="post">
 
                <div class="form-group">
                    <label>Ingredient</label>
                    <textarea id='product_name' name='product_name' class="form-control" required></textarea>
                    <!-- <input type="text" class="form-control" name="product_name" placeholder="Ingredient" required> -->
                </div>

                <!-- <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" class="form-control" name="quantity" placeholder="Quantity" required>
                </div> -->
 
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category" id="category" required>
                        <option value="">No Selected</option>
                        <?php foreach($category as $row):?>
                        <option value="<?php echo $row->category_id;?>"><?php echo $row->category_name;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
 
                <div class="form-group">
                    <label>Sub Category</label>
                    <select class="form-control" id="sub_category" name="sub_category" required>
                        <option value="">No Selected</option>
 
                    </select>
                </div>
 
                <div class="form-group">
                    <label>Serves</label>
                    <input type="text" class="form-control" name="product_serves" placeholder="Serves" required>
                </div>

                <div class="form-group">
                    <label>Preparation</label>
                    <input type="text" class="form-control" name="product_cooking" placeholder="Preparation" required>
                </div>

                <div class="form-group">
                    <label>Cooking</label>
                    <input type="text" class="form-control" name="product_preparation" placeholder="Cooking" required>
                </div>

                <div class="form-group">
                    <label>Product Preparation</label>
                    <input type="file" class="form-control-file" id="inputGroupFile01"
                                  aria-describedby="inputGroupFileAddon01" name="image">
                </div>
   
       

                Method: 
                <textarea id='method' name='method' ></textarea><br>

                <button class="btn btn-success" type="submit">Save Product</button>
 
            </form>
        </div>
      </div>
 
    </div>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
 
            $('#category').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('product/get_sub_category');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].subcategory_id+'>'+data[i].subcategory_name+'</option>';
                        }
                        $('#sub_category').html(html);
 
                    }
                });
                return false;
            }); 
             
        });
    </script>
     <script type="text/javascript">

        // Initialize CKEditor


        CKEDITOR.replace('method',{

        width: "540px",
        height: "200px"

        }); 

    </script>
    <script type="text/javascript">

// Initialize CKEditor


CKEDITOR.replace('product_name',{

width: "540px",
height: "200px"

}); 

</script>
</body>
</html>