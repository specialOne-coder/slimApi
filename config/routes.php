<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

require_once __DIR__ . '/db.php';



return function (App $app) {

    $db = new db();
    $db = $db->connect();

    $app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');
    });

/*=========================================================
	1 -> Users pour voir comment ça marche
===========================================================*/

    $app->post('/users', function (ServerRequestInterface $request, ResponseInterface $response) {
        $db = new db();
        $db = $db->connect();
        $user = $request->getParsedBody();
        $sql = "INSERT INTO users(username,first_name,last_name,email) VALUES (
        :username,:first_name,:last_name,:email)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("username",   $user['username']);
        $stmt->bindParam("first_name", $user['first_name']);
        $stmt->bindParam("last_name",  $user['last_name']);
        $stmt->bindParam("email",      $user['email']);
        $stmt->execute();
        //return $this->response->withJson($developer);
        $user->id = $db->lastInsertId();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');

    });
    $app->get('/users', function (ServerRequestInterface $request, ResponseInterface $response) {
        $db = new db();
        $db = $db->connect();
        $sql = "SELECT * FROM users";
        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $response->getBody()->write(json_encode($users));
        return $response->withHeader('Content-Type', 'application/json');
     });

    $app->put('/users/update/{id}',function (ServerRequestInterface $request, ResponseInterface $response, $args){
        $db = new db();
        $db = $db->connect();
        $user = $request->getParsedBody();
        $sql = "UPDATE users SET username=:username, first_name=:first_name, last_name=:last_name, email=:email WHERE id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("username",   $user['username']);
        $stmt->bindParam("first_name", $user['first_name']);
        $stmt->bindParam("last_name",  $user['last_name']);
        $stmt->bindParam("email",      $user['email']);
        $stmt->bindParam("id", $args['id']);
        $stmt->execute();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');
    });
    $app->delete('/users/delete/{id}',function (ServerRequestInterface $request, ResponseInterface $response, $args){
        $db = new db();
        $db = $db->connect();
        $sth = $db->prepare("DELETE FROM users WHERE id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');
    });


/*=========================================================
	2 -> Locataires
===========================================================*/


    $app->post('/locataires', function (ServerRequestInterface $request, ResponseInterface $response) {
        $db = new db();
        $db = $db->connect();
        $locataire = $request->getParsedBody();
        $sql = "INSERT INTO locataire(nomLocataire,telLocataire,emailLocataire) VALUES (
        :nomLocataire,:telLocataire,:emailLocataire)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nomLocataire",   $locataire['nomLocataire']);
        $stmt->bindParam("telLocataire", $locataire['telLocataire']);
        $stmt->bindParam("emailLocataire",  $locataire['emailLocataire']);
        $stmt->execute();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');

    });
    $app->get('/locataires', function (ServerRequestInterface $request, ResponseInterface $response) {
        $db = new db();
        $db = $db->connect();
        $sql = "SELECT * FROM locataire";
        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $response->getBody()->write(json_encode($users));
        return $response->withHeader('Content-Type', 'application/json');
     });

    $app->put('/locataires/update/{id}',function (ServerRequestInterface $request, ResponseInterface $response, $args){
        $db = new db();
        $db = $db->connect();
        $locataire = $request->getParsedBody();
        $sql = "UPDATE locataire SET nomLocataire=:nomLocataire, telLocataire=:telLocataire, emailLocataire=:emailLocataire WHERE idLocataire=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nomLocataire",   $locataire['nomLocataire']);
        $stmt->bindParam("telLocataire", $locataire['telLocataire']);
        $stmt->bindParam("emailLocataire",  $locataire['emailLocataire']);
        $stmt->bindParam("id", $args['id']);
        $stmt->execute();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');
    });
    $app->delete('/locataires/delete/{id}',function (ServerRequestInterface $request, ResponseInterface $response, $args){
        $db = new db();
        $db = $db->connect();
        $sth = $db->prepare("DELETE FROM locataire WHERE idLocataire=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');
    });

/*=========================================================
	3 -> Proprietaires
===========================================================*/

    $app->post('/proprietaires', function (ServerRequestInterface $request, ResponseInterface $response) {
        $db = new db();
        $db = $db->connect();
        $proprietaire = $request->getParsedBody();
        $sql = "INSERT INTO proprietaire(nomProp,prenomProp,telProp,emailProp,adresseProp) VALUES (
        :nomProp,:prenomProp,:telProp,:emailProp,:adresseProp)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nomProp",   $proprietaire['nomProp']);
        $stmt->bindParam("prenomProp", $proprietaire['prenomProp']);
        $stmt->bindParam("telProp",  $proprietaire['telProp']);
        $stmt->bindParam("emailProp",  $proprietaire['emailProp']);
        $stmt->bindParam("adresseProp",  $proprietaire['adresseProp']);
        $stmt->execute();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');

    });
    $app->get('/proprietaires', function (ServerRequestInterface $request, ResponseInterface $response) {
        $db = new db();
        $db = $db->connect();
        $sql = "SELECT * FROM proprietaire";
        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $response->getBody()->write(json_encode($users));
        return $response->withHeader('Content-Type', 'application/json');
     });

    $app->put('/proprietaires/update/{id}',function (ServerRequestInterface $request, ResponseInterface $response, $args){
        $db = new db();
        $db = $db->connect();
        $proprietaire = $request->getParsedBody();
        $sql = "UPDATE proprietaire SET nomProp=:nomProp, prenomProp=:prenomProp, telProp=:telProp, emailProp=:emailProp,adresseProp=:adresseProp WHERE idProp=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nomProp",   $proprietaire['nomProp']);
        $stmt->bindParam("prenomProp",   $proprietaire['prenomProp']);
        $stmt->bindParam("telProp", $proprietaire['telProp']);
        $stmt->bindParam("emailProp",  $proprietaire['emailProp']);
        $stmt->bindParam("adresseProp",  $proprietaire['adresseProp']);
        $stmt->bindParam("id", $args['id']);
        $stmt->execute();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');
    });
    $app->delete('/proprietaires/delete/{id}',function (ServerRequestInterface $request, ResponseInterface $response, $args){
        $db = new db();
        $db = $db->connect();
        $sth = $db->prepare("DELETE FROM proprietaire WHERE idProp=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');
    });

 /*=========================================================
	4 -> Maisons
===========================================================*/

    $app->post('/maisons', function (ServerRequestInterface $request, ResponseInterface $response) {
        $db = new db();
        $db = $db->connect();
        $maison = $request->getParsedBody();
        $sql = "INSERT INTO maison(idProp,codeMaison,nomMaison,quartier,ville) VALUES (
        :idProp,:codeMaison,:nomMaison,:quartier,:ville)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("idProp",   $maison['idProp']);
        $stmt->bindParam("codeMaison", $maison['codeMaison']);
        $stmt->bindParam("nomMaison",  $maison['nomMaison']);
        $stmt->bindParam("quartier",  $maison['quartier']);
        $stmt->bindParam("ville",  $maison['ville']);
        $stmt->execute();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');

    });
    $app->get('/maisons', function (ServerRequestInterface $request, ResponseInterface $response) {
        $db = new db();
        $db = $db->connect();
        $sql = "SELECT * FROM maison ";
        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $response->getBody()->write(json_encode($users));
        return $response->withHeader('Content-Type', 'application/json');
     });

    $app->put('/maisons/update/{id}',function (ServerRequestInterface $request, ResponseInterface $response, $args){
        $db = new db();
        $db = $db->connect();
        $maison = $request->getParsedBody();
        $sql = "UPDATE maison SET idProp=:idProp, codeMaison=:codeMaison, nomMaison=:nomMaison, quartier=:quartier,ville=:ville
                WHERE idMaison=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("idProp",   $maison['idProp']);
        $stmt->bindParam("codeMaison",   $maison['codeMaison']);
        $stmt->bindParam("nomMaison", $maison['nomMaison']);
        $stmt->bindParam("quartier",  $maison['quartier']);
        $stmt->bindParam("ville",  $maison['ville']);
        $stmt->bindParam("id", $args['id']);
        $stmt->execute();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');
    });
    $app->delete('/maisons/delete/{id}',function (ServerRequestInterface $request, ResponseInterface $response, $args){
        $db = new db();
        $db = $db->connect();
        $sth = $db->prepare("DELETE FROM maison WHERE idMaison=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');
    });

 /*=========================================================
	5 -> Règlements
===========================================================*/

    $app->post('/reglements', function (ServerRequestInterface $request, ResponseInterface $response) {
        $db = new db();
        $db = $db->connect();
        $reglement = $request->getParsedBody();
        $sql = "INSERT INTO reglementLoyer(idContrat,dateReg,montantReg) VALUES (
        :idContrat,:dateReg,:montantReg)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("idContrat",   $reglement['idContrat']);
        $stmt->bindParam("dateReg", $reglement['dateReg']);
        $stmt->bindParam("montantReg",  $reglement['montantReg']);
        $stmt->execute();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');

    });
    $app->get('/reglements', function (ServerRequestInterface $request, ResponseInterface $response) {
        $db = new db();
        $db = $db->connect();
        $sql = "SELECT * FROM reglementLoyer ";
        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $response->getBody()->write(json_encode($users));
        return $response->withHeader('Content-Type', 'application/json');
        });

    $app->put('/reglements/update/{id}',function (ServerRequestInterface $request, ResponseInterface $response, $args){
        $db = new db();
        $db = $db->connect();
        $reglement = $request->getParsedBody();
        $sql = "UPDATE reglementLoyer SET idContrat=:idContrat, dateReg=:dateReg, montantReg=:montantReg
                WHERE idReglement=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("idContrat",   $reglement['idContrat']);
        $stmt->bindParam("dateReg",   $reglement['dateReg']);
        $stmt->bindParam("montantReg", $reglement['montantReg']);
        $stmt->bindParam("id", $args['id']);
        $stmt->execute();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');
    });
    $app->delete('/reglements/delete/{id}',function (ServerRequestInterface $request, ResponseInterface $response, $args){
        $db = new db();
        $db = $db->connect();
        $sth = $db->prepare("DELETE FROM reglementLoyer WHERE idReglement=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');
    });

/*=========================================================
	1 -> Contrats
===========================================================*/

    $app->post('/contrats', function (ServerRequestInterface $request, ResponseInterface $response) {
        $db = new db();
        $db = $db->connect();
        $contrat = $request->getParsedBody();
        $sql = "INSERT INTO contratLocation(idMaison,idLocataire,codeContrat,titreContrat,termesContrat,
                debutContrat,finContrat,caution,avance) VALUES (
                :idMaison,:idLocataire,:codeContrat,:titreContrat,
                :termesContrat,:debutContrat,:finContrat,:caution,:avance)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("idMaison",   $contrat['idMaison']);
        $stmt->bindParam("idLocataire", $contrat['idLocataire']);
        $stmt->bindParam("codeContrat",  $contrat['codeContrat']);
        $stmt->bindParam("titreContrat",  $contrat['titreContrat']);
        $stmt->bindParam("termesContrat",  $contrat['termesContrat']);
        $stmt->bindParam("debutContrat",  $contrat['debutContrat']);
        $stmt->bindParam("finContrat",  $contrat['finContrat']);
        $stmt->bindParam("caution",  $contrat['caution']);
        $stmt->bindParam("avance",  $contrat['avance']);
        $stmt->execute();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');

    });
    $app->get('/contrats', function (ServerRequestInterface $request, ResponseInterface $response) {
        $db = new db();
        $db = $db->connect();
        $sql = "SELECT * FROM contratLocation ";
        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $response->getBody()->write(json_encode($users));
        return $response->withHeader('Content-Type', 'application/json');
     });

    $app->put('/contrats/update/{id}',function (ServerRequestInterface $request, ResponseInterface $response, $args){
        $db = new db();
        $db = $db->connect();
        $contrat = $request->getParsedBody();
        $sql = "UPDATE contratLocation SET idMaison=:idMaison, idLocataire=:idLocataire, codeContrat=:codeContrat,
                       titreContrat=:titreContrat,termesContrat=:termesContrat,debutContrat=:debutContrat,finContrat=:finContrat,
                       caution=:caution, avance=:avance
                WHERE idContrat=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("idMaison",   $contrat['idMaison']);
        $stmt->bindParam("idLocataire", $contrat['idLocataire']);
        $stmt->bindParam("codeContrat",  $contrat['codeContrat']);
        $stmt->bindParam("titreContrat",  $contrat['titreContrat']);
        $stmt->bindParam("termesContrat",  $contrat['termesContrat']);
        $stmt->bindParam("debutContrat",  $contrat['debutContrat']);
        $stmt->bindParam("finContrat",  $contrat['finContrat']);
        $stmt->bindParam("caution",  $contrat['caution']);
        $stmt->bindParam("avance",  $contrat['avance']);
        $stmt->bindParam("id", $args['id']);
        $stmt->execute();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');
    });
    $app->delete('/contrats/delete/{id}',function (ServerRequestInterface $request, ResponseInterface $response, $args){
        $db = new db();
        $db = $db->connect();
        $sth = $db->prepare("DELETE FROM contratLocation WHERE idContrat=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $response->getBody()->write(json_encode(['success' => true]));
        return $response->withHeader('Content-Type', 'application/json');
    });

};


