<?php 

    namespace app\models;
    use app\db\Db;

    class User {

        private static $table = "users";
        private object $db;

        public function __construct() { 
            $this->db = new Db();
        }

        public function getOne(int $id) {

            $query = 'SELECT * FROM '.self::$table.' WHERE id = :id';
            $stmt = $this->getDb()->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            }else {
                throw new \Exception("Usuário não encontrado");
            }
        }

        public function getAll() {

            $query = 'SELECT * FROM '.self::$table;
            $stmt = $this->getDb()->prepare($query);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                throw new \Exception("Nenhum usuário encontrado!");
            }
        }

        public function insert($data) {
            
            $query = "INSERT INTO ".self::$table."( nome, email, password) VALUES ( :nome, :email, :password)";
            $stmt = $this->getDb()->prepare($query);
            $stmt->bindValue(":nome", $data["nome"]);
            $stmt->bindValue(":email", $data["email"]);
            $stmt->bindValue(":password", $data["password"]);

            $stmt->execute();

            if($stmt->rowCount() > 0) {
                return 'Usuário(a) inserido com sucesso!';
            } else {
                throw new \Exception('Falha ao inserir o usuário(a)');
            }
        }

        public function update($id, $data) { 

            $query = 'UPDATE '.self::$table.' SET nome = :nome, email = :email, password = :password WHERE id = :id';
            $stmt = $this->getDb()->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':nome', $data['nome']);
            $stmt->bindValue(':email', $data['email']);
            $stmt->bindValue(':password', $data['password']);
            
            $stmt->execute();

            if($stmt->rowCount() > 0) { 
                return 'Dados do usuário(a) atualizaco';
            } else {
                throw new \Exception('Falha ao atualizar os dados do usuário(a)');
            }

        }

        public function delete($id) { 

            $query = 'DELETE FROM '.self::$table.' WHERE id = :id';
            $stmt = $this->getDb()->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                return 'Usuário(a) deletado com sucesso!';
             } else { 
                throw new \Exception('Falha ao deletar usuário(a)');
             }
        
        }

        public function getDb() {
            return $this->db->getDb();
        }
    }