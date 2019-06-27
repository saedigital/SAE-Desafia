<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title;?></li>
        </ol>
    </nav>
</div>
<div class="offset-2 col-8">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center"><?php echo $title;?></h3>
        </div>
        <form id="signupForm" method="post" action="" novalidate="novalidate">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-4 control-label col-form-label text-right" for="firstname">First name</label>
                    <div class="col-5">
                        <input type="text" class="form-control" id="firstname" name="firstname"
                               placeholder="First name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 control-label col-form-label text-right" for="lastname">Last name</label>
                    <div class="col-5">
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 control-label col-form-label text-right" for="username">Username</label>
                    <div class="col-5">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 control-label col-form-label text-right" for="email">Email</label>
                    <div class="col-5">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 control-label col-form-label text-right" for="password">Password</label>
                    <div class="col-5">
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Password">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 control-label col-form-label text-right" for="confirm_password">Confirm
                        password</label>
                    <div class="col-5">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                               placeholder="Confirm password">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-5 offset-4">
                        <div class="checkbox text-right">
                            <label>
                                <input type="checkbox" id="agree" name="agree" value="agree">Please agree to our policy
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="form-group row">
                    <div class="col-9 col-offset-4">
                        <button type="submit" class="btn btn-primary pull-right" value="Sign up">
                            <i class="fa fa-sign-in"></i>
                            Sign up
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>