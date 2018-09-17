<template>
                   <v-server-table url="/getemployees" :columns="columns" :options="options">
             				<template slot="birthday" slot-scope="props">
    							<div>
      								{{ getdate(props.row.birthday) }}
    							</div>
	   						</template>
               				<template slot="deathday" slot-scope="props">
    							<div>
      								{{ getdate(props.row.deathday) }}
    							</div>
	   						</template>
               				<template slot="actions" slot-scope="props">
    							<div>
      								<a :href=getemployee(props.row.id) class="btn btn-primary" role="button">View</a>
    							</div>
	   						</template>

                   </v-server-table>
</template>

<script>
    export default {
    	data(){
			return{
		 	     columns: ['lastname', 'firstname', 'middlename','birthday','deathday', 'address', 'actions'],
        		 options: {
        				params: {
							datefields: ['birthday','deathday']
				 		},
        				headings:{ 
            						lastname: 'Lastname',
					              	firstname: 'Firstname',
					              	middlename: 'Middlename',
					              	birthday: 'Birthday',
					              	deathday: 'Deathday',
									address: 'Address'
						            },
						requestFunction(data) 
						{
										return axios.get(this.url, {
											params: data
										}).catch(function (e){
											this.dispatch('error', e);
										}.bind(this));
						}
        		}
        	};
		},
        mounted() {
        },
        methods:{
			getdate(ddate)
			{
				if (ddate != null)
				{
					var d = new Date(ddate);
					return d.toLocaleFormat('%d %b %Y')
				}
				else
				{
					return null;
				}
			},
			getemployee: function(id)
			{
				return "/getemployee/" + id;
			},

		}
    }
</script>
