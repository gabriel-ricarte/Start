<template>
	<div class="col-xl-4 col-md-6 mb-4  bg-light"  v-model="segundo" >
		<div class="card  border-0 shadow-lg my-5" >
			<div class="card-header btn btn-lg btn-info text-white ">FAZENDO</div>
			<div class="card-body connectedSortable" id="draggablePanelList2" :data-value="doing"style="min-height: 80px">

	<div class="card pan dragg qitem bg-warning" :id="task.id"    :data-value="doing" style="position: relative;" v-for="task in tasksdois" v-bind:key="task.id" >	
					<div class="card-body" >
						<!-- <div class="container"> -->
							<h5 class="text-center noselect ">{{task.task}}</h5>
							<small class=" bottom-right noselect " style="float: right">{{task.dono}}</small>
							<!-- </div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</template>

	<script>
		export default {
			//props: ['tasksdois','doing']
			props: ['tasksdois','doing'],
			 data() {
    		return {
     			 quadro : this.doing,
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
  				segundo: {
  					get: function() {
  						return axios.get('/buscaTask/'+this.quadro).then(response => {
			                this.$emit('segundo', response.data);
			            });
  					},
  					set: function() {
  						axios.get('/buscaTask/'+this.quadro).then(response => {
	                //this.tasks = response.data;
			                this.$emit('segundo', response.data);
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
  						this.$emit('segundo', response.data);
  					});
  				}
  			}
		};
	</script>