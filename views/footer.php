		</main>
<footer class="footer navbar navbar-dark fixed-bottom bg-primary bg-gradient text-white">
	<p></p>
</footer>
		<script src="../assets/js/auto-resize-textarea.js"></script>
		<script src="../assets/js/bootstrap.bundle.min.js"></script>
		<script src="../assets/js/bootstrap-auto-dark-mode.js"></script>
		<script src="../assets/js/bootstrap-color-modes.js"></script>
		<script src="../assets/js/iconpicker.js"></script>
		<script src="../assets/js/tom-select.complete.min.js"></script>
		<script src="../assets/js/jquery-3.7.1.min.js"></script>
		<script src="../assets/js/rating.js"></script>
		<script>autoResizeTextarea(document.querySelectorAll("textarea.auto-resize"), {maxHeight: 400})</script>
		<script>
			IconPicker.Init({
				jsonUrl: '../assets/json/iconpicker.json',
			});
			IconPicker.Run('#GetIconPicker', function () {
				console.log('Icon Picker');
			});
		</script>
		<script>
			new TomSelect('#input-tags-ingredienttaste-view',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 3,
				render: {
					option: function (data, escape) {
						return `<div><i class="fa-fw ${data.src}"></i>${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div><i class="fa-fw ${item.src}"></i>${item.text}</div>`;
					}
				}
			});
		</script>
		<script>
			new TomSelect('#input-tags-ingredienttaste-edit',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 3,
				render: {
					option: function (data, escape) {
						return `<div><i class="fa-fw ${data.src}"></i>${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div><i class="fa-fw ${item.src}"></i>${item.text}</div>`;
					}
				}
			});
		</script>
		<script>
			new TomSelect('#input-tags-ingredienttype-view',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 3,
				render: {
					option: function (data, escape) {
						return `<div><i class="fa-fw ${data.src}"></i>${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div><i class="fa-fw ${item.src}"></i>${item.text}</div>`;
					}
				}
			});
		</script>
		<script>
			new TomSelect('#input-tags-ingredienttype-edit',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 3,
				render: {
					option: function (data, escape) {
						return `<div><i class="fa-fw ${data.src}"></i>${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div><i class="fa-fw ${item.src}"></i>${item.text}</div>`;
					}
				}
			});
		</script>
		<script>
			new TomSelect('#input-tags-cocktailcategory',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 10,
				render: {
					option: function (data, escape) {
						return `<div><i class="fa-fw ${data.src}"></i>${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div><i class="fa-fw ${item.src}"></i>${item.text}</div>`;
					}
				}
			});
		</script>
		<script>
			new TomSelect('#input-tags-cocktailtaste',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 10,
				render: {
					option: function (data, escape) {
						return `<div><i class="fa-fw ${data.src}"></i>${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div><i class="fa-fw ${item.src}"></i>${item.text}</div>`;
					}
				}
			});
		</script>
	</body>
</html>