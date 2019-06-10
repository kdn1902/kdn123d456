<template>
  <div id="dp">
        <datepicker :value="ddate" @selected="changeData" :clear-button=true @closed="closeDate"
        :bootstrap-styling=true clear-button-icon="fa fa-times" :language="ru" :monday-first=true></datepicker>
  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker'
import {en, ru} from 'vuejs-datepicker/dist/locale'

export default
{
  name: 'dp',
  components: {Datepicker},
  props:['ddate'],
  data () {
    return {
      en: en,
      ru: ru
    }
  },
  methods:{
  	changeData (newdate)
  	{
  		if(newdate != null )
  		{
  			this.$emit('changedate', newdate);
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
  },
  mounted(){
	console.log(ru);
  }
}
</script>