<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$nome = $cidade = $telefone = $email = $datanascimento = "";
$nome_err = $cidade_err = $telefone_err = $email_err = $datanascimento_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["codcliente"]) && !empty($_POST["codcliente"])){
    // Get hidden input value
    $codcliente = $_POST["codcliente"];
    
    //Validação
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
    if(empty($nome_err) && empty($cidade_err) && empty($telefone_err) && empty($email_err) && empty($datanascimento_err)){
        // Prepare an insert statement
        $sql = "UPDATE clientes SET nome=?, cidade=?, telefone=?, email=?, datanascimento=? WHERE codcliente=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssi", $param_nome, $param_cidade, $param_telefone, $param_email, $param_datanascimento, $param_codcliente);
            
            // Set parameters
            $param_nome = $nome;
            $param_cidade = $cidade;
            $param_telefone = $telefone;
            $param_email = $email;
            $param_datanascimento = $datanascimento;
            $param_codcliente = $codcliente;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["codcliente"]) && !empty(trim($_GET["codcliente"]))){
        // Get URL parameter
        $codcliente =  trim($_GET["codcliente"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM clientes WHERE codcliente = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_codcliente);
            
            // Set parameters
            $param_codcliente = $codcliente;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nome = $row["nome"];
                    $cidade = $row["cidade"];
                    $telefone = $row["telefone"];
                    $email = $row["email"];
                    $datanascimento = $row["datanascimento"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nome_err)) ? 'has-error' : ''; ?>">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>">
                            <span class="help-block"><?php echo $nome_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($cidade_err)) ? 'has-error' : ''; ?>">
                            <label>Cidade</label>
                            <input type="text" name="cidade" class="form-control" value="<?php echo $cidade; ?>">
                            <span class="help-block"><?php echo $cidade_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($telefone_err)) ? 'has-error' : ''; ?>">
                            <label>Telefone</label>
                            <input type="text" name="telefone" class="form-control" value="<?php echo $telefone; ?>">
                            <span class="help-block"><?php echo $telefone_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <textarea name="email" class="form-control"><?php echo $email; ?></textarea>
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($datanascimento_err)) ? 'has-error' : ''; ?>">
                            <label>Data de nascimento</label>
                            <input type="text" name="datanascimento" class="form-control" value="<?php echo $datanascimento; ?>">
                            <span class="help-block"><?php echo $datanascimento_err;?></span>
                        </div>
                        <input type="hidden" name="codcliente" value="<?php echo $codcliente; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>