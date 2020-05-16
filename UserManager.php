<?php
class UserManager extends DAO{
    private $user_list;

    function __construct(){
        $this->table = 'users';
        $this->connection = new PDO('mysql:host=localhost;dbname=demo', 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->user_list = array();
    }

    function save($data) {
        $data['pk'] = -1;
        $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);
        var_dump($data);
        $date = date("Y-m-d h:i:sa");
        $user = $this->create([
            'pk' => $data['pk'],
            'username' => $data['username'],
            'password' =>$data['password'],
        ]);
        var_dump($user);

        if ($user) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (username, password) VALUES (?, ?)"
                );
                $statement->execute([
                    $user->__get('username'),
                    $user->__get('password')
                ]);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }
    }

    function create($data) {
        return new User(
        $data['pk'],
        $data['username'],
        $data['password']
    );
    }

    function update($username,$password,$pk){
        $statement = $this->connection->prepare("UPDATE users SET username = ?, password = ? WHERE pk = ?");
        $statement->execute(([$username,$password,$pk]));
    }


    function fetchAll() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach($results as $product) {
                array_push($this->user_list, $this->create($product));
            }
            return $this->user_list;

        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
}
?>