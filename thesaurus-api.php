<?php
$word = $_GET['word'] ?? false;
$options = $word ? \PhantomWatson\Bombasticator\API::fetch($word) : [];
echo json_encode($options);
