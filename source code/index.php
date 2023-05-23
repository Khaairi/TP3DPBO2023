<?php

include('config/db.php');
include('classes/DB.php');
// include('classes/Director.php');
// include('classes/Genre.php');
include('classes/Film.php');
include('classes/Template.php');

$listFilm = new Film($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listFilm->open();

$listFilm->getFilmJoin();


if (isset($_POST['btn-cari'])) {
    $listFilm->searchPengurus($_POST['cari']);
} 
else if(isset($_POST['btn-filter']))
{
    $listFilm->filterFilm($_POST['filter']);
}
else
{
    $listFilm->getFilmJoin();
}

$data = null;

while ($row = $listFilm->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 film-thumbnail">
        <a href="detail.php?id=' . $row['film_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['film_poster'] . '" class="card-img-top" alt="' . $row['film_poster'] . '">
            </div>
            <div class="card-body">
                <p class="card-text film-nama my-0">' . $row['film_nama'] . '</p>
                <p class="card-text director-nama">' . $row['film_rilis'] . '</p>
                <p class="card-text genre-nama my-0">' . $row['genre_nama'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listFilm->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_FILM', $data);
$home->write();
