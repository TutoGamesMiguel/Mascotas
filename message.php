<?php

$conn = mysqli_connect("localhost", "root", "", "mascotasweb") or die("Database Error");


$getMesg = mysqli_real_escape_string($conn, $_POST['text']);


$check_data = "SELECT replies FROM chatbot WHERE queries LIKE '%$getMesg%'";
$run_query = mysqli_query($conn, $check_data) or die("Error");

if(mysqli_num_rows($run_query) > 0){
    $fetch_data = mysqli_fetch_assoc($run_query);
    $replay = $fetch_data['replies'];
    echo $replay;
}else{
    echo "¡lo siento, no puedo ayudarte con este incoveniente por favor comunicarse con el adminitrador de la pagina dixon.cardonas@ecci.edu.co!";
}

?>