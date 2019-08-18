<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$quantidade = $valorparcial = "";
$quantidade_err = $valorparcial_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["coditensdepedidos"]) && !empty($_POST["coditensdepedidos"])){
    // Get hidden input value
    $coditensdepedidos = $_POST["coditensdepedidos"];
    
    //Validação
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
    
    // Check input errors before inserting in database
    if(empty($quantidade_err) && empty($valorparcial_err)){
        // Prepare an insert statement
        $sql = "UPDATE itensdepedidos SET quantidade=?, valorparcial=? WHERE coditensdepedidos=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssi", $param_quantidade, $param_valorparcial, $param_coditensdepedidos);
            
            // Set parameters
            $param_quantidade = $quantidade;
            $param_valorparcial = $valorparcial;
            $param_coditensdepedidos = $coditensdepedidos;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["coditensdepedidos"]) && !empty(trim($_GET["coditensdepedidos"]))){
        // Get URL parameter
        $coditensdepedidos =  trim($_GET["coditensdepedidos"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM itensdepedidos WHERE coditensdepedidos = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_coditensdepedidos);
            
            // Set parameters
            $param_coditensdepedidos = $coditensdepedidos;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $quantidade = $row["quantidade"];
                    $valorparcial = $row["valorparcial"];
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
                        <div class="form-group <?php echo (!empty($quantidade_err)) ? 'has-error' : ''; ?>">
                            <label>Quantidade</label>
                            <input type="text" name="quantidade" class="form-control" value="<?php echo $quantidade; ?>">
                            <span class="help-block"><?php echo $quantidade_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($valorparcial_err)) ? 'has-error' : ''; ?>">
                            <label>Valor parcial</label>
                            <input type="text" name="valorparcial" class="form-control" value="<?php echo $valorparcial; ?>">
                            <span class="help-block"><?php echo $valorparcial_err;?></span>
                        </div>
                        
                        <input type="hidden" name="coditensdepedidos" value="<?php echo $coditensdepedidos; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="itensdepedidos.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>