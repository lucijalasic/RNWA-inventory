<?php

  class Category  {
    public $category_id;
    public $category_name;
    public $category_active;
    public $category_status;


    public function __construct($category_id,$category_name, $category_active, $category_status) {
      $this->category_id      = $category_id;
      $this->category_name    = $category_name;
      $this->category_active  = $category_active;
      $this->category_status  = $category_status;
    }

    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query(
                    'SELECT 
                      * 
                    FROM 
                      category 
                    LIMIT 50 ');

      foreach($req->fetchAll() as $category) {
        $list[] = new Category($category['category_id'], $category['category_name'], $category['category_active'], $category['category_status']);
      }

      return $list;
    }

    public static function find($id) {
      $db = Db::getInstance();
      $id = intval($id);
      $req = $db->prepare(
                    'SELECT 
                    * 
                    FROM 
                      category 
                    WHERE 
                      category_id = :id');
      $req->execute(array('id' => $id));
      $category = $req->fetch();

      return new Category($category['category_id'],$category['category_name'], $category['category_active'], $category['category_status']);
    }

    public static function insert($category_name, $category_active, $category_status) {
      $db = Db::getInstance();
      $sql="INSERT INTO 
              category (category_name, category_active, category_status)
            VALUES 
              ('$category_name', '$category_active', '$category_status')";
      $db->query($sql);
    }

    public static function update($id,$category_name, $category_active, $category_status) {
      $db = Db::getInstance();
      $id = intval($id);
 
      $sql="UPDATE 
              category 
            SET  
              category_name='$category_name', 
              category_active = '$category_active', 
              category_status='$category_status'
            WHERE 
              category_id = '$id' ";
      $db->query($sql);
    }

  	public static function delete($id) {
      $db = Db::getInstance();
      $sql="DELETE FROM 
              category 
            WHERE 
              category_id = '$id'";
	    $db->query($sql);
		}
  }
?>