@extends('admin.layouts.app-admin')
<style type="text/css">
textarea {
    width: 100%;
    height: 250px;
}
.ck-content
{
    height: 250px;
    overflow-y: auto;
    overflow-x: hidden;
}

</style>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
@section('content')
<style type="text/css"></style>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                           <div class="text-end">
                         <a href = "{{ route('venue/index') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>List Venue
                           </a>
                        </div>
                        <div class="row">
                      
                        <form class="form-horizontal" role="form" method = "post" action="{{ route('venue.content_add') }}">
                        @csrf

                        <input type="hidden" name="venue_id" value="{{ $venue->id }}">
                        <div class="col-12">
                        <div class="mb-4 row">
                            <label class="col-md-2 col-form-label" for="description">Description</label>
                            <div class="col-md-10">
                                <textarea id="editor" name="description" class="form-control" placeholder="Enter Description">
                                 {{ $venuecontent->description ?? ''}}
                                </textarea>
                            </div>

                        </div>

                   

                        <div class="mb-4 row">
                            <label class="col-md-2 col-form-label" for="key_features">Key Features</label>
                            <div class="col-md-10">
                                <textarea id="editorkey" name="key_features" class="form-control" placeholder="Enter Key Features">
                                 {{ $venuecontent->key_features ?? ''}}
                                </textarea>
                            </div>

                        </div>

                        <div class="mb-4 row">
                            <label class="col-md-2 col-form-label" for="ambience">Ambience</label>
                            <div class="col-md-10">
                                <textarea id="editorambience" name="ambience" class="form-control" placeholder="Enter Ambience">
                                 {{ $venuecontent->ambience ?? ''}}
                                </textarea>
                            </div>

                        </div>

                        <div class="mb-4 row">
                            <label class="col-md-2 col-form-label" for="event_sustability">Event Sustability</label>
                            <div class="col-md-10">
                                <textarea id="event_sustability" name="event_sustability" class="form-control" placeholder="Enter Sustability">
                                 {{ $venuecontent->event_sustability ?? ''}}
                                </textarea>
                            </div>

                        </div>

                        <div class="mb-4 row">
                            <label class="col-md-2 col-form-label" for="amenities">Amenities</label>
                            <div class="col-md-10">
                                <textarea id="editoramenities" name="amenities" class="form-control" placeholder="Enter Amenities">
                                 {{ $venuecontent->amenities ?? ''}}
                                </textarea>
                            </div>

                        </div>

                        
                        <div class="mb-4 row">
                            <label class="col-md-2 col-form-label" for="policy">Policy</label>
                            <div class="col-md-10">
                                <textarea id="editorpolicy" name="policy" class="form-control" placeholder="Enter Policy">
                                 {{ $venuecontent->policy ?? ''}}
                                </textarea>
                            </div>

                        </div>


                        </div>

                        <br><br>
                        <div class="justify-content-end row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Update Content</button>
                            </div>
                        </div>



      
                        </form>

                        
                            
                      </div>
                    </div>
              




                    </div>
                </div>
            </div>
       
@endsection
@push('scripts')

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

        ClassicEditor.create(document.querySelector('#editorkey')).catch(error => {
            console.error(error);
        });

        ClassicEditor.create(document.querySelector('#editorambience')).catch(error => {
            console.error(error);
        }); 
        ClassicEditor.create(document.querySelector('#event_sustability')).catch(error => {
            console.error(error);
        });

        ClassicEditor.create(document.querySelector('#editoramenities')).catch(error => {
            console.error(error);
        });
        ClassicEditor.create(document.querySelector('#editorpolicy')).catch(error => {
            console.error(error);
        });

</script>
@endpush
