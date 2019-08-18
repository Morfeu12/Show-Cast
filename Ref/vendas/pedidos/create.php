<?php
// Include config file
require_once 'config.php';
header( 'content-type: text/html; charset=utf-8' );
 
// Define variables and initialize with empty values
$datapedido = $dataentrega = $datapagamento = $valortotal = $fk_codcliente = "";
$datapedido_err =  $dataentrega_err = $datapagamento_err = $valortotal_err = $fk_codcliente_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
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
    $fk_codcliente = $_POST["fk_codcliente"];  
    

    // Check input errors before inserting in database
    if (empty($codcliente_err) && empty($datapedido_err) && empty($dataentrega_err) && empty($datapagamento_err) && empty($valortotal_err) && empty($fk_codcliente_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO pedidos (datapedido, dataentrega, datapagamento, valortotal, fk_codcliente) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_datapedido, $param_dataentrega, $param_datapagamento, $param_valortotal, $param_fk_codcliente );
            
            // Set parameters
            $param_datapedido = $datapedido;
            $param_dataentrega = $dataentrega;
            $param_datapagamento = $datapagamento;
            $param_valortotal = $valortotal;
            $param_fk_codcliente = $fk_codcliente;
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de pedidos</title>
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
                        <div class="form-group <?php echo (!empty($datapedido_err)) ? 'has-error' : ''; ?>">
                            <label>Data do pedido</label>
                            <input type="text" name="datapedido" class="form-control" value="<?php echo $datapedido; ?>">
                            <span class="help-block"><?php echo $datapedido_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($dataentrega_err)) ? 'has-error' : ''; ?>">
                            <label>Data de entrega</label>
                            <input tipe="text" name="dataentrega" class="form-control" value="<?php echo $dataentrega; ?>">
                            <span class="help-block"><?php echo $dataentrega_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($datapagamento_err)) ? 'has-error' : ''; ?>">
                            <label>Data de pagamento</label>
                            <input type="text" name="datapagamento" class="form-control" value="<?php echo $datapagamento; ?>">
                            <span class="help-block"><?php echo $datapagamento_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($valortotal_err)) ? 'has-error' : ''; ?>">
                            <label>Valor total</label>
                            <input type="text" name="valortotal" class="form-control" value="<?php echo $valortotal; ?>">
                            <span class="help-block"><?php echo $valortotal_err;?></span>
                        </div>
                        <!--  A bagunça começa aqui -->
                        <div class="form-group <?php echo (!empty($fk_codcliente_err)) ? 'has-error' : ''; ?>">
                            <label>Cliente</label>
                            <select name="fk_codcliente" class="form-control">
                                <option>Selecione</option>
                                <?php
                                    $result_fk_codcliente = "SELECT * FROM clientes";
                                    $resultado_fk_codcliente = mysqli_query($link, $result_fk_codcliente);
                                    while($row = mysqli_fetch_assoc($resultado_fk_codcliente)){ ?>
                                        <option value="<?php echo $row['codcliente']; ?>">
                                            <?php echo $row['nome']; ?>
                                        </option> <?php
                                    }
                                 ?>
                            </select></div><p></p>

                        <!--  A bagunça termina aqui aqui -->
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="pedidos.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>