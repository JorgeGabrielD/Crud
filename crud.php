<?php

include_once "conexao.php";

$acao = $_GET['acao'];

if(isset($_GET['id']))

{
    $id = $_GET['id'];
}

switch ($acao){
    case 'inserir':
        
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $data = $_POST['data'];
    $mensagem = $_POST['mensagem'];

    $sqlInsert = "INSERT INTO users (user_name, user_email, user_date, user_mensagem) 
    VALUES ('$nome', '$email', '$data', '$mensagem')";
    
    if(!mysqli_query($conexao,$sqlInsert))
    {
        die("erro ao inserir informações" . mysqli_error($conexao));
    }
    else
    {
        echo "<script language='javascript' type='text/javascript'>
        alert('dados cadastrados com sucesso!')
        window.location.href='crud.php?acao=selecionar'</script>";
    }

        break;
        
    case 'montar':
        
            $id = $_GET['id'];
            $sql = 'SELECT * FROM users WHERE user_id = ' . $id;
            $resultado = mysqli_query($conexao,$sql) or die ("Erro ao retornar dados");
        echo "<form method = 'post' name='dados' action='crud.php?acao=atualizar' onSubmit='returnenviardados();'>";
        echo"<table width='588' border='0' align='center' >";

        while ($registro = mysqli_fetch_array($resultado)){
            echo "<tr>";
            echo "<td width='118'><font size ='1' face='Verdana,Arial,Helvetica,sans-serif'>Código:</font></td>";
            echo "<td width='460'>";
            echo "<input name='id' type='text' class='formbutton' id='id' size='5'  maxlength='10' value=" .$id." readonly>";
            echo "</td>";
            echo "</tr>";

            echo " <tr>";
            echo " <td> <font face ='Verdana, Arial, Helvetica , sans-serif'><font size='1'> Nome: <strong>:</strong></font></td>";
            echo " <td rowspan='2'> <font size='2'>";
            echo "<style> textarea{resize:none;}></style>";
            echo "<textarea name='nome' cols='50' rows='3' class='formbutton'>" .htmlspecialchars ($registro['user_name']) . "</textarea>";
            echo "</font></td>";
            echo "</tr>";
            echo "<tr>";

            echo " <tr>";
            echo " <td> <font face ='Verdana, Arial, Helvetica , sans-serif'><font size='1'> Email: <strong>:</strong></font></td>";
            echo " <td rowspan='2'> <font size='2'>";
            echo "<style> textarea{resize:none;}></style>";
            echo "<textarea name='email' cols='50' rows='3' class='formbutton'>" .htmlspecialchars ($registro['user_email']) . "</textarea>";
            echo "</font></td>";
            echo "</tr>";
            echo "<tr>";

            echo " <tr>";
            echo " <td> <font face ='Verdana, Arial, Helvetica , sans-serif'><font size='1'> Data: <strong>:</strong></font></td>";
            echo " <td rowspan='2'> <font size='2'>";
            echo "<style> textarea{resize:none;}></style>";
            echo "<textarea name='data' cols='50' rows='3' class='formbutton'>" .htmlspecialchars ($registro['user_date']) . "</textarea>";
            echo "</font></td>";
            echo "</tr>";
            echo "<tr>";

            echo " <tr>";
            echo " <td> <font face ='Verdana, Arial, Helvetica , sans-serif'><font size='1'> Mensagem: <strong>:</strong></font></td>";
            echo " <td rowspan='2'> <font size='2'>";
            echo "<style> textarea{resize:none;}></style>";
            echo "<textarea name='mensagem' cols='50' rows='3' class='formbutton'>" .htmlspecialchars ($registro['user_mensagem']) . "</textarea>";
            echo "</font></td>";
            echo "</tr>";
            echo "<tr>";
            
            echo "<tr>";
            echo "<td height = '22'></td>";
            echo "<td>";
            echo "<input type= 'submit' class='formobjects'  value='Atualizar'>";
            echo "<button type='submit' formaction = 'crud.php?acao=selecionar'>Selecionar</button> ";
            echo "<input type= 'reset' name='reset' class='formobjects'  value='Limpar Campos'>";
            echo "</td>";
            echo "</tr>";

            echo"</table>";
            echo"</form>";
        }
        mysqli_close($conexao);
           
             
                
           
        break;
        
    case'atualizar':
        
        $codigo = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $data = $_POST['data'];
        $mensagem = $_POST['mensagem'];

        $sql = "UPDATE users SET user_name ='$nome' , user_email = '$email ' , user_date =' $data', user_mensagem = '  $mensagem' WHERE user_id = '$codigo' ";

        if(!mysqli_query($conexao,$sql)){
            die('</br> Erro no comando SQL UPDATE: ' . mysqli_error($conexao));
            echo "<script language = 'javascript' type ='text/javascript'>
            alert('Erro ao Atualizar');Windows.Location = 'crud.php?acao=selecionar'</script>";
        }
        else {
            echo "<script language='javascript' type='text/javascript'>
            alert('Dados atualizado com sucesso!')
            window.location.href='crud.php?acao=selecionar'</script>";
        }
        
        break;
        
    case 'deletar':
        
        $sql = "DELETE FROM users WHERE user_id = '" . $id . "'";
        
        if(!mysqli_query($conexao,$sql))
    {
        die("erro ao inserir informações" . mysqli_error($conexao));
    }
        else
    {
        echo "<script language='javascript' type='text/javascript'>
        alert('dados deletados com sucesso!')
        window.location.href='crud.php?acao=selecionar'</script>";
    }
    mysqli_close($conexao);
    header("Location:crud.php?acao=selecionar");
        
        
        break;
        
    case 'selecionar':
        
        date_default_timezone_set('America/Sao_Paulo');
      
        
        echo"<meta charset='UTF-8'>";
        echo"<center><table border=1>";
        echo"<tr>";
        echo"<th>CODIGO</th>";
        echo"<th>NOME</th>";
        echo"<th>EMAIL</th>";
        echo"<th>DATA CADASTRO</th>";
        echo"<th>MENSAGEM</th>";
        echo"<th>AÇÃO</th>";
        echo"</tr>";
        
        $sqlInsert = "SELECT * FROM users";
        $resultado = mysqli_query($conexao,$sqlInsert) or die("Erro ao retornar dados");
        
        echo"<center>Registro cadastrados na base de dados.<br/></center>";
        echo"</br>";
        
        while($registro = mysqli_fetch_array($resultado)){
            
            $id = $registro['user_id'];
            $nome = $registro['user_name'];
            $email = $registro['user_email'];
            $data = $registro['user_date'];
            $mensagem = $registro['user_mensagem'];
            
            echo"<tr>";
            echo"<td>" . $id . "</td>";
            echo"<td>" . $nome . "</td>";
            echo"<td>" . $email . "</td>";
            echo"<td>" . date("d/m/Y", strtotime($data)) . "</td>";
            echo"<td>" . $mensagem . "</td>";
            echo"<td> <a href='crud.php?acao=deletar&id=$id'><img src='delete.png' alt='Deletar registro'></a>
            <a href='crud.php?acao=montar&id=$id'><img src='update.png' alt='Atualizar' title='atualizar registro'</a>
            <a href='index.php'><img src='insert.png' alt='Inseir' title='Inserir registro'></a>";
            
            echo"</tr>";
        }
        mysqli_close($conexao);


        break;
    
    default:
        header("Location:crud.php?acao=selecionar");
        break;
}

