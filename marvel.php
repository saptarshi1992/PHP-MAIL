<?php
$data_set = file_get_contents('movies.json');
$data_set = json_decode($data_set, TRUE);
$movie_info = [];
$movie_id;
$count_words = [];
//FIND OUT DUPLICATE VALUES//
foreach ($data_set as $data) {
  //$movie_id = $data['movie_id'];
  if ($movie_id == $data['movie_id']) {
    $movie_info[count($movie_info) - 1]['name'] .= $data['name'];
    $movie_info[count($movie_info) - 1]['release_date'] .= $data['release_date'];
    $movie_info[count($movie_info) - 1]['rating'] .= $data['rating'];
  } else {
    if ($data['release_date'] != NULL && $data['release_date'] <= '2019-01-01' && $data['release_date'] >= '2018-01-01') {
      $movie_id = $data['movie_id'];
      $movie_info[] = array(
        'name' => $data['name'],
        'release_date' => $data['release_date'],
        'movie_id' => $data['movie_id'],
        'rating' => $data['rating']
      );
    }
  }
  // print_r($movie_id);
}
//print_r(json_encode($movie_info));

//frquent word in name//

$stopWords = ["a", "an", "and", "the", "is", "of", "with", "for", "in", "to", "as"];
foreach ($data_set as $data) {
  $clean_set = explode(' ', $data['name']);
  foreach ($clean_set as $clean) {
    if ($clean != empty($clean) && !in_array(strtolower($clean), $stopWords) && !empty($clean) && !is_numeric($clean)) {
      //print_r($clean);
      $cleanStr = preg_replace('/[^A-Za-z0-9]/', '', $clean);
      $count_words[$cleanStr] = isset($count_words[$cleanStr]) ? $count_words[$cleanStr] + 1 : 1;
    }
  }
}
arsort($count_words);
print_r(key($count_words));
