function load_TotalEngineer(){
	$.ajax({
		url : "/dashboard/totalEngineer",
		type: "GET",
		success: function(html){
			$('#changetable').html(html);
		}
	});
}
function load_TotalTeam(){
	$.ajax({
		url : "/dashboard/totalTeam",
		type: "GET",
		success: function(html){
			$('#changetable').html(html);
		}
	});
}
function load_TotalProject(){
	$.ajax({
		url : "/dashboard/totalProject",
		type: "GET",
		success: function(html){
			$('#changetable').html(html);
		}
	});
}
function load_TableTopEngineer(id){
	$.ajax({
		url : "/dashboard/tableTopEngineer",
		type: "GET",
		data: {"id" : ""+id},
		success: function(html){
			$('#changeTopEngineer').html(html);

		}
	});
}
