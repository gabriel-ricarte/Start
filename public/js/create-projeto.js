	function muda(id){
		//console.log(id.val());
		$(id).attr('type','date');
	}
	function muda2(){
		document.getElementById('change').innerHTML = '';
		document.getElementById('change').innerHTML = 
		`
		<select type="text" name="vertical" required class="form-control"><option selected="" hidden="" value="">ESCOLHA AQUI</option><option>HOLDING</option><option>JORNAL JANGADEIRO</option><option>TODO MUNDO AMA</option><option>FUTEBOLÊS</option>></select>
		`;
	}
$(document).ready(function(){
		$('[data-toggle="popover"]').popover();   
	});
function tu(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#tumb')
			.attr('src', e.target.result)
			.width(210)
			.height(150);
		};

		reader.readAsDataURL(input.files[0]);
	}
}
function pesquisa(dado){
  document.getElementById('resp').innerHTML = 
    `<h3>BUSCANDO ...</h3>
    `
    ;if(dado.length>=3){
    document.getElementById('inserir').innerHTML = 
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
      `<div class="table-responsive" style="font-size: medium"> 
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" id="style-9">
                      <thead>
                        <tr id="tablee" style="font-size: medium">
                          <th >USUÁRIO</th>
                          <th>EMAIL</th>
                          <th>SETOR</th>
                          <th>AÇÃO</th>
                        </tr>
                      </thead>
                      <tbody id="tableee" class="bg-light">
                      </tbody>
                    </table>
                  </div>
                  <span class="alert alert-warning">Se integrante não foi encontrado cadastre <button type="button" class="btn btn-warning active btn-sm" onclick="newplayer()">AQUI</button></span>
`;
      },
      error: function(){
        document.getElementById('resp').innerHTML = 'busca sem resultados';
      }
    });
 
		show.done(function(dat){ 
			
			 for(let i = 0 ; i < dat.length; i++){
			 	let hora = 
			 	`
			 	<tr style="font-size: medium">
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
  $('#po').attr('value','');
  document.getElementById('po').value = '';
  document.getElementById('valval').innerHTML = '';
  $('#po').removeAttr('readonly');
  $('#po').focus();
  document.getElementById('resp').innerHTML = '';
}
function selecionar(nome,id){
	$('#po').attr('value',nome);
	$('#po').attr('readonly','true');
	document.getElementById('resp').innerHTML = '<button class="btn btn-info btn-sm" onclick="eLaVamosNos()" type="button"><span class="fas fa-user-edit"></span></button>';
	document.getElementById('valval').innerHTML = '<input  type="hidden" value="'+id+'" name="po_id" required>';
	document.getElementById('po').value = nome;
	$('#razao').focus();
}

function newplayer(){
    $('#pesqPO').slideUp('fast',function(){});  
    $('#inserePO').slideDown('fast',function(){$('#nome-new').focus();}); 
}
function preparaInsercao(){
    document.getElementById('inserirP').innerHTML = 
    `
    <input type="email" name="email"  class="form-control col-12" value="`+$('#email-new').val()+`" required>
    <input type="text" name="nome"  class="form-control col-12" value="`+$('#nome-new').val()+`" required>
    
    `
    setTimeout(function() { executaInsercao(); },10);
}
function executaInsercao(){
  var form = $('#inserePessoa');
  var post_url = form.attr('action');
  var post_data = form.serialize();
  var show =  $.ajax({
    type: 'GET',
    url: post_url, 
    data: post_data,
    success: function(data) {
        //ação aqui
        console.log(data);
        document.getElementById('po').innerHTML = '';
        //document.getElementById('po').innerHTML = data;
      },
      error: function(){
        document.getElementById('resp').innerHTML = 'Erro na inserção';
      }
    });
}