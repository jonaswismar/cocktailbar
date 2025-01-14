$("div.rating-wrapper-my i").on("mouseover", function () {
		$(this).prevAll().addBack().addClass("fa-solid text-primary").removeClass("fa-regular text-secondary");
		$(this).nextAll().removeClass("fa-solid text-primary").addClass("fa-regular text-secondary");
});
$("div.rating-wrapper-my i").on("click", function () {
	let myrating = $(this).prevAll().length;
	let cocktailid = $(this).closest("div.rating-wrapper-my").data("id");
	let userid = $(this).closest("div.rating-wrapper-my").data("user");
	$(this).prevAll().addBack().addClass("vote-recorded");
	window.location = "rating_save.php?cocktailid=" + cocktailid + "&rating=" + myrating + "&userid=" + userid;
});