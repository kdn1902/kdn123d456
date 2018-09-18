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
 <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
   <ol class="carousel-indicators">
    <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleControls" data-slide-to="1"></li>
    <li data-target="#carouselExampleControls" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="https://natworld.info/wp-content/uploads/2018/01/%D0%A1%D0%BE%D1%87%D0%B8%D0%BD%D0%B5%D0%BD%D0%B8%D0%B5-%D0%BD%D0%B0-%D1%82%D0%B5%D0%BC%D1%83-%D0%9F%D1%80%D0%B8%D1%80%D0%BE%D0%B4%D0%B0.jpeg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://ruslo.info/wp-content/uploads/2018/05/priroda-turtsii-gora.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://ruslo.info/wp-content/uploads/2018/05/priroda-turtsii-gory.jpg" alt="Third slide">
    </div>
  </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
      			   
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