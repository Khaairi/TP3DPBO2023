<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Director.php');
include('classes/Genre.php');
include('classes/Film.php');
include('classes/Template.php');

$listFilm = new Film($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listFilm->open();

if (isset($_GET['id_del'])) {
    $id = $_GET['id_del'];
    if ($id > 0) {
        if ($listFilm->deleteFilm($id) > 0) {
            echo "<script>
                alert('Successfully delete data!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Failed to delete data!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}

$data = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $listFilm->getFilmById($id);
        $row = $listFilm->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['pengurus_nama'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['film_poster'] . '" class="img-thumbnail" alt="' . $row['film_poster'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Title</td>
                                    <td>:</td>
                                    <td>' . $row['film_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Release Year</td>
                                    <td>:</td>
                                    <td>' . $row['film_rilis'] . '</td>
                                </tr>
                                <tr>
                                    <td>Revenue</td>
                                    <td>:</td>
                                    <td>' . $row['film_revenue'] . '</td>
                                </tr>
                                <tr>
                                    <td>Director</td>
                                    <td>:</td>
                                    <td>' . $row['director_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Genre</td>
                                    <td>:</td>
                                    <td>' . $row['genre_nama'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="film.php?id_edit='. $row['film_id'] .'"><button type="button" class="btn btn-danger text-white">Update Data</button></a>
                <a href="detail.php?id_del='. $row['film_id'] .'" onclick="return confirmDelete(event)"><button type="button" class="btn btn-dark">Delete Data</button></a>
            </div>';
    }
}

$listFilm->close();
$detail = new Template('templates/skinDetail.html');
$detail->replace('DATA_DETAIL_FILM', $data);
$detail->write();
?>