<template>
  <div id="dp">
        <datepicker :value="ddate" @selected="changeData" :clear-button=true @closed="closeDate"
        :bootstrap-styling=true clear-button-icon="fa fa-times"></datepicker>
  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker'

export default
{
  name: 'dp',
  components: {Datepicker},
  props:['ddate'],
  methods:{
  	changeData (newdate)
  	{
  		if(newdate != null )
  		{
  			this.$emit('changedate', newdate.toLocaleFormat('%Y-%m-%d'))		
  		}
  		else
  		{
  				this.$emit('changedate')		
  		}
  	},
  	closeDate()
  	{
  		this.$emit('closedate');
  	}
  }
}
</script>