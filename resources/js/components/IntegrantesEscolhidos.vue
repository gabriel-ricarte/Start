<template>
	<div class="card-body" v-model="selecionados">
		<div class="table-responsive">
			
		
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>NOME</th>
					<th>PERMISSÃO</th>
					<th>CONTATO</th>
					<th>AÇÕES</th>
				</tr>
			</thead>
			<tbody >
				<tr v-for="integrante in integrantes" v-bind:key="integrante.id">
					<td>{{integrante.nome}}</td>
					<td> 
						<button type="button" class="btn btn-danger btn-sm buston" title="NÍVEL DE PERMISSÃO" data-container="body" data-toggle="popover" data-placement="top" data-content="Pode criar , editar e excluir tarefas" v-on:click="pop()"  v-on:mouseover="pop()">
							TOTAL
						</button>
					</td>
					<td> {{integrante.email}}</td>
					<td> 
						<button type="button" class="btn btn-danger btn-sm buston " title="REMOVER INTEGRANTE" v-on:click="preparaEx(time ,integrante.id ,projeto,csrf)" >
							<i class="fas fa-user-slash" ></i>
						</button>
					</td>
				</tr>
			</tbody>
		</table>
		<span><button type="button" class="btn btn-danger btn-sm buston ">TOTAL</button> : Pode criar , editar e excluir tarefas.</span><br>
		<span><button type="button" class="btn btn-danger btn-sm buston ">PARCIAL</button> : Somente resolução de tarefas.</span><br>
		<span><button type="button" class="btn btn-danger btn-sm buston "><i class="fas fa-user-slash" ></i></button> : Remover integrante.</span>
		</div>
	</div>
</template>
<style type="text/css">
.over{
	max-height: 800px;
	width: 100%;
	overflow: auto;
}
.buston{
	border-radius: 10px; margin-left: 8px;border-color: white;border-width: 3px;
}

</style>
<script>
	export default {
		props: ['integrantes','projeto','csrf','time'],
		data() {
			return {
				equipe : this.projeto,
			};
		},
		created() {
			Echo.private('newtask')
			.listen('NovoIntegrante', (e) => {
				this.buscaIntegrantes();
			});
		},
		computed: {
			selecionados: {
				get: function() {
					console.log(this.csrf);
					console.log(this.token);
					return axios.get('/buscaIntegrantes/'+this.equipe).then(response => {
						this.$emit('selecionados', response.data);
					});
				},
				set: function() {
					axios.get('/buscaIntegrantes/'+this.equipe).then(response => {
						this.$emit('selecionados', response.data);
					});
				}
			}
		},
		methods: {
			buscaIntegrantes() {
				axios.get('/buscaIntegrantes/'+this.equipe).then(response => {
					this.$emit('selecionados', response.data);
				});
			},
			pop(){
				$(document).ready(function(){
					$('[data-toggle="popover"]').popover();   
				});
			},
			  preparaEx(time ,user,proj,token){
      document.getElementById('exibe').innerHTML = '<center><div class="loader"></div></center>';
          document.getElementById('texto').innerHTML = 'Preparando Exclusão ...';
          $("#sobe").slideUp( "slow", function() {});
           
          $("#desce").slideDown( "slow", function() {});
        
         setTimeout(function() {

          document.getElementById('texto').innerHTML = '';
           document.getElementById('texto').innerHTML = 'Pronto para a Exclusão ! ';
          
          
        
          document.getElementById('exibe').innerHTML = '';
          document.getElementById('exibe').innerHTML = 
          `
           <form method="post" action="../../remove-player"  class="user" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="`+token+`">
                <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                  <center>
                    <label for="cliente">O integrante escolhido vai ser retirado do projeto !</label>
                 	<input type="hidden" name="equipe_id" value="`+time+`" >
                    <input type="hidden" name="user_id" value="`+user+`" >
                    <input type="hidden" name="projeto_id" value="`+proj+`" >
                    <input type="hidden" name="origem" value="criando" >
                    <br>
                   <button class="btn btn-primary btn-md">EXCLUIR</button>
                   </center>
                  </div>

                </div>
              </form>
          `
          ;


          },2000);
          

}
		}

	};

</script>