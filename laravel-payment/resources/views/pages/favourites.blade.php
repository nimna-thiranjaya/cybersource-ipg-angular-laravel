@include('layout.header')
@include('layout.sidebar')
<div class="main-panel">
    <div class="content-wrapper">
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" id="alert-message">
            {{ Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            @php
            Session::forget('success');
            @endphp

        </div>
        @endif

        @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" id="alert-message">
            {{ Session::get('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            @php
            Session::forget('error');
            @endphp
        </div>
        @endif
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Your Favourites ❤️</h3>
                        <h6 class="font-weight-normal mb-0">
                            You can add notes to your favourites by clicking on the heart icon on the top right corner
                            of the note.
                            <span class="text-primary">
                                3 Favorite Notes
                            </span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <section class="articles">

            @foreach($favouriteNotes as $note)
            <article>
                <div class="article-wrapper">
                    <figure onclick="openDateViewModal(this)" data-item-id="{{ $note->id }}">
                        <img src="{{$note->note_image}}" alt="" />
                    </figure>
                    <div class="article-body">
                        <h3>{{$note->note_title}}</h3>
                        <h5 style="display: flex; align-items: center; margin: 10px 0px;
                      "><i class="icon-folder"></i> <span class="mt-1 ml-1">{{$note->category_name}}</span></h5>
                        <div>
                            {!! Str::limit(strip_tags($note->note), 200) !!}

                        </div>
                        <!-- ----Add edit and delete and favourites buttons here---- -->
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <button class="btn btn-primary btn-sm" onclick="update({{ $note->id }})">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="openModal(this)"
                                    data-item-id="{{ $note->id }}">Delete</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-primary btn-sm float-right"
                                    onclick="addToUnFavorites({{$note->id}})">Unfavourite</button>
                            </div>
                        </div>
                    </div>
            </article>
            @endforeach

            <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure want to delete this note?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Confirm Delete</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
                style="
                        overflow: hidden;
                        margin-top: -40px;
                    " aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="
                        overflow-y: auto;
                        height: calc(100vh - 120px);
                    ">
                        <div class="modal-header">
                            <div class="avatar ml-2">
                                <img src="https://res.cloudinary.com/desnqqj6a/image/upload/v1690091561/7648864_lv8zvg.jpg"
                                    alt="" style="
    width: 60px;
    height: 60px;
    border-radius: 50%;
       " />
                            </div>
                            <div class='col' style="margin-top:-5px">

                                <h3 class="">Notebook Blog</h3>

                                <h6 class="text-muted" style="display:flex; align-items:center;"><i
                                        class="icon-folder mr-2"></i> <span class="mt-1 category-name">My
                                        Notebook</span></h6>



                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <img src="https://picsum.photos/id/1011/800/450" alt="" style="width:100%" />
                            <div class="modal-text mt-4">
                                ...
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <!-- partial -->
    </div>
    @include('layout.footer')
    <script>
    $(document).ready(function() {

    });
    document.addEventListener('DOMContentLoaded', function() {
        const Alert = document.getElementById('alert-message');
        // Hide the success alert after 2 seconds
        setTimeout(function() {
            Alert.style.display = 'none';
        }, 3000);
    });

    function openModal(button) {
        const itemId = button.getAttribute('data-item-id');
        $('#deleteConfirmationModal').modal('show');

        // Attach a click event to the "Confirm Delete" button inside the modal
        $('#confirmDeleteBtn').on('click', function() {
            deleteItem(itemId)
        });
    }

    function deleteItem(itemId) {
        const deleteUrl = "{{ URL::to('deletenote/') }}" + "/" + itemId;
        window.location.href = deleteUrl;
    }

    function addToUnFavorites(id) {
        const addToUnFavoritesUrl = "{{ URL::to('add-unfavorite/') }}" + "/" + id;
        window.location.href = addToUnFavoritesUrl;
    }

    function update(itemId) {
        const updateurl = "{{ URL::to('update-note/') }}" + "/" + itemId;
        window.location.href = updateurl;
    }

    function openDateViewModal(button) {
        const itemId = button.getAttribute('data-item-id');
        const viewModal = $('#viewModal');



        $.ajax({
            url: "{{ URL::to('get-specific-note/') }}" + "/" + itemId,
            type: "GET",
            dataType: "json",
            success: function(response) {
                viewModal.find('.blog-name').text(response.note_title);
                viewModal.find('.modal-body').find('img').attr('src', response.note_image);
                viewModal.find('.modal-text').html(response.note);
                viewModal.find('.category-name').text(response.category_name);


                // Show the modal after updating its content
                viewModal.modal('show');
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    </script>
