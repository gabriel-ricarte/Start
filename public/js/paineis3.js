jQuery(function($) {
        var panelList = $('#draggablePanelList1');
        var val1 = document.getElementById('draggablePanelList1').getAttribute('data-value');
        panelList.sortable({
            connectWith: ".connectedSortable",
            update: function(event,ui) {
                          movido(ui.item[0].id,val1,0);
            }

        }).disableSelection();
        var panelList2 = $('#draggablePanelList2');
        var val2 = document.getElementById('draggablePanelList2').getAttribute('data-value');
        panelList2.sortable({
            connectWith: ".connectedSortable",
            update: function(event,ui) {
                          movido(ui.item[0].id,val2,3);
            }
        }).disableSelection();
        var panelList3 = $('#draggablePanelList3');
        var val3 = document.getElementById('draggablePanelList3').getAttribute('data-value');
        panelList3.sortable({
            connectWith: ".connectedSortable",
            update: function(event,ui) {
                       movido(ui.item[0].id,val3,2);

            }
        }).disableSelection();

        var lixeira = $('#roxolixo');
        //var val1 = document.getElementById('draggablePanelList1').getAttribute('data-value');
        lixeira.sortable({
            connectWith: ".connectedSortable",
            update: function() {
                $('.pan', lixeira).each(function(index, elem) {
                     var $listItem = $(elem),
                         newIndex = $listItem.index();
                          preparaExclusao(elem.id,lixeira);
                          //console.log(elem.id,val1)
                });

            }

        }).disableSelection();
        var revisao = $('#revisaTarefa');
        revisao.sortable({
            connectWith: ".connectedSortable",
            update: function() {
                $('.pan', revisao).each(function(index, elem) {
                     var $listItem = $(elem),
                         newIndex = $listItem.index();
                          preparaRevisao(elem.id,revisao);
                          //console.log(elem.id,val1)
                });

            }

        }).disableSelection();

        });






  function  foca(){
    //$('#tare').focus();
setTimeout(function() { $('#tare').focus(); },900);
    }
function preparaRevisao(task){
$('#articlee').css('cursor', 'wait');
$('#'+task).css('cursor', 'wait');
    document.getElementById('insertRevisao').innerHTML = "";
    document.getElementById('insertRevisao').innerHTML =
    `
    <input type="text" name="task"  class="form-control col-12" value="`+task+`" required="required">

    `
    ;
    enviaRevisao(task);
    setTimeout(function() {  },10);
  }
function preparaExclusao(task){

$('#articlee').css('cursor', 'wait');
$('#'+task).css('cursor', 'wait');
    document.getElementById('insertlixo').innerHTML = "";
    document.getElementById('insertlixo').innerHTML =
    `
    <input type="text" name="task"  class="form-control col-12" value="`+task+`" required="required">

    `
    ;
    excluiTask(task);
    setTimeout(function() { },100);
  }
  function excluiTask(des){
     $('#articlee').css('cursor', 'wait');
  var form = $('#lixo');
  var post_url = form.attr('action');
  var post_data = form.serialize();
  $.ajax({
    type: 'GET',
    url: post_url,
    data: post_data,
    success: function(msg) {
        $('#articlee').css('cursor', 'default');
        $('#'+des).css('cursor', 'move');
        $("#some").slideDown( "fast", function() {});
        $('#respp').attr('class','alert alert-'+msg[1]);
        document.getElementById('respp').innerHTML = msg[0];
        setTimeout(function() { $("#some").slideUp( "fast", function() {}); },3500);
      },
      error: function(msg){
        $('#articlee').css('cursor', 'default');
        document.getElementById('respp').innerHTML = msg;
      }
    });
 }
 function enviaRevisao(des){
  $('#articlee').css('cursor', 'wait');
  var form = $('#revisaForm');
  var post_url = form.attr('action');
  var post_data = form.serialize();
  $.ajax({
    type: 'GET',
    url: post_url,
    data: post_data,
    success: function(msg) {
        $('#articlee').css('cursor', 'default');
        $('#'+des).css('cursor', 'move');
        $("#some").slideDown( "fast", function() {});
        $('#respp').attr('class','alert alert-'+msg[1]);
        document.getElementById('respp').innerHTML = msg[0];
        setTimeout(function() { $("#some").slideUp( "fast", function() {}); },3500);
      },
      error: function(msg){
        $('#articlee').css('cursor', 'default');
        document.getElementById('respp').innerHTML = msg;
      }
    });
 }



function movido(e,t,n){$("#articlee").css("cursor","wait"),$("#"+e).css("cursor","wait"),document.getElementById("insert").innerHTML="",document.getElementById("insert").innerHTML='\n        <input type="text" name="quadro"  class="form-control col-12" value="'+t+'" required="required">\n        <input type="text" name="task"  class="form-control col-12" value="'+e+'" required="required">\n        <input type="text" name="estado"  class="form-control col-12" value="'+n+'" required="required">\n\n        ',salvaMove(e),setTimeout(function(){},1)}
function salvaMove(des){
  $('#articlee').css('cursor', 'wait');
  var form = $('#move');
  var post_url = form.attr('action');
  var post_data = form.serialize();
  $.ajax({
    type: 'GET',
    url: post_url,
    data: post_data,
    success: function(msg) {

        $('#articlee').css('cursor', 'default');
        $('#'+des).css('cursor', 'move');
        $("#some").slideDown( "fast", function() {});
        $('#respp').attr('class','alert alert-'+msg[1]);
        document.getElementById('respp').innerHTML = msg[0];
        setTimeout(function() { $("#some").slideUp( "fast", function() {}); },3500);
      },
      error: function(msg){
        $('#articlee').css('cursor', 'default');
        document.getElementById('respp').innerHTML = msg;
      }
    });
}






 function ale(){
  var form = $('#cinza');
  var post_url = form.attr('action');
  var post_data = form.serialize();
  $.ajax({
    type: 'GET',
    url: post_url,
    data: post_data,
    success: function(msg) {
        //alert('deu certo');
      },
      error: function(){
        //alert('Falha carregando os dados!');
      }
    });
  $("#draggablePanelList1").load(location.href+" #draggablePanelList1>*","");
  $("#abt").load(location.href+" #abt>*","");
 }

 function gringosTrash(){
   $("#gringosTrash").slideDown( "fast", function() {});
 }
 function revisaTarefa(){
   $("#revisa").slideDown( "fast", function() {});
 }function fechaRevisa(){
   $("#revisa").slideUp( "fast", function() {});
 }
 function fechaQuadro(){
   $("#finaliza").slideDown( "fast", function() {});
 }
 function fechaQuadroUp(){
   $("#finaliza").slideUp( "fast", function() {});
 }
  function jogaFora(){
   $("#gringosTrash").slideUp( "fast", function() {$("#recharP").slideDown( "fast", function() {});});
 }
