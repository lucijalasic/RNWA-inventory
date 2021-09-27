<?php
  class CategoryController {
    public function index() {
      // we store all the posts in a variable
      $category = Category::all();
      require_once('views/category/index.php');
    }
  
    public function verifyinsert(){
      require_once('views/category/insert.php');
    }

    public function insert()
    {
      Category::insert($_POST['category_name'],$_POST['category_active'],$_POST['category_status']);
     return call('category', 'index');
    }
  
  public function verifyupdate()
  {
    if (!isset($_GET['id']))
          return call('pages', 'error');
    $category = Category::find($_GET['id']);
    require_once('views/category/update.php');
  }

  public function update()
  {
   
   Category::update($_POST['category_id'],$_POST['category_name'],$_POST['category_active'],$_POST['category_status']);
   return call('category', 'index');
  }

	public function delete() {
      if (!isset($_GET['id']))
        return call('pages', 'error');
      Category::delete($_GET['id']);
      return call('category', 'index');
    }

    public function verifydelete(){
      if (!isset($_GET['id']))
          return call('pages', 'error');
          require_once('views/category/delete.php');
      }
  }
 ?>