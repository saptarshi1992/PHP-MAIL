<?php
$data_set = file_get_contents('movies.json');
$data_set = json_decode($data_set, TRUE);
$movie_info = [];
$movie_id;
$count_words = [];
$unique_movie_info = [];
$new_data = [];
//FIND OUT DUPLICATE VALUES//


/*foreach ($data_set as $data) {
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
*/
foreach ($data_set as $data) {

  if (array_key_exists($data['movie_id'], $movie_info)) {
    if ($movie_info[$data['movie_id']]['name'] == NULL) {
      $movie_info[$data['movie_id']]['name'] = $data['name'];
    }
    if ($movie_info[$data['movie_id']]['release_date'] == NULL) {
      $movie_info[$data['movie_id']]['release_date'] = $data['release_date'];
    }
    if ($movie_info[$data['movie_id']]['rating'] == NULL) {
      $movie_info[$data['movie_id']]['rating'] = $data['rating'];
    }
  } else {
    if ($data['release_date'] != NULL) {
      $date = $data['release_date'];
      $movie_year = explode('-', $date);
      if ($movie_year[0] <= 2020 && $data['rating'] != null)
        $movie_info[$data['movie_id']] = $data;
    }
  }
}
foreach ($movie_info as $key => $value) {
  $unique_movie_info[] = $value;
}
//print_r($unique_movie_info);
//sort using rating of this movie json::

usort($unique_movie_info, function($a, $b) {
  return $b['rating'] <=> $a['rating'];
});

//sort using movie titile::
usort($unique_movie_info, function ($a, $b) {
  return strcmp($b['name'], $a['name']);

});
print_r($unique_movie_info);
//print_r(json_encode($unique_movie_info));
/*
foreach ($unique_movie_info as $m) {
  $new_data[$m['rating']]= $m;
}
print_r($new_data);
//print_r(json_encode($unique_movie_info));*/


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