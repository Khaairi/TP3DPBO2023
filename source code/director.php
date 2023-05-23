<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Director.php');
include('classes/Template.php');

$director = new Director($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$director->open();
$director->getDirector();

if (isset($_POST['btn-cari'])) {
    $director->searchDirector($_POST['cari']);
} else {
    $director->getDirector();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($director->updateDirector($id, $_POST) > 0) {
                echo "<script>
                alert('Successfully update data!');
                document.location.href = 'director.php';
            </script>";
            } else {
                echo "<script>
                alert('Failed to update data!');
                document.location.href = 'director.php';
            </script>";
            }
        }

        $btn = 'Update';
        $title = 'Update';
    }
} else {
    if (isset($_POST['submit'])) {
        if ($director->addDirector($_POST) > 0) {
            echo "<script>
                alert('Successfully add data!');
                document.location.href = 'director.php';
            </script>";
        } else {
            echo "<script>
                alert('Failed to add data!');
                document.location.href = 'director.php';
            </script>";
        }
    }

    $btn = 'Add';
    $title = 'Add';
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($director->deleteDirector($id) > 0) {
            echo "<script>
                alert('Successfully delete data!');
                document.location.href = 'director.php';
            </script>";
        } else {
            echo "<script>
                alert('Failed to delete data!');
                document.location.href = 'director.php';
            </script>";
        }
    }
}

$view = new Template('templates/skinTabel.html');
$mainTitle = 'Director';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Director</th>
<th scope="row">Film</th>
<th scope="row">Action</th>
</tr>';
$data = null;
$no = 1;

while ($dir = $director->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $dir['director_nama'] . '</td>
    <td>' . $dir['director_film'] . '</td>
    <td style="font-size: 22px;">
        <a href="director.php?id=' . $dir['director_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="director.php?hapus=' . $dir['director_id'] . '" onclick="return confirmDelete(event)" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

$form = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $director->getDirectorById($id);
    $directorByID = $director->getResult();
    $form .= '<form method="post" id="data">
            <div class="mb-3 row">
                <label for="nama" class="col-sm-4 col-form-label">Director Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="nama" value="' . $directorByID['director_nama'] . '">
                </div>
            </div>
        </form>';
} else {
    $form .= '<form method="post" id="data">
            <div class="mb-3 row">
                <label for="nama" class="col-sm-4 col-form-label">Director Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="nama">
                </div>
            </div>
        </form>';
}

$director->close();

$view->replace('FORM', $form);
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_TABEL', $data);
$view->write();
