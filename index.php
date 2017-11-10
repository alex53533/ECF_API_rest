<?php
require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();
$app['debug'] = true;

$pdo = new PDO('mysql:dbname=regatebdd;host=localhost;charset=utf8', 'root', 'mvb94', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

//get challenge
$app->get('/challenge/', function() use ($pdo){
	$sql = "SELECT * FROM challenge";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	 // Generate an array of the required objects
	 $arr = $stmt->fetchAll(\PDO::FETCH_OBJ);
	$response = new Response(json_encode($arr),200, array( 'Content-Type' => 'application/json' ));
	$response->setCharset('utf-8');
	return $response;
});

//get challenge by id
$app->get('/challenge/{id}', function ($id) use ($pdo){
  $sql = "SELECT * FROM challenge WHERE id_challenge = :id ";
  $stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	 // Generate an array of the required objects
	$arr = $stmt->fetchAll(\PDO::FETCH_OBJ);
	$response = new Response(json_encode($arr),200, array( 'Content-Type' => 'application/json' ));
	$response->setCharset('utf-8');
	return $response;
});

//get challengeRegate by id
$app->get('/challengeRegate/{id}', function ($id) use ($pdo){
  $sql = "SELECT r.id_regate, r.nom_regate, r.num_regate, r.date_regate, r.distance_regate FROM challenge c INNER JOIN regate r ON r.id_challenge = c.id_challenge WHERE c.id_challenge = :id ";
  $stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	 // Generate an array of the required objects
	$arr = $stmt->fetchAll(\PDO::FETCH_OBJ);
	$response = new Response(json_encode($arr),200, array( 'Content-Type' => 'application/json' ));
	$response->setCharset('utf-8');
	return $response;
});

//get regate
$app->get('/regate/', function() use ($pdo){
	$sql = "SELECT * FROM regate";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	 // Generate an array of the required objects
	 $arr = $stmt->fetchAll(\PDO::FETCH_OBJ);
	$response = new Response(json_encode($arr),200, array( 'Content-Type' => 'application/json' ));
	$response->setCharset('utf-8');
	return $response;
});

//get regate by id
$app->get('/regate/{id}', function ($id) use ($pdo){
  $sql = "SELECT * FROM regate WHERE id_regate = :id ";
  $stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	 // Generate an array of the required objects
	$arr = $stmt->fetchAll(\PDO::FETCH_OBJ);
	$response = new Response(json_encode($arr),200, array( 'Content-Type' => 'application/json' ));
	$response->setCharset('utf-8');
	return $response;
});

//get participe by id
$app->get('/participe/{id}', function ($id) use ($pdo){
  $sql = "SELECT * FROM participe p INNER JOIN voilier v ON p.id_voilier = v.id_voilier WHERE p.id_regate = :id ORDER BY place ASC";
  $stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	 // Generate an array of the required objects
	$arr = $stmt->fetchAll(\PDO::FETCH_OBJ);
	$response = new Response(json_encode($arr),200, array( 'Content-Type' => 'application/json' ));
	$response->setCharset('utf-8');
	return $response;
});

//get participe (resultats par place)
$app->get('/participe/', function() use ($pdo){
	$sql = "SELECT * FROM participe ORDER BY participe . place ASC ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	 // Generate an array of the required objects
	 $arr = $stmt->fetchAll(\PDO::FETCH_OBJ);
	$response = new Response(json_encode($arr),200, array( 'Content-Type' => 'application/json' ));
	$response->setCharset('utf-8');
	return $response;
});


//get resultats by regate
$app->get('/regate/resultats/{id}', function ($id) use ($pdo){
$sql = "SELECT * FROM regate reg INNER JOIN particip par ON reg.id_regate = par.id_regate INNER JOIN voilier voi ON par.id_voilier = voi.id_voilier WHERE reg.id_regate = :id ORDER BY place ASC";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':id', $id);
	$stmt->execute();
	 // Generate an array of the required objects
	$arr = $stmt->fetchAll(\PDO::FETCH_OBJ);
	$response = new Response(json_encode($arr),200, array( 'Content-Type' => 'application/json' ));
	$response->setCharset('utf-8');
	return $response;
});


//

$app->run();











/*
$app->get('/challenge/', function() use ($pdo){
	$sql = "SELECT * FROM challenge";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	 // Generate an array of the required objects
	 $arr = $stmt->fetchAll(\PDO::FETCH_OBJ);
	$response = new Response(json_encode($arr),200, array( 'Content-Type' => 'application/json' ));
	$response->setCharset('utf-8');
	return $response;
});

$app->get('/films/{id}', function($id) use($pdo){
	$sql = "SELECT * FROM film WHERE ID_FILM = :id";
	$stmt = $pdo->prepare($sql);
	//$stmt->debugDumpParams();
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	 // Generate an array of the required objects
	 $arr = $stmt->fetchAll(\PDO::FETCH_OBJ);
	$response = new Response(json_encode($arr),200, array( 'Content-Type' => 'application/json' ));
	$response->setCharset('utf-8');
	return $response;
});
*/
