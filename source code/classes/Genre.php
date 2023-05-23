<?php

class Genre extends DB
{
    function getGenre()
    {
        $query = "SELECT * FROM genre";
        return $this->execute($query);
    }

    function getGenreById($id)
    {
        $query = "SELECT * FROM genre WHERE genre_id=$id";
        return $this->execute($query);
    }

    function searchGenre($keyword)
    {
        $query = "SELECT * FROM genre WHERE genre_nama LIKE '%" . $keyword . "%'";
        return $this->execute($query);
    }

    function addGenre($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO genre VALUES('', '$nama', 0)";
        return $this->executeAffected($query);
    }

    function updateGenre($id, $data)
    {
        $nama = $data['nama'];
        $query = "UPDATE genre SET genre_nama = '$nama' WHERE genre_id = $id";
        return $this->executeAffected($query);
    }

    function deleteGenre($id)
    {
        $delete = "DELETE FROM film WHERE film_genre = $id";
        $this->executeAffected($delete);

        $query = "DELETE FROM genre WHERE genre_id = $id";
        return $this->executeAffected($query);
    }
}
