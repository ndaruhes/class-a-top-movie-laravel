<div class="modal fade" id="createMovieModal" tabindex="-1" aria-labelledby="createMovieModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createMovieModalLabel"><i class="uil uil-plus-circle me-1"></i>Buat Movie Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storeMovie') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Thumbnail Film</label>
                        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"  name="thumbnail" value="{{ old('thumbnail') }}">
                        @error('thumbnail')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Judul Film</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                            placeholder="Judul Film..." name="title" value="{{ old('title') }}">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Film</label>
                        <textarea rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Deskripsi Film..." name="description">
                            {{ old('description') }}
                        </textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                     <div class="form-group">
                        <label>Tahun Rilis</label>
                        <input type="number" class="form-control @error('tahun_rilis') is-invalid @enderror"
                            placeholder="Tahun Rilis..." name="tahun_rilis" value="{{ old('tahun_rilis') }}">
                        @error('tahun_rilis')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                     <div class="form-group">
                        <label>Genre</label>
                        <select class="form-control @error('genre') is-invalid @enderror" name="genre">
                            @foreach($genres as $genre)
                                <option value="{{$genre->id}}">{{$genre->title}}</option>
                            @endforeach
                        </select>
                        @error('genre')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
