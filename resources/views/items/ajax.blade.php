@extends('layouts.app')

@section('content')
    <div class="container" id="app">
        <h1>Items List</h1>

        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('items.create') }}" class="btn btn-primary">Create Item</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3" v-for="(item, index) in items" :key="index">
                <div class="card">
                    <div class="card-body" style="margin-bottom: 2px;">
                        <div style="float:left; padding-right:20px;">
                            <p class="card-text">@{{ item.quantity }} @{{ item.measure }}</p>
                        </div>
                        <div style="padding-left:20px;">
                            <h4 class="card-title" :class="{ 'crossed-out': item.nakupljeno }">@{{ item.Items }}</h4>
                            <input type="checkbox" v-model="item.nakupljeno" @change="updateNakupljeno(item)">
                            <a :href="'/items/' + item.id + '/edit'" class="btn btn-sm btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Include Vue.js from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        new Vue({
            el: '#app',
            data: {
                itemId: {!! json_encode($item->id) !!}, // Convert PHP array to JSON for Vue
            },
            methods: {
                updateNakupljeno(item) {
                    // Send AJAX request to update 'nakupljeno' parameter
                    axios.post(`/items/${itemId}/toggle-nakupljeno`, {nakupljeno: 1,
                }).then(response => {
                    // Handle success if needed
                }).catch(error => {
                    console.error('Error updating nakupljeno:', error);
                });
                }
            }
        });
    </script>
@endsection
