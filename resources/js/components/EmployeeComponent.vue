<template>
      <div>
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
						<template v-if="is_middlename_view"  > {{ empl.otchestvo }} </template>
						<template v-else><input v-focus class="form-control" v-model="empl.otchestvo" @blur="is_middlename_view = true" @keyup.13 = "is_middlename_view = true" />
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
    		};
    	},
    	props: ['empl'],
    	mounted() {
    		this.last_birthday = this.empl.birthday;
    	},
    	methods:{
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