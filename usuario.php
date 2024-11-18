<?php
    Class Usuario
    {
        private $pdo;

        public $msgErro = "";

        public function conectar($nome, $host, $usuario, $senha)
        {

            try {
                $this->pdo = new PDO("mysql:dbname=" . $nome, $usuario, $senha);
            } catch (PDOException $erro) {
                $this->msgErro = $erro->getMessage();
            }
        }
    
        public function getPdo()
        {
            return $this->pdo;
        }
        public function cadastrar($nome, $telefone, $email, $senha)
        {
            

            //verificar se o email já está cadastrado no banco de dados
            $sql = $this->pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :maria"); //:maria significa que colocamos um apelido na variavel email do PHP
            $sql->bindValue(":maria",$email);
            $sql->execute();

            //verificar se existe email cadastrado
            if($sql->rowCount() > 0)
            {
                return false;
            }
            else
            {
                //cadastrar usuario
                $sql = $this->pdo->prepare("INSERT INTO usuario (nome,telefone,email,senha) VALUES (:n, :t, :e, :s)");
                $sql->bindValue(":n",$nome);
                $sql->bindValue(":t",$telefone);
                $sql->bindValue(":e",$email);
                $sql->bindValue(":s",md5($senha));
                $sql->execute();
                return true;                
            }
        }

        public function logar($email,$senha)
        {

            $verificarEmail = $this->pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :e AND senha = :s"); // prepapre - preparar os usuarios para nao ficar exposto no sql
            $verificarEmail->bindValue(":e",$email);
            $verificarEmail->bindValue(":s", md5($senha));
            $verificarEmail->execute();

            if($verificarEmail->rowCount() > 0)
            {
                //posso logar no sistema, pois o email e a senha existem no banco de dados e estão de acordo.
                $dados = $verificarEmail->fetch();
                session_start();
                $_SESSION['id_usuario'] = $dados['id_usuario'];
                return true;
            }
            else
            {
                return false;
            }
        }

        public function listarUsuarios()
        {
            if (!$this->pdo){
                throw new Exception("Erro: Conexao com o banco de dados falhou");
            }
            global $pdo;

            $sqlListar = $this->pdo->prepare("SELECT * FROM usuario");
            $sqlListar->execute();

            if($sqlListar->rowCount()>0)
            {
                $dados = $sqlListar->fetchAll(PDO::FETCH_ASSOC);
                return $dados;
            }
            else
            {
                return false;
            }
        }

    }
    