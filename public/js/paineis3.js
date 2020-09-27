jQuery(function($) {
        var panelList = $('#draggablePanelList1');
        var val1 = document.getElementById('draggablePanelList1').getAttribute('data-value');
        panelList.sortable({
            connectWith: ".connectedSortable",
            update: function(event,ui) {
                //$('.pan', panelList).each(function(index, elem) {
               //      var $listItem = $(elem),
                 //        newIndex = $listItem.index();
                          movido(ui.item[0].id,val1,0);

              //  });

            }

        }).disableSelection();
        var panelList2 = $('#draggablePanelList2');
        var val2 = document.getElementById('draggablePanelList2').getAttribute('data-value');
        panelList2.sortable({
            connectWith: ".connectedSortable",
            update: function(event,ui) {
               // $('.pan', panelList2).each(function(index, elem) {
                 //    var $listItem = $(elem),
                   //      newIndex = $listItem.index();
                   console.log(ui.item[0].id);
                          movido(ui.item[0].id,val2,0);

                //});
            }
        }).disableSelection();
        var panelList3 = $('#draggablePanelList3');
        var val3 = document.getElementById('draggablePanelList3').getAttribute('data-value');
        panelList3.sortable({
            connectWith: ".connectedSortable",
            update: function(event,ui) {
                //$('.pan', panelList3).each(function(index, elem) {
                  //   var $listItem = $(elem),
                       //  newIndex = $listItem.index();
                       //  movido(elem.id,val3,2);
                       movido(ui.item[0].id,val3,2);
              //  });

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
                          amarelolixo(elem.id,lixeira);
                          //console.log(elem.id,val1)
                });

            }

        }).disableSelection();

        });






  function  foca(){
    //$('#tare').focus();
setTimeout(function() { $('#tare').focus(); },900);
    }

function amarelolixo(task){

$('#articlee').css('cursor', 'wait');
$('#'+task).css('cursor', 'wait');
   document.getElementById('insertlixo').innerHTML = "";
    document.getElementById('insertlixo').innerHTML =
    `
    <input type="text" name="task"  class="form-control col-12" value="`+task+`" required="required">

    `
    ;
    salvaEstado(task);
    setTimeout(function() {  },100);
  }
 function salvaEstado(des){
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
        $("#roxolixo").load(location.href+" #roxolixo>*","");
      },
      error: function(msg){
        $('#articlee').css('cursor', 'default');
        alert('Falha carregando os dados!'+msg);
      }
    });

  $("#roxolixo").load(location.href+" #roxolixo>*","");
  //$("#abt").load(location.href+" #abt>*","");
 }



      function movido(task,quadro,estado){

$('#articlee').css('cursor', 'wait');
$('#'+task).css('cursor', 'wait');
   document.getElementById('insert').innerHTML = "";
    document.getElementById('insert').innerHTML =
    `
    <input type="text" name="quadro"  class="form-control col-12" value="`+quadro+`" required="required">
    <input type="text" name="task"  class="form-control col-12" value="`+task+`" required="required">
    <input type="text" name="estado"  class="form-control col-12" value="`+estado+`" required="required">

    `
    ;
    salvaMove(task);
    setTimeout(function() {  },1);
  }

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

 //$("#recharP").load(location.href+" #recharP>*","");
  //$("#abt").load(location.href+" #abt>*","");
 }






 function ale(){
  //div.style.display="none";

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
  function jogaFora(){
   $("#gringosTrash").slideUp( "fast", function() {$("#recharP").slideDown( "fast", function() {});});
 }
