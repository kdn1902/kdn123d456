<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  		<div class="pull-right">
                   			<button type="button" class="btn btn-primary btn-sm" @click.prevent="saveEmployee">Save change</button>
                   		</div>
                </div>

                <div class="card-body">
	
	
	            <div class="row">
    			    	<div class="col-md-10 col-md-offset-1" v-if="status || err" >
        					<div class="panel panel-default">        	
               					<div class="panel-body" >
                       				<p v-if="status" class="text-success">{{ status }}</p>
                       				<ul v-if="err">
                       						<li v-for="value in err"><p class="text-danger">{{ value[0] }}</p></li>	
                       				</ul>
        	    				</div>
        					</div>
       					</div>
        		</div>

              <table class="table table-bordered">
              <thead class="thead-light">
						<th>Lastname</th><th>Firstname</th><th>Middlename</th><th>Birstday</th>
						<th>Deathday</th><th>Address</th>
			  </thead>
			  <tr class="table-info">
					<td @click.self = "is_lastname_view = ! is_lastname_view;  is_birthday_view = true; is_deathday_view = true">
						<template v-if="is_lastname_view"  > {{ empl.lastname }} </template>
						<template v-else><input v-focus class="form-control" v-model="empl.lastname" @blur="is_lastname_view = true" @keyup.13 = "is_lastname_view = true" />
            			</template>
					</td>
					<td @click.self = "is_firstname_view = ! is_firstname_view;  is_birthday_view = true; is_deathday_view = true">
						<template v-if="is_firstname_view"  > {{ empl.firstname }} </template>
						<template v-else><input v-focus class="form-control" v-model="empl.firstname" @blur="is_firstname_view = true" @keyup.13 = "is_firstname_view = true" />
            			</template>
					</td>
					<td @click.self = "is_middlename_view = ! is_middlename_view; is_birthday_view = true; is_deathday_view = true">
						<template v-if="is_middlename_view"  > {{ empl.middlename }} </template>
						<template v-else><input v-focus class="form-control" v-model="empl.middlename" @blur="is_middlename_view = true" @keyup.13 = "is_middlename_view = true" />
            			</template>
					</td>
					<td @click.self = "is_birthday_view = ! is_birthday_view">
						<template v-if="is_birthday_view"> {{ empl.birthday }}</template>
						<template v-else><mydatepicker :ddate="empl.birthday" @changedate="changeBirthday" @closedate="closeBirthday"></mydatepicker>
						</template>
					</td>
					<td @click.self = "is_deathday_view = ! is_deathday_view">
						<template v-if="is_deathday_view"> {{ empl.deathday }}</template>
						<template v-else><mydatepicker :ddate="empl.deathday" @changedate="changeDeathday" @closedate="closeDeathday"></mydatepicker>					
						</template>
					</td>
					<td @click.self = "is_address_view = ! is_address_view;  is_birthday_view = true; is_deathday_view = true">
						<template v-if="is_address_view"  > {{ empl.address }} </template>
						<template v-else><input v-focus class="form-control" v-model="empl.address" @blur="is_address_view = true" @keyup.13 = "is_address_view = true" />
            			</template>
					</td>
				</tr>
			</table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
    	data(){
    		return {
    			last_birthday:null,
    			is_lastname_view: true,
    			is_firstname_view: true,
    			is_middlename_view: true,
    			is_birthday_view: true,
    			is_deathday_view: true,
    			is_address_view: true,
    			err: null,
    			status: null
    		};
    	},
    	props: ['empl'],
    	mounted() {
    		this.last_birthday = this.empl.birthday;
    	},
    	methods:{
    		 saveEmployee()
    		 {
     		 	axios.post('/savemployee', {
		                id: this.empl.id,
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
        	    this.status = response.data.status;
        	})
        	.catch(error => {
        		this.status = null;
        	    this.err = error.response.data.errors;
        	})

			 },
    	  	 changeBirthday(newdata)
    	  	 {
    	  	    	if(newdata != null)
    	  	    	{
						this.empl.birthday = newdata;
					}
   	 				else
   	 				{
						this.empl.birthday = this.last_birthday;
					}
   	 				
   	 		 },
   	 		 closeBirthday()
   	 		 {
  				 	this.is_birthday_view = true;
			 },
			 changeDeathday(newdata)
    	  	 {
   	 				this.empl.deathday = newdata;
   	 		 },
   	 		 closeDeathday()
   	 		 {
				 	this.is_deathday_view = true;
			 }
    	}
    }
    
</script>