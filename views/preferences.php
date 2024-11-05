<?php include("header.php") ?>
<form>
	<fieldset>
		<h5 class="mb-0 mt-5">App Einstellungen</h5>
		<p>Einstellungen rund um das Verhalten der App</p>
		<div class="list-group mb-5 shadow">
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col">
                            <strong class="mb-0">Ignoriere Garnitur</strong>
                            <p class="text-muted mb-0">Wenn gesetzt, werden dekorative Garnituren als optional betrachtet.</p>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="alert1" checked="" />
                                <span class="custom-control-label"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col">
                            <strong class="mb-0">Startseite</strong>
                            <p class="text-muted mb-0">Auswahl welche Seite als Startseite dient.</p>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="alert1" checked="" />
                                <span class="custom-control-label"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col">
                            <strong class="mb-0">Sprache</strong>
                            <p class="text-muted mb-0">Auswahl in welcher Sprache die App läuft.</p>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="alert1" checked="" />
                                <span class="custom-control-label"></span>
                            </div>
                        </div>
                    </div>
                </div>
		<hr class="my-4" />
	</fieldset>
</form>
<?php include("footer.php") ?>