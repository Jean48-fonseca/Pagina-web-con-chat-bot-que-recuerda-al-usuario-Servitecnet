<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function procesarChat(Request $request)
    {
        $historial = $request->input('historial',[]);

        //llamada a la API de Deepseek
        try{
            // URL de Deepseek usando el modelo Mistral
           $url = 'https://api.deepseek.com/chat/completions';

            // 2. Definimos las reglas de la IA 
            $instruccionDelSistema = [
                [
                    'role' => 'system',
                    'content' => 'Eres el ingeniero virtual experto de ServiTecNet, una empresa especialista en construcción e ingeniería. Tu objetivo es asesorar a los clientes de forma muy profesional, amable y concisa en español. Eres experto y debes promover los siguientes servicios: construcción en general, vaciado de piso, instalación de drywall, tarrajeo, asentamiento de ladrillos y ejecución de proyectos de casas. Tu objetivo es descubrir qué servicio necesita el cliente y dónde. Hazle 2 o 3 preguntas cortas para entender su proyecto. Cuando ya tengas la información clara, no te despidas, en su lugar, tu ÚLTIMO mensaje debe empezar EXACTAMENTE con la etiqueta [WHATSAPP] seguida de un resumen técnico de lo que pide el cliente.'
                ]
            ];

            // 3. FUSIONAMOS la instrucción con la memoria de la conversación (LA CURA DE LA AMNESIA)
            $mensajesParaLaAPI = array_merge($instruccionDelSistema, $historial);

            // 4. Hacemos la petición a DeepSeek enviando TODO el bloque fusionado
            // Nota: Agregué withoutVerifying() por si XAMPP molesta con los certificados SSL
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.deepseek.key'),
                'Content-Type' => 'application/json',
            ])->post($url, [
                'model' => 'deepseek-chat',
                'messages' => $mensajesParaLaAPI, // Aquí inyectamos todo el historial
                'max_tokens' => 250 
            ]);
                if($response->successful()){
                    $data = $response->json();
                    // Huggin faces devuelve el texto dentro de choices -> message -> content
                    $respuestaBot = $data['choices'][0]['message']['content'] ?? 'Lo siento, no pude generar una respuesta.';
               if(str_contains($respuestaBot, '[WHATSAPP]')){
                $resumenLimpio =trim(str_replace('[WHATSAPP]', '',$respuestaBot));
               Lead::create([
                   'resumen_proyecto' => $resumenLimpio,
                   'estado' => 'Pendiente'
               ]);
                }
                return response()->json(['respuesta' => $respuestaBot]);
            } else {
                return response()->json(['respuesta' => 'Error de Deepseek: ' . $response->body()], 500);
            }

        } catch (\Exception $e) {
            return response()->json(['respuesta' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
        
    }
}
