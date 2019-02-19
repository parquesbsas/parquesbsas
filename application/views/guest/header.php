
   <script type="text/javascript">
if(window.screen.availWidth == 1280)window.parent.document.body.style.zoom="120%"
if(window.screen.availWidth == 1152)window.parent.document.body.style.zoom="108%"
if(window.screen.availWidth == 1024)window.parent.document.body.style.zoom="96%"
if(window.screen.availWidth == 800)window.parent.document.body.style.zoom="75%";
if(window.screen.availWidth == 640)window.parent.document.body.style.zoom="60%"
</script>
 <div class="cover">
      <div class="cover-image" style="background-image : url('<?=base_url('public/img').'/'.$img?>')"></div>

      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
              <?php if($this->session->userdata('login')){

               //  var_dump($this->session->userdata); ?>
            <h1>Parques Bs As</h1>
            <br>
            <br>
           <?php }else{?>

 <h1>Parques Bs As</h1>
            <br>
            <br>
 <a class="btn btn-lg btn-primary" href="<?=base_url()?>registro">Registrarse</a>


            <?}?>
          </div>
        </div>
      </div>
    </div>


