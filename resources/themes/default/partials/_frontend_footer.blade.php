		<div class="row">
			<div class="col-md-12">
				  @if(count($links))<img alt="Bootstrap Image Preview" src="/upload/banner/@if(!is_null($links{0}->url)){{$links{0}->url}}@endif" class="img-rounded text-center img-responsive">@endif
			</div>
		</div>
		<div class="row" style="padding-top: 15px">
			<div class="col-md-5">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4609.745778194293!2d-45.26084228446926!3d-21.69866770133328!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cadce11c1b7a85%3A0x2720a00a85a7f34c!2sCol%C3%A9gio+Uni%C3%A3o+-+Unidade+II!5e1!3m2!1spt-BR!2sbr!4v1473357815573" width="460" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
			<div class="col-md-7">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<h4 style="color: black;">Endereço:</h4><br><br>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
						<address>
							<strong>Unidade I:</strong><br>
							Avenida do Centenário, 670, Parque Bandeirantes<br>
							37410-000 Três Corações - MG<br>
							Telefone: (35) 3232-4605
						</address>
							</div>
							<div class="col-md-6">
						<address>
							<strong>Unidade II:</strong><br>
							Avenida 7 de Setembro, 424, Centro<br>
							37410-000 Três Corações - MG<br>
							Telefone: (35) 3231-3554
						</address> 
							</div>
						</div>
					</div>
				</div>	
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4 col-xs-4" style="text-align: center;">
								@if(count($links))<a href="@if(!is_null($links{1}->url)){{$links{1}->url}}@endif" target="_blank"><span class="hb hb-xs spin"><i class="fa fa-facebook"></i></span></a>@endif
							</div>
							<div class="col-md-4 col-xs-4" style="text-align: center;">
								@if(count($links))<a href="@if(!is_null($links{2}->url)){{$links{2}->url}}@endif" target="_blank"><span class="hb hb-xs spin"><i class="fa fa-instagram"></i></span></a>@endif
							</div>
							<div class="col-md-4 col-xs-4" style="text-align: center;">
								@if(count($links))<a href="@if(!is_null($links{3}->url)){{$links{3}->url}}@endif" target="_blank"><span class="hb hb-xs spin"><i class="fa fa-youtube"></i></span></a>@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="jumbotron jumbotron_height">
					<p class="text-center" style="font-size: 14px; color: black;"><strong>Copyright &copy; 2016<a href="http://www.azagga.com.br/" style="color: white;">A/Zagga Comunicação</a>.</strong> Todos os direitos reservados.</p>
				</div>
			</div>
		</div>
		<!-- jQuery 2.1.4 -->
		<script src="{{ asset ("/bower_components/admin-lte/plugins/jQuery/jQuery-2.1.4.min.js") }}" type="text/javascript"></script>
		<script src="{{ asset ("/bower_components/admin-lte/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js" type="text/javascript"></script>
		<script src="{{ asset ('/js/hexagons.min.js') }}" type="text/javascript"></script>
		<script type="text/javascript">
		  $(document).ready(function(){
			$('.carousel').carousel({
			  interval: 5000
			})
		  });
		  $('.box-body').matchHeight();
		  $('.box-heading').matchHeight();
		  $('.box-atividadesc').matchHeight();
		  $('.box-atividadesf').matchHeight();
		</script>
		@yield('footer_extra')

