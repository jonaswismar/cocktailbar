$("div.cocktailrating-wrapper-my i").on("mouseover", function () {
		$(this).prevAll().addBack().addClass("fa-solid text-primary").removeClass("fa-regular text-secondary");
		$(this).nextAll().removeClass("fa-solid text-primary").addClass("fa-regular text-secondary");
});
$("div.cocktailrating-wrapper-my i").on("click", function () {
	let myrating = $(this).prevAll().length;
	let cocktailid = $(this).closest("div.cocktailrating-wrapper-my").data("id");
	$(this).prevAll().addBack().addClass("vote-recorded");
	window.location = "cocktailrating_save.php?cocktailid=" + cocktailid + "&rating=" + myrating;
});
$("div.ingredientrating-wrapper-my i").on("mouseover", function () {
		$(this).prevAll().addBack().addClass("fa-solid text-primary").removeClass("fa-regular text-secondary");
		$(this).nextAll().removeClass("fa-solid text-primary").addClass("fa-regular text-secondary");
});
$("div.ingredientrating-wrapper-my i").on("click", function () {
	let myrating = $(this).prevAll().length;
	let ingredientid = $(this).closest("div.ingredientrating-wrapper-my").data("id");
	$(this).prevAll().addBack().addClass("vote-recorded");
	window.location = "ingredientrating_save.php?ingredientid=" + ingredientid + "&rating=" + myrating;
});