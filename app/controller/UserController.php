<?php  

    namespace app\controller;
    use app\models\User;

    class UserController {

        public $userModel;

        public function __construct() {
            $this->userModel = new User();
        }

        public function get($id = null) {  

            if($id) {
                return $this->userModel->getOne($id);
            } else {
                return $this->userModel->getAll();
            }
        }

        public function post() {
            
             $postJson =  json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);

             if(is_array($postJson) && count($postJson) > 0) {
                return $this->userModel->insert($postJson);
            } else {
                throw new \Exception('É necessário inseri os dados nas inputs');
            }
        }
        public function put($id) {

            if($id) { 

                $postJson =  json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);

             if(is_array($postJson) && count($postJson) > 0) {
                return $this->userModel->update($id, $postJson);
            } else {
                throw new \Exception('É necessário inseri os dados nas inputs');
            }

            } else {
                throw new \Exception('É necessário informar o id do usuário a ser alterado');
            }

        }

        public function delete($id) {

            if($id) {
                return $this->userModel->delete($id);
            } else {
                throw new \Exception('É necessário informar o id do usuário a ser deletado');
            }
        }

    }