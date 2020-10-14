<template>
	<div class="col-xl-4 col-md-6 mb-4  bg-light " v-model="primeiro" v-if="tipo == 3" >
		<div class="card  border-0 shadow-lg my-5 " >
			<div class="card-header btn btn-lg btn-info text-white ">A FAZER</div>
			<div class="card-body connectedSortable over" id="draggablePanelList1" :data-value="todo" style="min-height: 80px">
					<div :class="task.prioridade" :id="task.id"   :data-value="todo" style="position: relative;" v-for="task in tasks" v-bind:key="task.id">	
						<div class="card-body" >
							<h5 class="text-center noselect">{{task.task}}</h5>
							<p v-if="task.revisao != 'TESTE'">{{task.revisao}}</p>
							<small class=" bottom-right noselect " style="float: right">{{task.dono}} 
								<button class="badge badge-danger" v-if="task.pause == 0"><span class="fas fa-pause"></span></button>
								<button class="badge badge-light" v-if="task.revisao != 'TESTE'"><span class="fas fa-tools"></span></button>
							</small>
							<small class=" bottom-left noselect " style="float: left"  v-if="task.pause == 0">
							 {{task.tempo}} 
							</small>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6 mb-4  bg-light " v-model="primeiro" v-else>
		<div class="card  border-0 shadow-lg my-5 " >
			<div class="card-header btn btn-lg btn-info text-white ">A FAZER</div>
			<div class="card-body connectedSortable over" id="draggablePanelList1" :data-value="todo" style="min-height: 80px">
					<div :class="task.prioridade" :id="task.id"   :data-value="todo" style="position: relative;" v-for="task in tasks" v-bind:key="task.id">	
						<div class="card-body" >
							<h5 class="text-center noselect">{{task.task}}</h5>
							<p v-if="task.revisao != 'TESTE'">{{task.revisao}}</p>
							<small class=" bottom-right noselect " style="float: right">{{task.dono}} 
								<button class="badge badge-danger" v-if="task.pause == 0"><span class="fas fa-pause"></span></button>
								<button class="badge badge-light" v-if="task.revisao != 'TESTE'"><span class="fas fa-tools"></span></button>
							</small>
							<small class=" bottom-left noselect " style="float: left"  v-if="task.pause == 0">
							 {{task.tempo}} 
							</small>

						</div>
					</div>
				</div>
			</div>
		</div>
	</template>
	<style type="text/css">
	.over{

		max-height: 800px;
		
    	width: 100%;
    	overflow: auto;
	}
    
	</style>
	<script>
		export default {
			props: ['tasks','todo','tipo'],
			 data() {
    		return {
     			 quadro : this.todo,
    			};
  			},
  			created() {
  				Echo.private('newtask')
  				.listen('NovaTask', (e) => {
  					this.buscaTask();
  				});
  				Echo.private('taskmovida')
			        .listen('TaskMovida', (e) => {
			            this.buscaTask();
			        });
			    Echo.private('invalido')
			        .listen('MovimentoInvalido', (e) => {
			        	this.zera();
			            this.buscaTask();
			        });
  			},
  			computed: {
  				primeiro: {
  					get: function() {
  						return axios.get('/buscaTask/'+this.quadro).then(response => {
			                this.$emit('primeiro', response.data);
			            });
  					},
  					set: function() {
  						axios.get('/buscaTask/'+this.quadro).then(response => {
			                this.$emit('primeiro', response.data);
			            });
  					}
  				}
  			},
  			methods: {
  				buscaTask() {
  					axios.get('/buscaTask/'+this.quadro).then(response => {
  						this.$emit('primeiro', response.data);
  					});
  				},zera() {	
  					this.$emit('primeiro',[]);
  				}
  			}
  
		};

	</script>