@extends('layout.layout')

@push('styles')
<style>
	input[type="radio"]:checked ~ .icon:before {
		content: '';
		position: absolute;
		top: 5px; left: 5px; right: 5px; bottom: 4px;
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
    <form id="sex-picker" action="{{ url('paso1') }}" method="post" class="flex flex-col items-center w-full">
        {{ csrf_field() }}
        <div class="mb-8 w-full">
            <h1 class="text-2xl text-center mb-10">¿Cuál es tu sexo?</h1>
			<div class="flex justify-around">
				<div>
					<label for="masculino" class="flex items-center flex-col cursor-pointer">
						<input
							   class="hidden"
							   type="radio"
							   name="sexo"
							   id="masculino"
							   value="Masculino" 
							   @if(isset($siHay->sexo) && $sihay->sexo == 'Masculino')
								   selected 
							   @endif
						/>
						<div class='icon relative mb-4'>
							<img src="{{ asset('/svg/male-symbol.svg') }}" alt="Icono del simbolo masculino" />
						</div>
						Masculino
					</label>
				</div>
				<div>
					<label for="femenino" class="flex items-center flex-col cursor-pointer">
						<input
							   class="hidden"
							   type="radio"
							   name="sexo"
							   id="femenino"
							   value="Femenino" 
							   @if(isset($siHay->sexo) && $sihay->sexo == 'Femenino')
								   selected 
							   @endif
						/>
						<div class="icon relative mb-4">
							<img src="{{ asset('/svg/female-symbol-icon.svg') }}" alt="Icono del simbolo femenino" />
						</div>
						Femenino
					</label>
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
		function checkSexPicker() {
			if ($('input[name="sexo"]').is(':checked')) {
				$('button[type="submit"]').attr('disabled', false)
			} else {
				$('button[type="submit"]').attr('disabled', true)
			}
		}

		checkSexPicker()

		$('#sex-picker').on('change', function() {
			checkSexPicker()
		})
	})
</script>
@endpush