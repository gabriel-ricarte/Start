<template>
	<div class="card-body int" id="integranteform" v-model="livres" >
                	

                		<div class="col-sm-12 mb-3 mb-sm-0">
                			<label for="integrante-nome">Digite Aqui</label>
                			<input v-model="findName" class="form-control" id="integrantenome" type="text" placeholder="Nome" />
                			<div id="valval" style="display: none"></div>
                			<input type="hidden"  name="projeto_id" :value="projeto">
                			<br>
                			<div id="resp" class="col-sm-12">
                				<div class="table-responsive" > 
                					<table class="table table-striped table-sm " id="style-9">
                						<thead>
                							<tr id="tablee" style="font-size: small">
                								<th>USUÁRIO</th>
                								<th>EMAIL</th>
                								<th>AÇÃO</th>
                							</tr>
                						</thead>
                						<tbody id="tableee" class="bg-light">
                							<tr style="font-size: smaller"  v-for="user in filteredNames">
			 									<td style="font-size: smaller">{{user.nome}}</td>
			 									<td>{{user.email.substring(0,25)}}<span style="font-size: 10px" v-if="user.email.length > 25">...</span></td>
			 									<td>
			 										<form method="POST" action="../../equipe" class="user">
                            						<input type="hidden" name="_token" v-bind:value="csrf">
                            						<input type="hidden"  name="projeto_id" :value="projeto">
                            						<input type="hidden" name="integrante_id" :value="user.id">
			 										<button class="btn btn-success btn-sm" type="submit" v-on:click="selecionar(user.nome , user.id)"><span class="fas fa-user-plus"></span></button>
			 										</form>
			 									</td>
			 								</tr>
                						</tbody>
                					</table>
                				</div>
                				<!-- <ul>
                					<li v-bind:key="user.id">{{user.nome}}</li>
                				</ul> -->
                			</div>
                		</div>


            <span class="alert alert-warning">Se integrante não foi encontrado cadastre <button class="btn btn-warning active btn-sm" v-on:click="newplayer()">AQUI</button></span>
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
.int{
	max-height: 500px;
	overflow-x: auto;
}

</style>
<script>
	export default {
			props: ['users','projeto','csrf'],
			 data() {
    		return {
     			 id : this.projeto,
     			 findName : '',
    			};
  			},
		
		computed: {
			livres: {
				get: function() {
					return axios.get('/buscaIntegrantesD/'+this.id).then(response => {
						this.$emit('livres', response.data);
						this.names = response.data;
					});
				},
				set: function() {
					axios.get('/buscaIntegrantesD/'+this.id).then(response => {
						this.$emit('livres', response.data);
						this.names = response.data;
					});
				}
			},
			filteredNames() {
				//console.log(this.users);
				return this.users.filter(item => {
					let emails = item.email.toLowerCase().indexOf(this.findName.toLowerCase()) > -1;
					return item.nome.toLowerCase().indexOf(this.findName.toLowerCase()) > -1;
				})
			// filteredNames() {
			// 	let filter = new RegExp(this.findName, 'i');
			// 	console.log(this.users);
			// 	return this.users.filter(el => el.match(filter));
			 }
		},
		methods: {
			newplayer(){
				document.getElementById('texto-pesquisa').innerHTML = '';
				document.getElementById('texto-pesquisa').innerHTML = 'CADASTRE NOVO PARTICIPANTE <span style="float : right;"><button class="btn btn-danger btn-sm" onclick="fecha(\'novo-integrante\')"><span class="far fa-times-circle"></span></button></span>';
				$('#integranteform').slideUp('fast',function(){});  
				$('#btn-confirma').slideUp('fast',function(){});  

		    	$('#novo-integrante').slideDown('fast',function(){$('#nome-new').focus();}); 
			}
			

		}

	};

</script>