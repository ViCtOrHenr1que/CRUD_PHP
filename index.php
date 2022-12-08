<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud com PHP 7</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Lista de Clientes</h2>
        <a class="btn btn-primary" href="/crudphp/create.php" role="button">Novo Cliente</a>
        <br>
        <table class = "table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Criado em</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $passoword = "";
                $database = "crudphp";

                //conectando o banco de dados
                $connection = new mysqli($servername, $username, $passoword, $database);
                
                //checando a conexão
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                //lendo todas as linhas da tabela na base de dados
                $sql = "SELECT * FROM clientes";
                $result = $connection->query($sql);

                if (!$result){
                    die("Invalid query: " . $connection->error);
                }

                //ler dados de cada linha 
                while($row = $result->fetch_assoc()){
                    echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[nome]</td>
                        <td>$row[email]</td>
                        <td>$row[telefone]</td>
                        <td>$row[endereco]</td>
                        <td>$row[created_at]</td>
                        <td>
                            <a class = 'btn btn-primary btn-sm' href='/crudphp/edit.php?id=$row[id]'>Editar</a>
                            <a class = 'btn btn-primary btn-sm' href='/crudphp/delete.php?id=$row[id]'>Deletar</a>
                        </td>
                    </tr>
                    ";
                }

                
                ?>

            </tbody>
        </table>
    </div>
</body>
</html>