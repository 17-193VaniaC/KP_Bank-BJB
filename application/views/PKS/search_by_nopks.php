<?php
$sqli = mysqli_connect("localhost", "root", "", "bankbjb");
if($sqli === false){
    die("ERROR: Could not connect to database. " . mysqli_connect_error());
}
 
if(isset($_REQUEST["term"])){
    $sql = "SELECT * FROM pks WHERE NO_PKS LIKE ?";
    
    if($stmt = mysqli_prepare($sqli, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $term);
        $term = $_REQUEST["term"] . '%';
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $nopks=$row['id'];
                $url="rincian_pks.php?no_pks=$nopks";
                echo "<a href=$url><p>" . $row["NAMA_PROJECT"] . '|'.$row["JENIS"]. '|'. $row["VENDOR"]. "</p></a>";}
            } 
            else{
                echo "<p>       </p>";}
        }   
    }    
    mysqli_stmt_close($stmt);
}
mysqli_close($sqli);
?>
