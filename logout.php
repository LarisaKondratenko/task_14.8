<?php
session_start();
unset($_SESSION['authorized']);
header('Location: index.php');