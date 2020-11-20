<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link href="<?php echo base_url().'assets/css/bootstrap.css'?>" rel="stylesheet" type="text/css">
    <script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
 
      <div class="row justify-content-md-center">
        <div class="col col-lg-6">
            <h3>Edit Recipe:</h3>
            <a href="<?php echo site_url('product');?>" class="btn btn-success btn-sm"><i class="fa fa-chevron-left"></i> Back</a><hr/>
            <form action="<?php echo site_url('product/update_product');?>" method="post">
 
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
                    <select class="form-control category" name="category" required>
                        <option value="">No Selected</option>
                        <?php foreach($category as $row):?>
                        <option value="<?php echo $row->category_id;?>"><?php echo $row->category_name;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
 
                <div class="form-group">
                    <label>Sub Category</label>
                    <select class="form-control sub_category" name="sub_category" required>
                        <option value="">No Selected</option>
 
                    </select>
                </div>
 
                <div class="form-group">
                    <label>Product Serves</label>
                    <input type="number" class="form-control" name="product_serves" placeholder="Serves" required>
                </div>

                <div class="form-group">
                    <label>Product Cooking</label>
                    <input type="number" class="form-control" name="product_cooking" placeholder="Cooking" required>
                </div>

                <div class="form-group">
                    <label>Product Preparation</label>
                    <input type="number" class="form-control" name="product_preparation" placeholder="Preparation" required>
                </div>

                <div class="form-group">
                    <label>Product Preparation</label>
                    <input type="file" class="form-control-file" id="inputGroupFile01"
                                  aria-describedby="inputGroupFileAddon01" name="image">
                </div>
                <!-- <div class="custom-file">
                                <input type="file" class="form-control-file" id="inputGroupFile01"
                                  aria-describedby="inputGroupFileAddon01" name="image"> -->

                Method: 
                <textarea id='method' name='method' ></textarea><br>
 
                <input type="hidden" name="product_id" value="<?php echo $product_id?>" required>
                <button class="btn btn-success" type="submit">Update Product</button>
 
            </form>
        </div>
      </div>
 
    </div>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            //call function get data edit
            get_data_edit();
 
            $('.category').change(function(){ 
                var id=$(this).val();
                var subcategory_id = "<?php echo $sub_category_id;?>";
                $.ajax({
                    url : "<?php echo site_url('product/get_sub_category');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
 
                        $('select[name="sub_category"]').empty();
 
                        $.each(data, function(key, value) {
                            if(subcategory_id==value.subcategory_id){
                                $('select[name="sub_category"]').append('<option value="'+ value.subcategory_id +'" selected>'+ value.subcategory_name +'</option>').trigger('change');
                            }else{
                                $('select[name="sub_category"]').append('<option value="'+ value.subcategory_id +'">'+ value.subcategory_name +'</option>');
                            }
                        });
 
                    }
                });
                return false;
            }); 
 
            //load data for edit
            function get_data_edit(){
                var product_id = $('[name="product_id"]').val();
                $.ajax({
                    url : "<?php echo site_url('product/get_data_edit');?>",
                    method : "POST",
                    data :{product_id :product_id},
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        $.each(data, function(i, item){
                            $('[name="product_name"]').val(data[i].product_name);
                            $('[name="quantity"]').val(data[i].quantity);
                            $('[name="category"]').val(data[i].product_category_id).trigger('change');
                            $('[name="sub_category"]').val(data[i].product_subcategory_id).trigger('change');
                            $('[name="product_serves"]').val(data[i].product_serves);
                            $('[name="product_cooking"]').val(data[i].product_cooking);
                            $('[name="product_preparation"]').val(data[i].product_prreparation);
                        });
                    }
 
                });
            }
             
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