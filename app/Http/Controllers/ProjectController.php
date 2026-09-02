<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

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
        // Validar que los datos lleguen correctamente
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

       // 1. Subir imagen a Cloudinary
        if ($request->hasFile('image')) {
            $rutaImagen = cloudinary()->upload($request->file('image')->getRealPath(), [
                'folder' => 'servitecnet/images'
            ])->getSecurePath();
        }

        // 2. Subir modelo 3D a Cloudinary (resource_type auto es vital para .glb)
        if ($request->hasFile('modelo_3d')) {
            $ruta3d = cloudinary()->upload($request->file('modelo_3d')->getRealPath(), [
                'folder' => 'servitecnet/models3d',
                'resource_type' => 'auto'
            ])->getSecurePath();
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
        // 1. Subir nueva imagen a Cloudinary si existe
        if ($request->hasFile('image')) {
            $project->image_path = cloudinary()->upload($request->file('image')->getRealPath(), [
                'folder' => 'servitecnet/images'
            ])->getSecurePath();
        }

        // 2. Subir nuevo modelo 3D a Cloudinary si existe
        if ($request->hasFile('modelo_3d')) {
            $project->modelo_3d_ruta = cloudinary()->upload($request->file('modelo_3d')->getRealPath(), [
                'folder' => 'servitecnet/models3d',
                'resource_type' => 'auto'
            ])->getSecurePath();
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
        $project->delete();

        // 3. Recargar la página con mensaje de éxito
        return redirect()->route('projects.index')->with('success', 'El proyecto fue eliminado exitosamente.');
    }
}
