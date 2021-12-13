<?php
class Rest extends BaseController{
    function list() {
       $query=$this->pdo->query("SELECT id, title FROM mutants_objects");
       $query->execute();
       $data=$query->fetchAll();
       echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    function retrieve() {
        $query = $this->pdo->prepare("SELECT description, id, image, info FROM mutants_objects WHERE id = :id");
        $query->bindValue("id", $this->params['id']);
        $query->execute();

        $data = $query->fetch();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    function create() {
        $data=file_get_contents("php://input");
        $data=json_decode($data,True);
        $sql=<<<EOL
        INSERT INTO mutants_objects(title, description, type, info, image)
        VALUES(:title, :description, :type, :info, :image_url)
        EOL;

        $query=$this->pdo->prepare($sql);
        $query->bindValue("title", $data['title']);
        $query->bindValue("description", $data['description']);
        $query->bindValue("type", $data['type']);
        $query->bindValue("info", $data['info']);
        $query->bindValue("image_url", $data['image_url']);      
       
        $query->execute();
        $context['id'] = $this->pdo->lastInsertId(); 
        http_response_code(200);
        header("Content-type:application/json");
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    function update() {
        $data=file_get_contents("php://input");
        $data=json_decode($data,True);
        $sql=<<<EOL
        UPDATE `mutants_objects` SET `title`= :title, `description`= :description, `type`= :type, `info`= :info,`image`= :image_url  WHERE `id`= :id
        EOL;
        $query=$this->pdo->prepare($sql);
        $query->bindValue("id", $this->params['id']);
        $query->bindValue("title", $data['title']);
        $query->bindValue("description", $data['description']);
        $query->bindValue("type", $data['type']);
        $query->bindValue("info", $data['info']);
        $query->bindValue("image_url", $data['image_url']);
        $query->execute();
    
        http_response_code(200);
        header("Content-type:application/json");
        echo json_encode(['id'=>$this->params['id']]);
    }
    function delete() {
        $query = $this->pdo->prepare("DELETE FROM mutants_objects WHERE id = :id");
        $query->bindValue("id", $this->params['id']);
        $query->execute();

        http_response_code(200);
    }

    function process_response(){
      
        $method = $_SERVER['REQUEST_METHOD'];
         if($method == 'GET'){
             if(isset($this->params['id']))
                $this->retrieve();
             else 
                $this->list();
            }
         else if ($method == 'POST'){
            if(isset($this->params['id']))
            $this->update();
            else 
            $this->create();
            }
        else if ($method == 'DELETE'){
            $this->delete();
        }
    }
}