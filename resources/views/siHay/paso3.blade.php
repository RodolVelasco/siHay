@extends('layout.layout')

@push('styles')
<style>
	input[type="radio"]:checked ~ .icon:before {
		content: '';
		position: absolute;
		top: 4px; left: 4px; right: 4px; bottom: 0;
		z-index: -1;
		border-radius: 50%;
		background: linear-gradient(90deg, #EA7C68 0%, #7B5191 40.21%, #7B5191 61.86%, #58B2D0 100%);
	}
	
	button {
		color: white;
		border-radius: 0.75rem;
		background: linear-gradient(90deg, #E287AE 0%, #B08FB9 100%);
	}
	
	button:disabled {
		opacity: 0.5;
		cursor: not-allowed;
	}
</style>

@endpush

@section('content')
	@if(config('app.debug') == true)
	<div class="absolute top-0 left-0 bg-gray-100 border">
		<h1 class="border-b pb-2 text-center font-bold p-3 mb-3">
			Debugging Information
		</h1>
		@if(Session::has('siHay'))
			<ul class="p-3">
				@foreach(Session::get('siHay') as $key => $item)
					@if (is_string($key) && is_string($item))
						<li>{{ $key }}: {{ $item }}</li>
					@endif
				@endforeach
			</ul>
		@endif
	</div>
	@endif
    <form id="nutrition-preferences" action="{{ url('paso3') }}" method="post" class="flex flex-col items-center w-full">
        {{ csrf_field() }}
		<div class="mb-8 w-full">
			<h1 class="text-2xl text-center mb-10">Preferencias Nutricionales</h1>
			<div class="flex flex-col justify-around">
				{{-- First Row of options --}}
				<div class="flex justify-around mb-6">
					<div>
						
						<label for="vegan" class="flex items-center flex-col cursor-pointer">
							<input
							   class="hidden"
							   type="radio"
							   name="preferenciaNutricional"
							   id="vegan"
							   value="vegan" 
							   @if(isset($siHay->preferenciaNutricional) && $sihay->preferenciaNutricional == 'vegan')
								   selected 
							   @endif
							/>
							<div class='icon relative mb-4'>
								<img src="{{ asset('/svg/vegan.svg') }}" alt="Icono de veganismo" />
							</div>
							Vegan
						</label>
					</div>
					<div>
						<label for="keto" class="flex items-center flex-col cursor-pointer">
							<input
								   class="hidden"
								   type="radio"
								   name="preferenciaNutricional"
								   id="keto"
								   value="keto" 
								   @if(isset($siHay->preferenciaNutricional) && $sihay->preferenciaNutricional == 'keto')
									   selected 
								   @endif
							/>
							<div class='icon relative mb-4'>
								<img src="{{ asset('/svg/keto.svg') }}" alt="Icono de dieta Keto" />
							</div>
							Keto
						</label>
					</div>
				</div>
				
				{{-- Second Row of options --}}
				<div class="flex justify-around mb-6">
					<div>
						<label for="sugarFree" class="flex items-center flex-col cursor-pointer">
							<input
								   class="hidden"
								   type="radio"
								   name="preferenciaNutricional"
								   id="sugarFree"
								   value="sugarFree" 
								   @if(isset($siHay->preferenciaNutricional) && $sihay->preferenciaNutricional == 'sugarFree')
									   selected 
								   @endif
							/>
							<div class='icon relative mb-4'>
								<img src="{{ asset('/svg/sugar-free.svg') }}" alt="Icono de libre de azucar" />
							</div>
							Sugar Free
						</label>
					</div>
					<div>
						<label for="glutenFree" class="flex items-center flex-col cursor-pointer">
							<input
								   class="hidden"
								   type="radio"
								   name="preferenciaNutricional"
								   id="glutenFree"
								   value="glutenFree" 
								   @if(isset($siHay->preferenciaNutricional) && $sihay->preferenciaNutricional == 'glutenFree')
									   selected 
								   @endif
							/>
							<div class='icon relative mb-4'>
								<img src="{{ asset('/svg/gluten-free.svg') }}" alt="Icono de dieta sin gluten" />
							</div>
							Gluten Free
						</label>
					</div>
				</div>
				
				{{-- Third Row of options --}}
				<div class="flex justify-around mb-6">
					<div>
						<label for="veggie" class="flex items-center flex-col cursor-pointer">
							<input
								   class="hidden"
								   type="radio"
								   name="preferenciaNutricional"
								   id="veggie"
								   value="veggie" 
								   @if(isset($siHay->preferenciaNutricional) && $sihay->preferenciaNutricional == 'veggie')
									   selected 
								   @endif
							/>
							<div class='icon relative mb-4'>
								<img src="{{ asset('/svg/veggie.svg') }}" alt="Icono de vegetales" />
							</div>
							Veggie
						</label>
					</div>
					<div>
						<label for="ninguno" class="flex items-center flex-col cursor-pointer">
							<input
								   class="hidden"
								   type="radio"
								   name="preferenciaNutricional"
								   id="ninguno"
								   value="ninguno" 
								   @if(isset($siHay->preferenciaNutricional) && $sihay->preferenciaNutricional == 'ninguno')
									   selected 
								   @endif
							/>
							<div class='icon relative mb-4'>
								<img src="{{ asset('/svg/no-preference.svg') }}" alt="Icono de ninguna preferencia" />
							</div>
							Ninguno
						</label>
					</div>
				</div>
			</div>
		</div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
		<button type="submit" class="py-1 px-8 focus:outline-none focus:shadow-outline" disabled>Siguiente</button>
    </form>
@endsection

@push('scripts')
<script>
	$(function() {
		function checkDietPicker() {
			if ($('input[name="preferenciaNutricional"]').is(':checked')) {
				$('button[type="submit"]').attr('disabled', false)
			} else {
				$('button[type="submit"]').attr('disabled', true)
			}
		}

		checkDietPicker()

		$('#nutrition-preferences').on('change', function() {
			checkDietPicker()
		})
	})
</script>
@endpush