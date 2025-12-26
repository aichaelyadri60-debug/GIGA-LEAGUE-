<?php  
class Database{
    private string $servername ;
    private string $username ;
    private string $password ;
    private string $dbname ;
    public function __construct(string $Sn ,string $Un ,string $p ,string $dn){
        $this->servername =$Sn;
        $this->username =$Un;
        $this->password =$p;
        $this->dbname =$dn;

    }
    public function connexion(){

        try{
            $conn =new PDO("mysql:host={$this->servername};dbname={$this->dbname}",$this->username  ,$this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully\n";
            return $conn;
        }catch(PDOException $e){
            die("erreur connexion " .$e->getMessage());
        
        }
    }

}
