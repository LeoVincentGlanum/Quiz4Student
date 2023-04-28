
@extends(backpack_view('blank'))

@section('content')

    <div class="container">
        <h1>Parametrage du questionnaire</h1>
        <form method="post" action="{{route('parameters.changeNbQuestions')}}">
            @csrf
            <div class="form-group">
                <label for="numberQuestions" class="form-label mt-4">Nombres de question par test</label>
                <input type="number" value="{{$checkParameter}}" name="nbQuestions" class="form-control" id="numberQuestions" aria-describedby="numberQuestions" placeholder="Enter le nombre de question par test">
            </div>
            <button type="submit" class="btn btn-primary">Sauvegarder</button>
        </form>
    </div>
@endsection
