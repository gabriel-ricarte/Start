<template>
	<div class="col-xl-4 col-md-6 mb-4  bg-light" v-model="last" >
		<div class="card  border-0 shadow-lg my-5" >
			<div class="card-header btn btn-lg btn-info text-white ">FEITO</div>
			<div class="card-body connectedSortable" id="draggablePanelList3" :data-value="done" style="min-height: 80px">

	<div class="card pan dragg qitem bg-light" :id="task.id"   :data-value="done" style="position: relative;" v-for="task in taskslast" v-bind:key="task.id">	
					<div class="card-body" >
						<!-- <div class="container"> -->
							<h5 class="text-center noselect">{{task.task}}</h5>
							<small class=" bottom-right noselect"  style="float: left">{{task.custo}}</small><small class=" bottom-right noselect"  style="float: right">{{task.dono}}</small>
							<!-- </div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</template>

	<script>
		export default {
			//props: ['taskslast','done']
			props: ['taskslast','done'],
			 data() {
    		return {
     			 quadro : this.done,
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
  			},
  			computed: {
  				last: {
  					get: function() {
  						return axios.get('/buscaTask/'+this.quadro).then(response => {
			                this.$emit('last', response.data);
			            });
  					},
  					set: function() {
  						axios.get('/buscaTask/'+this.quadro).then(response => {
	                //this.tasks = response.data;
			                this.$emit('last', response.data);
			            });
  						//this.$emit('emitterdrawer', val)
  					}
  				}
  			},
  			methods: {
  				buscaTask() {
  					axios.get('/buscaTask/'+this.quadro).then(response => {
  						//this.tasks = response.data;
  						this.$emit('last', response.data);
  					});
  				}
  			}
		};

	</script>