<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Director.php');
include('classes/Genre.php');
include('classes/Film.php');
include('classes/Template.php');

$view = new Template('templates/skinForm.html');

$film = new Film($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$film->open();

if(isset($_GET['id_edit']))
{
    $id_edit = $_GET['id_edit'];
    $film->getFilmById($id_edit);
    $filmById = $film->getResult();

    if (isset($_POST['submit'])) {

        $check;
        if(isset($_FILES['file_image']) && is_uploaded_file($_FILES['file_image']['tmp_name']))
        {
            $check = true;
        }
        else
        {
            $check = false;
        }
    
        if ($film->updateFilm($id_edit, $_POST, $_FILES, $check) > 0) {
            echo "<script>
                alert('Successfully update data!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Failed to update data!');
                document.location.href = 'film.php';
            </script>";
        }
    }
}
else
{
    if (isset($_POST['submit'])) {
        if ($film->addFilm($_POST, $_FILES) > 0) {
            echo "<script>
                alert('Successfully add data!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Failed to add data!');
                document.location.href = 'film.php';
            </script>";
        }
    }
}


$data = null;

if(isset($_GET['id_edit']))
{
    $id_edit = $_GET['id_edit'];
    $film->getFilmById($id_edit);
    $filmById = $film->getResult();

    $director = new Director($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $director->open();
    $director->getDirector();

    $optionsDirector = null;
    while ($row = $director->getResult()) {
        if($filmById['film_director'] == $row['director_id'])
        {
            $optionsDirector .= "<option value=". $row['director_id']. " selected>" . $row['director_nama'] . "</option>";
        }
        else
        {
            $optionsDirector .= "<option value=". $row['director_id']. ">" . $row['director_nama'] . "</option>";
        }
    }

    $director->close();

    $genre = new Genre($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $genre->open();
    $genre->getGenre();

    $optionsGenre = null;
    while ($row = $genre->getResult()) {
        if($filmById['film_genre'] == $row['genre_id'])
        {
            $optionsGenre .= "<option value=". $row['genre_id']. " selected>" . $row['genre_nama'] . "</option>";
        }
        else
        {
            $optionsGenre .= "<option value=". $row['genre_id']. ">" . $row['genre_nama'] . "</option>";
        }
    }

    $genre->close();

    $data = '<form method="post" enctype="multipart/form-data" id="data">
            <div class="mb-3 row">
                <label for="file" class="col-sm-2 col-form-label">Poster</label>
                <div class="col-sm-10">
                    <input type="hidden" name="oldImage" value="'.$filmById['film_poster'].'">
                    <input class="form-control" type="file" name="file_image">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" value="'.$filmById['film_nama'].'">
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="rilis" class="col-sm-2 col-form-label">Year</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="rilis" value="'.$filmById['film_rilis'].'">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="revenue" class="col-sm-2 col-form-label">Revenue</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="revenue" value="'.$filmById['film_revenue'].'">
                </div>
            </div>' .

            '<div class="mb-3 row">
                <label for="director" class="col-sm-2 col-form-label">Director</label>
                <div class="col-sm-10">
                    <select class="form-select" name="director"required>'.
                        $optionsDirector
                    . '</select>
                </div>
            </div>' .

            '<div class="mb-3 row">
                <label for="genre" class="col-sm-2 col-form-label">Genre</label>
                <div class="col-sm-10">
                    <select class="form-select" name="genre" required>' .
                        $optionsGenre
                    .'</select>
                </div>
            </div>
        </form>';

    $title = 'Update';
}
else
{
    $director = new Director($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $director->open();
    $director->getDirector();

    $optionsDirector = null;
    while ($row = $director->getResult()) {
        $optionsDirector .= "<option value=". $row['director_id']. ">" . $row['director_nama'] . "</option>";
    }

    $director->close();

    $genre = new Genre($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $genre->open();
    $genre->getGenre();

    $optionsGenre = null;
    while ($row = $genre->getResult()) {
        $optionsGenre .= "<option value=". $row['genre_id']. ">" . $row['genre_nama'] . "</option>";
    }

    $genre->close();

    $data = '<form method="post" enctype="multipart/form-data" id="data">
            <div class="mb-3 row">
                <label for="file" class="col-sm-2 col-form-label">Poster</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" name="file_image">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama">
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="rilis" class="col-sm-2 col-form-label">Year</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="rilis">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="revenue" class="col-sm-2 col-form-label">Revenue</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="revenue">
                </div>
            </div>' .

            '<div class="mb-3 row">
                <label for="director" class="col-sm-2 col-form-label">Director</label>
                <div class="col-sm-10">
                    <select class="form-select" name="director" required>
                        <option value="" disabled selected hidden>Select Director</option>'.
                        $optionsDirector
                    . '</select>
                </div>
            </div>' .

            '<div class="mb-3 row">
                <label for="genre" class="col-sm-2 col-form-label">Genre</label>
                <div class="col-sm-10">
                    <select class="form-select" name="genre" required>
                        <option value="" disabled selected hidden>Select Genre</option>'.
                        $optionsGenre
                    .'</select>
                </div>
            </div>
        </form>';

    $title = 'Add';
}


$film->close();

$view->replace('TITLE', $title);
$view->replace('FORM', $data);
$view->write();
?>