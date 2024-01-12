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
            <div class="col-md-12" ref="pagination">
                {{ $items->links('pagination::bootstrap-5') }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-12" v-for="item in items" :key="item.id">
                <div class="card" :class="{ 'bg-grey': item.nakupljeno }">
                    <div class="card-body d-md-flex align-items-center flex-column flex-md-row">
                        <div class="col-12 col-md-1 mb-2 mb-md-0">
                            <!-- Display the checkbox or "KUPLJENO" badge based on nakupljeno -->
                            <input v-if="!item.nakupljeno" type="checkbox" :checked="item.nakupljeno == 1" :disabled="item.nakupljeno == 1" @change="updateNakupljeno(item)">
                            <span v-else>&#128176</span>
                        </div>
                        <div class="col-12 col-md-3 text-center text-md-left mb-2 mb-md-0">
                            <p class="card-text">@{{ item.quantity }} @{{ item.measure }}</p>
                        </div>
                        <div class="col-12 col-md-6 text-center text-md-left mb-2 mb-md-0">
                            <h4 class="card-title" v-html="item.displayedItems"></h4>
                        </div>
                        <div class="col-12 col-md-2 text-center text-md-right">
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
        <div class="row">
            <div class="col-md-12" ref="pagination">
                {{ $items->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- Include Vue.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    var itemsData = {!! json_encode($items) !!};
    new Vue({
    el: '#app',
    data: {
        items: itemsData.data,
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

                    const index = this.items.findIndex(i => i.id === item.id);
                    if (index !== -1) {
                        this.items.splice(index, 1);

                        // Check if there are more items on the current page
                        if (this.items.length === 0) {
                            // If the current page becomes empty, navigate to the previous page
                            const currentPage = this.$route ? (parseInt(this.$route.params.page) || 1) : 1;
                            console.log('page:'+currentPage);
                            if (currentPage > 1) {
                                this.fetchItems(currentPage - 1);
                                this.$router.push({ name: this.$route.name, query: { page: currentPage - 1 } });
                            }
                        }
                    }
                })
                .catch(error => {
                    console.error('Error deleting item:', error.response ? error.response.data : error.message);
                });
        },
        fetchItems(page = 1) {
            axios.get(`/items?page=${page}`)
                .then(response => {
                    this.items = response.data && response.data.data ? response.data : { data: [] }; // Check if response.data and response.data.data are defined
                    this.items.data.forEach(item => {
                        item.displayedItems = item.nakupljeno == 1 ? `<del>${item.Items}</del>` : `<strong>${item.Items}</strong>`;
                        item.disableCheckbox = false;
                    });

                    if (this.items.data.length === 0 && this.items.last_page > 0) {
                        // If the current page becomes empty, navigate to the last page
                        this.$router.push({ name: this.$route.name, query: { page: this.items.last_page } });
                    }
                })
                .catch(error => {
                    console.error('Error fetching items:', error.response ? error.response.data : error.message);
                });
            },
    },
    created() {
        if (this.items.length > 0) {
            this.items.forEach(item => {
                item.displayedItems = item.nakupljeno == 1 ? `<del>${item.Items}</del>` : `<strong>${item.Items}</strong>`;
                item.disableCheckbox = false;
            });
        } else {
            this.fetchItems(this.$route.query.page || 1);
            this.currentPage = parseInt(this.$route.query.page) || 1;
        }
    },
    watch: {
        // Use the beforeRouteUpdate guard to update the currentPage variable
        '$route'() {
            if (this.$route.query.page && this.$route.query.page !== 'undefined') {
                this.fetchItems(this.$route.query.page);
                this.currentPage = parseInt(this.$route.query.page); // Update the currentPage variable
            }
        },
    },
    beforeRouteUpdate(to, from, next) {
        // Update the currentPage variable when the route is about to change
        this.currentPage = parseInt(to.query.page) || 1;
        next();
    },
});
</script>
@endsection
