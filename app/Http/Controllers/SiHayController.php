<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;
use App\Helpers\CalculoDeFormulas;

class SiHayController extends Controller
{
    /**
     * Display a welcome logo. Entry point.
     *
     * @return \Illuminate\Http\Response
     */
    public function bienvenida(Request $request)
    {
		$request->session()->forget('siHay');
		$sheets = Sheets::spreadsheet(config('sheets.post_spreadsheet_id'))
                        ->sheet(config('sheets.post_sheet_id'))
                        ->get();
		
        $header = [
            'uuid',
            'imc',
			'preferenciaNutricional',
			'objetivo',
			'nombreCompleto',
            'email',
			'informacion',
			'fecha',
        ];

        $posts = Sheets::collection($header, $sheets);
        $posts = $posts->reverse();
        return view('siHay.bienvenida')->with(compact('posts'));
    }
	
	/**
     * Show the step 1 Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function sexo(Request $request)
    {
        $siHay = $request->session()->get('siHay');
        return view('siHay.paso1');
    }

    /**
     * Post Request to store step1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createSexo(Request $request)
    {
        $validatedData = $request->validate([
            'sexo' => 'required'
        ]);
		
        if(empty($request->session()->get('siHay'))){
            $nuevoSiHay = [];
			$nuevoSiHay['sexo'] = $request->input('sexo');
            //array_push($nuevoSiHay, $data);
			//dd($nuevoSiHay);
            $request->session()->put('siHay', $nuevoSiHay);
        }else{
            $actualizarSiHay = $request->session()->get('siHay');
            $actualizarSiHay['sexo'] = $request->input('sexo');
            $request->session()->put('siHay', $actualizarSiHay);
        }

        return redirect('/paso2');

    }	
	
	/**
     * Show the step 2 Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function objetivo(Request $request)
    {
		if (!$request->session()->has('siHay')) {
			return redirect()->route('inicio');
		}
		
        $siHay = $request->session()->get('siHay');
        return view('siHay.paso2');
    }

    /**
     * Post Request to store step1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createObjetivo(Request $request)
    {
        $validatedData = $request->validate([
            'objetivo' => 'required'
        ]);
		
        if(empty($request->session()->get('siHay'))){
            $nuevoSiHay = [];
			$nuevoSiHay['objetivo'] = $request->input('objetivo');
            //array_push($nuevoSiHay, $data);
			//dd($nuevoSiHay);
            $request->session()->put('siHay', $nuevoSiHay);
        }else{
            $actualizarSiHay = $request->session()->get('siHay');
            $actualizarSiHay['objetivo'] = $request->input('objetivo');
            $request->session()->put('siHay', $actualizarSiHay);
        }

        return redirect('/paso3');

    }
	
	/**
     * Show the step 5 Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function preferenciaNutricional(Request $request)
    {
		if (!$request->session()->has('siHay')) {
			return redirect()->route('inicio');
		}
		
        $siHay = $request->session()->get('siHay');
        return view('siHay.paso3');
    }

    /**
     * Post Request to store step4 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createPreferenciaNutricional(Request $request)
    {
        $validatedData = $request->validate([
            'preferenciaNutricional' => 'required'
        ]);
		
        if(empty($request->session()->get('siHay'))){
            $nuevoSiHay = [];
			$nuevoSiHay['preferenciaNutricional'] = $request->input('preferenciaNutricional');
            //array_push($nuevoSiHay, $data);
			//dd($nuevoSiHay);
            $request->session()->put('siHay', $nuevoSiHay);
        }else{
            $actualizarSiHay = $request->session()->get('siHay');
            $actualizarSiHay['preferenciaNutricional'] = $request->input('preferenciaNutricional');
            $request->session()->put('siHay', $actualizarSiHay);
        }

        return redirect('/paso4');

    }
	
	/**
     * Show the step 2 Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function actividadFisica(Request $request)
    {
		if (!$request->session()->has('siHay')) {
			return redirect()->route('inicio');
		}
		
        $siHay = $request->session()->get('siHay');
        return view('siHay.paso4');
    }

    /**
     * Post Request to store step1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createActividadFisica(Request $request)
    {
        $validatedData = $request->validate([
            'actividadFisica' => 'required'
        ]);
		
        if(empty($request->session()->get('siHay'))){
            $nuevoSiHay = [];
			$nuevoSiHay['actividadFisica'] = $request->input('actividadFisica');
            //array_push($nuevoSiHay, $data);
			//dd($nuevoSiHay);
            $request->session()->put('siHay', $nuevoSiHay);
        }else{
            $actualizarSiHay = $request->session()->get('siHay');
            $actualizarSiHay['actividadFisica'] = $request->input('actividadFisica');
            $request->session()->put('siHay', $actualizarSiHay);
        }

        return redirect('/paso5');

    }
	
	
	/**
     * Show the step 4 Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function medida(Request $request)
    {
		if (!$request->session()->has('siHay')) {
			return redirect()->route('inicio');
		}
		
        $siHay = $request->session()->get('siHay');
        return view('siHay.paso5');
    }

    /**
     * Post Request to store step4 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createMedida(Request $request)
    {
        $validatedData = $request->validate([
            'edad' => 'required',
			'estatura' => 'required',
			'peso' => 'required',
        ]);
		
        if(empty($request->session()->get('siHay'))){
            $nuevoSiHay = [];
			$nuevoSiHay['edad'] = $request->input('edad');
			$nuevoSiHay['peso'] = $request->input('peso');
			$nuevoSiHay['estatura'] = $request->input('estatura');
            //array_push($nuevoSiHay, $data);
			//dd($nuevoSiHay);
            $request->session()->put('siHay', $nuevoSiHay);
        }else{
            $nuevoSiHay = $request->session()->get('siHay');
            $nuevoSiHay['edad'] = $request->input('edad');
			$nuevoSiHay['peso'] = $request->input('peso');
			$nuevoSiHay['estatura'] = $request->input('estatura');
            $request->session()->put('siHay', $nuevoSiHay);
        }
		
		$imc = CalculoDeFormulas::imc($nuevoSiHay['peso'], $nuevoSiHay['estatura']);
		$imcClasificacion = CalculoDeFormulas::clasificacionImc($imc);
		$pesoIdeal = CalculoDeFormulas::pesoIdeal($nuevoSiHay['sexo'], $nuevoSiHay['estatura']);
		$bmr = CalculoDeFormulas::paso1CalculoBMR($nuevoSiHay['sexo'], $nuevoSiHay['peso'], $nuevoSiHay['estatura'], $nuevoSiHay['edad']);
		$razonNivelActividad = CalculoDeFormulas::paso2NivelActividad($nuevoSiHay['actividadFisica']);
		$calorias = CalculoDeFormulas::paso3Calorias($bmr, $nuevoSiHay['objetivo'], $razonNivelActividad);
		$macronutrientes = CalculoDeFormulas::macronutrientes($nuevoSiHay['preferenciaNutricional']);
		//dd(['bmr',$bmr], ['razonNivelActividad', $razonNivelActividad], ['calorias',$calorias]);
		
		//transforma camel case a array. perdidaDePeso => ['perdida', 'De', 'Peso']
		$arrObjetivo = preg_split('/(?=[A-Z])/', $nuevoSiHay['objetivo']);
		
		$arrAux = preg_split('/(?=[A-Z])/', $nuevoSiHay['preferenciaNutricional']);
		$preferenciaNutricionalTexto = implode (" ", $arrAux);
		
		//dd($imcClasificacion);
		
		$nuevoSiHay['imc'] = $imc;
		$nuevoSiHay['imcClasificacion'] = $imcClasificacion['texto'];
		$nuevoSiHay['imcColor'] = $imcClasificacion['color'];
		$nuevoSiHay['bmr'] = $bmr;
		$nuevoSiHay['razonNivelActividad'] = $razonNivelActividad;
		$nuevoSiHay['pesoIdeal'] = $pesoIdeal;
		$nuevoSiHay['calorias'] = $calorias;
		$nuevoSiHay['textoCalorias'] = strtoupper("Calorias de ") . strtoupper(implode (" ", $arrObjetivo));
		$nuevoSiHay['macronutrientes'] = $macronutrientes;
		$nuevoSiHay['preferenciaNutricionalTexto'] = $preferenciaNutricionalTexto;
		$nuevoSiHay['preferenciaNutricionalTextoGoogle'] = ucwords($nuevoSiHay['preferenciaNutricionalTexto']);
		$nuevoSiHay['objetivoTextoGoogle'] = ucwords(implode (" ", $arrObjetivo));
		$nuevoSiHay['uuid'] = uniqid();
		
		
		$append = [
			$nuevoSiHay['uuid'],
            $nuevoSiHay['imc'],
            $nuevoSiHay['preferenciaNutricionalTextoGoogle'],
			$nuevoSiHay['objetivoTextoGoogle'],
        ];
		$request->session()->put('siHay', $nuevoSiHay);
        
		Sheets::spreadsheet(config('sheets.post_spreadsheet_id'))
              ->sheet(config('sheets.post_sheet_id'))
              ->append([$append]);
		
		return redirect('/resultados');

    }
	
	
	/**
     * Show the step 5 Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function resultados(Request $request)
    {
		if (!$request->session()->has('siHay')) {
			return redirect()->route('inicio');
		}
		
        $siHay = $request->session()->get('siHay');
        return view('siHay.resultados');
    }

    /**
     * Post Request to store newsletter info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createNewsLetter(Request $request)
    {
        $validatedData = $request->validate([
            'nombreCompleto' => 'required',
			'email' => 'required|email',
			'terminosCondiciones' => 'required'
        ]);
		
        if(empty($request->session()->get('siHay'))){
            $nuevoSiHay = [];
			$nuevoSiHay['email'] = $request->input('email');
			$nuevoSiHay['nombreCompleto'] = $request->input('nombreCompleto');
            $request->session()->put('siHay', $nuevoSiHay);
        }else{
            $nuevoSiHay = $request->session()->get('siHay');
            $nuevoSiHay['email'] = $request->input('email');
			$nuevoSiHay['nombreCompleto'] = $request->input('nombreCompleto');
            $request->session()->put('siHay', $nuevoSiHay);
        }
		
        return redirect('/informacion');

    }
	
	/**
     * Show the step 5 Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function informacion(Request $request)
    {
		if (!$request->session()->has('siHay')) {
			return redirect()->route('inicio');
		}
		
        //$siHay = $request->session()->get('siHay');
        return view('siHay.informacion');
    }

    /**
     * Post Request to store newsletter info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createInformacion(Request $request)
    {
        $validatedData = $request->validate([
            'informacion' => 'required',
        ]);
		if(empty($request->session()->get('siHay'))){
            $nuevoSiHay = [];
			$nuevoSiHay['informacion'] = $request->input('informacion');
            $request->session()->put('siHay', $nuevoSiHay);
        }else{
            $nuevoSiHay = $request->session()->get('siHay');
            $nuevoSiHay['informacion'] = $request->input('informacion');
            $request->session()->put('siHay', $nuevoSiHay);
        }
		
		$informacionTextoGoogle = "";
		$tam = count($nuevoSiHay['informacion']);
		$cont = 1;
		foreach($nuevoSiHay['informacion'] as $val){
			$aux = preg_split('/(?=[A-Z])/', $val);
			$auxA = implode(" ", $aux);
			$informacionTextoGoogle .= ucwords($auxA);
			if($cont < $tam)
				$informacionTextoGoogle = $informacionTextoGoogle . ", ";
			$cont++;
		}
		
		$nuevoSiHay['informacionTextoGoogle'] = $informacionTextoGoogle;
		$request->session()->put('siHay', $nuevoSiHay);
		
		$append = [
			$nuevoSiHay['uuid'],
            $nuevoSiHay['imc'],
            $nuevoSiHay['preferenciaNutricionalTextoGoogle'],
			$nuevoSiHay['objetivoTextoGoogle'],
			$nuevoSiHay['nombreCompleto'],
			$nuevoSiHay['email'],
			$nuevoSiHay['informacionTextoGoogle'],
			now()->toDateTimeString(),
        ];
		
		Sheets::spreadsheet(config('sheets.post_spreadsheet_id'))
              ->sheet(config('sheets.post_sheet_id'))
              ->append([$append]);

        return redirect('/suscrito');

    }
	
	/**
     * Show the step 5 Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function suscrito(Request $request)
    {
		if (!$request->session()->has('siHay')) {
			return redirect()->route('inicio');
		}
		
        //$siHay = $request->session()->get('siHay');
        return view('siHay.suscrito');
    }
}
