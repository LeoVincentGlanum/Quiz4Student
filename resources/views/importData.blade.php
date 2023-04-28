
@extends(backpack_view('blank'))

@section('content')

    <div class="container">
        <h3>Importer les concepts</h3>

        <p>Sélectionnez un fichier Excel (.xlsx) pour importer les données

        <form method="POST" action="{{ route('excel.import') }}" enctype="multipart/form-data" >

            <!-- CSRF Token -->
            @csrf

            <input type="file" name="fichier" >

            <button type="submit" >Importer</button>

        </form>


        <h3 class="mt-5">Importer les cours</h3>

        <p>Sélectionnez un fichier Excel (.xlsx) pour importer les données

        <form method="POST" action="{{ route('excel.importCours') }}" enctype="multipart/form-data" >

            <!-- CSRF Token -->
            @csrf

            <input type="file" name="fichier" >

            <button type="submit" >Importer les cours</button>

        </form>
    </div>

@endsection
