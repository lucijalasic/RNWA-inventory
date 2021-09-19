<?php
function getOrders($ime) { 
	require('../config.php');

    $clientName = '"'.$ime.'"';

	$titles = "<thead>
					<tr>
					<th>ID narudžbe</th>
					<th>Datum narudžbe</th>
					<th>Klijent</th>
					<th>Proizvod</th>
					<th>Količina</th>
					<th>Iznos</th>
					<th>Status</th>
					</tr>
				</thead>
				<tbody> ";
	$endTbody = "</tbody>";

	$query = "SELECT 
		 o.order_id,
		 o.order_date,
		 o.client_name,
		 o.product_name,
		 o.noOfProducts,
		 o.total_amount,
		 o.payment_status
		FROM 
			orders o 
		WHERE o.client_name = " . $clientName;

	$result = $conn->query($query);

    if(mysqli_num_rows($result) > 0) {
 		while($row1 = mysqli_fetch_assoc($result))
 		{
			$output .= '
			<tr>
			  <td>'.$row1["order_id"].'</td>
			  <td>'.$row1["order_date"].'</td>
			  <td>'.$row1["client_name"].'</td>
			  <td>'.$row1["product_name"].'</td>
			  <td>'.$row1["noOfProducts"].'</td>
			  <td>'.$row1["total_amount"].'</td>
			  <td>'.$row1["payment_status"].'</td>
			 </tr>
			';
 		}

		return $titles.$output.$endTbody;

		}
		else {
			return '<div style="color: red;">
						--Traženi klijent '.$clientName.' nema trenutno narudžbi ili ste unijeli neispravno ime!
					</div>';
		}
} 

$server = new SoapServer(null, 
array('uri' => "http://test-uri"));

$server->addFunction("getOrders"); 
$server->handle(); 