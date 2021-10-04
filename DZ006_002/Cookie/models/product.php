<?php
  class Product  {
    public $product_id;
    public $product_name;
    public $brand_id;
    public $category_id;
    public $quantity;
    public $rate;
    public $active;
    public $status;

    public function __construct($product_id, $product_name, $brand_id, $category_id, $quantity, $rate, $active, $status) {
      $this->product_id    = $product_id;
      $this->product_name  = $product_name;
      $this->brand_id      = $brand_id;
      $this->category_id   = $category_id;
      $this->quantity      = $quantity;
      $this->rate          = $rate;
      $this->active        = $active;
      $this->status        = $status;
    }

    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query(
        'SELECT 
        p.product_id,
        p.product_name,
        b.brand_name,
        c.category_name,
        p.quantity,
        p.rate,
        p.active,
        p.status 
      FROM 
        product p
      JOIN 
        brands b ON p.brand_id= b.brand_id
      JOIN
        category c ON p.category_id = c.category_id');

      foreach($req->fetchAll() as $post) {
        $list[] = new Product(
          $post['product_id'], 
          $post['product_name'], 
          $post['brand_name'], 
          $post['category_name'], 
          $post['quantity'], 
          $post['rate'], 
          $post['active'], 
          $post['status']);
      }

      return $list;
    }

    public static function find($id) {
      $db = Db::getInstance();
      $id = intval($id);
      $req = $db->prepare('SELECT 
                            p.product_id,
                            p.product_name,
                            b.brand_name,
                            c.category_name,
                            p.quantity,
                            p.rate,
                            p.active,
                            p.status 
                          FROM 
                            product p
                          JOIN 
                            brands b ON p.brand_id= b.brand_id
                          JOIN
                            category c ON p.category_id = c.category_id');

      $req->execute(array('id' => $id));
      $post = $req->fetch();

      return new Product(
        $post['product_id'],
        $post['product_name'], 
        $post['brand_id'], 
        $post['category_id'],
        $post['quantity'],
        $post['rate'], 
        $post['active'], 
        $post['status']);
    }

    public static function insert($id, $product_name, $brand_id , $category_id, $quantity, $rate, $active, $status) {
      $db = Db::getInstance();
      $id = intval($id);
      $brand_id = intval($brand_id);

      $sql="INSERT INTO 
              product (product_id, product_name, brand_id, category_id, quantity, rate, active, status)
            VALUES 
              ('$id','$product_name', '$brand_id', '$category_id', '$quantity','$rate', '$active', '$status')";
      $db->query($sql);
    }

    public static function update($id, $product_name, $brand_name, $category_name, $quantity, $rate, $active, $status) {
      $db = Db::getInstance();
      $id = intval($id);

      $query_brand = "SELECT brand_id FROM brands WHERE brand_name='$brand_name' LIMIT 1";
      $brand_id = $db->query($query_brand);
      $query_category = "SELECT category_id FROM category WHERE category_name='$category_name' LIMIT 1";
      $category_id = $db->query($query_category);
    
      $sql="UPDATE 
              product 
            SET 
              product_name = '$product_name', brand_id = '$brand_id', category_id='$category_id', quantity = '$quantity', rate = '$rate', active='$active', status='$status' 
            WHERE 
              product_id = '$id'";
      $db->query($sql);
    }

  	public static function delete($id) {
      $db = Db::getInstance();
      $sql="DELETE FROM 
              product 
            WHERE 
              product_id = '$id'";
	    $db->query($sql);
		}
  }
  
?>