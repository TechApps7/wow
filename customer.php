<?php
$id = $_GET['id'];
if(filter_var($id, FILTER_VALIDATE_INT)){ 
    $db = new mysqli("localhost", "nosam", "TXRdQpH1zzhsfqC0", "chinook");
    if(!$db->set_charset("utf8")){
        echo "Error setting charset";
    }
    if($db->connect_errno){
        echo "Error connecting to database<br>";
        echo "Error: ".$db->connect_error."<br>";
    }
    $sql = 
"SELECT c.FirstName, c.LastName, i.InvoiceId
FROM customer AS c, invoice AS i
WHERE c.CustomerId=? AND c.CustomerId=i.CustomerId";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = array();
    while($r = $result->fetch_assoc())
        $rows[] = $r;
}
else{
    $id = false;
}

?>

<HTML>
    <head>
        <title>
            <?php 
            if($id && $rows){
            echo $rows[0]['FirstName'] . " " . $rows[0]['LastName'];
        }
        else if(!$id)
            echo "ID Entered was invalid. Please resubmit your data";
        else
            echo "No results";
            ?>
        </title>
    </head>
    <body>
        <?php
        if($id && $rows){
            echo "<h3>" . $rows[0]['FirstName'] . " " . $rows[0]['LastName'] . "</h3>";
        }
        else if(!$id)
            echo "<h1>ID Entered was invalid. Please resubmit your data</h1>";
        else
            echo "<h3>No results</h3>";
        ?>
        <ul>
            <?php
            foreach($rows as $row){
                $id = $row['InvoiceId'];
                echo "<li><a href=order.php?id=${id}> Order #${id}</a></li>";
            }
            
            ?>
        </ul>
        
    </body>
</HTML>
