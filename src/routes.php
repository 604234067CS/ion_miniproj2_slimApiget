<?php

// get all todos
    $app->get('/member', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM member ORDER BY mem_id");
        $sth->execute();
        $member = $sth->fetchAll();
        return $this->response->withJson($member);
    });
    $app->get('/picture', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT * FROM picture ORDER BY id_pic");
       $sth->execute();
       $picture = $sth->fetchAll();
       return $this->response->withJson($picture);
   });
   $app->get('/rentedroom', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM rentedroom ORDER BY id_ren");
   $sth->execute();
   $rentedroom = $sth->fetchAll();
   return $this->response->withJson($rentedroom);
});
$app->get('/type', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM type ORDER BY type_id");
   $sth->execute();
   $type = $sth->fetchAll();
   return $this->response->withJson($type);
});
 
    // Retrieve todo with id 
    $app->get('/todo/[{id}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM tasks WHERE id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $todos = $sth->fetchObject();
        return $this->response->withJson($todos);
    });
 
 
    // Search for todo with given search teram in their name
    $app->get('/todos/search/[{query}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM tasks WHERE UPPER(task) LIKE :query ORDER BY task");
        $query = "%".$args['query']."%";
        $sth->bindParam("query", $query);
        $sth->execute();
        $todos = $sth->fetchAll();
        return $this->response->withJson($todos);
    });
 
    // Add a new todo
    $app->post('/todo', function ($request, $response) {
        $input = $request->getParsedBody();
        $sql = "INSERT INTO tasks (task) VALUES (:task)";
         $sth = $this->db->prepare($sql);
        $sth->bindParam("task", $input['task']);
        $sth->execute();
        $input['id'] = $this->db->lastInsertId();
        return $this->response->withJson($input);
    });
        
 
    // DELETE a todo with given id
    $app->delete('/todo/[{id}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("DELETE FROM tasks WHERE id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $todos = $sth->fetchAll();
        return $this->response->withJson($todos);
    });
 
    // Update todo with given id
    $app->put('/todo/[{id}]', function ($request, $response, $args) {
        $input = $request->getParsedBody();
        $sql = "UPDATE tasks SET task=:task WHERE id=:id";
         $sth = $this->db->prepare($sql);
        $sth->bindParam("id", $args['id']);
        $sth->bindParam("task", $input['task']);
        $sth->execute();
        $input['id'] = $args['id'];
        return $this->response->withJson($input);
    });
    $app->get('/condomiuium', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT rentedroom.id_ren,
        rentedroom.name_ren,
        rentedroom.address_ren,
        rentedroom.price,
        rentedroom.facilities,
        rentedroom.id_pic,
        type.name_type,
        rentedroom.res_gender,
        rentedroom.phone_ren
        FROM rentedroom, type,picture
        WHERE rentedroom.id_type = type.type_id AND type.type_id LIKE 't0001%' AND rentedroom.id_ren = picture.id_ren AND rentedroom.price");
       $sth->execute();
       $member = $sth->fetchAll();
       return $this->response->withJson($member);
   });
   $app->get('/apartamen', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT rentedroom.id_ren,
    rentedroom.name_ren,
    rentedroom.address_ren,
    rentedroom.price,
    rentedroom.facilities,
    rentedroom.id_pic,
    type.name_type,
    rentedroom.res_gender,
    rentedroom.phone_ren
    FROM rentedroom, type,picture
    WHERE rentedroom.id_type = type.type_id AND type.type_id LIKE 't0002%' AND rentedroom.id_ren = picture.id_ren AND rentedroom.price");
   $sth->execute();
   $member = $sth->fetchAll();
   return $this->response->withJson($member);
});
$app->get('/mansion', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT rentedroom.id_ren,
    rentedroom.name_ren,
    rentedroom.address_ren,
    rentedroom.price,
    rentedroom.facilities,
    rentedroom.id_pic,
    type.name_type,
    rentedroom.res_gender,
    rentedroom.phone_ren
    FROM rentedroom, type,picture
    WHERE rentedroom.id_type = type.type_id AND type.type_id LIKE 't0003%' AND rentedroom.id_ren = picture.id_ren AND rentedroom.price");
   $sth->execute();
   $member = $sth->fetchAll();
   return $this->response->withJson($member);
});
$app->get('/dorm', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT rentedroom.id_ren,
    rentedroom.name_ren,
    rentedroom.address_ren,
    rentedroom.price,
    rentedroom.facilities,
    rentedroom.id_pic,
    type.name_type,
    rentedroom.res_gender,
    rentedroom.phone_ren
    FROM rentedroom, type,picture
    WHERE rentedroom.id_type = type.type_id AND type.type_id LIKE 't0004%' AND rentedroom.id_ren = picture.id_ren AND rentedroom.price");
   $sth->execute();
   $member = $sth->fetchAll();
   return $this->response->withJson($member);
});

$app->get('/search/[{query}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM rentedroom WHERE name_ren LIKE :query ORDER BY name_ren");
   $query = "%".$args['query']."%";
   $sth->bindParam("query", $query);
   $sth->execute();
   $todos = $sth->fetchAll();
   return $this->response->withJson($todos);
});


