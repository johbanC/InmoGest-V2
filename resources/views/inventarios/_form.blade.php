@csrf

<label class="upprcase text-gray-700 text-ux">Titulo</label>
<span class="text-xs text-red-600">@error('title') {{ $message }} @enderror</span>
<input type="text" name="title" class="rounded border-gray-200 w-full mb-4" value="{{ old('title', $post->title) }}">


<label class="upprcase text-gray-700 text-ux">Slug</label>
<span class="text-xs text-red-600">@error('slug') {{ $message }} @enderror</span>
<input type="text" name="slug" class="rounded border-gray-200 w-full mb-4" value="{{ old('slug', $post->slug) }}">

<label class="upprcase text-gray-700 text-ux">Contenido</label>
<span class="text-xs text-red-600">@error('body') {{ $message }} @enderror</span>
<textarea name="body" rows="5" class="rounded border-gray-200 w-full">{{ old('body', $post->body) }}</textarea>


<div class="flex justify-between intems-center ">
    <a href="{{ route('posts.index') }}" class="text-indigo-600">Volver</a>

    <input type="submit" value="Enviar" class="bg-gray-800 text-white rounded px-4 py-2">

</div>