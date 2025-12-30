<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WIMS::Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"/>
<style type="text/css">

    body {
        background: linear-gradient(90deg, #000000, #4f8f38);
        padding: 20px;
        color: #fff;
        font-family: "Poppins", sans-serif;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .box {
        width: 100%;
        border: 1px solid #e0e0e0;
        background: #fff;
        text-align: left;
        position: relative;
        border-radius: 10px;
        padding: 15px 20px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .box:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }
    .form-container {
        max-width: 400px;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.95);
        border: none;
        border-radius: 12px;
        padding: 35px 25px;
        color: #000;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease-in-out;
        animation: fadeIn 0.6s ease-in-out;
    }

    .form-container:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25);
    }
    .logo-container {
        width: 80px;
        margin: 0 auto 15px;
        text-align: center;
    }

    .logo-container img {
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(109, 182, 81, 0.4);
        transition: transform 0.3s ease;
    }

    .logo-container img:hover {
        transform: scale(1.05);
    }

    label {
        margin-top: 10px;
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 10px 12px;
        background: #f9f9f9;
        transition: all 0.3s;
        font-size: 14px;
    }

    .form-control:focus {
        background: #fff;
        border-color: #6DB651;
        box-shadow: 0 0 6px rgba(109, 182, 81, 0.5);
        outline: none;
    }

    .btn-success {
        background:#6DB651;
        border: none;
        border-radius: 30px;
        color: #fff;
        font-weight: 600;
        padding: 10px 20px;
        font-size: 16px;
        width: 100%;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 15px rgba(109, 182, 81, 0.3);
    }

    .btn-success:hover {
        transform: scale(1.03);
        box-shadow: 0 6px 20px rgba(109, 182, 81, 0.5);
        background: black;
    }

    .form-check {
        display: block;
        width: 100%;
    }

    .form-check-label {
        width: 100%;
    }

    .price {
        position: absolute;
        right: 10px;
        bottom: 27%;
    }

    .price .real {
        color: #e63946;
        text-decoration: line-through;
        margin-right: 5px;
    }

    .price .offered {
        color: #1E5631;
        font-weight: bold;
    }

    .lgChoice {
        border: 1px solid #ccc;
        margin-bottom: 12px;
        margin-top: 12px;
        background: #fff;
        color: #000 !important;
        border-radius: 8px;
        transition: 0.3s;
        padding: 8px;
    }

    .lgChoice:hover {
        border-color: #6DB651;
        box-shadow: 0 0 8px rgba(109, 182, 81, 0.3);
    }

    .text-danger {
        color: #e63946 !important;
        font-weight: 500;
        transition: 0.3s;
    }

    .text-danger:hover {
        text-decoration: underline;
        color: #1E5631 !important;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 480px) {
        .form-container {
            padding: 25px 15px;
        }

        .btn-success {
            font-size: 15px;
        }
    }
</style>

</head>
<body>
     
    <div class="container mt-5">
        <div style="width:400px; margin:0 auto;">
            <?php if(session()->has('logoutStatus')):?>

                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Logged Out!
                </div>

            <?php endif?>

        
            <?= display_session_msg()?>
        </div>
        <div class="form-container">
            <div class="logo-container">
                <img src="<?= base_url('public/assets/img/temp_logo.jpg')?>">
            </div>
            <h4 class="text-center mb-3">Login</h4>
        <?php echo form_open('account/verify-login', 'autocomplete="off"')?>
            
         
             <div class="row">
                <div class="col">
                    <label>Email Id / Mobile</label>
                    <input type="text" class="form-control" placeholder="User Id" name="user_id" value="<?= old('user_id')?>">
                    <div class="validation-error"><?= display_form_error(validation_errors(), 'user_id')?></div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="user_password">
                    <div class="validation-error"><?= display_form_error(validation_errors(), 'user_password')?></div>
                </div>
              </div>
         
         
        
        <div class="text-center mt-2">
            <button class="btn btn-success p-2">Login Now</button>
            <div class="mt-4"> <a class="text-danger" href="#">Forget Password...?</a></div>
        </div>
        <?php echo  form_close();?>
        </div>
    </div>
</body>
</html>
