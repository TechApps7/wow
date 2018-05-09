<?php
if(isset($_GET['search']))
    $search = htmlspecialchars($_GET['search']);

$db = new mysqli("localhost", "nosam", "TXRdQpH1zzhsfqC0", "chinook");
if(!$db->set_charset("utf8")){
    echo "Error setting charset";
}
if($db->connect_errno){
    echo "Error connecting to database<br>";
    echo "Error: ".$db->connect_error."<br>";
}
if(isset($search)){
    $search = "%" . $search . "%";
    $stmt = $db->prepare("SELECT FirstName, LastName, CustomerId FROM customer WHERE FirstName LIKE ? OR LastName LIKE ? ORDER BY FirstName");
    $stmt->bind_param("ss", $search, $search);
    $stmt->execute();
    $result = $stmt->get_result();
}
else
    $result = $db->query("SELECT FirstName, LastName, CustomerId FROM customer ORDER BY FirstName");

if(!$result){
    echo "Error querying database<br>";
    echo "Error: ".$db->error."<br>";
}

$qu = array();
while($row = $result->fetch_assoc()){
    $qu[] = $row;
}
?>
<HTML>
    <head>
        <title>Customer</title>
    </head>
    <body>
        <ul>
            <?php
            foreach($qu as $row){
                $id = $row["CustomerId"];
                echo "<li><a href='customer.php?id=${id}'>" . $row["FirstName"] . " " . $row["LastName"] . " (${id})";
                echo "</a></li>";
            }
            ?>
        </ul>
    </body>
</HTML>