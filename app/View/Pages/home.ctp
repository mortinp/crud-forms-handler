<div id="front-page-bg">
    <div id="navgradient">
        <div id="navbar">
            <nav id="nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#!">
                    <!--<img alt="Logo" src="./TruckPlease - Get quotes from local movers._files/logo-6273ab41968af780b3c919630482922f.png">-->
                        <span class="white"><i class="glyphicon glyphicon-road"></i> <big>Yo</big>Te<big>Llevo</big></span>
                    </a>
                </div>
                <div class="navbar-collapse navbar-ex1-collapse collapse" style="height: 1px; ">
                    <ul class="nav navbar-nav navbar-right">
                        <!--<li><a class="nav-link" href="https://www.truckplease.com/jobs/contents-of-a-2-400-sq-foot-house-including">Example Job</a></li>-->
                        <li><?php echo $this->Html->link(__('Entrar'), array('controller' => 'users', 'action' => 'login'), array('class'=>'nav-link'))?></li>
                        <li><?php echo $this->Html->link(__('Registrarse'), array('controller' => 'users', 'action' => 'register'), array('class'=>'nav-link')) ?></li>
                    </ul>
                </div>
            </nav>
        </div>

    </div>
    <h1 id="sell" class="handwritten white">Desata la creatividad en tus viajes</h1>
    <h2 class="handwritten-2 white">
		  Contacta con uno de nuestros <big><big><span class="text-info"><b>taxis</b></span></big></big> 
		  para moverte por <big><big><span class="text-info"><b>Cuba</b></span></big></big>
    </h2>
    <div style="padding-top:50px">
        <a href="#!" class="btn btn-success show-travel-form" style="font-size:20pt;white-space: normal;max-width:500px">
				Contactar un taxi
            <div style="font-size:12pt;padding-left:50px;padding-right:50px">
			Completa nuestro formulario y acuerda los términos del viaje con tu chofer
            </div>
        </a>
    </div>
</div>

<div class="row sell">
    <div class="col-md-4 center">
        <span class="glyphicon glyphicon-user"></span>
        <span class="glyphicon glyphicon-user"></span>
        <span class="glyphicon glyphicon-user"></span>
        <p class="sell-text">
			Te ponemos en contacto con hasta 3 de nuestros choferes para que acuerdes el viaje directamente con ellos.
        </p>
    </div>
    <div class="col-md-4 center">
        <span class="glyphicon glyphicon-comment"></span>
        <span class="glyphicon glyphicon-usd"></span>
        <p class="sell-text">
			Escoge el chofer que mejor se ajuste a tus requerimientos. Acuerda tus recorridos, horarios y el precio del viaje o ruta.
        </p>
    </div>
    <div class="col-md-4 center">
        <!--<span class="glyphicon glyphicon-road"></span>-->
        <span class="glyphicon glyphicon-briefcase"></span>
        <span class="glyphicon glyphicon-camera"></span>
        <span class="glyphicon glyphicon-music"></span>
        <p class="sell-text">
			Llegado el momento, haz tu viaje de la manera acordada, improvisa en el camino y crea los mejores recuerdos de esta isla fantástica.
        </p>
    </div>
</div>

</br>
<div class="container well" style="padding:15px;background-color:lightskyblue;">
    <div class="row">
        <div id="FormContainer">
            <legend style="text-align:center">
                Crea un Anuncio de Viaje
                <div><small><small>¿Ya estás registrado en <em>YoTeLlevo</em>? <?php echo $this->Html->link(__('Entra y mira tus anuncios'), array('controller' => 'users', 'action' => 'login')) ?></small></small></div>
            </legend>
            <?php echo $this->Session->flash(); ?>
            <!--<form action="/yotellevo/travels/edit/153/153" style="" id="TravelForm" onsubmit="event.returnValue = false; return false;" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="PUT"/></div>        <fieldset>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="col-md-6 inline-input-left">
                                <div class="form-group">
                                    <label for="TravelOrigin">Origen del Viaje</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                        <input name="data[Travel][origin]" class="form-control locality-typeahead" required="required" value="" autofocus="autofocus" type="text" id="TravelOrigin"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 inline-input-right">
                                <div class="form-group">
                                    <label for="TravelDestination">Destino del Viaje</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                        <input name="data[Travel][destination]" class="form-control locality-typeahead" required="required" value="" type="text" id="TravelDestination"/>
                                    </div>
                                </div>
                            </div>
                            <label for="TravelDate">Fecha</label>
                            <div class="form-group input-group required">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                <input name="data[Travel][date]" class="form-control datepicker" dateFormat="dd/mm/yyyy" type="text" value="" id="TravelDate" required="required"/>

                            </div>
                            <div class="form-group required">
                                    <label for="TravelPeopleCount">Personas que viajan</label>
                                <input name="data[Travel][people_count]" class="form-control" min="1" type="number" value="0" id="TravelPeopleCount" required="required"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label for="TravelContact">Información de Contacto</label>
                                <textarea name="data[Travel][contact]" class="form-control" placeholder="Explica a los choferes la forma de contactarte (número de teléfono, correo electrónico o cualquier otra forma que prefieras). Escribe algo como: llamar al teléfono 12-3456 a Pepito." cols="30" rows="6" id="TravelContact" required="required"></textarea>
                            </div>
                            <div style="clear:both;height:100%;overflow:auto;padding-bottom:10px">
                                <div>
                                        <label>Preferencias</label>
                                </div>
                                <div style="padding-right:10px;float:left">
                                    <input type="hidden" name="data[Travel][need_modern_car]" id="TravelNeedModernCar_" value="0"/>
                                    <input type="checkbox" name="data[Travel][need_modern_car]"  value="1" id="TravelNeedModernCar"/> Auto Moderno
                                </div>
                                <div style="padding-right:10px;float:left">
                                    <input type="hidden" name="data[Travel][need_air_conditioner]" id="TravelNeedAirConditioner_" value="0"/>
                                    <input type="checkbox" name="data[Travel][need_air_conditioner]"  value="1" id="TravelNeedAirConditioner"/> Aire Acondicionado
                                </div>
                            </div>
                            <input type="hidden" name="data[Travel][id]" class="form-control" value="" id="TravelId"/>
                        </div>	
                    </div>
                    <div class="submit col-md-6 col-md-offset-3">
                        <a href="javascript:void" class="btn btn-primary" style="font-size:18pt;white-space: normal;" id="TravelSubmit" onclick="form=get_form(this);if($(form).valid())form.submit();return false;">
								Crear Anuncio
                            <div style='font-size:12pt;padding-left:50px;padding-right:50px'>
								Enseguida contactarás con hasta 3 de nuestros choferes
                            </div>
                        </a>
                    </div>
            </form>-->
            <?php echo $this->element('pending_travel_form', array('bigButton'=>true, 'horizontal'=>true)); ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.show-travel-form').click(function() {
            $('html, body').animate({
                scrollTop: $('#FormContainer').offset().top
            }, 300);
            $('#TravelOrigin').focus();
        });
    });
</script>