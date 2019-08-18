<?php
// Include config file
require_once 'config.php';
header( 'content-type: text/html; charset=utf-8' );
 
// Define variables and initialize with empty values
$nome = $cidade = $telefone = $email = $datanascimento = "";
$nome_err =  $cidade_err = $telefone_err = $email_err = $datanascimento_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
	// Validate nome
    $input_nome = trim($_POST["nome"]);
    if(empty($input_nome)){
        $nome_err = "Insira um nome.";
    } elseif(!filter_var(trim($_POST["nome"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $nome_err = 'Nome inválido.';
    } else{
        $nome = $input_nome;
    }
    
    // Validate cidade
    $input_cidade = trim($_POST["cidade"]);
    if(empty($input_cidade)){
        $cidade_err = 'Insira um endereço.';     
    } else{
        $cidade = $input_cidade;
    }
    
	
	// Validate telefone
    $input_telefone = trim($_POST["telefone"]);
    if(empty($input_telefone)){
        $telefone_err = 'Telefone inválido.';
    } else{
        $telefone = $input_telefone;
    }
    
	// Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = 'Please enter a valid email.';
    } else{
        $email = $input_email;
    }
	
	// Validate datanascimento
    $input_datanascimento = trim($_POST["datanascimento"]);
    if(empty($input_datanascimento)){
        $datanascimento_err = 'Data inválida.';
    } else{
        $datanascimento = $input_datanascimento;
    }
    // Check input errors before inserting in database
    if (empty($codcliente_err) && empty($nome_err) && empty($cidade_err) && empty($telefone_err) && empty($email_err) && empty($datanascimento_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO clientes (nome, cidade, telefone, email, datanascimento) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_nome, $param_cidade, $param_telefone, $param_email, $param_datanascimento );
            
            // Set parameters
			$param_nome = $nome;
            $param_cidade = $cidade;
			$param_telefone = $telefone;
			$param_email = $email;
			$param_datanascimento = $datanascimento;
			
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: clientes.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nome_err)) ? 'has-error' : ''; ?>">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>">
                            <span class="help-block"><?php echo $nome_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($cidade_err)) ? 'has-error' : ''; ?>">
                            <label>Cidade</label>
                            <textarea name="cidade" class="form-control"><?php echo $cidade; ?></textarea>
                            <span class="help-block"><?php echo $cidade_err;?></span>
                        </div>
                        
						<div class="form-group <?php echo (!empty($telefone_err)) ? 'has-error' : ''; ?>">
                            <label>Telefone</label>
                            <input type="text" name="telefone" class="form-control" value="<?php echo $telefone; ?>">
                            <span class="help-block"><?php echo $telefone_err;?></span>
                        </div>
						
						<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>E-mail</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
						
						<div class="form-group <?php echo (!empty($datanascimento_err)) ? 'has-error' : ''; ?>">
                            <label>Data de Nascimento</label>
                            <input type="text" name="datanascimento" class="form-control" value="<?php echo $datanascimento; ?>">
                            <span class="help-block"><?php echo $datanascimento_err;?></span>
                        </div>
						
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="clientes.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>