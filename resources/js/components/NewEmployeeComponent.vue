<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   			<button type="button" class="btn btn-primary" @click.prevent="saveEmployee">Save changes</button>
                </div>

                <div class="card-body">
                
   					<div v-if="status" class="row alert alert-success" role="alert">
             					{{ status }}
					</div>
      			   
      			    <ul class="list-group" v-if="err">
      			   		<li v-for="value in err" class="list-group-item list-group-item-danger">{{ value[0] }}</li>
      			    </ul><br />
				
			<div class="row">	
              <table class="table table-bordered">
              <thead class="thead-light">
						<th><h4>Lastname</h4></th>
						<th><h4>Firstname</h4></th>
						<th><h4>Middlename</h4></th>
						<th><h4>Birstday</h4></th>
						<th><h4>Deathday</h4></th>
						<th><h4>Address</h4></th>
			  </thead>
			  <tr class="table-info">
					<td>
						<input class="form-control" v-model="empl.lastname" />
					</td>
					<td >
						<input class="form-control" v-model="empl.firstname" />
					</td>
					<td>
						<input class="form-control" v-model="empl.middlename" />
					</td>
					<td>
						<mydatepicker @changedate="changeBirthday"></mydatepicker>
					</td>
					<td>
						<mydatepicker @changedate="changeDeathday"></mydatepicker>
					</td>
					<td>
						<input class="form-control" v-model="empl.address">
					</td>
				</tr>
			</table>
			</div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
    	data(){
    		return {
    			empl: {},
    			err: null,
    			status: null,
    		};
    	},
    	methods:{
    		 saveEmployee()
    		 {
     		 	axios.post('/newemployee', {
                		lastname: this.empl.lastname,
                		firstname: this.empl.firstname,
                		middlename: this.empl.middlename,
		                birthday: this.empl.birthday,
                		deathday: this.empl.deathday,
                		address: this.empl.address,
        		}
        	)
        	.then(response => {
        		this.err = null;
         		window.location.replace(response.data.redirect);
        	})
        	.catch(error => {
        		this.status = null;
        	    this.err = error.response.data.errors;
        	})
			},
    	  	changeBirthday(newdata)
    	  	{
				this.empl.birthday = newdata;
   	 		},
			changeDeathday(newdata)
    	  	{
 				this.empl.deathday = newdata;
   	 		}
    	}
    }
    
</script>