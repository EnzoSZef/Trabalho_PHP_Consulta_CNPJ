<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consulta CNPJ</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f8ff;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            background: #ffffff;
            padding: 25px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 128, 255, 0.2);
        }

        h1, h3, h4 {
            text-align: center;
            color: #0d47a1;
        }

        form {
            display: flex;
            gap: 12px;
            margin-bottom: 25px;
            justify-content: center;
        }

        input[type="text"] {
            width: 320px;
            padding: 10px;
            border: 2px solid #42a5f5;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s ease-in-out;
        }

        input[type="text"]:focus {
            border-color: #1e88e5;
            outline: none;
        }

        button {
            padding: 10px 20px;
            background-color: #00bfa5;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #009688;
        }

        .info {
            padding: 20px;
            border-radius: 6px;
            background-color: #e8f5e9;
            border: 2px solid #66bb6a;
            color: #2e7d32;
            margin-top: 20px;
        }

        .info.error {
            background-color: #ffebee;
            border-color: #e53935;
            color: #c62828;
        }

        .info-ul {
            padding-left: 20px;
            margin: 10px 0;
        }

        p {
            margin: 5px 0;
            font-size: 15px;
        }
    </style>
</head>
<body>
<?php
$erro = '';
$dados = null;

if (isset($_GET['cnpj']) && !empty($_GET['cnpj'])) {
    $cnpj = preg_replace('/\D/', '', $_GET['cnpj']);

    if (strlen($cnpj) !== 14) {
        $erro = 'CNPJ inválido.';
    } else {
        $url = "https://receitaws.com.br/v1/cnpj/$cnpj";
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $resposta = curl_exec($ch);
        curl_close($ch);

        if ($resposta !== false) {
            $dados = json_decode($resposta, true);
            if (isset($dados['status']) && $dados['status'] === 'ERROR') {
                $erro = 'Erro: ' . $dados['message'];
                $dados = null;
            }
        } else {
            $erro = 'Erro na requisição.';
        }
    }
}
?>

<div class="container">
    <h1>Consulta de CNPJ</h1>

    <form method="get">
        <input type="text" name="cnpj" placeholder="Digite o CNPJ" pattern="\d{14}" title="Digite 14 números" required
               value="<?php echo isset($_GET['cnpj']) ? htmlspecialchars($_GET['cnpj']) : ''; ?>">
        <button type="submit">Consultar</button>
    </form>

    <?php
    if ($erro != '') {
        echo '<div class="info error">' . $erro . '</div>';
    } else if ($dados != null) {
        echo '<div class="info">';
        echo '<h3>Informações da Empresa</h3>';
        echo '<p><strong>Nome:</strong> ' . ($dados['nome'] ?? '---') . '</p>';
        echo '<p><strong>Nome Fantasia:</strong> ' . ($dados['fantasia'] ?? '---') . '</p>';
        echo '<p><strong>Situação Cadastral:</strong> ' . ($dados['situacao'] ?? '---') . '</p>';
        echo '<p><strong>Data de Abertura:</strong> ' . ($dados['abertura'] ?? '---') . '</p>';
        echo '<p><strong>Tipo:</strong> ' . ($dados['tipo'] ?? '---') . '</p>';
        echo '<p><strong>Natureza Jurídica:</strong> ' . ($dados['natureza_juridica'] ?? '---') . '</p>';
        echo '<p><strong>Capital Social:</strong> R$ ' . ($dados['capital_social'] ?? '---') . '</p>';
        echo '<p><strong>UF:</strong> ' . ($dados['uf'] ?? '---') . '</p>';
        echo '<p><strong>Município:</strong> ' . ($dados['municipio'] ?? '---') . '</p>';
        echo '<p><strong>Bairro:</strong> ' . ($dados['bairro'] ?? '---') . '</p>';
        echo '<p><strong>Logradouro:</strong> ' . ($dados['logradouro'] ?? '---') . '</p>';
        echo '<p><strong>Número:</strong> ' . ($dados['numero'] ?? '---') . '</p>';
        echo '<p><strong>CEP:</strong> ' . ($dados['cep'] ?? '---') . '</p>';
        echo '<p><strong>Complemento:</strong> ' . ($dados['complemento'] ?? '---') . '</p>';
        echo '<p><strong>Telefone:</strong> ' . ($dados['telefone'] ?? '---') . '</p>';
        echo '<p><strong>Email:</strong> ' . ($dados['email'] ?? '---') . '</p>';
        echo '<p><strong>Última Atualização:</strong> ' . ($dados['ultima_atualizacao'] ?? '---') . '</p>';

        echo '<h4>Atividade Principal</h4>';
        if (!empty($dados['atividade_principal'])) {
            echo '<ul class="info-ul">';
            for ($i = 0; $i < count($dados['atividade_principal']); $i++) {
                echo '<li>' . $dados['atividade_principal'][$i]['code'] . ' - ' . $dados['atividade_principal'][$i]['text'] . '</li>';
            }
            echo '</ul>';
        }

        echo '<h4>Atividades Secundárias</h4>';
        if (!empty($dados['atividades_secundarias'])) {
            echo '<ul class="info-ul">';
            for ($i = 0; $i < count($dados['atividades_secundarias']); $i++) {
                echo '<li>' . $dados['atividades_secundarias'][$i]['code'] . ' - ' . $dados['atividades_secundarias'][$i]['text'] . '</li>';
            }
            echo '</ul>';
        }

        echo '</div>';
    }
    ?>
</div>
</body>
</html>
