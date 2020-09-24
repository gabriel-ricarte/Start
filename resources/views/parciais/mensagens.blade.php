<?php if(session()->has('per')){
        echo '<div style="text-align: center" class="alert alert-warning" id="fecha">';
        echo '<button type="button" class="close" data-dismiss="alert">×</button>';
        echo session()->get('per');
        echo '</div>';
    }?>
    <?php if(session()->has('msg')){
        echo '<div style="text-align: center" class="alert alert-success" id="fecha">';
        echo '<button type="button" class="close" data-dismiss="alert">×</button>';
        echo session()->get('msg');
        echo '</div>';
    }?>
    @if(count($errors)>0)
<div class="alert alert-danger" id="fecha">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<script type="text/javascript">
   if($("#fecha").length){
   setInterval(function () {
   document.getElementById('fecha').innerHTML = "";
   $('#fecha').removeAttr('class');
}, 3000); }
</script>
