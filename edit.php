<?php
$servername = "localhost";
$username = "root";
$passoword = "";
$database = "crudphp";

//conectando o banco de dados
$connection = new mysqli($servername, $username, $passoword, $database);


$id = "";
$nome = "";
$email = "";
$telefone = "";
$endereco = "";

$errorMessage = "";
$sucessMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //METODO GET: MOSTRAR OS DADOS DO CLIENTE 
    if ( !isset($_GET["id"]) ){
        header("location: /crudphp/index.php");
        exit;
    }

    $id = $_GET["id"];

    // ler a linha do cliente selecionada da tabela do BD
    $sql = "SELECT * FROM clientes WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /crudphp/index.php");
        exit;
    }

    $nome = $row["nome"];
    $email = $row["email"];
    $telefone = $row["telefone"];
    $endereco = $row["endereco"];
}
else {
    // METODO POST: ATUALIZA OS DADOS DO CLIENTE 

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];

    do {
        if( empty($nome) || empty($email) || empty($telefone) || empty($endereco) ){
            $errorMessage = "Todos os campos devem estar preenchidos!";
             break;
         }

         $sql = "UPDATE clientes 
         SET nome = '$nome', email = '$email', telefone = '$telefone', endereco = '$endereco'
         WHERE id = $id ";


        // $sql = "UPDATE clientes" .
        //   "SET nome = '$nome' " . 
        //   "SET email = '$email' " .
        //   "SET telefone = '$telefone' " .
        //   "SET endereco = '$endereco' " .
        //   "WHERE id = '$id'";

         $result = $connection->query($sql);

         if (!$result){
            $errorMessage = "Invalid query: " . $connection->error;
            break;
         }

         $sucessMessage = "Cliente atualizado com sucesso!";

         header("location: /crudphp/index.php");
         exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud PHP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class = "container my-5">
        <h2>Novo Cliente</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class = 'alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'><button>
            </div>  
            ";
        }
        ?>
        <form method="post">
            <input type="hidden" name = "id" value ="<?php echo $id ?>">
            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">Nome</label>
                <div class  = "col-sm-6">
                    <input type="text" class = "form-control" name = "nome" value="<?php echo $nome ?>">
                </div>
            </div>

            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">Email</label>
                <div class  = "col-sm-6">
                    <input type="text" class = "form-control" name = "email" value="<?php echo $email ?>">
                </div>
            </div>

            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">Telefone</label>
                <div class  = "col-sm-6">
                    <input type="text" class = "form-control" name = "telefone" value="<?php echo $telefone ?>">
                </div>
            </div>

            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">Endereço</label>
                <div class  = "col-sm-6">
                    <input type="text" class = "form-control" name = "endereco" value="<?php echo $endereco ?>">
                </div>
            </div>

            <?php
            if (!empty($sucessMessage)){
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$sucessMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss = 'alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <div class = "row mb-3">
                <div class = "offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class = "btn btn-outline-primary" href="/crudphp/index.php" role = "button">cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>