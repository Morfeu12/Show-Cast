<?php
// Include config file
require_once 'config.php';
header( 'content-type: text/html; charset=utf-8' );
 
// Define variables and initialize with empty values
$codproduto = $nome = $descricao = $preco =  "";
$codproduto_err = $nome_err =  $descricao_err = $preco_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate codcodproduto
    $input_codproduto = $_POST["codproduto"];
    if(!is_numeric($input_codproduto)){
        $codproduto_err = 'Código inválido. Insira um número de 1-9999';
    } else{
        $codproduto = $input_codproduto;
    }

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
    if (empty($codproduto_err) && empty($nome_err) && empty($descricao_err) && empty($preco_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO produtos (codproduto, nome, descricao, preco) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_codproduto, $param_nome, $param_descricao, $param_preco);
            
            // Set parameters
			$param_codproduto = $codproduto;
            $param_nome = $nome;
            $param_descricao = $descricao;
            $param_preco = $preco;
			
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produtos</title>
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
                        <div class="form-group <?php echo (!empty($codproduto_err)) ? 'has-error' : ''; ?>">
                            <label>Código do produto</label>
                            <input type="text" name="codproduto" class="form-control" value="<?php echo $codproduto; ?>">
                            <span class="help-block"><?php echo $codproduto_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($nome_err)) ? 'has-error' : ''; ?>">
                            <label>nome</label>
                            <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>">
                            <span class="help-block"><?php echo $nome_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($descricao_err)) ? 'has-error' : ''; ?>">
                            <label>descricao</label>
                            <textarea name="descricao" class="form-control"><?php echo $descricao; ?></textarea>
                            <span class="help-block"><?php echo $descricao_err;?></span>
                        </div>
                        
						<div class="form-group <?php echo (!empty($preco_err)) ? 'has-error' : ''; ?>">
                            <label>preco</label>
                            <input type="number" name="preco" class="form-control" value="<?php echo $preco; ?>">
                            <span class="help-block"><?php echo $preco_err;?></span>
                        </div>
						
										
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="produtos.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>