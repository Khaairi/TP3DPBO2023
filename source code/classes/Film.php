<?php

class Film extends DB
{
    function getFilmJoin()
    {
        $query = "SELECT * FROM film JOIN director ON film.film_director=director.director_id JOIN genre ON film.film_genre=genre.genre_id ORDER BY film.film_id";

        return $this->execute($query);
    }

    function getFilm()
    {
        $query = "SELECT * FROM film";
        return $this->execute($query);
    }

    function getFilmById($id)
    {
        $query = "SELECT * FROM film JOIN director ON film.film_director=director.director_id JOIN genre ON film.film_genre=genre.genre_id WHERE film_id=$id";
        return $this->execute($query);
    }

    function searchPengurus($keyword)
    {
        $query = "SELECT * FROM film JOIN director ON film.film_director=director.director_id JOIN genre ON film.film_genre=genre.genre_id WHERE film_nama LIKE '%". $keyword ."%'";
        return $this->execute($query);
    }

    function filterFilm($keyword)
    {
        if($keyword == "latest")
        {
            $query = "SELECT * FROM film JOIN director ON film.film_director=director.director_id JOIN genre ON film.film_genre=genre.genre_id ORDER BY film.film_rilis DESC";
            return $this->execute($query);
        }
        else if($keyword == "old")
        {
            $query = "SELECT * FROM film JOIN director ON film.film_director=director.director_id JOIN genre ON film.film_genre=genre.genre_id ORDER BY film.film_rilis";
            return $this->execute($query);
        }
        else if($keyword == "a-z")
        {
            $query = "SELECT * FROM film JOIN director ON film.film_director=director.director_id JOIN genre ON film.film_genre=genre.genre_id ORDER BY film.film_nama";
            return $this->execute($query);
        }
        else if($keyword == "z-a")
        {
            $query = "SELECT * FROM film JOIN director ON film.film_director=director.director_id JOIN genre ON film.film_genre=genre.genre_id ORDER BY film.film_nama DESC";
            return $this->execute($query);
        }
    }

    function addFilm($data, $file)
    {
        $tmp_file = $file['file_image']['tmp_name'];
        $film_poster = $file['file_image']['name'];
        
        $dir = "assets/images/$film_poster";
        move_uploaded_file($tmp_file, $dir);

        $film_nama = $data['nama'];
        $film_rilis = $data['rilis'];
        $film_revenue = $data['revenue'];
        $film_director = $data['director'];
        $film_genre = $data['genre'];

        $query = "INSERT INTO film VALUES('','$film_poster', '$film_nama', $film_rilis, $film_revenue, $film_director, $film_genre)";

        return $this->executeAffected($query);
    }

    function updateFilm($id, $data, $file, $check)
    {
        $film_nama = $data['nama'];
        $film_rilis = $data['rilis'];
        $film_revenue = $data['revenue'];
        $film_director = $data['director'];
        $film_genre = $data['genre'];

        if($check)
        {
            $tmp_file = $file['file_image']['tmp_name'];
            $film_poster = $file['file_image']['name'];
            
            $dir = "assets/images/$film_poster";
            move_uploaded_file($tmp_file, $dir);

            $query = "UPDATE film SET film_poster = '$film_poster', film_nama = '$film_nama', film_rilis = $film_rilis, film_revenue = $film_revenue, film_director = $film_director, film_genre = $film_genre WHERE film_id = $id";

            return $this->executeAffected($query);
        }
        else
        {
            $film_poster = $data['oldImage'];

            $query = "UPDATE film SET film_poster = '$film_poster', film_nama = '$film_nama', film_rilis = $film_rilis, film_revenue = $film_revenue, film_director = $film_director, film_genre = $film_genre WHERE film_id = $id";

            return $this->executeAffected($query);
        }
    }

    function deleteFilm($id)
    {
        $query = "DELETE FROM film WHERE film_id = $id";
        return $this->executeAffected($query);
    }
}
