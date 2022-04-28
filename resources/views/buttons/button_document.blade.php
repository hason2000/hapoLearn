@if (Auth::check())
    @forelse (Auth::user()->documents as $key => $documentGet)
        @if ($documentGet->id == $document->id)
            <button class="doc-btn btn-learned">Learned</button>
            @break
        @endif
        @if ($key == count(Auth::user()->documents) - 1)
            <form action="{{ route('users-documents.store') }}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="document_id" value="{{ $document->id }}">
                <button type="submit" class="doc-btn">Learn</button>
            </form>
        @endif 
    @empty
        <form action="{{ route('users-documents.store') }}" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="document_id" value="{{ $document->id }}">
            <button type="submit" class="doc-btn">Learn</button>
        </form>
    @endforelse
@else
    <form action="{{ route('users-documents.store') }}" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="document_id" value="{{ $document->id }}">
        <button type="submit" class="doc-btn">Learn</button>
    </form>
@endif
