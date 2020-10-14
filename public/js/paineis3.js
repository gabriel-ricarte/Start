jQuery(function($) {
  //listeners de movimento de tarefas no kanban
        var panelList = $('#draggablePanelList1');
        var val1 = document.getElementById('draggablePanelList1').getAttribute('data-value');
        panelList.sortable({
            connectWith: ".connectedSortable",
            update: function(event,ui) {
                          //console.log(ui.item[0]);
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
 //fim dos listeners
 //listener da lixeira para exclusão de tarefas
        var lixeira = $('#excluiTarefaQuadro');
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
  //fim da lixeira
  //inicio do listener de rvisão de tarefas       
        var revisao = $('#revisaTarefaQuadro');
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
  //fim
    //inicio do listener de pausa de tarefas       
        var pausa = $('#pausaTarefaQuadro');
        pausa.sortable({
            connectWith: ".connectedSortable",
            update: function() {
                $('.pan', pausa).each(function(index, elem) {
                     var $listItem = $(elem),
                         newIndex = $listItem.index();
                          preparaPausa(elem.id,pausa);
                          //console.log(elem.id,val1)
                });

            }

        }).disableSelection();
  //fim

        });
//fim dos listeners dos quadros

function  foca(){
setTimeout(function() { $('#tare').focus(); },100);
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
    setTimeout(function() {excluiTask(task);},10);
  }
function excluiTask(des){
  $('#articlee').css('cursor', 'wait');
  var form = $('#lixoForm');
  var post_url = form.attr('action');
  var post_data = form.serialize();
  $.ajax({
    type: 'GET',
    url: post_url,
    data: post_data,
    success: function(msg) {
        $('#articlee').css('cursor', 'default');
        $('#'+des).css('cursor', 'move');
        $("#responseDiv").slideDown( "fast", function() {});
        $('#responseHere').attr('class','alert alert-'+msg[1]);
        document.getElementById('responseHere').innerHTML = msg[0];
        setTimeout(function() { $("#responseDiv").slideUp( "fast", function() {}); },3500);
      },
      error: function(msg){
        $('#articlee').css('cursor', 'default');
        document.getElementById('responseHere').innerHTML = msg;
      }
    });
 }
function preparaRevisao(task){
$('#articlee').css('cursor', 'wait');
$('#'+task).css('cursor', 'wait');
    document.getElementById('insertRevisao').innerHTML = "";
    document.getElementById('insertRevisao').innerHTML =
    `
    <input type="text" name="task"  class="form-control col-12" value="`+task+`" required="required">

    `;
  setTimeout(function() {enviaRevisao(task);  },10);
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
        $("#responseDiv").slideDown( "fast", function() {});
        $('#responseHere').attr('class','alert alert-'+msg[1]);
        document.getElementById('responseHere').innerHTML = msg[0];

        fecha('revisaTarefaDiv');
        $("#revisaTarefaDivForm").slideDown( "fast", function() {});
        document.getElementById('insertTaskId').innerHTML = '<input type="hidden" name="task_id" id="revisa_id" value="'+des+'">';
        setTimeout(function() { $("#responseDiv").slideUp( "fast", function() {}); },3500);
      },
      error: function(msg){
        $('#articlee').css('cursor', 'default');
        document.getElementById('responseHere').innerHTML = msg;
      }
    });

 }
 function preparaPausa(task){
$('#articlee').css('cursor', 'wait');
$('#'+task).css('cursor', 'wait');
    document.getElementById('insertPausa').innerHTML = "";
    document.getElementById('insertPausa').innerHTML =
    `
    <input type="text" name="task"  class="form-control col-12" value="`+task+`" required="required">

    `;
  setTimeout(function() {enviaPausa(task);  },10);
}

 function enviaPausa(des){
  $('#articlee').css('cursor', 'wait');
  var form = $('#pausaForm');
  var post_url = form.attr('action');
  var post_data = form.serialize();
  $.ajax({
    type: 'GET',
    url: post_url,
    data: post_data,
    success: function(msg) {
        $('#articlee').css('cursor', 'default');
        $('#'+des).css('cursor', 'move');
        $("#responseDiv").slideDown( "fast", function() {});
        $('#responseHere').attr('class','alert alert-'+msg[1]);

        // document.getElementById('responseHere').innerHTML = msg[0];
        // setTimeout(function() { $("#responseDiv").slideUp( "fast", function() {}); },3500);
        fecha('pausaTarefaDiv');
        $("#revisaTarefaDivFormp").slideDown( "fast", function() {});
        document.getElementById('insertTaskIdp').innerHTML = '<input type="hidden" name="task_id" id="revisa_id" value="'+des+'">';
        setTimeout(function() { $("#responseDiv").slideUp( "fast", function() {}); },3500);
      },
      error: function(msg){
        $('#articlee').css('cursor', 'default');
         document.getElementById('responseHere').innerHTML = msg.responseJSON.errors.tarefa[0];
      }
    });

 }



function movido(e,t,n){$("#articlee").css("cursor","wait"),$("#"+e).css("cursor","wait"),document.getElementById("insert").innerHTML="",document.getElementById("insert").innerHTML='\n        <input type="text" name="quadro"  class="form-control col-12" value="'+t+'" required="required">\n        <input type="text" name="task"  class="form-control col-12" value="'+e+'" required="required">\n        <input type="text" name="estado"  class="form-control col-12" value="'+n+'" required="required">\n\n        ',salvaMove(e),setTimeout(function(){},1)}
function salvaMove(des){
  $('#articlee').css('cursor', 'wait');
  var form = $('#moveForm');
  var post_url = form.attr('action');
  var post_data = form.serialize();
  var show = $.ajax({
    type: 'GET',
    url: post_url,
    data: post_data,
    success: function(msg) {

        $('#articlee').css('cursor', 'default');
        $('#'+des).css('cursor', 'move');
        $("#responseDiv").slideDown( "fast", function() {});
        $('#responseHere').attr('class','alert alert-'+msg[1]);
        document.getElementById('responseHere').innerHTML = msg[0];
        setTimeout(function() { $("#responseDiv").slideUp( "fast", function() {}); },3500);
      },
      error: function(msg){
        $('#articlee').css('cursor', 'default');
        document.getElementById('responseHere').innerHTML = msg.responseJSON.errors;
      }
    });
    show.done(function(dat){ 
      //console.log(dat[1]);
      if(dat[1] == 'revisa'){
        //console.log(dat[2]);
        setTimeout(function() {  preparaRevisao(dat[2]);},250);
      }
    });
}

function abreFuncao(id){
    $('#funcoes').slideUp('fast',function(){});  
    $('#'+id).slideDown('fast',function(){$('#tarefa').focus();});                
  }
function fecha(id){
    $('#'+id).slideUp('fast',function(){});  
    $('#funcoes').slideDown('fast',function(){});                
}
function executaFormNovaTarefa(){
  var form = $('#formTarefa');
  var post_url = form.attr('action');
  var post_data = form.serialize();
  $.ajax({
    type: 'GET',
    url: post_url, 
    data: post_data,
    success: function(msg) {
      $("#responseDiv").slideDown( "fast", function() {});
        $('#responseHere').attr('class','alert alert-'+msg[1]);
        document.getElementById('responseHere').innerHTML = msg[0];
        setTimeout(function() { $("#responseDiv").slideUp( "fast", function() {}); },3500);
      },
      error: function(msg){
        //alert('Falha carregando os dados!'+msg);
        $("#responseDiv").slideDown( "fast", function() {});
        $('#responseHere').attr('class','alert alert-danger');
        document.getElementById('responseHere').innerHTML = msg.responseJSON.errors.tarefa[0];
        setTimeout(function() { $("#responseDiv").slideUp( "fast", function() {}); },3500);
      }
    });
  setTimeout(function() {fecha('novaTarefaDiv');reset();},10);
}

