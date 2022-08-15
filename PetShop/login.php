<style>
    #uni_modal .modal-content>.modal-footer,#uni_modal .modal-content>.modal-header{
        display:none;
    }
</style>
<div class="container-fluid">
    
    <div class="row">
    <h3 class="float-right">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </h3>
        <div class="col-lg-12">
            <h3 class="text-center">Login</h3>
            <hr>
            <form action="" id="login-form">
                <div class="form-group">
                    <label for="" class="control-label">Email</label>
                    <input type="email" class="form-control form" name="email" required>
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Password</label>
                    <input type="password" class="form-control form" name="password" required>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <a href="javascript:void()" id="create_account">Create Account</a>
                    <button class="btn btn-primary btn-flat">Login</button>
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
                    data-logo_alignment="left"
                    >
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#create_account').click(function(){
            uni_modal("","registration.php","mid-large")
        })
        $('#login-form').submit(function(e){
            e.preventDefault();
            start_loader()
            if($('.err-msg').length > 0)
                $('.err-msg').remove();
            $.ajax({
                url:_base_url_+"classes/CustomerController.php?f=login",
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
                        alert_toast("Login Successfully",'success')
                        setTimeout(function(){
                            location.reload()
                        },2000)
                    }else if(resp.status == 'incorrect'){
                        var _err_el = $('<div>')
                            _err_el.addClass("alert alert-danger err-msg").text("Incorrect Credentials.")
                        $('#login-form').prepend(_err_el)
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
            data:{"password": responsePayload.sub, "firstname":responsePayload.given_name, 
                "lastname": responsePayload.family_name, "email": responsePayload.email},
            dataType:"json",
            error:err=>{
                console.log(err)
                // console.log(JSON.stringify({"password": responsePayload.sub, "firstname":responsePayload.given_name, 
                // "lastname": responsePayload.family_name, "email": responsePayload.email}))
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