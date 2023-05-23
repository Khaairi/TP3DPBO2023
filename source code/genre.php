<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Genre.php');
include('classes/Template.php');

$genre = new Genre($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$genre->open();
$genre->getGenre();

if (isset($_POST['btn-cari'])) {
    $genre->searchGenre($_POST['cari']);
} else {
    $genre->getGenre();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($genre->updateGenre($id, $_POST) > 0) {
                echo "<script>
                alert('Successfully update data!');
                document.location.href = 'genre.php';
            </script>";
            } else {
                echo "<script>
                alert('Failed to update data!');
                document.location.href = 'genre.php';
            </script>";
            }
        }

        $btn = 'Update';
        $title = 'Update';
    }
}
else
{
    if (isset($_POST['submit'])) {
        if ($genre->addGenre($_POST) > 0) {
            echo "<script>
                alert('Successfully add data!');
                document.location.href = 'genre.php';
            </script>";
        } else {
            echo "<script>
                alert('Failed to add data!');
                document.location.href = 'genre.php';
            </script>";
        }
    }

    $btn = 'Add';
    $title = 'Add';
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($genre->deleteGenre($id) > 0) {
            echo "<script>
                alert('Successfully delete data!');
                document.location.href = 'genre.php';
            </script>";
        } else {
            echo "<script>
                alert('Failed to delete data!');
                document.location.href = 'genre.php';
            </script>";
        }
    }
}

$view = new Template('templates/skinTabel.html');
$mainTitle = 'Genre';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Genre</th>
<th scope="row">Film</th>
<th scope="row">Action</th>
</tr>';
$data = null;
$no = 1;

while ($gen = $genre->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $gen['genre_nama'] . '</td>
    <td>' . $gen['genre_film'] . '</td>
    <td style="font-size: 22px;">
        <a href="genre.php?id=' . $gen['genre_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="genre.php?hapus=' . $gen['genre_id'] . '" onclick="return confirmDelete2(event)" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

$form = null;
if (isset($_GET['id']))
{
    $id = $_GET['id'];
    $genre->getGenreById($id);
    $genreByID = $genre->getResult();
    $form .= '<form method="post" id="data">
            <div class="mb-3 row">
                <label for="nama" class="col-sm-4 col-form-label">Genre</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="nama" value="'. $genreByID['genre_nama'] .'">
                </div>
            </div>
        </form>';
}
else
{
    $form .= '<form method="post" id="data">
            <div class="mb-3 row">
                <label for="nama" class="col-sm-4 col-form-label">Genre</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="nama">
                </div>
            </div>
        </form>';
}

$genre->close();

$view->replace('FORM', $form);
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_TABEL', $data);
$view->write();
