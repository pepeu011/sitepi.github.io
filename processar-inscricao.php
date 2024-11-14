<?php
// Dados de conexão PostgreSQL
$dsn = "pgsql:host=fixedly-reciprocal-mallard.data-1.use1.tembo.io;port=5432;dbname=postgres";
$username = "postgres";
$password = "qthoiR3zo5zktkbg";

try {
    // Conectar ao banco de dados usando PDO
    $conn = new PDO($dsn, $username, $password);

    // Configura o modo de erro do PDO para lançar exceções
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitiza e obtém os valores do formulário
        $nome = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $telefone = htmlspecialchars($_POST['phone']);
        $curso = htmlspecialchars($_POST['course']);
        $comentarios = htmlspecialchars($_POST['comments']);

        // SQL para inserir os dados na tabela inscricoes
        $sql = "INSERT INTO inscricoes (nome, email, telefone, curso, comentarios)
                VALUES (:nome, :email, :telefone, :curso, :comentarios)";

        // Prepara a query
        $stmt = $conn->prepare($sql);

        // Vincula os parâmetros
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':curso', $curso);
        $stmt->bindParam(':comentarios', $comentarios);

        // Executa a query
        if ($stmt->execute()) {
            echo "Inscrição realizada com sucesso!";
        } else {
            echo "Erro ao registrar inscrição.";
        }
    } else {
        echo "Método de requisição inválido.";
    }
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>
