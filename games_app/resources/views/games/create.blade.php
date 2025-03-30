@extends('layouts.app')

@section('content')
    <div id="app" class="container"
         data-csrf="{{ csrf_token() }}"
    >
        @csrf <!-- {{ csrf_field() }} -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <h1>Add game</h1>

        <form @submit.prevent="submitForm" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" v-model="form.title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Developer</label>
                <input type="text" v-model="form.developer" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Release Date</label>
                <input type="date" v-model="form.release_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" v-model="form.price" step="0.01" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Genre</label>
                <input type="text" v-model="form.genre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Platform</label>
                <input type="text" v-model="form.platform" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Cover (Image)</label>
                <input type="file" @change="handleFileUpload" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-success">Add</button>
            <a href="{{ route('games.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Vue({
                el: "#app",
                data() {
                    return {
                        form: {
                            title: "",
                            developer: "",
                            release_date: "",
                            price: "",
                            genres: [],
                            platforms: [],
                            cover: null,
                        },
                        genres: [],
                        platforms: [],
                        storeUrl: "{{ route('games.store') }}",
                        csrfToken: ""
                    };
                },
                mounted() {
                    const app = document.getElementById('app');
                    if (app) {
                        this.genres = JSON.parse(app.getAttribute('data-genres'));
                        this.platforms = JSON.parse(app.getAttribute('data-platforms'));
                        this.csrfToken = app.getAttribute('data-csrf');
                    }
                },
                methods: {
                    handleFileUpload(event) {
                        this.form.cover = event.target.files[0];
                    },
                    submitForm() {
                        let formData = new FormData();
                        console.log(this.form)
                        formData.append("title", this.form.title);
                        formData.append("developer", this.form.developer);
                        formData.append("genre", this.form.genre);
                        formData.append("platform", this.form.platform);
                        formData.append("release_date", this.form.release_date);
                        formData.append("price", this.form.price);


                        if (this.form.cover) {
                            formData.append("cover", this.form.cover);
                        }

                        axios.post(this.storeUrl, formData, {
                            headers: {
                                "X-CSRF-TOKEN": this.csrfToken,
                                "X-Requested-With": "XMLHttpRequest",
                                "Accept": "application/json"
                            }
                        })
                            .then(response => {
                                console.log(response.data);
                                if (response.data.success) {
                                    window.location.href = "{{ route('games.index') }}";
                                } else {
                                    alert("Error while adding game");
                                }
                            })
                            .catch(error => {
                                console.error("Error:", error.response ? error.response.data : error);
                            });
                    }
                }
            });
        });
    </script>

@endsection

