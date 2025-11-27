<?php
global $posts;

require_once '../components/header.php';
require_once '../static/posts.php';
require_once '../functions/functions.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
displayPost($posts, $id);

require_once '../components/footer.php';