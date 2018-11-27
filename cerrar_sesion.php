<?php
/**
 * Created by PhpStorm.
 * User: AZETASOFT
 * Date: 26/11/2018
 * Time: 15:42
 */

session_start();
session_destroy();
header("location:index.php");
?>