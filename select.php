<?php

	/* Exemplo de código para abrir conexão com banco de dados */

	$host = "localhost";
	$usuario = "root";
	$senha = "";
	$banco = "Final";

	/* abre a conexão */
	$link = mysqli_connect($host,$usuario,$senha);
	if(!$link)
	{
		/* não conseguiu abrir a conexão */
		echo "Erro de conexao: " . mysqli_connect_error();
		die();
	}

	/* seleciona o banco de dados */
	if(!mysqli_select_db($link, $banco))
	{
		/* erro ao selecionar o banco de dados */
		echo "Erro na selecao do banco: " . mysqli_error($link);
		mysqli_close($link);
		die();
	}

	/* enviando a consulta para o banco de dados */
	$resposta = mysqli_query($link, "select * from Idioma");
	if($resposta)
	{
		/* deu certo!! mostar o resultado */
		/* pega a primeira linha */
		$linha = mysqli_fetch_assoc($resposta); // Pega a primeira
?>
<p>Escolha o idioma de sua preferência:</p>
<?php 
        while($linha)
        {
            $cod_idioma = $linha['cod_idioma'];
            $idioma = $linha['nome_idioma'];

            echo "$idioma: <input type=\"radio\" name=\"idioma\" value=\"$cod_idioma?>\"><br>";
            $linha = mysqli_fetch_assoc($resposta); // Pega a proxima linha
        }
	}
	else
	{
		/* erro ao executar a consulta */
		echo mysqli_error($link);
	}

	/* fecha a conexão */
	mysqli_close($link);
?>