function desce(id){
     $("#sobe").slideUp( "fast", function() {$("#desce"+id).slideDown( "fast", function() {});});
     $("#projs").slideUp( "fast", function() {$("#equips").slideDown( "fast", function() {});});
     $("#and").slideUp( "fast", function() {$("#quad").slideDown( "fast", function() {});$("#btnV").slideDown( "fast", function() {});});
     $("#btnV").attr('onclick','sobe('+id+')');
  }
  function sobe(id){
     $("#desce"+id).slideUp( "fast", function() {$("#sobe").slideDown( "fast", function() {});});
     $("#quad").slideUp( "fast", function() {$("#and").slideDown( "fast", function() {});$("#btnV").slideUp( "fast", function() {});});
     $("#equips").slideUp( "fast", function() {$("#projs").slideDown( "fast", function() {});});
  }
  function del(id){
    document.getElementById('tecnome').innerHTML="";
    document.getElementById('tecnome').innerHTML=$('#nome'+id).val();
    
     $('#exc').attr('onclick','deleta('+id+')');
  }
  function update(id){
    document.getElementById('tecnomeU').innerHTML="";
    document.getElementById('tecnomeU').innerHTML=$('#nome'+id).val();
    document.getElementById('permissaoa').innerHTML="";
    document.getElementById('permissaoa').innerHTML=$('#permi'+id).val()
     $('#alter').attr('onclick','permishon('+id+')');
  }



  
  function permishon(id){
    document.getElementById('insertUp').innerHTML = "";
    document.getElementById('insertUp').innerHTML = 
    `
    <input type="text" name="tecnico_id"  class="form-control col-12" value="`+$('#tec'+id).val()+`" required="required">
    <input type="text" name="equipe_id"  class="form-control col-12" value="`+$('#equipe'+id).val()+`" required="required">
    <input type="text" name="permissao"  class="form-control col-12" value="`+$('#permisshion').val()+`" required="required">
    `
    ;
    
    setTimeout(function() { executaUpdate(); },20);
  }
  function deleta(id){
    document.getElementById('insertDel').innerHTML = "";
    document.getElementById('insertDel').innerHTML = 
    `
    <input type="text" name="tecnico_id"  class="form-control col-12" value="`+$('#tec'+id).val()+`" required="required">
    <input type="text" name="equipe_id"  class="form-control col-12" value="`+$('#equipe'+id).val()+`" required="required">
    `
    ;
    
    setTimeout(function() { executaDelete(); },20);
  }

  function executaUpdate(){
  var form = $('#upup');
  var post_url = form.attr('action');
  var post_data = form.serialize();
  $.ajax({
    type: 'GET',
    url: post_url, 
    data: post_data,
    success: function(msg) {
        //aqui se for um sucesso
        $("#content").load(location.href+" #content>*","");
      },
      error: function(msg){
        
        alert('Falha na operação !'+msg);
      }
    });

  $("#content").load(location.href+" #content>*","");
  //$("#abt").load(location.href+" #abt>*","");
 }
   function executaDelete(){
  var form = $('#deldel');
  var post_url = form.attr('action');
  var post_data = form.serialize();
  $.ajax({
    type: 'GET',
    url: post_url, 
    data: post_data,
    success: function(msg) {
        //aqui se for um sucesso
        $("#content").load(location.href+" #content>*","");
      },
      error: function(msg){
        
        alert('Falha na operação !'+msg);
      }
    });

  $("#content").load(location.href+" #content>*","");
  //$("#abt").load(location.href+" #abt>*","");
 }