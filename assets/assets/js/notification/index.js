$(document).ready(function(){
	$(".notif-item").click(function(){
      var ID=$(this).attr('id');
      $.ajax({
            type: 'POST',
            url: '/gsm/notification/item_clicked/',
            data: {id : ID},
            success: function(data) {
            	$("#item-"+ID).toggleClass("bg-grey");
            	$("#item-"+ID).removeClass("bg-yellow");
            	$(this).removeClass("notif-item");
            	$(this).toggleClass("notif-detail");
                $("#notif-detail").html('<img src="assets/images/loading.gif"> loading...').load('notification/detail/'+ID);
                $("#notif-badge").load('notification/load_badge');
            }
        });
     });

	$(".notif-detail").click(function(){
      var ID=$(this).attr('id');
      $("#notif-detail").html('<img src="assets/images/loading.gif"> loading...').load('notification/detail/'+ID);
  });
});