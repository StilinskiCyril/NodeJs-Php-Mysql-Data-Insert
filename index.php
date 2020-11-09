<?php
require_once ('vendor/autoload.php');
use GuzzleHttp\Client;
$client = new Client();
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    if (!empty($name) && !empty($email) && !empty($phone)) {
        try {
            $response = $client->request('POST', 'http://localhost:4000/save', [
                'form_params' => [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
            ]);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
        }
        $response_data = $response->getBody()->getContents();
        var_dump($response_data);
    } else {
        echo 'fill in all the fields';
    }
}
?>


<!DOCTYPE html>
<html lang="en" >
<head >
    <meta charset="UTF-8" >
    <title >NodeJs PHP</title >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head >
<body >
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            NodeJs PHP post upload
        </div>
        <div class="card-body">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" METHOD="post">
                <div class="form-group">
                    <label for="name" >Name:</label >
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email" >Email:</label >
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone" >Phone:</label >
                    <input type="phone" name="phone" class="form-control">
                </div>
                <button type="submit" name="submit" class="btn btn-success btn-block">Save</button>
            </form >
        </div>
    </div>
</div>
</body >
</html >
