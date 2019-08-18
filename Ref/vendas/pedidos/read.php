<?php
// Check existence of id parameter before processing further
if(isset($_GET["codpedido"]) && !empty(trim($_GET["codpedido"]))){
    // Include config file
    require_once 'config.php';
    
    // Prepare a select statement
    $sql = "SELECT * FROM pedidos WHERE codpedido = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_codpedido);
        
        // Set parameters
        $param_codpedido = trim($_GET["codpedido"]);
        
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
                $datapagamento= $row["datapagamento"];
                $valortotal = $row["valortotal"];
                $fk_codcliente = $row["fk_codcliente"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
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
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Registros</title>
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
                        <h1>Visualizar Registro</h1>
                    </div>
                    <div class="form-group">
                        <label>Data de pedido</label>
                        <p class="form-control-static"><?php echo $row["datapedido"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>dataentrega</label>
                        <p class="f"datapagamentool-static"><?php echo $row["dataentrega"]; ?></p>
                        <div class="form-group">
                        <label>Data de pagamento</label>
                        <p class="form-control-static"><?php echo $row["datapagamento"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Valor total</label>
                        <p class="form-control-static"><?php echo $row["valortotal"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Codigo do cliente</label>
                        <p class="form-control-static"><?php echo $row["fk_codcliente"]; ?></p>
                    </div>
                    <p><a href="pedidos.php" class="btn btn-primary">Voltar</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>