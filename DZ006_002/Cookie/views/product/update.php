<div class="container">
<form action="?controller=product&action=update" method="POST">
  <div class="form-group">
    <label for="product_id">product ID:</label>
    <input type="text" class="form-control" name="product_id" value=<?php echo $product->product_id?>>
    </div>
    <div class="form-group">
    <label for="product_name">Naziv:</label>
    <input type="text" class="form-control" name="product_name" value=<?php echo $product->product_name?>>
  </div>
  <div class="form-group">
    <label for="brand_name">Brand:</label>
    <input type="text" class="form-control" name="brand_name" value=<?php echo $product->brand_name?>>
  </div>
  <div class="form-group">
    <label for="category_name">Kategorija:</label>
    <input type="text" class="form-control" name="category_name" value=<?php echo $product->category_name?>>
  </div>
  <div class="form-group">
    <label for="quantity">Količina:</label>
    <input type="text" class="form-control" name="quantity" value=<?php echo $product->quantity?>>
    </div>
    <div class="form-group">
    <label for="rate">Ocjena:</label>
    <input type="text" class="form-control" name="rate" value=<?php echo $product->rate?>>
  </div>
  <div class="form-group">
    <label for="active">Aktivno:</label>
    <input type="text" class="form-control" name="active" value=<?php echo $product->active?>>
  </div>
  <div class="form-group">
    <label for="status">Status:</label>
    <input type="text" class="form-control" name="status" value=<?php echo $product->status?>>
  </div>
 
    <button type="submit" class="btn btn-default">Confirm</button>
</form> 
</div>