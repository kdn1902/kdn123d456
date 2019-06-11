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
      							<a :href=getemployee(props.row.id) class="btn btn-primary" role="button" data-toggle="tooltip" data-placement="left" title="View, Edit, Delete this Employee">Смотреть</a>
    						</div>
	   				</template>
                   </v-server-table>
</template>

<script>
    export default {
    	data(){
		return {
			columns: ['lastname', 'firstname', 'middlename','birthday','deathday', 'address', 'actions'],
        		options: {
        			params: {
					datefields: ['birthday','deathday']
					},
        			headings:{
            				lastname: 'Фамилия',
					firstname: 'Имя',
					middlename: 'Отчество',
					birthday: 'День рождения',
					deathday: 'День смерти',
					address: 'Адрес',
					actions: ''
					},
				requestFunction(data){
					return axios.get(this.url, {
					    params: data
						}).catch(function (e){
						this.dispatch('error', e);
						}.bind(this));
					},
        			texts:{
					filter: "Поиск:",
					filterPlaceholder: "Введите строку",
					limit: "Записей:",
					noResults: "Ничего не найдено",
					count: "Показано с {from} до  {to} из {count} записей|{count} записей|Одна запись",
					first: 'Первая',
					last: 'Последняя',
					page: "Страница:",
					filterBy: "Отсортировано по {column}",
					loading: 'Загрузка...',
					defaultOption: 'Select {column}',
					columns: 'Столбцы'
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
					var options = { year: 'numeric',  month: 'long', day: 'numeric' };
					var dateFormatter = new Intl.DateTimeFormat('ru-RU', options);
					return dateFormatter.format(d)
					// return d.toLocaleFormat('%d %b %Y')
				}
				else
				{
					return null;
				}
			},
			getemployee(id)
			{
				return "/getemployee/" + id;
			},

		}
    }
</script>
