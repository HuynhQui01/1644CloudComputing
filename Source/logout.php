<?php
    setcookie("userName","", time()-7200);
    setcookie("role","", time()-7200);
    setcookie("storeID","", time()-7200);
    setcookie("uID","", time()-7200);
    setcookie("address","", time()-7200);
    header('location: home.php');
?>