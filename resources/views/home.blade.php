@extends('layouts/layout')

@section('title', 'Home')

@section('content')
<main>
    <div class="container-fluid w-50 py-5">
        <form action="{{ route('main.search') }}" method="get" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" id="search" name="search" placeholder="Search notes with heading">
                <button class="btn btn-bd-primary px-3" type="submit">Search</button>
            </div>
        </form>

        @if ($results = Session::get('results'))
            @if ($results->isEmpty())
                <p class="text-body-secondary">No results found.</p>
            @else
                <p>Results</p>
                @foreach ($results as $result)
                    <div class="card w-100 mb-3" data-bs-toggle="modal" data-bs-target="#noteModal-{{$result->id}}" type="button">
                        <div class="card-body">
                            <div class="card-title fs-5">
                                <h3>{{$result->heading}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="noteModal-{{$result->id}}" tabindex="-1" aria-labelledby="noteModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="{{ route('main.edit', ['id' => $result->id]) }}" method="post" class="px-4">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="heading" class="form-label">Heading</label>
                                                <input type="text" class="form-control w-100" id="heading" name="heading"
                                                    value="{{$result->heading}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="note" class="form-label">Note</label>
                                                <textarea class="form-control" id="note" name="note" rows="15"
                                                    required>{{$result->note}}</textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-bd-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                                <div class="col-6 d-flex justify-content-end">
                                                    <button type="submit" id="edit" class="btn btn-bd-primary">Save</button>
                                        </form>
                                        <form action="{{ route('main.delete', ['id' => $result->id]) }}" method="post" class="ms-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" id="delete" class="btn btn-bd-delete">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                @endforeach
            @endif
        @endif

        @if ($data->isEmpty())
            <p class="text-body-secondary">No notes yet.</p>
        @else
                <p>Notes</p>
                @foreach ($data as $note)
                        <div class="card w-100 mb-3" data-bs-toggle="modal" data-bs-target="#noteModal-{{$note->id}}" type="button">
                            <div class="card-body">
                                <div class="card-title fs-5">
                                    <h3>{{$note->heading}}</h3>
                                </div>
                                <p class="card-text">{{$note->note}}</p>
                            </div>
                        </div>
                        <div class="modal fade" id="noteModal-{{$note->id}}" tabindex="-1" aria-labelledby="noteModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="{{ route('main.edit', ['id' => $note->id]) }}" method="post" class="px-4">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="heading" class="form-label">Heading</label>
                                                <input type="text" class="form-control w-100" id="heading" name="heading"
                                                    value="{{$note->heading}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="note" class="form-label">Note</label>
                                                <textarea class="form-control" id="note" name="note" rows="15"
                                                    required>{{$note->note}}</textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-bd-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                                <div class="col-6 d-flex justify-content-end">
                                                    <button type="submit" id="edit" class="btn btn-bd-primary">Save</button>
                                        </form>
                                        <form action="{{ route('main.delete', ['id' => $note->id]) }}" method="post" class="ms-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" id="delete" class="btn btn-bd-delete">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                @endforeach
        @endif

    @if (Session::get('fail'))
        <div class="alert alert-danger w-100">
            {{Session::get('fail')}}
        </div>
    @endif
    <button type="button" class="btn btn-bd-secondary w-100" data-bs-toggle="modal" data-bs-target="#addNoteModal">
        + Add Note</button>
    <div class="modal fade" id="addNoteModal" tabindex="-1" aria-labelledby="addNoteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header px-5">
                    <h1 class="modal-title fs-5" id="addNoteModalLabel">Add Note</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('main.add') }}" method="post" class="px-4">
                        @csrf
                        <div class="mb-3">
                            <label for="heading" class="form-label">Heading</label>
                            <input type="text" class="form-control w-100" id="heading" name="heading"
                                placeholder="Add a heading" required>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <textarea class="form-control" id="note" name="note" rows="15"
                                placeholder="Write something..." required></textarea>
                        </div>
                        <button type="button" class="btn btn-bd-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-bd-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
@endsection