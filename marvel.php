<?php
$jsonData = '[
  {
    "name": "Iron Man",
    "release_date": "2008-05-02",
    "movie_id": "tt0371746",
    "rating": 7.9
  },
  {
    "name": "Captain America: The First Avenger",
    "release_date": "2011-07-22",
    "movie_id": "tt0458339",
    "rating": 6.9
  },
  {
    "name": "Ant-Man",
    "release_date": "2015-07-17",
    "movie_id": "tt0478970",
    "rating": 7.3
  },
  {
    "name": "Captain Marvel 2",
    "release_date": "2022-11-11",
    "movie_id": "tt10676048",
    "rating": ""
  },
  {
    "name": "Fantastic Four",
    "release_date": "",
    "movie_id": "tt10676052",
    "rating": ""
  },
  {
    "name": "Untitled Spider-Man: Far From Home sequel",
    "release_date": "2021-12-17",
    "movie_id": "tt10872600",
    "rating": ""
  },
  {
    "name": "Ant-Man and the Wasp: Quantumania",
    "release_date": "",
    "movie_id": "tt11213558",
    "rating": ""
  }
]';

$data = json_decode($jsonData, true);

$nameCounts = [];
$commonTerms = [];

foreach ($data as $entry) {
    if (isset($entry['name'])) {
        $name = $entry['name'];
        $terms = explode(" ", $name);
        
        foreach ($terms as $term) {
            if (strlen($term) > 2) { // Ignore short words like "and", "the", etc.
                if (!isset($nameCounts[$term])) {
                    $nameCounts[$term] = 0;
                }
                $nameCounts[$term]++;
                if ($nameCounts[$term] > 1 && !in_array($term, $commonTerms)) {
                    $commonTerms[] = $term;
                }
            }
        }
    }
}

echo "Common terms between movie names: " . implode(", ", $commonTerms);
?>