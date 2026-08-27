<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use hasFactory;
class ProjectController extends Controller
{
    //linea para q funcione el create
    protected $fillable=['title','description','image_path'];

    // estaq funcion muestra la tabla con todos los proyectos
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //1. Validar que los datos lleguen correctamente
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'encargado' => 'required|string|max:255',
            //la imagen frontal normal
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp |max:9122',
            //archivo modelo 3D
            'modelo_3d' => 'nullable|file'
        ]);
        $rutaImagen = null;
        $ruta3d = null;

        //2.Procesar la imagen
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            //se crea nombre unico usando la hora de creacion para evitar sobreescritura de imagen
            $imageName =time() . '.' . $image->getClientOriginalExtension();

            //La foto se guarda fisicamente en public/images/projects
            $image->move(public_path('images/projects'), $imageName);

            // Guardar la ruta  en una variable de la base de datos
            $rutaImagen = 'images/projects/' . $imageName;
        }
        //procesar el modelo 3D
        if ($request->hasFile('modelo_3d')){
            $modelo = $request->file('modelo_3d');
            //el prefijo '3d_' facilita su identificación
            $modeloName = '3d_' . time(). '.' . $modelo->getCLientOriginalExtension();
            $modelo->move(public_path('models3d'), $modeloName);
            $ruta3d = 'models3d/' . $modeloName;
            }
            $es_destacado = $request->has('es_destacado') ? 1 : 0;
        // 3. Guardar todo en la base de datos
        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'encargado' => $request->encargado,
            'image_path' => $rutaImagen,
            'modelo_3d_ruta' => $ruta3d,
            'es_destacado' => $es_destacado,
        ]);
        //4. redirige al usuario al formulario con mensaje de éxito
        return redirect()->route('projects.index')->with('success', '¡El proyecto se ha subido correctamente al portafolio!');
        
        }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view ('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, )
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'encargado' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'modelo_3d' => 'nullable|file'
            
            ]);
        if ($request->hasFile('image')) {
            // 1. Borrar la imagen anterior si existe
            {
                $oldImagePath = public_path($project->image_path);
                if ($project->image_path && file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // 2. Procesar la nueva imagen
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path('images/projects'), $imageName);
            //actualizamos la ruta en el proyecto
            $project->image_path = 'images/projects/' . $imageName;
        }
        //bloque modelo 3d
        if ($request->hasFile('modelo_3d')) {
            // Borrar el modelo 3D anterior si existe para ahorrar espacio
            $oldModelPath = public_path($project->modelo_3d_ruta);
            if ($project->modelo_3d_ruta && file_exists($oldModelPath)) {
                unlink($oldModelPath);
            }
            // Procesar el nuevo modelo 3D
            $modelo = $request->file('modelo_3d');
            $modeloName = '3d_' . time() . '.' . $modelo->getClientOriginalExtension();
            $modelo->move(public_path('models3d'), $modeloName);
            
            // Actualizamos la ruta SOLO del modelo 3D
            $project->modelo_3d_ruta = 'models3d/' . $modeloName;
        }
        //Actualizamos los textos
        $project->title = $request->title;
        $project->description = $request->description;
        $project->encargado = $request->encargado;
        $project->es_destacado = $request->has('es_destacado') ? 1 : 0;
        //guardamos los cambio
        $project->save();
        //redirige al usuario al panel con un mensake de exito
        return redirect()->route('projects.index')->with('success', '¡Proyecto editado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // 1. Buscar la foto física en la carpeta y borrarla para liberar espacio
        $imagePath = public_path($project->image_path);
        
        if ($project->image_path && file_exists(public_path($project->$imagePath))) {
            unlink(public_path($project->image_path));
        }
        if ($project->modelo_3d_ruta && file_exists(public_path($project->modelo_3d_ruta))){
            unlink(public_path($project->modelo_3d_ruta));
        }

        // 2. Borrar el registro de la base de datos
        $project->delete();

        // 3. Recargar la página con mensaje de éxito
        return redirect()->route('projects.index')->with('success', 'El proyecto y archivos  fueron eliminados exitosamente.');
    }
}
