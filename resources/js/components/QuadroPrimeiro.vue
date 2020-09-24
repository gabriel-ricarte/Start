<template>
	<div class="col-xl-4 col-md-6 mb-4  bg-light" >
		<div class="card  border-0 shadow-lg my-5" >
			<div class="card-header btn btn-lg btn-info text-white ">A FAZER</div>
			<div class="card-body connectedSortable" id="draggablePanelList1" :data-value="todo" style="min-height: 80px">

	<div class="card pan dragg qitem bg-warning " :id="task.id"   :data-value="todo" style="position: relative;" v-for="task in tasks" v-bind:key="task.id">	
					<div class="card-body" >
						<!-- <div class="container"> -->
							<h5 class="text-center noselect">{{task.task}}</h5>
							<small class=" bottom-right noselect" style="float: right">{{task.dono}}</small>
							<!-- </div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</template>

	<script>
		export default {
			props: ['tasks','todo'],

		};

	</script>