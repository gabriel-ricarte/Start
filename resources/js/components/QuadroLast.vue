<template>
	<div class="col-xl-4 col-md-6 mb-4  bg-light" >
		<div class="card  border-0 shadow-lg my-5" >
			<div class="card-header btn btn-lg btn-info text-white ">FEITO</div>
			<div class="card-body connectedSortable" id="draggablePanelList3" :data-value="done" style="min-height: 80px">

	<div class="card pan dragg qitem bg-light" :id="task.id"   :data-value="done" style="position: relative;" v-for="task in taskslast" v-bind:key="task.id">	
					<div class="card-body" >
						<!-- <div class="container"> -->
							<h5 class="text-center noselect">{{task.task}}</h5>
							<small class=" bottom-right noselect"  style="float: right">{{task.dono}}</small>
							<!-- </div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</template>

	<script>
		export default {
			props: ['taskslast','done']
		};

	</script>