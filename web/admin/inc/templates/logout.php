<?php
session_start();

unset ($_SESSION['username']);

session_destroy();

echo 1;
