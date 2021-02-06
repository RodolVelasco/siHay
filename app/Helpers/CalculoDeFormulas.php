<?php

namespace App\Helpers;

class CalculoDeFormulas
{
    public static function textoHaciaMayusculas(string $string)
    {
        return strtoupper($string);
    }
	
	
	/*
		peso en kg
		estatura en metro
	*/
	public static function imc(float $peso, int $estatura)
    {
		$imc = round($peso / pow(self::conversorCmsHaciaMts($estatura), 2), 2);
        return $imc;
    }
	
	public static function conversorCmsHaciaMts(int $estaturaCms)
	{
		$estaturaMts = round($estaturaCms / 100, 2);
		return $estaturaMts;
	}
	
	public static function clasificacionImc(int $imc)
	{
		$imcArray = [];
		if($imc >= 0 && $imc <= 18.49) {
			$imcArray = [
				'texto' => "Delgadez extrema",
				'color' => "#00FFFF"
			];
			return $imcArray;
		}
		if($imc >= 18.50 && $imc <= 24.99){
			$imcArray = [
				'texto' => "Peso normal",
				'color' => "#6EFF7C"
			];
			return $imcArray;
		}
		if($imc >= 25 && $imc <= 29.99){
			$imcArray = [
				'texto' => "Sobrepeso",
				'color' => "#ff6600"
			];
			return $imcArray;
		}
		if($imc >= 30 && $imc <= 34.99){
			$imcArray = [
				'texto' => "Obesidad 1",
				'color' => "#ff0000"
			];
			return $imcArray;
		}
		if($imc >= 35 && $imc <= 39.99){
			$imcArray = [
				'texto' => "Obesidad 2",
				'color' => "#ff0000"
			];
			return $imcArray;
		}
		if($imc >= 40){
			$imcArray = [
				'texto' => "Obesidad 3",
				'color' => "#ff0000"
			];
			return $imcArray;
		}
		
		if($imcArray == null) {
			$imcArray = [
				'texto' => "IMC no entra en rangos de clasificación",
				'color' => "#ff0000"
			];
		}
		
		return $imcArray;
	}
	
	/*
		$estatura en cms
	*/
	public static function paso1CalculoBMR(string $sexo, float $peso, float $estatura, int $edad)
	{
		$bmr = 0;
		if($sexo == "Femenino"){
			$bmr = 655 + (9.6 * $peso) + (1.8 * $estatura) - (4.7 * $edad);
		}
		if($sexo == "Masculino"){
			$bmr = 66 + (13.7 * $peso) + (5 * $estatura) - (6.75 * $edad);
		}
		
		return $bmr;
	}
	
	public static function paso2NivelActividad(string $nivelActividad)
	{
		$razonNivelActividad = 0;
		if($nivelActividad == "sedentario")
			$razonNivelActividad = 1.2;
		
		if($nivelActividad == "levementeActivo")
			$razonNivelActividad = 1.55;
		
		if($nivelActividad == "activo")
			$razonNivelActividad = 1.725;
			
		if($nivelActividad == "altamenteActivo")
			$razonNivelActividad = 1.9;
		
		return $razonNivelActividad;
	}
	
	public static function paso3Calorias(float $bmr, string $objetivo, float $razonNivelActividad)
	{
		$calorias = 0;
		if($objetivo == "mantenimiento")
			$calorias = $bmr * $razonNivelActividad;
		
		if($objetivo == "perdidaDePesoLeve")
			$calorias = ($bmr * $razonNivelActividad) * 0.78;
		
		if($objetivo == "perdidaDePesoAlta")
			$calorias = ($bmr * $razonNivelActividad) * 0.53;
		
		return (int) $calorias;
	}
	
	public static function pesoIdeal(string $sexo, float $estatura)
	{
		$pesoIdeal = 0;
		if($sexo == "Femenino")
			$pesoIdeal = 0.67 * $estatura - 52;
		
		if($sexo == "Masculino")
			$pesoIdeal = 0.75 * $estatura - 62.5;
		
		return $pesoIdeal;
	}
	
	public static function macronutrientes(string $preferenciaNutricional)
	{
		$array = [];
		if($preferenciaNutricional == "vegan") {
			$array = [
				'carbohidratos' => 50,
				'proteina' => 15,
				'grasas' => 35
			];
		}
		if($preferenciaNutricional == "keto") {
			$array = [
				'carbohidratos' => 5,
				'proteina' => 35,
				'grasas' => 60
			];
		}
		if($preferenciaNutricional == "sugarFree") {
			$array = [
				'carbohidratos' => 55,
				'proteina' => 15,
				'grasas' => 30
			];
		}
		if($preferenciaNutricional == "glutenFree") {
			$array = [
				'carbohidratos' => 20,
				'proteina' => 45,
				'grasas' => 35
			];
		}
		if($preferenciaNutricional == "veggie") {
			$array = [
				'carbohidratos' => 45,
				'proteina' => 25,
				'grasas' => 30
			];
		}
		if($preferenciaNutricional == "ninguno") {
			$array = [
				'carbohidratos' => 45,
				'proteina' => 40,
				'grasas' => 15
			];
		}
		
		return $array;
	}
}