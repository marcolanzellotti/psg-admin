<?php
class Mentor
{


    function __construct()
    {
    }
    function auth($username, $password)
    {
        global $con;
        $username = mysqli_escape_string($con, $username);
        $password = mysqli_escape_string($con, $password);

        $qAuth = $con->query("SELECT * FROM mentors WHERE username='$username' and password='$password'");
        $mentor = $qAuth->fetch_assoc();
        return $mentor;
    }
    function getById(int $id)
    {
        global $con;
        $qMentor = $con->query("SELECT * FROM mentors WHERE id = $id");
        if (!$qMentor) return false;
        return $qMentor->fetch_assoc();
    }
    function create($name, $username, $password)
    {
        global $con;
        $name = mysqli_escape_string($con, $name);
        $username = mysqli_escape_string($con, $username);
        $password = mysqli_escape_string($con, $password);
        $qCreateMentor = $con->query("INSERT INTO mentors (name, username, password) VALUES ('$name', '$username', '$password')");
        return ($qCreateMentor) ? $con->insert_id : false;
    }

    function delete(int $id)
    {
        global $con;
        $qDeleteMentor = $con->query("DELETE FROM mentors WHERE id=$id");
        return $qDeleteMentor;
    }

    function list()
    {
        global $con;
        $res = [];
        $qListMentors = $con->query("SELECT * FROM mentors");
        if (!$qListMentors) return false;
        while ($mentor = $qListMentors->fetch_assoc()) {
            array_push($res, $mentor);
        }
        return $res;
    }

    function update(int $id, array $data)
    {
        global $con;
        $name = mysqli_escape_string($con, $data['name']);
        $username = mysqli_escape_string($con, $data['username']);
        $password = mysqli_escape_string($con, $data['password']);
        $qUpdateMentor = $con->query("UPDATE mentors SET name='$name', username='$username', password='$password' WHERE id=$id");
        return ($qUpdateMentor) ? $id : false;
    }
}
