<?php
  class ProductController {
    public function index() {
      $product = Product::all();
      require_once('views/product/index.php');
    }
  
    public function verifyinsert(){
      require_once('views/product/insert.php');
    }

    public function insert() {
      Product::insert(
        $_POST['product_id'],
        $_POST['product_name'],
        $_POST['brand_id'],
        $_POST['category_id'], 
        $_POST['quantity'],
        $_POST['rate'],
        $_POST['active'],
        $_POST['status']);
      return call('product', 'index');
    }
  
  public function verifyupdate() {
    if (!isset($_GET['id']))
          return call('pages', 'error');

    $product = Product::find($_GET['id']);
    require_once('views/product/update.php');
  }

  public function update() {
   Product::update(
        $_POST['product_id'],
        $_POST['product_name'],
        $_POST['brand_name'],
        $_POST['category_name'], 
        $_POST['quantity'],
        $_POST['rate'],
        $_POST['active'],
        $_POST['status']);

   return call('product', 'index');
  }

	public function delete() {
      if (!isset($_GET['id']))
        return call('pages', 'error');
        
      Product::delete($_GET['id']);
      return call('product', 'index');
    }

    public function verifydelete(){
      if (!isset($_GET['id']))
          return call('pages', 'error');
          require_once('views/product/delete.php');
      }
  }
 ?>