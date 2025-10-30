@extends('admin.layouts.app')

@section('title')
    Voice Index
@endsection

@section('body')
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Voices Index</li>
                </ol>
            </nav>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#voiceModal"
                onclick="openVoiceModal('add')">
                Add Voice
            </button>
        </div>

        <div class="col-xl-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 style="font-size: 20px;font-weight:800">Voices List</h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-striped text-center align-middle">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Audio</th>
                                    <th>Note</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($voices as $voice)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $voice->title }}</td>
                                    <td>
                                        <audio controls>
                                            <source src="{{ asset($voice->audio_path) }}" type="audio/mpeg">
                                        </audio>



                                    </td>
                                    <td>{{ $voice->note }}</td>
                                    <td>
                                        <a href="#"
                                            class="btn btn-light btn-sm rounded-circle border"
                                            title="Edit"
                                            onclick="openVoiceModal('edit', '{{ $voice->id }}', @js($voice->title), '{{ asset('storage/' . $voice->audio_path) }}', @js($voice->note))">
                                            <i class="fa fa-pen-to-square text-warning"></i>
                                        </a>

                                        <button class="btn btn-light btn-sm rounded-circle border deleteVoice" title="Delete" data-id="{{ $voice->id }}">
                                            <i class="fa fa-trash text-danger"></i>
                                        </button>
                                    </td>
                                </tr>
                                 @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Voice Modal -->
    <div class="modal fade" id="voiceModal" tabindex="-1" role="dialog" aria-labelledby="voiceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="voiceModalLabel">Add Voice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>

                <form id="voiceForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="voice_id" value="" id="voiceId">

                        <div class="form-group mb-3">
                            <label for="voiceTitle">Title</label>
                            <input type="text" name="title" value=""  id="voiceTitle" class="form-control"
                                placeholder="Enter voice title" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="voiceFile">Audio File</label>
                            <input type="file" name="audio" value="" id="voiceFile" class="form-control" accept="audio/*"
                                onchange="previewAudio(event)">
                            <audio id="audioPreview" controls class="mt-2" style="display:none; width:100%;"></audio>
                        </div>

                        <div class="form-group mb-3">
                            <label for="voiceNote">Note</label>
                            <textarea name="note" id="voiceNote" class="form-control" rows="3"
                                placeholder="Enter note..."></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="voiceSaveBtn">Save Voice</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Audio preview
            function previewAudio(event) {
                const file = event.target.files[0];
                const audioPreview = document.getElementById('audioPreview');
                if (file) {
                    audioPreview.src = URL.createObjectURL(file);
                    audioPreview.style.display = 'block';
                } else {
                    audioPreview.style.display = 'none';
                }
            }

            // Open modal for add/edit
            function openVoiceModal(action, id = null, title = '', audio = '', note = '') {
                const modalLabel = document.getElementById('voiceModalLabel');
                const saveBtn = document.getElementById('voiceSaveBtn');
                const voiceForm = document.getElementById('voiceForm');

                document.getElementById('voiceId').value = id || '';
                document.getElementById('voiceTitle').value = title || '';
                document.getElementById('voiceNote').value = note || '';
                document.getElementById('voiceFile').value = '';
                document.getElementById('audioPreview').style.display = audio ? 'block' : 'none';
                if (audio) {
                    document.getElementById('audioPreview').src = audio;
                }

                if (action === 'edit') {
                    modalLabel.textContent = 'Edit Voice';
                    saveBtn.textContent = 'Update Voice';
                } else {
                    modalLabel.textContent = 'Add Voice';
                    saveBtn.textContent = 'Save Voice';
                }

                $('#voiceModal').modal('show');
            }

            $(document).ready(function(){
                $('#voiceForm').on('submit', function(e){
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        url: '{{ url("/createVoices") }}',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response){
                            alert('Voice saved successfully!');
                            location.reload();
                        },
                        error: function(xhr){
                            alert('An error occurred while saving the voice.');
                        }
                    });
                })
            })
        </script>
    @endpush --}}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
function previewAudio(event) {
    const file = event.target.files[0];
    const audioPreview = document.getElementById('audioPreview');
    if (file) {
        audioPreview.src = URL.createObjectURL(file);
        audioPreview.style.display = 'block';
    } else {
        audioPreview.style.display = 'none';
    }
}

function openVoiceModal(action, id = null, title = '', audio = '', note = '') {
    const modalLabel = document.getElementById('voiceModalLabel');
    const saveBtn = document.getElementById('voiceSaveBtn');

    document.getElementById('voiceId').value = id || '';
    document.getElementById('voiceTitle').value = title || '';
    document.getElementById('voiceNote').value = note || '';
    document.getElementById('voiceFile').value = '';

    const audioPreview = document.getElementById('audioPreview');
    if (audio) {
        audioPreview.src = audio;
        audioPreview.style.display = 'block';
    } else {
        audioPreview.style.display = 'none';
    }

    if (action === 'edit') {
        modalLabel.textContent = 'Edit Voice';
        saveBtn.textContent = 'Update Voice';
    } else {
        modalLabel.textContent = 'Add Voice';
        saveBtn.textContent = 'Save Voice';
    }

    $('#voiceModal').modal('show');
}

document.addEventListener('DOMContentLoaded', function () {
    // AJAX Submit
    $('#voiceForm').on('submit', function (e) {
        e.preventDefault();

        var voiceId = $('#voiceId').val();
        var formData = new FormData(this);
        var url = voiceId ? `/editVoice/${voiceId}` : `/createVoices`;
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message,
                    timer: 1500,
                    showConfirmButton: false
                });
                setTimeout(() => location.reload(), 1600);
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while saving the voice.'
                });
            }
        });
    });
});
$(document).on('click', '.deleteVoice', function(){
    var button = $(this); // ✅ store reference
    var VoiceId = button.data('id');
    $.ajax({
        url: '/deleteVoice/' + VoiceId,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}' // ✅ always include CSRF token for POST in Laravel
        },
        success: function(response){
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: response.message,
                timer: 1500,
                showConfirmButton: false
            });
             button.closest('tr').fadeOut(500, function() {
                $(this).remove();
            });;
        },
        error: function(xhr){
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'An error occurred while deleting the voice.'
            });
        }
    })
})
</script>

@endsection
