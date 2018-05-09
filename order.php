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
"SELECT c.FirstName, c.LastName, t.Name
FROM customer AS c, invoice AS i, invoiceline AS il, track AS t
WHERE i.InvoiceId=? AND i.InvoiceId=il.InvoiceId AND t.TrackId=il.TrackId
GROUP BY t.TrackId";
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
            if($id)
                echo $rows[0]['FirstName'] . " " . $rows[0]['LastName'];
            ?>
        </title>
    </head>
    <body>
        <ul>
        <?php
        foreach($rows as $row){
            echo "<li>${row['Name']}</li>";
        }    
        ?>
        </ul>
    </body>
</HTML>