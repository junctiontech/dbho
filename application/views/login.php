<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?=base_url();?>images/favicon.ico">
    <title>Homeonline</title>

    <!-- Bootstrap core CSS -->

    <link href="<?=base_url();?>css/bootstrap.min.css" rel="stylesheet">

    <link href="<?=base_url();?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=base_url();?>css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?=base_url();?>css/custom.css" rel="stylesheet">
    <link href="<?=base_url();?>css/icheck/flat/green.css" rel="stylesheet">


    <script src="<?=base_url();?>js/jquery.min.js"></script>

</head>

<body style="background:#F7F7F7;">
   
    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>
 
        <div id="wrapper">
		<?php  if($this->session->flashdata('category_error_login')) { ?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button>
                <strong><?=$this->session->flashdata('category_error_login')?></strong>  </div>
		<?php }?>
		<?php  if($this->session->flashdata('category_success_login')) { ?>
				<div class="row" >
				<div class="alert alert-success" >
				<strong><?=$this->session->flashdata('category_success_login')?></strong> <?php echo"<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";?>
				</div>
				</div>
		<?php }?>
            <div id="login" class="animate form">
                <section class="login_content">
                    <form method="post" action="<?=base_url();?>Login/login_user">
                        <h1>Login</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required="" name="username"/>
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="" name="password"/>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default submit" >Log in</button>
                            <a class="reset_pass" href="javascript:;">Lost your password?</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">New to site?
                                <a href="#toregister" class="to_register"> Create Account </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i><img src="<?=base_url();?>images/logo-f.png"/></i> Homeonline</span></h1>
                                <p>©2015 All Rights Reserved. Homeonline | Privacy and Terms</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            <div id="register" class="animate form">
                <section class="login_content">
                    <form>
                        <h1>Create Account</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required="" />
                        </div>
                        <div>
                            <input type="email" class="form-control" placeholder="Email" required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <a class="btn btn-default submit" href="javascript:;">Submit</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">Already a member ?
                                <a href="#tologin" class="to_register"> Log in </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i><img src="<?=base_url();?>images/logo-f.png"/></i> Homeonline</span></h1>
                                <p>©2015 All Rights Reserved. Homeonline | Privacy and Terms</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
        </div>
    </div>

</body>

</html>