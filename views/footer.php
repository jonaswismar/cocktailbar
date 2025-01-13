		</main>
		<footer class="footer navbar navbar-dark fixed-bottom bg-primary bg-gradient text-white">
			<p><?php $stmt_sql_currentbar_data = mysqli_prepare($link, $sql_currentbar_data);
				mysqli_stmt_bind_param($stmt_sql_currentbar_data, "i", $_SESSION["bar"]);
				mysqli_stmt_execute($stmt_sql_currentbar_data);
				$currentbar_data_all_res=mysqli_stmt_get_result($stmt_sql_currentbar_data);
				while($currentbar_data_all_rows= mysqli_fetch_array($currentbar_data_all_res, MYSQLI_ASSOC)){
					echo 	'<i class="' . $currentbar_data_all_rows['icon'] . '"></i> ' . $currentbar_data_all_rows['barname'];
				}
				mysqli_stmt_close($stmt_sql_currentbar_data);
				mysqli_close($link);
			?></p>
		</footer>
		<script src="../assets/js/auto-resize-textarea.js"></script>
		<script src="../assets/js/bootstrap.bundle.min.js"></script>
		<!--<script src="../assets/js/bootstrap-auto-dark-mode.js"></script>-->
		<script src="../assets/js/bootstrap-color-modes.js"></script>
		<script src="../assets/js/tom-select.complete.min.js"></script>
		<script src="../assets/js/jquery-3.7.1.min.js"></script>
		<script src="../assets/js/rating.js"></script>
		<script>
			window.onload = function() {
				document.documentElement.setAttribute("data-bs-theme", '<?php echo $_SESSION["darkmode"]; ?>');
			};
		</script>
		<script>autoResizeTextarea(document.querySelectorAll("textarea.auto-resize"), {maxHeight: 400})</script>
<?php if($current_file_name == "ingredient.php"){
	echo "		<script>
			new TomSelect('#input-tags-ingredienttaste-new',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 10,
				render: {
					option: function (data, escape) {
						return `<div><i class=\"fa-fw \${data.src}\"></i>\${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div><i class=\"fa-fw \${item.src}\"></i>\${item.text}</div>`;
					}
				}
			});
		</script>
		<script>
			new TomSelect('#input-tags-ingredienttaste-view',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 10,
				render: {
					option: function (data, escape) {
						return `<div><i class=\"fa-fw \${data.src}\"></i>\${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div><i class=\"fa-fw \${item.src}\"></i>\${item.text}</div>`;
					}
				}
			});
		</script>
		<script>
			new TomSelect('#input-tags-ingredienttaste-edit',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 10,
				render: {
					option: function (data, escape) {
						return `<div><i class=\"fa-fw \${data.src}\"></i>\${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div><i class=\"fa-fw \${item.src}\"></i>\${item.text}</div>`;
					}
				}
			});
		</script>
		<script>
			new TomSelect('#input-tags-ingredienttype-new',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 1,
				render: {
					option: function (data, escape) {
						return `<div><i class=\"fa-fw \${data.src}\"></i>\${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div><i class=\"fa-fw \${item.src}\"></i>\${item.text}</div>`;
					}
				}
			});
		</script>
		<script>
			new TomSelect('#input-tags-ingredienttype-view',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 1,
				render: {
					option: function (data, escape) {
						return `<div><i class=\"fa-fw \${data.src}\"></i>\${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div><i class=\"fa-fw \${item.src}\"></i>\${item.text}</div>`;
					}
				}
			});
		</script>
		<script>
			new TomSelect('#input-tags-ingredienttype-edit',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 1,
				render: {
					option: function (data, escape) {
						return `<div><i class=\"fa-fw \${data.src}\"></i>\${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div><i class=\"fa-fw \${item.src}\"></i>\${item.text}</div>`;
					}
				}
			});
		</script>";
}
?>
<?php if($current_file_name == "cocktail.php"||$current_file_name == "specials.php"){
	echo "		<script>
			new TomSelect('#input-tags-cocktailcategory-new',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 10,
				render: {
					option: function (data, escape) {
						return `<div><i class=\"fa-fw \${data.src}\"></i>\${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div><i class=\"fa-fw \${item.src}\"></i>\${item.text}</div>`;
					}
				}
			});
		</script>
		<script>
			new TomSelect('#input-tags-cocktailcategory-view',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 10,
				render: {
					option: function (data, escape) {
						return `<div><i class=\"fa-fw \${data.src}\"></i>\${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div><i class=\"fa-fw \${item.src}\"></i>\${item.text}</div>`;
					}
				}
			});
		</script>
		<script>
			new TomSelect('#input-tags-cocktailcategory-edit',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 10,
				render: {
					option: function (data, escape) {
						return `<div><i class=\"fa-fw \${data.src}\"></i>\${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div><i class=\"fa-fw \${item.src}\"></i>\${item.text}</div>`;
					}
				}
			});
		</script>
		<script>
			new TomSelect('#input-tags-cocktailtaste-new',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 10,
				render: {
					option: function (data, escape) {
						return `<div><i class=\"fa-fw \${data.src}\"></i>\${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div><i class=\"fa-fw \${item.src}\"></i>\${item.text}</div>`;
					}
				}
			});
		</script>
		<script>
			new TomSelect('#input-tags-cocktailtaste-view',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 10,
				render: {
					option: function (data, escape) {
						return `<div><i class=\"fa-fw \${data.src}\"></i>\${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div><i class=\"fa-fw \${item.src}\"></i>\${item.text}</div>`;
					}
				}
			});
		</script>
		<script>
			new TomSelect('#input-tags-cocktailtaste-edit',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 10,
				render: {
					option: function (data, escape) {
						return `<div><i class=\"fa-fw \${data.src}\"></i>\${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div><i class=\"fa-fw \${item.src}\"></i>\${item.text}</div>`;
					}
				}
			});
		</script>";
		}
?>
<?php if($current_file_name == "cocktailingredient.php"){
	echo "		<script>
			new TomSelect('#input-tags-ingredient-new',{
				plugins: ['clear_button','remove_button','input_autogrow'],
				persist: false,
				create: false,
				maxItems: 10,
				render: {
					option: function (data, escape) {
						return `<div>\${data.text}</div>`;
					},
					item: function (item, escape) {
						return `<div>\${item.text}</div>`;
					}
				}
			});
		</script>";
		}
?>
	</body>
</html>