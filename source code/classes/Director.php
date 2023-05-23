<?php

class Director extends DB
{
    function getDirector()
    {
        $query = "SELECT * FROM director";
        return $this->execute($query);
    }

    function getDirectorById($id)
    {
        $query = "SELECT * FROM director WHERE director_id=$id";
        return $this->execute($query);
    }

    function searchDirector($keyword)
    {
        $query = "SELECT * FROM director WHERE director_nama LIKE '%" . $keyword . "%'";
        return $this->execute($query);
    }

    function addDirector($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO director VALUES('', '$nama', 0)";
        return $this->executeAffected($query);
    }

    function updateDirector($id, $data)
    {
        $nama = $data['nama'];
        $query = "UPDATE director SET director_nama = '$nama' WHERE director_id = $id";
        return $this->executeAffected($query);
    }

    function deleteDirector($id)
    {
        $delete = "DELETE FROM film WHERE film_director = $id";
        $this->executeAffected($delete);

        $query = "DELETE FROM director WHERE director_id = $id";
        return $this->executeAffected($query);
    }
}
