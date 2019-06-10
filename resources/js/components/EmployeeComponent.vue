<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   			<button type="button" class="btn btn-primary" @click.prevent="saveEmployee">Save changes</button>
                   			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   			<button type="button" class="btn btn-warning" @click.prevent="cancelEmployee">Cancel changes</button>
                   			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   			<button type="button" class="btn btn-danger" @click.prevent="dropEmployee">Drop employee</button>
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
						<th><h4><span class="badge badge-light">Фамилия</span></h4></th>
						<th><h4><span class="badge badge-light">Имя</span></h4></th>
						<th><h4><span class="badge badge-light">Отчество</span></h4></th>
						<th><h4><span class="badge badge-light">День рождения</span></h4></th>
						<th><h4><span class="badge badge-light">День смерти</span></h4></th>
						<th><h4><span class="badge badge-light">Адрес</span></h4></th>
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
						<template v-if="is_birthday_view"> {{ printdate(empl.birthday) }}</template>
						<template v-else><mydatepicker :ddate="empl.birthday" @changedate="changeBirthday" @closedate="closeBirthday"></mydatepicker>
						</template>
					</td>
					<td @click.self = "is_deathday_view = ! is_deathday_view">
						<template v-if="is_deathday_view"> {{ printdate(empl.deathday) }}</template>
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
			
			
			<table>
			<tr v-for="photo in empl.small_photo">
			<td>
					<a data-toggle="modal" :data-target="getsmallphotoid(photo)">
				    <img :src="small_photo_url(photo)"></img></a>
			</td>
			<td>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-sm" @click="dropPhoto(photo)" data-toggle="tooltip" data-placement="right" title="Press this button to delete this photo from server">Delete photo</button>
			</td>
			</tr>
			</table>
			
			<br />
			<div class="alert alert-primary" role="alert">
	  			<h1><span class="badge badge-pill badge-primary">Upload photos:</span></h1><br />
  				<div class="row">
        		        <form enctype="multipart/form-data">
            				<input type="file" accept="image/*" name="image" @change="changePhoto" />
            				<button type="button" class="btn btn-primary" @click="uploadPhoto" data-toggle="tooltip" data-placement="right" title="Press this button to upload this photo to server" v-if="uploadPhotoButtonStatus" >Upload photo</button>
            				<br /><img :src="src"/>
        				</form>
	   			</div>
			</div>
            </div>
            </div>
       		<template v-for="photo in empl.photo">
			<div :id="getphotoid(photo)" class="modal fade">
				<div class="modal-dialog">
						<img :src="photo_url(photo)"></img>
				</div>
			</div>
			</template>
        </div>
    </div>
</template>

<script>

    export default {
    	data(){
    		return {
    			empl: {},
    			is_lastname_view: true,
    			is_firstname_view: true,
    			is_middlename_view: true,
    			is_birthday_view: true,
    			is_deathday_view: true,
    			is_address_view: true,
    			err: null,
    			status: null,
    			image: null,
    			content: null,
    			uploadPhotoButtonStatus: false
    		};
    	},
    	props: ['employee'],
    	mounted() {
    			this.empl = JSON.parse(this.employee);
    	},
    	computed: {
		  /*	has_photo(){
			 	 	 return this.empl.small_photo == null ? false: true;
	 			 },*/
			src() {
			     	if (this.content) {
            					return this.content;
	     			}
	 		}
		},
    	methods:{
			printdate(ddate)
			{
                            if(ddate != null)
			    {
				    var d = new Date(ddate);
				    var options = { year: 'numeric', month: 'long', day: 'numeric' };
				    var dateFormatter = new Intl.DateTimeFormat('ru-RU', options);
				    return dateFormatter.format(d);
			    }
			},
    			getsmallphotoid(photo){
				return "#" + photo.replace('employee_photo/small/', '').replace(/[^a-zA-Z]/g, '');
			},
    			getphotoid(photo){
				return photo.replace('employee_photo/', '').replace(/[^a-zA-Z]/g, '');
			},
    			photo_url(photo){
		 		return "/storage/" + photo;
			},
	    		small_photo_url(photo){
				return "/storage/" + photo;
	 		},
    		   	dropPhoto(photo)
    		   	{
				   	 	if (confirm("Do you want to delete the photo?"))
   	 					{
   		 					axios.post('/dropphoto', {
   	 							smallphoto:photo
   	 						})
							.then(response => {
								this.empl.photo.splice(this.empl.photo.indexOf(response.data.photo), 1);
								this.empl.small_photo.splice(this.empl.small_photo.indexOf(response.data.small_photo), 1);
        					})
        					.catch(error => {
        	    					console.log(error);
        					})
				    		}
	 		},

    		  changePhoto(e) 
    		  {
					e.preventDefault();
        				this.image = e.target.files[0];
        				let reader = new FileReader();
        				reader.onload = this.onImageLoad;
        				reader.readAsDataURL(this.image);
	 		  },
 		  onImageLoad(e)
 		  {
        	 			this.content = e.target.result;
        	 			this.uploadPhotoButtonStatus = true;
     		  },
 		  uploadPhoto()
 		  {
 					let data = new FormData();
					data.append('image', this.image);
					data.append('id', this.empl.id);
					axios.post('/uploadfoto', data)
					.then(response => {
    							this.empl.photo.push(response.data.photo);
							this.empl.small_photo.push(response.data.small_photo);
        				})
        				.catch(error => {
        	    				console.log(error);
        				})
 		  },

    		 cancelEmployee()
    		 {
    		 	this.empl = JSON.parse(this.employee);
			 },
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
    		dropEmployee()
    		{
    			if (confirm("Do you want to delete this employee?"))
    			{
	     		 	axios.post('/dropemployee', {
			                id: this.empl.id
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
				}        		
			 },
    	  	changeBirthday(newdata)
    	  	{
    	  	    	if(newdata != null)
    	  	    	{
						this.empl.birthday = newdata;
					}
   	 				else
   	 				{
						this.empl.birthday = JSON.parse(this.employee).birthday;
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