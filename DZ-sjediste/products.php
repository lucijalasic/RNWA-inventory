<h3 style="text-align: center;">Ispis proizvoda iz baze</h3>
<table>
    <thead>
        <tr>
            <th>
                Naziv proizvoda
            </th>
            <th>
                Količina
            </th>
            <th>
                Ocjena
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        require('../config.php');
        
        $sql = "SELECT product_name, quantity, rate from inventory.product limit 10";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td data-label=".'Naziv proizvoda'.">".$row["product_name"]."</td><td data-label=".'Količina'.">".$row["quantity"]."</td><td data-label=".'Ocjena'.">".$row["rate"]."</td></tr>";
            }
        } else {
            echo "0 results";
        }
        
        $conn->close();
        ?> 
    </tbody>
</table>