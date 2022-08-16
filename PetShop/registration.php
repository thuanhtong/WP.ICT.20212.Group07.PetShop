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
                    <label for="" class="control-label">Default Delivery Address</label>
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
                <button class="btn btn-primary btn-flat">Register </button>
            </div>

            <script src="https://accounts.google.com/gsi/client" async defer></script>
            <div id="g_id_onload"
                data-client_id="1037365626905-ejomrv26a2flju8opdfu4jd0lo60cm8v.apps.googleusercontent.com"
                data-callback="handleCredentialResponse"
                data-auto_prompt="false">
            </div>
            <div class="g_id_signin form-group"
                data-type="standard"
                data-theme="filled_blue"
                data-size="large"
                data-theme="outline"
                data-text="continue_with"
                data-shape="rectangular"
                data-logo_alignment="left">
            </div>
        </div>
    </form>

</div>
<script>
    $(function(){
        $('#login-show').click(function(){
            uni_modal("","login.php")
        })
        $('#registration').submit(function(e){
            e.preventDefault();
            start_loader()
            if($('.err-msg').length > 0)
                $('.err-msg').remove();
            $.ajax({
                url:_base_url_+"classes/CustomerController.php?f=register",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                error:err=>{
                    console.log(err)
                    alert_toast("an error occured",'error')
                    end_loader()
                },
                success:function(resp){
                    if(typeof resp == 'object' && resp.status == 'success'){
                        alert_toast("Account succesfully registered",'success')
                        setTimeout(function(){
                            location.reload()
                        },2000)
                    }else if(resp.status == 'failed' && !!resp.msg){
                        var _err_el = $('<div>')
                            _err_el.addClass("alert alert-danger err-msg").text(resp.msg)
                        $('[name="password"]').after(_err_el)
                        end_loader()
                        
                    }else{
                        console.log(resp)
                        alert_toast("an error occured",'error')
                        end_loader()
                    }
                }
            })
        })
    })
</script>


<script>
    function parseJwt (token) {     
        var base64Url = token.split('.')[1];     
        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');     
        var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {         
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);     
        }).join(''));      
        return JSON.parse(jsonPayload)
    } 

    function handleCredentialResponse(response) {
        const responsePayload = parseJwt(response.credential);

        $.ajax({
            url:_base_url_+"classes/CustomerController.php?f=gglogin",
            method:"POST",
            data:{"firstname":responsePayload.given_name, 
                "lastname": responsePayload.family_name, "email": responsePayload.email},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("an error occured",'error')
                end_loader()
            },
            success:function(resp){
                if(typeof resp == 'object' && resp.status == 'success'){
                    alert_toast("Google Login Successfully",'success')
                    setTimeout(function(){
                        location.reload()
                    },2000)
                }
                else {
                    console.log(resp)
                    alert_toast("An error occured",'error')
                    end_loader()
                }
            }
        })
    }
</script>