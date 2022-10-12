<!DOCTYPE html>
<html>
<head>
    <title>Archive Upload</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>Arsipkan Surat</h2>
            </div>
        </div>
        <form action="{{ route('archive.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nomor Surat:</strong>
                        <input type="text" name="letter_number" class="form-control" placeholder="Nomor Surat">
                        @error('letter_number')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Kategori:</strong>
                        <select class="form-control" name="category" id="category">
                            @foreach($category as $cat)
                                <option value="{{$cat->id}}">{{$cat->archive_category}}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Judul:</strong>
                        <input type="text" name="title" class="form-control" placeholder="Judul">
                        @error('title')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="document">Documents</label>
                        <div class="needsclick dropzone" id="document-dropzone">

                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('archive.index') }}"> Kembali</a>
                </div>
                <button type="submit" class="btn btn-primary ml-3">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- CSS assets in head section --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />

{{-- ... a lot of main HTML code ... --}}

{{-- JS assets at the bottom --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
{{-- ...Some more scripts... --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

<script>
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
        url: '{{ route('archive.storeMedia') }}',
        maxFilesize: 5, // MB
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
        },
        removedfile: function (file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="document[]"][value="' + name + '"]').remove()
        },
        init: function () {
            @if(isset($project) && $project->document)
            var files =
                {!! json_encode($project->document) !!}
                for (var i in files) {
                var file = files[i]
                this.options.addedfile.call(this, file)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
            }
            @endif
        }
    }
</script>
</body>
</html>
