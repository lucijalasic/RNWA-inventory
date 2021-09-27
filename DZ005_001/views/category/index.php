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
    <center><h1>Category</h1></center>
	<br>

  <a class="btn1" href="?controller=category&action=verifyinsert" role="button">Dodaj +</a>


  <div class="table-responsive"> 
    <table class="table">
        <tr>
            <th>Category ID</th>
            <th>Naziv</th>
            <th>Aktivno</th>
            <th>Status</th>
            <th>Uredi</th>
            <th>Izbriši</th>
            
        </tr>
        <?php foreach ($category as $row): ?>
        <tr>
            <td><?php echo $row->category_id ?></td>
            <td><?php echo $row->category_name ?></td>
            <td><?php echo $row->category_active ?></td>
            <td><?php echo $row->category_status ?></td>
            <td><a href="?controller=category&action=verifyupdate&id=<?php echo $row->category_id?>" class="btn btn-primary btn-xs"> Uredi</a></td>
            <td><a href="?controller=category&action=verifydelete&id=<?php echo $row->category_id?>" class="btn btn-danger btn-xs"> Izbriši</a></td>

        </tr>
        <?php endforeach ?>
    </table>
	</div>
  </div>
 
    
