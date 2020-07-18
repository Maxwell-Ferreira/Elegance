	</div>

<footer class="font-small pt-4 py-4 mb-0" style="background-color: #000; min-width: 730px;">
  	<div style="text-align: center;">
    	<img src="<?= URL. 'assets/img/logo/logoteste.png' ?>" style="width: 350px" >
    </div>
  <div class=" text-center py-3 text-white">© 2019 Copyright: 
    <a href="<?=URL?>home/index" class="text-decoration-none text-white"> Elegance.com.br</a> 
  </div>

</footer>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="<?= URL; ?>assets/js/holder.min.js"></script>
<script src="<?= URL; ?>assets/js/script.js"></script>

<script type="text/javascript">
    function mostrarSenha(){
        if(document.getElementById("idSenha").type == "password"){
            document.getElementById("idSenha").type = "text";
            document.getElementById("idConfSenha").type = "text";
        }else{
            document.getElementById("idSenha").type = "password";
            document.getElementById("idConfSenha").type = "password";
        }
    } 
</script>
</body>
</html>
