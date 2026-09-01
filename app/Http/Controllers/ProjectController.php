<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
class ProjectController extends Controller
{
    // estaq funcion muestra la tabla con todos los proyectos
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

 
    public function store(Request $request)
    {
        //1. Validar que los datos lleguen correctamente
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'encargado' => 'required|string|max:255',
            //la imagen frontal normal
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:9122',
            //archivo modelo 3D
            'modelo_3d' => 'nullable|file'
        ]);
        $rutaImagen = null;
        $ruta3d = null;

        //2.Procesar la imagen
       if ($request->hasFile('image')) {
        // Laravel genera el nombre único, lo guarda en storage/app/public/projects/images y devuelve la ruta
        $rutaImagen = $request->file('image')->store('projects/images', 'public');
    }

    if ($request->hasFile('modelo_3d')) {
        // Se guarda en storage/app/public/projects/models3d
        $ruta3d = $request->file('modelo_3d')->store('projects/models3d', 'public');
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
    public function update(Request $request, Project $project )
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'encargado' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'modelo_3d' => 'nullable|file'
            
            ]);
        if ($request->hasFile('image')) {
            // Borra la imagen antigua del storage
            if ($project->image_path) {
                Storage::disk('public')->delete($project->image_path);
            }
            // Guarda la nueva
            $project->image_path = $request->file('image')->store('projects/images', 'public');
        }

        // 2. Procesar el nuevo modelo 3D si se subió uno
        if ($request->hasFile('modelo_3d')) {
            // Borra el modelo 3D antiguo del storage
            if ($project->modelo_3d_ruta) {
                Storage::disk('public')->delete($project->modelo_3d_ruta);
            }
            // Guarda el nuevo
            $project->modelo_3d_ruta = $request->file('modelo_3d')->store('projects/models3d', 'public');
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
        // 1. Eliminar archivos físicos asociados usando Storage
        if ($project->image_path) {
            Storage::disk('public')->delete($project->image_path);
        }
        if ($project->modelo_3d_ruta) {
            Storage::disk('public')->delete($project->modelo_3d_ruta);
        }

        // 2. Borrar el registro de la base de datos
        $project->delete();

        // 3. Recargar la página con mensaje de éxito
        return redirect()->route('projects.index')->with('success', 'El proyecto y archivos  fueron eliminados exitosamente.');
    }
}
