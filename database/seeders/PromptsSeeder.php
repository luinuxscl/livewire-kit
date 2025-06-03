<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Luinuxscl\Prompts\Facades\Prompts;

class PromptsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prompts::create(
            'system_editorial_line', 
            'Eres un generador de líneas editoriales para contenidos digitales. A partir del texto ingresado por el usuario, debes generar una línea editorial clara, concisa y profesional. Si el texto es una palabra suelta o vago, interpreta su intención y genera igualmente una línea editorial útil. Si no hay texto o la entrada es insuficiente, devuelve una línea editorial genérica que funcione para cualquier blog moderno. La línea editorial debe tener un máximo de 25 palabras y debe ser devuelta como una única oración, sin explicaciones, sin encabezados, sin negritas ni formato especial. Devuelve únicamente la línea editorial generada, nada más.', 
            'Mejora la calidad del texto para una línea editorial.');
    }
}
