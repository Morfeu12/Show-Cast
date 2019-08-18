<?php
// Include config file
require_once 'config.php';
header( 'content-type: text/html; charset=utf-8' );
 
// Define variables and initialize with empty values
$quantidade = $valorparcial = $fk_codpedido = $fk_codproduto = "";
$quantidade_err =  $valorparcial_err = $fk_codpedido_err = $fk_codproduto_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
	// Validate quantidade
    $input_quantidade = trim($_POST["quantidade"]);
    if(empty($input_quantidade)){
        $quantidade_err = "Insira uma quantidade.";
    } else{
        $quantidade = $input_quantidade;
    }
    
    // Validate valorparcial
    $input_valorparcial = trim($_POST["valorparcial"]);
    if(empty($input_valorparcial)){
        $valorparcial_err = 'Insira um endereço.';     
    } else{
        $valorparcial = $input_valorparcial;
    }
    
	
	// Validate fk_codpedido
    $fk_codpedido = $_POST["fk_codpedido"];
    
	
	// Validate fk_codproduto
    $fk_codproduto = $_POST["fk_codproduto"];
    
    // Check input errors before inserting in database
    if (empty($quantidade_err) && empty($valorparcial_err) && empty($fk_codpedido_err) && empty($fk_codproduto_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO itensdepedidos (quantidade, valorparcial, fk_codpedido, fk_codproduto) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_quantidade, $param_valorparcial, $param_fk_codpedido,  $param_fk_codproduto );
            
            // Set parameters
			$param_quantidade = $quantidade;
            $param_valorparcial = $valorparcial;
			$param_fk_codpedido = $fk_codpedido;
			$param_fk_codproduto = $fk_codproduto;
			
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: itensdepedidos.php");
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
    <title>Cadastro de intens de pedido</title>
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
                        <div class="form-group <?php echo (!empty($quantidade_err)) ? 'has-error' : ''; ?>">
                            <label>Quantidade</label>
                            <input type="text" name="quantidade" class="form-control" value="<?php echo $quantidade; ?>">
                            <span class="help-block"><?php echo $quantidade_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($valorparcial_err)) ? 'has-error' : ''; ?>">
                            <label>Valor parcial</label>
                            <textarea name="valorparcial" class="form-control"><?php echo $valorparcial; ?></textarea>
                            <span class="help-block"><?php echo $valorparcial_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($fk_codpedido_err)) ? 'has-error' : ''; ?>">
                            <label>Pedido</label>
                            <select name="fk_codpedido" class="form-control">
                                <option>Selecione</option>
                                <?php
                                    $result_fk_codpedido = "SELECT * FROM pedidos";
                                    $resultado_fk_codpedido = mysqli_query($link, $result_fk_codpedido);
                                    while($row = mysqli_fetch_assoc($resultado_fk_codpedido)){ ?>
                                        <option value="<?php echo $row['codpedido']; ?>">
                                            <?php echo $row['codpedido']; ?>
                                        </option> <?php
                                    }
                                 ?>
                                </select>
                            </div><p></p>
                            <div class="form-group <?php echo (!empty($fk_codproduto_err)) ? 'has-error' : ''; ?>">
                            <label>Produto</label>
                            <select name="fk_codproduto" class="form-control">
                                <option>Selecione</option>
                                <?php
                                    $result_fk_codproduto = "SELECT * FROM produtos";
                                    $resultado_fk_codproduto = mysqli_query($link, $result_fk_codproduto);
                                    while($row = mysqli_fetch_assoc($resultado_fk_codproduto)){ ?>
                                        <option value="<?php echo $row['codproduto']; ?>">
                                            <?php echo $row['nome']; ?>
                                        </option> <?php
                                    }
                                 ?>
                                </select>
                            </div><p></p>
						
						
						
						
						
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="itensdepedidos.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>