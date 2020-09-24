<template>
 <div class="row">
    <div class="card bg-primary text-white mb-5" style="min-width: 18rem;max-width: 20rem;" v-for="user in tecnicosatd" v-bind:key="user.id" v-if="user.sexo == 'ON' && user.status == 'EM ATENDIMENTO'" >

               <div class="card-header bg-primary text-white" >{{user.nome}}</div>
              <div class="card-body">
                <h5 class="card-title">{{user.status}}</h5>
              </div>
            </div>
            </div>
</template>

<script>
  export default {
    props: ['tecnicosatd']
  };

</script>