
function pop(){
  $(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
  });
}
  
  	function pesquisa(dado){
  document.getElementById('resp').innerHTML = 
    `<h3>BUSCANDO ...</h3>
    `
    ;if(dado.length>=3){
    document.getElementById('inserirr').innerHTML = 
    `
    <input type="text" name="dado"  class="form-control col-12" value="`+dado+`" required>
    
    `
    setTimeout(function() { executaBusca(); },10);
    }else{
    	  document.getElementById('resp').innerHTML = 
    `<h3>BUSCANDO ...</h3>
    `

    }
    
  
}


 function executaBusca(){
  var form = $('#buscaC');
  var post_url = form.attr('action');
  var post_data = form.serialize();
  var show =  $.ajax({
    type: 'GET',
    url: post_url, 
    data: post_data,
    success: function() {
      
      document.getElementById('resp').innerHTML = 
      `<div class="table-responsive" > 
            <table class="table table-striped table-sm " id="style-9">
                      <thead>
                        <tr id="tablee" style="font-size: small">
                          <th>USUÁRIO</th>
                          <th>EMAIL</th>
                          <th>SETOR</th>
                          <th>AÇÃO</th>
                        </tr>
                      </thead>
                      <tbody id="tableee" class="bg-light">
                      </tbody>
                    </table>
                  </div>
`;
      },
      error: function(){
        document.getElementById('resp').innerHTML = 'busca sem resultados';
      }
    });
 
		show.done(function(dat){ 
			console.log();
			
			 for(let i = 0 ; i < dat.length; i++){
			 	let hora = 
			 	`
			 	<tr style="font-size: smaller">
			 	<td>`+  
                 dat[i].nome
             	+`</td>
                <td>`+  
             	dat[i].email
              	+`</td>
                <td>`+ 
             	dat[i].setor
                +`</td>
                <td>
               	<button class="btn btn-success btn-sm" type="button" onclick="selecionar('`+dat[i].nome+`',`+dat[i].id+`)">SELECIONAR </button>
                </td>
				</tr> `;
                $('#tableee').append(hora);
			 }
		});

}
function eLaVamosNos(){
  $('#integrante-nome').attr('value','');
  document.getElementById('integrante-nome').value = '';
  document.getElementById('valval').innerHTML = '';
  $('#integrante-nome').removeAttr('readonly');
  $('#integrante-nome').focus();
}

function selecionar(nome,id){
	$('#integrante-nome').attr('value',nome);
	$('#integrante-nome').attr('readonly','true');
	document.getElementById('resp').innerHTML = '<button class="btn btn-info btn-sm" onclick="eLaVamosNos()" type="button"><span class="fas fa-undo-alt"></span></button> <button class="btn btn-danger btn-sm" onclick="selecionado()" type="submit"><span class="fas fa-user-plus"></span></button> ';
	document.getElementById('valval').innerHTML = '<input  type="hidden" value="'+id+'" name="integrante_id" required>';
	document.getElementById('integrante-nome').value = nome;
	$('#razao').focus();
	}

function newplayer(){
		document.getElementById('texto-pesquisa').innerHTML = '';
		document.getElementById('texto-pesquisa').innerHTML = 'CADASTRE NOVO PARTICIPANTE';
		$('#integrante-form').slideUp('fast',function(){});  
		$('#btn-confirma').slideUp('fast',function(){});  

    	$('#novo-integrante').slideDown('fast',function(){$('#nome-new').focus();}); 
	}
function fecha(){

	}