<script>
    $(document).ready(function(){
        window.viewer_modal = function($src = ''){
            start_loader()
            var t = $src.split('.')
            t = t[1]
            if(t =='mp4'){
                var view = $("<video src='"+$src+"' controls autoplay></video>")
            } else {
                var view = $("<img src='"+$src+"' />")
            }
            $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
            $('#viewer_modal .modal-content').append(view)
            $('#viewer_modal').modal({
                show:true,
                backdrop:'static',
                keyboard:false,
                focus:true
            })
            end_loader()  
        }

        window.uni_modal = function($title = '' , $url='',$size=""){
            start_loader()
            $.ajax({
                url:$url,
                error:err=>{
                    console.log()
                    alert("An error occured")
                },
                success:function(resp){
                    if(resp){
                        $('#uni_modal .modal-title').html($title)
                        $('#uni_modal .modal-body').html(resp)
                        if($size != ''){
                            $('#uni_modal .modal-dialog').addClass($size+'  modal-dialog-centered')
                        } else {
                            $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md modal-dialog-centered")
                        }
                        $('#uni_modal').modal({
                        show:true,
                        backdrop:'static',
                        keyboard:false,
                        focus:true
                        })
                        end_loader()
                    }
                }
            })
        }
        window._conf = function($msg='',$func='',$params = []){
            $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
            $('#confirm_modal .modal-body').html($msg)
            $('#confirm_modal').modal('show')
        }
    })
</script>



<footer class="main-footer text-sm">
    <strong>Copyright © <?php echo date('Y') ?>. </strong> All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b><?php echo $_settings->info('short_name') ?> (by: <a href="mailto:giang.ntt194750@sis.hust.edu.vn,anh.ttt194728@sis.hust.edu.vn">MurphyTeam</a> )</b> v1.0
    </div>
</footer>


    <script src="<?php echo base_url ?>utils/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url ?>utils/plugins/chart.js/Chart.min.js"></script>
    <script src="<?php echo base_url ?>utils/plugins/sparklines/sparkline.js"></script>
    <script src="<?php echo base_url ?>utils/plugins/select2/js/select2.full.min.js"></script>
    <script src="<?php echo base_url ?>utils/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?php echo base_url ?>utils/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <script src="<?php echo base_url ?>utils/plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="<?php echo base_url ?>utils/plugins/moment/moment.min.js"></script>
    <script src="<?php echo base_url ?>utils/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url ?>utils/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="<?php echo base_url ?>utils/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="<?php echo base_url ?>utils/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url ?>utils/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url ?>utils/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url ?>utils/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo base_url ?>utils/dist/js/adminlte.js"></script>