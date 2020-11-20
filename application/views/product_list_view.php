<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link href="<?php echo base_url().'assets/css/bootstrap.css'?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url().'assets/css/datatables.css'?>" rel="stylesheet" type="text/css">
    
</head>
<body>
    <div class="container">
 
      <div class="row justify-content-md-center">
        <div class="col col-lg-12">
            <h3>Product List</h3>
            <?php echo $this->session->flashdata('msg');?>
            <a href="<?php echo site_url('product/add_new');?>" class="btn btn-success btn-sm">Add New Product</a><hr/>
            <!-- <a href="<?php echo  base_url('/ExportController/exportCSV'); ?>"class="btn btn-success btn-sm">Export</a><br><br> -->



            <table class="table table-striped" id="mytable" style="font-size: 14px;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Ingredient</th>
                        <th>Quantity</th>
                        <th>Serves</th>
                        <th>Cooking</th>
                        <th>Preparation</th>
                        <th>Category</th>
                        <th>Recipe</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 0;
                        foreach ($products->result() as $row):
                            $no++;
                    ?>
                    <tr>
                        <td><?php echo $no;?></td>
                        <td><?php echo $row->product_name;?></td>
                        <td><?php echo $row->quantity;?></td>
                        <td><?php echo $row->product_serves;?></td>
                        <td><?php echo $row->product_cooking;?></td>
                        <td><?php echo $row->product_preparation;?></td>
                        <td><?php echo $row->category_name;?></td>
                        <td><?php echo $row->subcategory_name;?></td>

                       <!-- method -->
                        
                        <td>
                        <a href="<?php echo site_url('product/get_edit/'.$row->product_id);?>" class="btn btn-sm btn-info">Edit</a>

                        <a href="<?php echo site_url('product/delete/'.$row->product_id);?>" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                       
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>

                          
            <h4>Ingredient</h4>
            <?php echo $row->product_name;?>
            <h4>Method: </h4>
            <br>
            <?php echo $row->method;?>

                       
        </div>
      </div>
 
    </div>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/datatables.js'?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#mytable').DataTable();
        });
    </script>
   
</body>
</html>