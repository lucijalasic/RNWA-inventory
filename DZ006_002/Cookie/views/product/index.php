<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
    border: 1px solid #ddd;
    padding: 8px;
}

th {text-align: left;
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #ba936c;
    color: white;
}
.btn1{
  background-color: #59be66;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
</style>
<div class="container">
	<br>
    <center><h1>Product</h1></center>
	<br>

  <a class="btn1" href="?controller=product&action=verifyinsert" role="button">Dodaj +</a>


  <div class="table-responsive"> 
    <table class="table">
        <tr>
            <th>Produkt ID</th>
            <th>Naziv</th>
            <th>Brand</th>
            <th>Kategorija</th>
            <th>Količina</th>
            <th>Ocjena</th>
            <th>Aktivno</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
            
        </tr>
        <?php foreach ($product as $row): ?>
        <tr>
            <td><?php echo $row->product_id ?></td>
            <td><?php echo $row->product_name ?></td>
            <td><?php echo $row->brand_id ?></td>
            <td><?php echo $row->category_id ?></td>
            <td><?php echo $row->quantity ?></td>
            <td><?php echo $row->rate ?></td>
            <td><?php echo $row->active ?></td>
            <td><?php echo $row->status ?></td>
            <td><a href="?controller=product&action=verifyupdate&id=<?php echo $row->product_id?>"> Uredi</a></td>
            <td><a href="?controller=product&action=verifydelete&id=<?php echo $row->product_id?>"> Izbrisi</a></td>

        </tr>
        <?php endforeach ?>
    </table>
	</div>
  </div>
 
    
