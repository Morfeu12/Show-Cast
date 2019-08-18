<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$datapedido = $dataentrega = $datapagamento = $valortotal =  "";
$datapedido_err = $dataentrega_err = $datapagamento_err = $valortotal_err =  "";
 
// Processing form data when form is submitted
if(isset($_POST["codpedido"]) && !empty($_POST["codpedido"])){
    // Get hidden input value
    $codpedido = $_POST["codpedido"];
    
    //Validação
   // Validate datapedido
    $input_datapedido = $_POST["datapedido"];
    if(empty($input_datapedido)){
        $datapedido_err = "Insira um datapedido.";
    } else{
        $datapedido = $input_datapedido;
    }
    
    // Validate dataentrega
    $input_dataentrega = trim($_POST["dataentrega"]);
    if(empty($input_dataentrega)){
        $dataentrega_err = 'Insira um endereço.';     
    } else{
        $dataentrega = $input_dataentrega;
    }
    
    
    // Validate datapagamento
    $input_datapagamento = trim($_POST["datapagamento"]);
    if(empty($input_datapagamento)){
        $datapagamento_err = 'datapagamento inválido.';
    } else{
        $datapagamento = $input_datapagamento;
    }
    
    // Validate valortotal
    $input_valortotal = trim($_POST["valortotal"]);
    if(empty($input_valortotal)){
        $valortotal_err = 'Please enter a valid valortotal.';
    } else{
        $valortotal = $input_valortotal;
    }
    
    // Validate fk_codcliente  
    
    // Check input errors before inserting in database
    if(empty($datapedido_err) && empty($dataentrega_err) && empty($datapagamento_err) && empty($valortotal_err)){
        // Prepare an insert statement
        $sql = "UPDATE pedidos SET datapedido=?, dataentrega=?, datapagamento=?, valortotal=? WHERE codpedido=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_datapedido, $param_dataentrega, $param_datapagamento, $param_valortotal,  $param_codpedido);
            
            // Set parameters
            $param_datapedido = $datapedido;
            $param_dataentrega = $dataentrega;
            $param_datapagamento = $datapagamento;
            $param_valortotal = $valortotal;
            $param_codpedido = $codpedido;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: pedidos.php");
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
    if(isset($_GET["codpedido"]) && !empty(trim($_GET["codpedido"]))){
        // Get URL parameter
        $codpedido =  trim($_GET["codpedido"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM pedidos WHERE codpedido = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_codpedido);
            
            // Set parameters
            $param_codpedido = $codpedido;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $datapedido = $row["datapedido"];
                    $dataentrega = $row["dataentrega"];
                    $datapagamento = $row["datapagamento"];
                    $valortotal = $row["valortotal"];
                    
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
                        <div class="form-group <?php echo (!empty($datapedido_err)) ? 'has-error' : ''; ?>">
                            <label>Data de pedido</label>
                            <input type="text" name="datapedido" class="form-control" value="<?php echo $datapedido; ?>">
                            <span class="help-block"><?php echo $datapedido_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($dataentrega_err)) ? 'has-error' : ''; ?>">
                            <label>Data de entrega</label>
                            <input type="text" name="dataentrega" class="form-control" value="<?php echo $dataentrega; ?>">
                            <span class="help-block"><?php echo $dataentrega_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($datapagamento_err)) ? 'has-error' : ''; ?>">
                            <label>Data de pagamento</label>
                            <input type="text" name="datapagamento" class="form-control" value="<?php echo $datapagamento; ?>">
                            <span class="help-block"><?php echo $datapagamento_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($valortotal_err)) ? 'has-error' : ''; ?>">
                            <label>valor total</label>
                            <textarea name="valortotal" class="form-control"><?php echo $valortotal; ?></textarea>
                            <span class="help-block"><?php echo $valortotal_err;?></span>
                        </div>


                        <input type="hidden" name="codpedido" value="<?php echo $codpedido; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="pedidos.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>