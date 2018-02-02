
var rel1 = new Chart(document.getElementById("rel1"), {
	type:'bar',
	//type:'line',
	data:{
		labels:days_list,
		datasets:[{
			label:'Receita',
			data:revenue_list,
			fill:false,
			backgroundColor:'#0000FF',
			borderColor:'#0000FF'
		},
		]
	}
});


var rel2 = new Chart(document.getElementById("rel2"), {
	type:'doughnut',
	data:{
		labels:forma_name_list,
		datasets: [{
			data:forma_list,
			backgroundColor:['#008000', '#0000FF', '#FFA500','#FF0000','#778899']
		}]
	}
});

