@extends('mecanicienHome.index')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
          <h1 class="text-2xl font-bold mb-6">modify infos</h1>
   
           <form action="{{ route('clients.update', $client->id) }}" method="POST">
               @csrf
               @method('PUT')
   
               <div class="mb-4">
                   <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                   <input type="text" name="nom" id="nom" placeholder="Nom" value="{{ $client->firstName }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
               </div>
   
               <div class="mb-4">
                   <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                   <input type="text" name="prenom" id="prenom" placeholder="Prénom" value="{{ $client->lastName }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
               </div>
   
               <div class="mb-4">
                   <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                   <input type="text" name="adresse" id="adresse" placeholder="Adresse" value="{{ $client->address }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
               </div>
   
               <div class="mb-4">
                   <label for="numero_telephone" class="block text-sm font-medium text-gray-700">Numéro de téléphone</label>
                   <input type="text" name="numero_telephone" id="numero_telephone" placeholder="Numéro de téléphone" value="{{ $client->phoneNumber }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
               </div>
               <button type="submit"
                   class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                   edit
                </button>
           </form>
       </div>
</body>
@endsection