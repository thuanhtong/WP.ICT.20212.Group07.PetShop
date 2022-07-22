<style>
    #uni_modal .modal-content>.modal-footer,#uni_modal .modal-content>.modal-header{
        display:none;
    }
    .required:after {
        content:" *";
        color: red;
    }
</style>
<div class="container-fluid">
    <form action="" id="registration">
        <div class="row">
        
        <h3 class="text-center">Create New Account
            <span class="float-right">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </span>
        </h3>
            <hr>
        </div>
        <div class="row  align-items-center h-100">           
            <div class="col-lg-6 border-right">
                <div class="form-group">
                    <label for="" class="control-label required">Firstname</label>
                    <input type="text" class="form-control form-control-sm form" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="" class="control-label required">Lastname</label>
                    <input type="text" class="form-control form-control-sm form" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="" class="control-label required">Phone Number</label>
                    <input type="text" class="form-control form-control-sm form" name="contact" required>
                </div>
                <div class="form-group">
                    <label for="" class="control-label required">Gender</label>
                    <select name="gender" id="" class="custom-select select" required>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="" class="control-label required">Default Delivery Address</label>
                    <textarea class="form-control form" rows='4' name="default_delivery_address"></textarea>
                </div>
                <div class="form-group">
                    <label for="" class="control-label required">Email </label>
                    <input type="text" class="form-control form-control-sm form" name="email" required>
                </div>
                <div class="form-group">
                    <label for="" class="control-label required">Password</label>
                    <input type="password" class="form-control form-control-sm form" name="password" required>
                </div>
            </div>
            <div class="form-group d-flex justify-content-between">
                <a href="javascript:void()" id="login-show">Already have an Account</a>
                <button class="btn btn-primary btn-flat">Register</button>
            </div>
        </div>
    </form>

</div>
<script>
    $(function(){
        $('#login-show').click(function(){
            uni_modal("","login.php")
        })       
    })
</script>