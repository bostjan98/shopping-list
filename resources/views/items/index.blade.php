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
            <div class="col-md-12 mb-3" v-for="item in items" :key="item.id">
                <div class="card">

                    <div class="card-body" style="margin-bottom: 2px;">
                        <div style="float:left; padding-right:20px;"><input type="checkbox" :checked="item.nakupljeno" @click="updateNakupljeno(item.id)"></div>
                        <div style="float:left; padding-right:20px;">
                            <p class="card-text">@{{ item.quantity }} @{{ item.measure }}</p>
                        </div>
                        <div style="padding-left:20px;">
                            <h4 class="card-title" v-html="item.Items">@{{ item.Items }}</h4>
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
        items: {!! isset($items) ? json_encode($items) : '[]' !!},
    },
    methods: {
    updateNakupljeno(itemId) {
        const item = this.items.find(item => item.id === itemId);
        if (item) {
            item.nakupljeno = !item.nakupljeno;
            if (item.nakupljeno) {
                    // If nakupljeno is true, show crossed-out text
                    item.Items = `<del>${item.Items}</del>`;
                } else {
                    // If nakupljeno is false, show strong text
                    item.Items = `<strong>${item.Items}</strong>`;
                }
            axios.post(`/items/${itemId}/toggle-nakupljeno`)
                .then(response => {
                    console.log('Success:', response.data);
                })
                .catch(error => {
                    console.error('Error updating nakupljeno:', error.response.data);
                    // Revert the change if there's an error
                    item.nakupljeno = !item.nakupljeno;
                });
        }
    }
}
});
</script>
@endsection
