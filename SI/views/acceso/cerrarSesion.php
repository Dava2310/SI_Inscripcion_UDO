<?php
    session_start();
    session_destroy();
    echo "<script>window.alert('SE HA CERRADO SU SESION');</script>";
    echo "<script>window.location='/';</script>";
    exit();
?>