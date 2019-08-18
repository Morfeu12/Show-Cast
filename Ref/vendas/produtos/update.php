<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$nome = $descricao = $preco = "";
$nome_err = $descricao_err = $preco_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["codproduto"]) && !empty($_POST["codproduto"])){
    // Get hidden input value
    $codproduto = $_POST["codproduto"];
    
    //Validação
    // Validate nome
    $input_nome = trim($_POST["nome"]);
    if(empty($input_nome)){
        $nome_err = "Insira um nome.";
    } elseif(!filter_var(trim($_POST["nome"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $nome_err = 'nome inválido.';
    } else{
        $nome = $input_nome;
    }
    
    // Validate descricao
    $input_descricao = trim($_POST["descricao"]);
    if(empty($input_descricao)){
        $descricao_err = 'Insira um endereço.';     
    } else{
        $descricao = $input_descricao;
    }
    
    // Validate preco
    $input_preco = $_POST["preco"];
    if(!is_numeric($input_preco)){
        $preco_err = 'preco inválido.';
    } else{
        $preco = $input_preco;
    }
    
    // Check input errors before inserting in database
    if(empty($nome_err) && empty($descricao_err) && empty($preco_err)){
        // Prepare an insert statement
        $sql = "UPDATE produtos SET nome=?, descricao=?, preco=? WHERE codproduto=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_nome, $param_descricao, $param_preco, $param_codproduto);
            
            // Set parameters
            $param_nome = $nome;
            $param_descricao = $descricao;
            $param_preco = $preco;
            $param_codproduto = $codproduto;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: produtos.php");
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
    if(isset($_GET["codproduto"]) && !empty(trim($_GET["codproduto"]))){
        // Get URL parameter
        $codproduto =  trim($_GET["codproduto"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM produtos WHERE codproduto = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_codproduto);
            
            // Set parameters
            $param_codproduto = $codproduto;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nome = $row["nome"];
                    $descricao = $row["descricao"];
                    $preco = $row["preco"];
                    
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
                        <div class="form-group <?php echo (!empty($descricao_err)) ? 'has-error' : ''; ?>">
                            <label>descricao</label>
                            <input type="text" name="descricao" class="form-control" value="<?php echo $descricao; ?>">
                            <span class="help-block"><?php echo $descricao_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($preco_err)) ? 'has-error' : ''; ?>">
                            <label>preco</label>
                            <input type="text" name="preco" class="form-control" value="<?php echo $preco; ?>">
                            <span class="help-block"><?php echo $preco_err;?></span>
                        </div>
                        
                        <input type="hidden" name="codproduto" value="<?php echo $codproduto; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="prodotos.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>