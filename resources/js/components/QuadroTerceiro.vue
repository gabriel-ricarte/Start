<template>
	<div class="col-xl-4 col-md-6 mb-4  bg-light text-white"  v-model="terceiro" v-if="tipo == 4" >
		<div class="card  border-0 shadow-lg my-5" >
			<div class="card-header btn btn-lg btn-info text-white ">EM TESTE</div>
			<div class="card-body connectedSortable over" id="draggablePanelList3" :data-value="testing"style="min-height: 80px">

				<div :class="task.prioridade" :id="task.id"    :data-value="testing" style="position: relative;" v-for="task in taskstres" v-bind:key="task.id" >	
					<div class="card-body" >
						<!-- <div class="container"> -->
							<h5 class="text-center noselect ">{{task.task}}</h5>
							<p v-if="task.revisao != 'TESTE'">{{task.revisao}}</p>
							<small class=" bottom-right noselect " style="float: left">{{moment(task.tempo).fromNow()}}</small><small class=" bottom-right noselect " style="float: right">{{task.dono}} <button class="badge badge-light" v-if="task.revisao != 'TESTE'"><span class="fas fa-tools"></span></button></small>
							<!-- </div> -->
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
    .blink {
  -webkit-animation: glowing 1500ms infinite;
  -moz-animation: glowing 1500ms infinite;
  -o-animation: glowing 1500ms infinite;
  animation: glowing 1500ms infinite;
}
@-webkit-keyframes glowing {
  0% { background-color: #3989d2; -webkit-box-shadow: 0 0 3px #3989d2; }
  50% { background-color: #347ec0; -webkit-box-shadow: 0 0 40px #347ec0; }
  100% { background-color: #1e69ac; -webkit-box-shadow: 0 0 3px #1e69ac; }
}

	</style>
	<script>
		export default {
			//props: ['tasksdois','doing']
			props: ['taskstres','testing','tipo'],
			 data() {
    		return {
     			 quadro : this.testing,
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
  				terceiro: {
  					get: function() {
  						return axios.get('/buscaTask/'+this.quadro).then(response => {
			                this.$emit('terceiro', response.data);
			            });
  					},
  					set: function() {
  						axios.get('/buscaTask/'+this.quadro).then(response => {
	                //this.tasks = response.data;
			                this.$emit('terceiro', response.data);
			            });
  						//this.$emit('emitterdrawer', val)
  					}
  				}
  			},
  			// mounted() {
	  		// 	 axios.get('/buscaTask/'+this.quadro).then(response => {
	    //             //this.tasks = response.data;
	    //             this.$emit('segundo', response.data);
	    //         });
  			// },
  			methods: {
  				buscaTask() {
  					axios.get('/buscaTask/'+this.quadro).then(response => {
  						this.$emit('terceiro', response.data);
  					});
  				},zera() {
  					
  					this.$emit('terceiro',[]);
  					
  				}
  			}
		};
	</script>