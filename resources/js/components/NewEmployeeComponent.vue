<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   			<button type="button" class="btn btn-primary" @click.prevent="createEmployee">Create Employee</button>
                </div>

                <div class="card-body">
   				   <template v-if="err">
						<div v-for="value in err" class="row alert alert-danger" role="alert">
							{{ value[0] }}
						</div>
      			   </template>
      			   <h1>
      			   Hello, world!!!	
      			   </h1>
      			   
      			   
			  </div>
		  </div>
      </div>
   </div>
</template>
<script>
    export default {
    	data(){
				return{
						err:null,
									
				}
			},
		methods: {
			createEmployee()
			{
				
			}
		}
	}
</script>