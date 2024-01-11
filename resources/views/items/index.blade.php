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
            <div class="col-md-12 mb-3" v-for="item in items" :key="item.id">
                <div class="card">
                    <div class="card-body" style="margin-bottom: 2px;">
                        <div style="float:left; padding-right:20px;">
                            <!-- Disable the checkbox if nakupljeno is true -->
                            <input type="checkbox" :checked="item.nakupljeno == 1" :disabled="item.nakupljeno == 1" @change="updateNakupljeno(item)">
                        </div>
                        <div style="float:left; padding-right:20px;">
                            <p class="card-text">@{{ item.quantity }} @{{ item.measure }}</p>
                        </div>
                        <div style="padding-left:20px;">
                            <h4 class="card-title" v-html="item.displayedItems"></h4>
                            <a :href="'/items/' + item.id + '/edit'" class="btn btn-sm btn-primary">Edit</a>
                            <button @click="deleteItem(item)" class="btn btn-sm btn-danger">Delete</button>
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
                // Initialize nakupljeno to 0 if it's undefined (consider adjusting your data structure)
                this.$set(item, 'nakupljeno', 0);
            }

            item.nakupljeno = !item.nakupljeno;
console.log(item.nakupljeno);
            if (item.nakupljeno) {
                // If nakupljeno is true, show crossed-out text
                var str = item.Items;
                item.displayedItems = str.includes('<strong>') ? str.replace(/<strong>(.*?)<\/strong>/, '<del>$1</del>') : `<del>${str}</del>`;
            } else {
                // If nakupljeno is false, show strong text
                var str = item.Items;
                item.displayedItems = str.includes('<strong>') ? str.replace(/<strong>(.*?)<\/strong>/, '<del>$1</del>') : `<del>${str}</del>`;
            }

            // Disable the checkbox after updating
            this.$nextTick(() => {
                item.disableCheckbox = true;
            });

            axios.post(`/items/${item.id}/toggle-nakupljeno`)
                .then(response => {
                    console.log('Success:', response.data);
                })
                .catch(error => {
                    console.error('Error updating nakupljeno:', error.response.data);
                    // Revert the change if there's an error
                    item.nakupljeno = !item.nakupljeno;
                    // Revert displayedItems as well
                    item.displayedItems = item.nakupljeno ? `<del>${item.Items}</del>` : item.Items;
                })
                .finally(() => {
                    // Re-enable the checkbox after the request is complete
                    this.$nextTick(() => {
                        item.disableCheckbox = false;
                    });
                });
        },
        deleteItem(item) {
            axios.delete(`/items/${item.id}`)
                .then(response => {
                    console.log('Success:', response.data);
                    // Remove the item from the items array
                    this.items = this.items.filter(i => i.id !== item.id);
                })
                .catch(error => {
                    console.error('Error deleting item:', error.response.data);
                });
        }
    },
    created() {
        // Initialize displayedItems based on the initial state of nakupljeno
        this.items.forEach(item => {
            item.displayedItems = item.nakupljeno == 1 ? `<del>${item.Items}</del>` : `<strong>${item.Items}</strong>`;
            item.disableCheckbox = false; // Initialize disableCheckbox to false
        });
    }
});
</script>
@endsection
