@extends('auth.layouts')

@section('content')
    <div class="container" id="app">
        <h1>Items List</h1>

        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('items.create') }}" class="btn btn-primary">Create Item</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-12" v-for="item in items" :key="item.id">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="col-md-1">
                            <!-- Display the checkbox or "KUPLJENO" badge based on nakupljeno -->
                            <input v-if="!item.nakupljeno" type="checkbox" :checked="item.nakupljeno == 1" :disabled="item.nakupljeno == 1" @change="updateNakupljeno(item)">
                            <span v-else>&#128176</span>
                        </div>
                        <div class="col-md-3">
                            <p class="card-text">@{{ item.quantity }} @{{ item.measure }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4 class="card-title" v-html="item.displayedItems"></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="btn-group">
                                <!-- Display the "Edit" button if nakupljeno is false -->
                                <a v-if="!item.nakupljeno" :href="'/items/' + item.id + '/edit'" class="btn btn-sm btn-primary" style="width:70px;padding:5px;">Edit</a>
                                <a v-else class="btn btn-sm btn-secondary" style="width:70px;padding:5px;">Edit</a>
                                <button @click="deleteItem(item)" class="btn btn-sm btn-danger" style="margin-left:5px;width:70px;padding:5px;">Delete</button>
                            </div>
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
        updateNakupljeno(item) {
            if (item.nakupljeno === undefined) {
                this.$set(item, 'nakupljeno', 0);
            }

            item.nakupljeno = !item.nakupljeno;
            if (item.nakupljeno) {
                var str = item.Items;
                item.displayedItems = str.includes('<strong>') ? str.replace(/<strong>(.*?)<\/strong>/, '<del>$1</del>') : `<del>${str}</del>`;
            } else {
                var str = item.Items;
                item.displayedItems = str.includes('<strong>') ? str.replace(/<strong>(.*?)<\/strong>/, '<del>$1</del>') : `<del>${str}</del>`;
            }

            this.$nextTick(() => {
                item.disableCheckbox = true;
            });

            axios.post(`/items/${item.id}/toggle-nakupljeno`)
                .then(response => {
                    console.log('Success:', response.data);
                })
                .catch(error => {
                    console.error('Error updating nakupljeno:', error.response.data);
                    item.nakupljeno = !item.nakupljeno;
                    item.displayedItems = item.nakupljeno ? `<del>${item.Items}</del>` : item.Items;
                })
                .finally(() => {
                    this.$nextTick(() => {
                        item.disableCheckbox = false;
                    });
                });
        },
        deleteItem(item) {
            axios.delete(`/items/${item.id}`)
                .then(response => {
                    console.log('Success:', response.data);
                    this.items = this.items.filter(i => i.id !== item.id);
                })
                .catch(error => {
                    console.error('Error deleting item:', error.response.data);
                });
        }
    },
    created() {
        this.items.forEach(item => {
            item.displayedItems = item.nakupljeno == 1 ? `<del>${item.Items}</del>` : `<strong>${item.Items}</strong>`;
            item.disableCheckbox = false;
        });
    }
});
</script>
@endsection
